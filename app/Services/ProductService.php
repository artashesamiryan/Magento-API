<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;

class ProductService
{    
    /**
     * repository
     *
     * @var ProductRepository $repository
     */
    private $repository;
    
    /**
     * __construct
     *
     * @param ProductRepository $repository
     * @return void
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * get
     *
     * @return void
     */
    public function fetch(){
        return $this->repository->fetch();
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
