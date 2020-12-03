<?php

namespace App\Services;

use App\Repositories\Fitment\FitmentRepository;
use Illuminate\Http\Request;

class FitmentService
{

    private $repository;

    public function __construct(FitmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function push(Request $request)
    {
        return $this->repository->push($request);
    }
}
