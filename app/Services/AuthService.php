<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthService
{    
    /**
     * repository
     *
     * @var AuthRepository $repository
     */
    private $repository;
    
    /**
     * __construct
     *
     * @param AuthRepository $repository
     * @return void
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }
        
    /**
     * getToken
     *
     * @param Request $request
     * @return void
     */
    public function getToken(Request $request)
    {
        return $this->repository->getToken($request);
    }
}
