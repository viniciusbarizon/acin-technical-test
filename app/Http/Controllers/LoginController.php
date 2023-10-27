<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(): string {
        return json_encode([
            'token' => $this->getToken()
        ]);
    }

    private function getToken(): string {
        return (new LoginAction)->getToken(
            email: request()->email,
            password: request()->password
        );
    }
}
