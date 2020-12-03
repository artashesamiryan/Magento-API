<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{    
    /**
     * service
     *
     * @var ProductService $service
     */
    private $service;
    
    /**
     * __construct
     *
     * @param ProductService $service
     * @return void
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

        
    /**
     * fetch
     *
     * @return void
     */
    public function fetch()
    {
        return $this->service->fetch();
    }
    
    /**
     * get
     *
     * @return void
     */
    public function get(){
        return $this->service->get();
    }
    
    /**
     * push
     *
     * @param  mixed $request
     * @return void
     */
    public function push(Request $request){
        return $this->service->push($request);
    }
}
