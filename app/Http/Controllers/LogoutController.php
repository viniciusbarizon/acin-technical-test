<?php

namespace App\Http\Controllers;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $this->revokeToken();
    }

    private function revokeToken(): void
    {
        request()->user()->currentAccessToken()->delete();
    }
}
