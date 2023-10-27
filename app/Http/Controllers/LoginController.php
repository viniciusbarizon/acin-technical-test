<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(): string {
        return $this->getToken();
    }

    private function getToken(): string {
        return (new TokenAction)->get(
            email: request()->email,
            password: request()->password
        );
    }
}
