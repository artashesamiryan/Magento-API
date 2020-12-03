<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * service
     *
     * @var OrderService $service
     */
    private $service;

    /**
     * __construct
     *
     * @param OrderService $service
     * @return void
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * fetch
     *
     * @param Request $request
     * @return void
     */
    public function fetch(Request $request)
    {
        return $this->service->fetch($request);
    }
    
    /**
     * get
     *
     * @return void
     */
    public function get(){
        return $this->service->get();
    }
}
