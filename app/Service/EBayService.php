<?php

namespace App\Service;

class EBayService
{

    /**
     * @var string
     */
    private $url;

    public function __construct()
    {
        $this->url = env('EBAY_SERVICE_URL');
    }

    private function generateURL($keyword, $filters) {
        $this->url .= "&keywords=$keyword";

        if (in_array('min_price', $filters)) {
            $this->url .= "&itemFilter.MinPrice=" . $filters['min_price'];
        }

        if (in_array('max_price', $filters)) {
            $this->url .= "&itemFilter.MaxPrice=" . $filters['min_price'];
        }

        $this->url .= "&sortOrder=Price";
    }

    private function formatResults($items) {
        return $items;
    }

    public function search($keyword, $filters) {
        $this->generateURL($keyword, $filters);
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: text/xml",
            "X-EBAY-SOA-SECURITY-APPNAME: " . env("EBAY_APPID"),
            "X-EBAY-SOA-OPERATION-NAME: " . env("EBAY_SOA_OPERATION"),
        ]);

        $XMLBody = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<findItemsByKeywordsRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
</findItemsByKeywordsRequest>
XML;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $XMLBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $decodeResponse = json_decode($response, true) ?? [];
        return !$decodeResponse ? [] : $this->formatResults($decodeResponse["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"]);
    }
}


