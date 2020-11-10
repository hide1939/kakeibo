<?php 

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileImageControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function editでステータスコード200が返る()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile_image');
        $response->assertOk();
    }

    /** @test */
    public function editでプロフィール画像登録画面が表示できる()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/profile_image');
        $response->assertViewIs('layouts.profileimage');
    }

    /** @test */
    public function editで現在設定されているプロフィール画像が表示される()
    {
        $user = User::factory()->imagepath()->create();

        $response = $this->actingAs($user)->get('/profile_image');
        $response->assertViewHas('profile_image_path', $user->profile_image_path);
    }

    /** @test */
    public function storeでプロフィール画像の保存ができたらプロフィール画像編集画面にリダイレクトする()
    {
        Storage::fake();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile_image', [
            'profile_image' => UploadedFile::fake()->image('test.jpg')
        ]);
        $response->assertRedirect('/profile_image');
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

    /** @test */
    public function destroyでプロフィール画像を削除したらステータスコード200が返る()
    {
        $user = User::factory()->imagepath()->create();
        Storage::putFileAs(
            'profile_image', 
            UploadedFile::fake()->image('test.jpg'), 
            $user->profile_image_path
        );

        $response = $this->actingAs($user)->delete('/profile_image');
        $response->assertOk();
    }

    /** @test */
    public function destroyでDBのプロフィール画像のパスを削除できる()
    {
        $user = User::factory()->imagepath()->create();

        $this->actingAs($user)->delete('/profile_image');

        $this->assertNull(User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function destroyでストレージのプロフィール画像を削除できる()
    {
        $user = User::factory()->imagepath()->create();
        Storage::putFileAs(
            'profile_image', 
            UploadedFile::fake()->image('test.jpg'), 
            $user->profile_image_path
        );

        $this->actingAs($user)->delete('/profile_image');

        Storage::disk()->assertMissing('profile_image/' . $user->profile_image_path);
    }
}