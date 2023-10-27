<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginActionTest extends TestCase
{
    private $response;

    public function test_login(): void
    {
        $this->setResponse();
        $this->assertToken();
    }

    private function setResponse(): void {
        $this->response = $this->postJson(
            '/api/login',
            ['email' => 'ara87@example.com', 'password' => 'password']
        );
    }

    private function assertToken(): void {
        $this->response->assertStatus(200)
            ->assertJson([
                'token' => 'abc',
            ]);
    }
}
