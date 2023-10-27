<?php

namespace Tests\Feature;

use App\Actions\LoginAction;
use App\Actions\LogoutAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    private TestResponse $response;
    private string $token;
    private string $email;

    public function test_it_deletes_the_token(): void {
        $this->setEmail();
        $this->setToken();

        $this->logout();

        $this->assertResponse();
    }

    private function setEmail(): void {
        $this->email = User::first()->email;
    }

    private function setToken(): void {
        $this->token = (new LoginAction)->getToken(
            email: $this->email,
            password: 'password'
        );
    }

    private function logout(): void {
        $this->response = $this->withHeaders(['Authorization'=>'Bearer '.$this->token])
            ->post('/api/logout');
    }

    private function assertResponse(): void {
        $this->response->assertStatus(200);
    }
}
