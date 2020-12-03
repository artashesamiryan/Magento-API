<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * repository
     *
     * @var CategoryRepository $repository
     */
    private $repository;

    /**
     * __construct
     *
     * @param CategoryRepository $repository
     * @return void
     */
    public function __construct(CategoryRepository $repository)
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
    public function get()
    {
        return $this->repository->get();
    }
}
