<?php

namespace Tests\Http\Controllers\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\Api\MainController;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function indexで登録した支出のjsonデータが返る()
    {
        $user = User::factory()->create();
        Expense::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'api')
            ->get(action([MainController::class, 'index']));
        $response->assertJsonCount(1, 'month_expenses');
    }

    /** @test */
    public function indexで登録した収入のjsonデータが返る()
    {
        $user = User::factory()->create();
        Income::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'api')
            ->get(action([MainController::class, 'index']));
        $response->assertJsonCount(1, 'month_incomes');
    }

    /** @test */
    public function storeでjson形式で渡ってくる支出データを登録できる()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->postJson(action([MainController::class, 'store'], ['param' => 'e']), [
            'item' => '超高級焼肉',
            'amount' => 200000
        ]);

        $this->assertDatabaseHas('expenses', [
            'item' => '超高級焼肉',
            'amount' => 200000
        ]);
    }

    /** @test */
    public function storeでjson形式で渡ってくる収入データを登録できる()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->postJson(action([MainController::class, 'store'], ['param' => 'i']), [
            'item' => '仕事',
            'amount' => 200000
        ]);

        $this->assertDatabaseHas('incomes', [
            'item' => '仕事',
            'amount' => 200000
        ]);
    }
}
