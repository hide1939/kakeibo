<?php

namespace Tests\Services\Command;

use App\Models\User;
use App\Services\Command\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new UserService;
    }

    /** @test */
    public function registでユーザーの新規登録ができる()
    {
        $this->service->regist([
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
    public function registでプロフィール画像のパスも含めて新規登録できる()
    {
        $this->service->regist([
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
            'profile_image_path' => 'test.jpg'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test君',
            'email' => 'test@example.com',
            'profile_image_path' => 'test.jpg'
        ]);
    }

    /** @test */
    public function registでハッシュ化したパスワードを保存できる()
    {
        $this->service->regist([
            'name' => 'test君',
            'email' => 'test@example.com',
            'password' => 'password@123',
        ]);

        $this->assertTrue(Hash::check(
            'password@123',
            User::where('email', 'test@example.com')->first()->password
        ));
    }
}