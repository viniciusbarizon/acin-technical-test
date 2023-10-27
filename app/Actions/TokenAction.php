<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenAction
{
    private string $email;
    private ?User $user;
    private string $password;

    public function get(string $email, string $password): string {
        $this->email = $email;
        $this->password = $password;

        $this->setUser();

        if ($this->checkPassword() === false) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->getToken();
    }

    private function setUser(): void {
        $this->user = User::where('email', $this->email)->firstOrFail();
    }

    private function checkPassword(): bool {
        return Hash::check($this->password, $this->user->password);
    }

    private function getToken(): string {
        return $this->user->createToken(time())->plainTextToken;
    }
}
