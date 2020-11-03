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

    private $service;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();
        $this->service = new ProfileImageUseCase;
    }

    /** @test */
    public function storeはデータベースにプロフィール画像のパスを保存する()
    {   
        $user = User::factory()->create();

        $this->service->store(UploadedFile::fake()->image('test.jpg'), $user->id);
        $this->assertNotNull(User::find($user->id)->profile_image_path);
    }

    /** @test */
    public function storeはストレージにプロフィール画像を保存する()
    {
        $user = User::factory()->create();

        $this->service->store(UploadedFile::fake()->image('test.jpg'), $user->id);

        Storage::disk()->assertExists('/profile_image/' . User::find($user->id)->profile_image_path);
    }
}