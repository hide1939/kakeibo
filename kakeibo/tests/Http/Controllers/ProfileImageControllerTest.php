<?php 

namespace Tests\Http\Controllers;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    /** @test */
    public function storeでプロフィール画像の保存ができたら200が返る()
    {
        Storage::fake();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile_image', [
            'profile_image' => UploadedFile::fake()->image('test.jpg')
        ]);
        $response->assertOk();
    }

    /** @test */
    public function storeでデータベースにプロフィール画像のパスを保存できる()
    {
        Storage::fake();
        $user = User::factory()->create();

        $this->actingAs($user)->post('/profile_image', [
            'profile_image' => UploadedFile::fake()->image('test.jpg')
        ]);
        $this->assertNotNull(User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function storeでストレージにプロフィール画像を保存できる()
    {
        Storage::fake();
        $user = User::factory()->create();

        $this->actingAs($user)->post('/profile_image',[
            'profile_image' => UploadedFile::fake()->image('test.jpg')
        ]);
        Storage::disk()->assertExists('/profile_image/' . User::find($user->id)->profile_image_path);
    }
}