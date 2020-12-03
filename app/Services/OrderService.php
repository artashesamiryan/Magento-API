<?php

namespace App\Services;

use App\Repositories\Order\OrderRepository;
use Illuminate\Http\Request;

class OrderService
{    
    /**
     * repository
     *
     * @var OrderRepository $repository
     */
    private $repository;
    
    /**
     * __construct
     *
     * @param OrderRepository $repository
     * @return void
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * fetch
     *
     * @param Request $request
     * @return void
     */
    public function fetch(Request $request)
    {
        return $this->repository->fetch($request);
    }
    
    /**
     * get
     *
     * @return void
     */
    public function get(){
        return $this->repository->get();
    }
}
