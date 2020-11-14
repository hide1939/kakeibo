<?php

namespace Tests\Services\Query;

use App\Models\User;
use App\Services\Query\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
    public function getByIdはユーザーが存在する場合はそのユーザーのモデルオブジェクトを返す()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(
            User::class,
            $this->service->getById($user->id)
        );
    }

    /** @test */
    public function getByIdはユーザーが存在しない場合はnullを返す()
    {
        $this->assertNull(
            $this->service->getById(1)
        );
    }
}