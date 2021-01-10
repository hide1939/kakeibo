<?php

namespace Tests\Http\Controllers\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\Api\MainController;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
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
    public function indexは指定した年月の収支のjsonデータを返す()
    {   
        $user = User::factory()->create();

        // 指定しない年月
        Expense::factory()->create([
            'user_id' => $user->id,
            'amount' => 800,
            'created_at' => '2018-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $user->id,
            'amount' => 200,
            'created_at' => '2016-08-09 14:08:34' 
        ]);

        // 指定する年月
        Expense::factory()->create([
            'user_id' => $user->id,
            'amount' => 200,
            'created_at' => '2020-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $user->id,
            'amount' => 500,
            'created_at' => '2020-10-09 14:08:34' 
        ]);

        $response = $this->actingAs($user, 'api')->getJson(action([MainController::class, 'index'], [
            'y' => '2020',
            'm' => '10'
        ]));
        $response->assertJson(['month_total_amount' => 300]);
    }

    /** @test */
    public function indexは年月を指定しなかった場合は今月の収支のjsonデータを返す()
    {   
        $user = User::factory()->create();

        // 指定しない年月
        Expense::factory()->create([
            'user_id' => $user->id,
            'amount' => 800,
            'created_at' => '2018-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $user->id,
            'amount' => 200,
            'created_at' => '2016-08-09 14:08:34' 
        ]);

        // 今月登録した収支
        Expense::factory()->create([
            'user_id' => $user->id,
            'amount' => 200,
            'created_at' => Carbon::now()
        ]);
        Income::factory()->create([
            'user_id' => $user->id,
            'amount' => 500,
            'created_at' => Carbon::now() 
        ]);

        $response = $this->actingAs($user, 'api')->getJson(action([MainController::class, 'index']));
        $response->assertJson(['month_total_amount' => 300]);
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
