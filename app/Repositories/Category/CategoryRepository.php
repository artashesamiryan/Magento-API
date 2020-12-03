<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CategoryRepository
{
    public function fetch(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->header('token'),
            'Accept' => 'application/json',
        ])->get(
            'http://59.92.233.19/magento/rest/V1/categories/list',
            [
                'searchCriteria[pageSize]' => '00'
            ]
        );

        if($response->successful()){
            foreach($response->json()['items'] as $item){
                try{
                    $c = new Category;
                    $c->category_id = $item['id'];
                    $c->parent_id = $item['id'];
                    $c->name = $item['name'];
                    $c->position = $item['position'];
                    $c->level = $item['level'];
                    $c->children = $item['children'];
                    $c->path = $item['path'];
                    $c->available_sort_by = implode(',', $item['available_sort_by']);
                    $c->include_in_menu = $item['include_in_menu'];
                    $c->created_at = $item['created_at'];
                    $c->updated_at = $item['updated_at'];
                    $c->save();
                }catch(\Exception $e){
                    return response()->json(['message' => $e->getMessage()], 500);
                }

                foreach($item['custom_attributes'] as $attr){
                    try{
                        $at = new CategoryAttribute;
                        $at->category_id = $c->id;
                        $at->attribute_code = $attr['attribute_code'];
                        $at->value = $attr['value'];
                        $at->save();
                    }catch(\Exception $e){
                        return response()->json(['message' => $e->getMessage()], 500);
                    }
                }
            }

            $categories = Category::paginate(20);
            
            return response()->json(['message' => 'Categories successfully inserted', 'categories' => $categories]);
        }else{
            return response($response->json(), 200);
        }
    }

    public function get(){
        $categories = Category::with(['parent', 'attributes'])->paginate(20);
        return response()->json($categories, 200);
    }
}
