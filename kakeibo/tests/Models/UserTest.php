<?php

namespace Tests\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function Userモデルオブジェクトは、データベースに画像パスが存在する場合はそのパスを返す()
    {
        $user = User::create([
            'name' => 'taro',
            'email' => 'test@example.com',
            'password' => 'testpass123',
            'profile_image_path' => 'test.jpg',
        ]);

        $this->assertEquals('test.jpg', $user->profile_image_path);
    }

    /** @test */
    public function Userモデルオブジェクトは、データベースにパスがない場合はデフォルト画像のパスを返す()
    {
        $user = User::create([
            'name' => 'taro',
            'email' => 'test@example.com',
            'password' => 'testpass123',
        ]);

        $this->assertEquals('default.png', $user->profile_image_path);
    }
}