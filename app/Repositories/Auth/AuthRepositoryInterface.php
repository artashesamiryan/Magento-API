<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function getToken(Request $request);
}
