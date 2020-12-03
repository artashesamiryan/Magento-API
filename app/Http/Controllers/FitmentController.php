<?php

namespace App\Http\Controllers;

use App\Services\FitmentService;
use Illuminate\Http\Request;

class FitmentController extends Controller
{
    private $service;

    public function __construct(FitmentService $service)
    {
        $this->service = $service;
    }

    public function push(Request $request)
    {
        return $this->service->push($request);
    }
}
