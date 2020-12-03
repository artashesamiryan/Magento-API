<?php

namespace App\Repositories\Order;

use Illuminate\Http\Request;

interface OrderInterface
{
    public function fetch(Request $request);
}
