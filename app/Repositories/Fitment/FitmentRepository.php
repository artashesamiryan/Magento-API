<?php

namespace App\Repositories\Fitment;

use App\Models\Fitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FitmentRepository
{
    public function push(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part#' => 'required|string',
            'year' => 'required|string|numeric',
            'make' => 'required|string',
            'model' => 'required|string',
            'sub_model' => 'string',
            'engine' => 'string',
            'trim' => 'required|string',
            'notes' => 'string',
            'product_sku' => 'required|string'
        ]);

        $fitment_info = implode('~', $request->except('product_sku'));

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $f = new Fitment($request->all());
        $f->save();
        
        $response = Http::contentType("application/json")
            ->withHeaders([
                'Authorization' => 'Bearer ' . $request->header('token'),
                'Accept' => 'application/json',
            ])->put(
                'http://59.92.233.19/magento/rest/V1/products/' . $request->product_sku,
                [
                    "product" => [
                        "custom_attributes" => [
                            [
                                "attribute_code" => "fitment_info",
                                "value" => $fitment_info
                            ]
                        ]
                    ]
                ]
            );

        return response($response->json(), $response->status());
    }
}
