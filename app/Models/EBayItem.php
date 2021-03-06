<?php

namespace App\Models;

class EBayItem
{
    /**
     * @var string
     */
    private $provider = "ebay";
    private $item_id;
    private $click_out_link;
    private $main_photo_url;
    private $price;
    private $price_currency;
    private $shipping_price;
    private $title;
    private $description;
    private $valid_until;
    private $brand;

    /**
     * @param $ebayItemArray
     */
    public function __construct($ebayItemArray)
    {
        $this->item_id = $ebayItemArray["itemId"][0];
        $this->click_out_link = $ebayItemArray["viewItemURL"][0];
        $this->main_photo_url = $ebayItemArray['galleryURL'][0];
        $this->price = $ebayItemArray['sellingStatus'][0]['currentPrice'][0]['__value__'];
        $this->price_currency = $ebayItemArray['sellingStatus'][0]['currentPrice'][0]['@currencyId'];
        if (array_key_exists('shippingServiceCost', $ebayItemArray['shippingInfo'][0])) {
            $this->shipping_price = $ebayItemArray['shippingInfo'][0]['shippingServiceCost'][0]['__value__'];
        }
        $this->title = $ebayItemArray['title'][0];
        // didn't see any kind of description in response
        $this->description = $ebayItemArray['title'][0];

        preg_match('/P?(\d+)DT?(\d+)H?(\d+)M?(\d+)S/', $ebayItemArray['sellingStatus'][0]['timeLeft'][0], $matches);
        if (count($matches) === 5) {
            $this->valid_until = $matches[1] . " day(s) " . $matches[2] . " hour(s) " . $matches[3] . " minute(s) " . $matches[4] . " second(s)";
        }else {
            $this->valid_until = $ebayItemArray['sellingStatus'][0]['timeLeft'][0];
        }
        // didn't find brand only see category
        $this->brand = $ebayItemArray['primaryCategory'][0]['categoryName'][0];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }


}
