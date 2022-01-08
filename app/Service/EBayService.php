<?php

namespace App\Service;

use App\Models\EBayItem;

class EBayService
{

    /**
     * @var string
     */
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param array $items
     * @return array
     */
    protected function formatResults(array $items): array
    {
        $responses = collect([]);
        foreach($items as $item) {
            $ebayItem = new EBayItem($item);
            $responses->add($ebayItem->toArray());
        }
        return $responses->toArray();
    }

    /**
     * @param $data
     * @param $xml_data
     */
    protected function arrayToXML($data, &$xml_data) {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key; //dealing with <0/>..<n/> issues
                }
                $subNode = $xml_data->addChild($key);
                $this->arrayToXML($value, $subNode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

    /**
     * @param string $key
     * @param array $filters
     * @return array
     */
    public function search(string $key, array $filters): array
    {
        // This method is for other service creation.
        return [];
    }
}


