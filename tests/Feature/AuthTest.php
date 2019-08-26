<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{

    public function testLoginByPasswordResponseSuccess()
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@mail.com',
            'password' => 'secret'
        ]);

        $response->assertStatus(200);
    }

    public function testLoginByPasswordResponseAssertStructure()
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@mail.com',
            'password' => 'secret'
        ]);

        $response->assertJsonStructure(['token_type', 'token', 'expires_at']);
    }

    public function testLoginByPasswordResponseFailed()
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@mail.com',
            'password' => 'hacker'
        ]);

        $response->assertStatus(401);
    }

    public function testLogout()
    {
        $responseLogin = $this->post(route('login'), [
            'email' => 'admin@mail.com',
            'password' => 'secret'
        ]);

        $responseLogout = $this->post(route('logout'), [], [
            'Authorization' => "Bearer {$responseLogin->json('token')}"
        ]);

        $responseLogout->assertStatus(200);
    }
}
