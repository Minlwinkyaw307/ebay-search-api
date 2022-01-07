<?php

namespace App\Models;

class EBayItem
{
    private $provider = "ebay";
    private $itemId;
    private $clickOutLink;
    private $mainPhotoUrl;
    private $price;
    private $priceCurrency;
    private $shippingPrice;
    private $title;
    private $description;
    private $validUntil;
    private $brand;

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @param mixed $clickOutLink
     */
    public function setClickOutLink($clickOutLink): void
    {
        $this->clickOutLink = $clickOutLink;
    }

    /**
     * @param mixed $mainPhotoUrl
     */
    public function setMainPhotoUrl($mainPhotoUrl): void
    {
        $this->mainPhotoUrl = $mainPhotoUrl;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @param mixed $priceCurrency
     */
    public function setPriceCurrency($priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * @param mixed $shippingPrice
     */
    public function setShippingPrice($shippingPrice): void
    {
        $this->shippingPrice = $shippingPrice;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $validUntil
     */
    public function setValidUntil($validUntil): void
    {
        $this->validUntil = $validUntil;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }


}
