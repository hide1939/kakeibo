<?php

namespace Tests\UseCases;

use App\Models\User;
use App\UseCases\ProfileImageUseCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileImageUseCaseTest extends TestCase
{
    use DatabaseTransactions;

    private $usecase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();
        $this->usecase = new ProfileImageUseCase;
    }

    /** @test */
    public function storeはデータベースにプロフィール画像のパスを保存する()
    {   
        $user = User::factory()->create();

        $this->usecase->store(UploadedFile::fake()->image('test.jpg'), $user->id);

        $this->assertNotNull(User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function storeはストレージにプロフィール画像を保存する()
    {
        $user = User::factory()->create();

        $this->usecase->store(UploadedFile::fake()->image('test.jpg'), $user->id);

        Storage::disk()->assertExists('profile_image/' . User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function deleteはDBのプロフィール画像のパスを削除する()
    {
        $user = User::factory()->imagepath()->create();

        $this->usecase->delete($user->id);

        $this->assertNull(User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function deleteはストレージのプロフィール画像を削除できる()
    {
        $user = User::factory()->imagepath()->create();
        Storage::putFileAs(
            'profile_image', 
            UploadedFile::fake()->image('test.jpg'), 
            $user->profile_image_path
        );

        $this->usecase->delete($user->id);

        Storage::disk()->assertMissing('profile_image/' . $user->profile_image_path);
    }
}