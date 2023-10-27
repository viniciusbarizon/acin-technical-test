<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginActionTest extends TestCase
{
    use RefreshDatabase;

    private $response;

    public function test_login(): void
    {
        $this->setResponse();
        $this->assertToken();
    }

    private function setResponse(): void {
        $this->response = $this->post(
            '/api/login',
            ['email' => $this->getEmail(), 'password' => 'password']
        );
    }

    private function getEmail(): string {
        return User::first()->email;
    }

    private function assertToken(): void {
        $this->response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}
