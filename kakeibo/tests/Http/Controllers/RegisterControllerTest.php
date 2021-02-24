<?php

namespace Tests\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function createでステータスコード200が返る()
    {
        $response = $this->get('/register');
        $response->assertOk();
    }

    /** @test */
    public function createで新規登録画面が表示できる()
    {
        $response = $this->get('/register');
        $response->assertViewIs('layouts.register');
    }

    /** @test */
    public function storeでユーザーの新規登録ができる()
    {
        $this->post('/register', [
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test君',
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function storeで新規登録後は定期収支登録画面にリダイレクトする()
    {
        $response = $this->post('/register', [
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
        ]);

        $response->assertRedirect('/regular');
    }

    /** @test */
    public function storeで新規登録後はログイン状態になる()
    {
        $this->post('/register', [
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
        ]);

        $this->assertTrue(Auth::check());
    }

    /** @test */
    public function storeで認証状態にできなかった場合は新規登録画面にリダイレクトする()
    {
        Auth::shouldReceive('attempt')->andReturn(false);
        $response = $this->post('/register', [
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
        ]);

        $response->assertRedirect('/register');
    }
}