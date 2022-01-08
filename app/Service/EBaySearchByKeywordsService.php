<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class EBaySearchByKeywordsService extends EBayService
{
    /**
     * @param $keyword
     * @param $filters
     * @return bool|string
     */
    private function generateXMLBody($keyword, $filters) {
        $body = [
            "keywords" => $keyword,
        ];

        if (array_key_exists('price_min', $filters)) {
            if (!array_key_exists('itemFilter', $body)) {
                $body['itemFilter'] = [];
            }
            $body['itemFilter']['MinPrice'] = $filters['price_min'];
        }

        if (array_key_exists('price_max', $filters)) {
            if (!array_key_exists('itemFilter', $body)) {
                $body['itemFilter'] = [];
            }
            $body['itemFilter']['MaxPrice'] = $filters['price_max'];
        }

        if (!array_key_exists('paginationInput', $body)) {
            $body['paginationInput'] = [];
        }
        $body['paginationInput']['entriesPerPage'] = $filters['per_page'];
        $body['paginationInput']['pageNumber'] = $filters['page'];


        if (array_key_exists('sorting', $filters)) {
            if ($filters['sorting'] === 'by_price_asc') {
                $body['sortOrder'] = 'PricePlusShippingLowest';
            }
            // can add more sorting here
        }
        $xml = new SimpleXMLElement(
            '<findItemsByKeywordsRequest xmlns="http://www.ebay.com/marketplace/search/v1/services"/>'
        );

        $this->arrayToXML($body, $xml);

        return $xml->asXML();
    }


    /**
     * @param string $key
     * @param array $filters
     * @return array
     */
    public function search(string $key, array $filters): array
    {
        $xmlBody = $this->generateXMLBody($key, $filters);

        $response = Http::withHeaders([
            'X-EBAY-SOA-SECURITY-APPNAME' => env("EBAY_APPID"),
            'X-EBAY-SOA-OPERATION-NAME' => env("EBAY_SOA_OPERATION"),
        ])
            ->withBody($xmlBody, 'text/xml')
            ->post($this->url)->json();

        $response = !$response ? [] : $response["findItemsByKeywordsResponse"][0];

        $formattedItems = $this->formatResults(
            $response["searchResult"][0]["item"]
        );

        return [
            "items" => $formattedItems,
            "per_page" => $response['paginationOutput'][0]['entriesPerPage'][0],
            "page" => $response['paginationOutput'][0]['pageNumber'][0],
            "total_page" => $response['paginationOutput'][0]['totalPages'][0],
            "count" => $response['paginationOutput'][0]['totalEntries'][0],
        ];
    }
}
