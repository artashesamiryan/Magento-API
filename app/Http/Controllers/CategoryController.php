<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{    
    /**
     * service
     *
     * @var CategoryService $service
     */
    protected $service;
    
    /**
     * __construct
     *
     * @param CategoryService $service
     * @return void
     */
    public function __construct(CategoryService $service)
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
    public function get()
    {
        return $this->service->get();
    }
}
