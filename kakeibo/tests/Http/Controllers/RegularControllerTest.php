<?php

namespace Tests\Http\Controllers;

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
    public function editでregular_expenseがviewに渡る()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_expense');
    }

    /** @test */
    public function editでregular_incomeがviewに渡る()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/regular');
        $response->assertViewHas('regular_income');
    }
}