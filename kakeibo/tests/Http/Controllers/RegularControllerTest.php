<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegularControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function editで成功のステータスコードが返る()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/regular');
        $response->assertSuccessful();
    }

    /** @test */
    public function editで定期収支登録画面が表示できる()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewIs('layouts.regular');
    }
}