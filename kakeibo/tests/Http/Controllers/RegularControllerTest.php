<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\RegularController;
use App\Models\Expense;
use App\Models\Income;
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

    /** @test */
    public function editで定期収支の合計金額がviewに渡る()
    {
        $user = User::factory()
            ->has(Income::factory()->regular()->state(['amount' => 1200]))
            ->has(Expense::factory()->regular()->state(['amount' => 500]))
            ->create();
        
        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_total_amount', 700);
    }

    /** @test */
    public function editで定期収支の負の合計金額がviewに渡る()
    {
        $user = User::factory()
            ->has(Income::factory()->regular()->state(['amount' => 500]))
            ->has(Expense::factory()->regular()->state(['amount' => 1200]))
            ->create();

        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_total_amount', -700);
    }

    /** @test */
    public function editでregular_expensesがviewに渡る()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_expenses');
    }

    /** @test */
    public function editでregular_incomesがviewに渡る()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_incomes');
    }

    /** @test */
    public function storeでクエリパラメータがeの場合はExpenseテーブルにデータを登録できる()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post(action([RegularController::class, 'store'], ['param' => 'e']), [
            'item' => 'item', 
            'amount' => 200,
        ]);

        $this->assertDatabaseHas('expenses', [
            'user_id' => $user->id,
            'item' => 'item',
            'amount' => 200,
            'is_regular' => 1
        ]);
    }

    /** @test */
    public function storeでクエリパラメータがiの場合はIncomeテーブルにデータを登録できる()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post(action([RegularController::class, 'store'], ['param' => 'i']), [
            'item' => 'item', 
            'amount' => 200,
        ]);

        $this->assertDatabaseHas('incomes', [
            'user_id' => $user->id,
            'item' => 'item',
            'amount' => 200,
            'is_regular' => 1
        ]);
    }

    /** @test */
    public function storeで登録処理が完了した後は定期収支画面にリダイレクトする()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(action([RegularController::class, 'store'], ['param' => 'i']), [
            'item' => 'item', 
            'amount' => 200,
        ]);

        $response->assertRedirect(action([RegularController::class, 'edit']));
    }
}