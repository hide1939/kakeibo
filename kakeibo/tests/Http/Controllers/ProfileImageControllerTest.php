<?php 

namespace Tests\Http\Controllers;

use Tests\TestCase;

class ProfileImageControllerTest extends TestCase
{
    /** @test */
    public function editでステータスコード200が返る()
    {
        $response = $this->get('/profile_image');
        $response->assertOk();
    }

    /** @test */
    public function editでプロフィール画像登録画面が表示できる()
    {
        $response = $this->get('/profile_image');
        $response->assertViewIs('layouts.profileimage');
    }
}