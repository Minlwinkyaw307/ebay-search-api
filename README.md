## **EBay Search API**

You can check out live demo from [here](http://ebay.minlwinkyaw.com)

## **Requirements**

1. PHP, >7.3 or >8.0 
2. Composer
3. Linux, MacOS (Didn't Test On Windows using setup command but can be installed easily)

## **How To Install**
* `git clone` this project and enter to the folder
* Create Database
* Create `.env`
* Copy `.env.example` to `.env`
* Fill `EBAY_APPID` with EBay Developer APPID
* To use Google Analytics add view id to .env as `ANALYTICS_VIEW_ID`
* run `php artisan server`
* Search API endpoint can be access through `<APP_URL>/api/search`

## Parameters For Search EndPoint

### URL 
###`<APP_URL>/api/search`


| Name | Type | Requirement | Description |
|---|---|---|---|
| keywords | string | required | Keyword that will be use for searching |
| min_price | number | optional | Min price for filtering items. Must be greater than 0 |
| max_price | number | optional | Max price for filtering items. Must be greater than 0 and Min price
| sorting | enum | optional | Way of sorting the result items. Options are `default` and `by_price_asc`. Default is default sorting by ebay and `by_price_asc` is sorting price lower to higher. |
| per_page | number | optional | Number of items to be showing each page of the request. Value can be between 1 to 25. If nothing was provided or greater than 25, 25 will be used as default |
| page | number | optional | Page number of pagination. Value must be greater than 1. If nothing was provided, 1 will be used as default. |

## Responses
| Key | Type | Description |
|---|---|---|
| items | Array | List of ebay item results |
| items.*.provider | string | Results service provider name |
| items.*.item_id | string | Current result item id |
| items.*.click_out_link | string | Current result's checkout detail product link |
| items.*.main_photo_url | string/null | Current result item's main photo |
| items.*.price | number | Current result item's price in provide currency |
| items.*.price_currency | string | Current result item's price currency name |
| items.*.shipping_price | number/null | Current result item's shipment cost |
| items.*.title | string | Title of the current item |
| items.*.description | string | Description of the current item |
| items.*.valid_until | string | Determine when current item will be still valid |
| items.*.brand | string | Category of the current item |
| per_page | number | Number of items per page |
| page | number | Current page number |
| total_page | number | Total number of pages can be formed by provided parameters. |
| count | number | Total number of items can be retrieved by provided parameters |
