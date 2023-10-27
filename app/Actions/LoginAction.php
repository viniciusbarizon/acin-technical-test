<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    private string $email;
    private ?User $user;
    private string $password;

    public function login(string $email, string $password): string {
        $this->email = $email;
        $this->password = $password;

        $this->setUser();

        return $this->getToken();
    }

    private function setUser(): void {
        $this->user = User::where('email', $this->email)->firstOrFail();
    }

    private function hashCheck(): bool {
        return Hash::check($this->password, $this->user->password);
    }

    private function getToken(): string {
        return $this->user->createToken(time())->plainTextToken;
    }
}
