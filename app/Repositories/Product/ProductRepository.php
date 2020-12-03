<?php

namespace App\Repositories\Product;

use App\Models\Price;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductPriceInfo;
use App\Models\ProductPriceInfoExtensionAttribute;

class ProductRepository
{
    /**
     * fetch
     *
     * @return void
     */
    public function fetch()
    {
        $response = Http::get(
            'http://59.92.233.19/magento/rest/V1/products-render-info?storeId=1&searchCriteria[pageSize]=0&currencyCode=USD',
            [
                "storeId" => 1,
                "searchCriteria[pageSize]" => 0,
                "currencyCode" => "USD"
            ]
        );


        if ($response->successful()) {
            foreach ($response->json()['items'] as $item) {
                try {
                    $p = new Product;
                    $p->url = $item['url'];
                    $p->product_id = $item['id'];
                    $p->name = $item['name'];
                    $p->type = $item['type'];
                    $p->is_salable = $item['is_salable'];
                    $p->store_id = $item['store_id'];
                    $p->currency_code = $item['currency_code'];
                    $p->save();
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }

                try {
                    $pip = new Price;
                    $pip->final_price = $item['price_info']['final_price'];
                    $pip->max_price = $item['price_info']['max_price'];
                    $pip->max_regular_price = $item['price_info']['max_regular_price'];
                    $pip->minimal_regular_price = $item['price_info']['minimal_regular_price'];
                    $pip->special_price = $item['price_info']['special_price'];
                    $pip->minimal_price = $item['price_info']['minimal_price'];
                    $pip->regular_price = $item['price_info']['regular_price'];
                    $pip->save();
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }


                try {
                    $pi = new ProductPriceInfo;
                    $pi->product_id = $p->id;
                    $pi->price_info_id = $pip->id;
                    $pi->save();
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }


                try {
                    $t = new Price;
                    $t->final_price = $item['price_info']['extension_attributes']['tax_adjustments']['final_price'];
                    $t->max_price = $item['price_info']['extension_attributes']['tax_adjustments']['max_price'];
                    $t->max_regular_price = $item['price_info']['extension_attributes']['tax_adjustments']['max_regular_price'];
                    $t->special_price = $item['price_info']['extension_attributes']['tax_adjustments']['special_price'];
                    $t->minimal_price = $item['price_info']['extension_attributes']['tax_adjustments']['minimal_price'];
                    $t->regular_price = $item['price_info']['extension_attributes']['tax_adjustments']['regular_price'];
                    $t->save();
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }

                try {
                    $ppie = new ProductPriceInfoExtensionAttribute;
                    $ppie->msrp_price = $item['price_info']['extension_attributes']['msrp']['msrp_price'];
                    $ppie->is_applicable = $item['price_info']['extension_attributes']['msrp']['is_applicable'];
                    $ppie->is_shown_price_on_gesture = $item['price_info']['extension_attributes']['msrp']['is_shown_price_on_gesture'];
                    $ppie->msrp_message = $item['price_info']['extension_attributes']['msrp']['msrp_message'];
                    $ppie->tax_id = $t->id;
                    $ppie->product_info_id = $pi->id;
                    $ppie->save();
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 500);
                }

                foreach ($item['images'] as $image) {
                    try {
                        $i = new ProductImage;
                        $i->url = $image['url'];
                        $i->code = $image['code'];
                        $i->height = $image['height'];
                        $i->width = $image['width'];
                        $i->label = $image['label'];
                        $i->resized_width = $image['resized_width'];
                        $i->resized_height = $image['resized_height'];
                        $i->product_id = $p->id;
                        $i->save();
                    } catch (\Exception $e) {
                        return response()->json(['message' => $e->getMessage()], 500);
                    }
                }
            }

            $products = Product::paginate(20);
            return response()->json(['message' => 'Products successfully inserted into database', 'products' => $products], 200);
        } else {
            return response()->json(['message' => 'Error, could not fetch products, please try again later!'], 200);
        }
    }

    /**
     * get
     *
     * @return void
     */
    public function get()
    {
        try {
            $products = Product::with(['priceInfo.prices', 'priceInfo.extensionAttributes', 'priceInfo.extensionAttributes.tax', 'images'])->paginate(20);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
