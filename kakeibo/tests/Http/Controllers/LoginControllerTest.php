<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function indexでステータスコード200が返る()
    {
        $response = $this->get('/login');
        $response->assertOk();
    }

    /** @test */
    public function indexでログイン画面が表示できる()
    {
        $response = $this->get('/login');
        $response->assertViewIs('layouts.login');
    }

    /** @test */
    public function loginで認証状態になる()
    {
        User::factory()->create([
            'name' => 'testさん',
            'email' => 'test@example.com',
            'password' => Hash::make('test@123')
        ]);

        $this->post('/login', [
            'name' => 'testさん',
            'email' => 'test@example.com',
            'password' => 'test@123'
        ]);

        $this->assertTrue(Auth::check());
    }

    /** @test */
    public function loginでログイン後はメイン画面へ遷移する()
    {
        User::factory()->create([
            'name' => 'testさん',
            'email' => 'test@example.com',
            'password' => Hash::make('test@123')
        ]);

        $response = $this->post('/login', [
            'name' => 'testさん',
            'email' => 'test@example.com',
            'password' => 'test@123'
        ]);

        $response->assertRedirect('/main');
    }

    /** @test */
    public function loginで認証に失敗した場合はログイン画面に遷移する()
    {
        User::factory()->create([
            'name' => 'testさん',
            'email' => 'test@example.com',
            'password' => Hash::make('test@123')
        ]);

        $response = $this->post('/login', [
            'name' => 'testさん',
            'email' => 'test@example.com',
            // パスワード間違い
            'password' => 'hoge@123'
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function logoutで認証状態を解除できる()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/logout');

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function logoutでログアウトした後はログイン画面に遷移する()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logout');

        $response->assertRedirect('/login');
    }
}