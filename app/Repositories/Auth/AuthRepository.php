<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Http;

class AuthRepository
{
    /**
     * getToken
     *
     * @param Request $request
     * @return void
     */
    public function getToken(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        $response = Http::contentType("application/json")
            ->post(
                'http://59.92.233.19/magento/rest/V1/integration/admin/token',
                [
                    'username' => $request->username,
                    'password' => $request->password
                ]
            );

        if ($response->successful()) {
            return response()->json(['token' => $response->json()], 200);
        } else {
            return response($response->json(), 400);
        }
    }
}
