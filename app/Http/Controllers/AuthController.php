<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    /**
     * __construct
     *
     * @param AuthService $service
     * @return void
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * getToken
     *
     * @param Request $request
     * @return void
     */
    public function getToken(Request $request)
    {
        return $this->service->getToken($request);
    }
}
