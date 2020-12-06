<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\MainController;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'laravelkun'
        ]);
    }

    /** @test */
    public function indexはメイン画面を表示する()
    {
        $this->actingAs($this->user)->get('/main')
            ->assertViewIs('layouts.main');
    }

    /** @test */
    public function indexは指定した年月の収支を表示する()
    {   
        // 指定しない年月
        Expense::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 800,
            'created_at' => '2018-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 200,
            'created_at' => '2016-08-09 14:08:34' 
        ]);

        // 指定する年月
        Expense::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 200,
            'created_at' => '2020-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 500,
            'created_at' => '2020-10-09 14:08:34' 
        ]);

        $response = $this->actingAs($this->user)->get(action([MainController::class, 'index'], [
            'y' => '2020',
            'm' => '10'
        ]));
        $response->assertViewHas('month_total_amount', 300);
    }

    /** @test */
    public function indexは年月を指定しない場合は今月の収支の合計値を表示する()
    {
        // 今月以外
        Expense::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 800,
            'created_at' => '2018-10-4 20:00:00'
        ]);
        Income::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 200,
            'created_at' => '2016-08-09 14:08:34' 
        ]);

        // 今月
        Expense::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 200,
            'created_at' => Carbon::now()
        ]);
        Income::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 500,
            'created_at' => Carbon::now()
        ]);

        // クエリパラメータで何も渡さない
        $response = $this->actingAs($this->user)->get(action([MainController::class, 'index']));
        $response->assertViewHas('month_total_amount', 300);
    }

    /** @test */
    public function indexでmonth_expensesをviewに渡せる()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index']))
            ->assertViewHas('month_expenses');

    }

    /** @test */
    public function indexでmonth_incomesをviewに渡せる()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index']))
            ->assertViewHas('month_incomes');

    }

    /** @test */
    public function indexでログインユーザー名がviewに渡る()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index']))
            ->assertViewHas('login_user_name', 'laravelkun');
    }

    /** @test */
    public function indexでクエリパラメータで指定した年月がviewに渡る()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index'], [
            'y' => '2020',
            'm' => '5'
        ]))->assertViewHas([
                'year' => '2020',
                'month' => '5'
            ]);
    }

    /** @test */
    public function クエリパラメータで指定しなかった場合は、indexで現在の年月がviewに渡る()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index']))
            ->assertViewHas([
                'year' => Carbon::now()->year,
                'month' => Carbon::now()->month
            ]);
    }

    /** @test */
    public function storeで指定した支出を登録できる()
    {
        $this->actingAs($this->user)->post(action([MainController::class, 'store'], ['param' => 'e']), [
            'item' => '超高級焼肉',
            'amount' => 200000
        ]);

        $this->assertDatabaseHas('expenses', [
            'item' => '超高級焼肉',
            'amount' => 200000
        ]);
    }

    /** @test */
    public function storeで指定した収入を登録できる()
    {
        $this->actingAs($this->user)->post(action([MainController::class, 'store'], ['param' => 'i']), [
            'item' => '仕事',
            'amount' => 200000
        ]);

        $this->assertDatabaseHas('incomes', [
            'item' => '仕事',
            'amount' => 200000
        ]);
    }
}