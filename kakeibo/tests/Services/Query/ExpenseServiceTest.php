<?php

namespace Tests\Services\Query;

use App\Models\Expense;
use App\Services\Query\ExpenseService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExpenseServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new ExpenseService;
    }

    /** @test */
    public function 定期支出の合計値を取得できる()
    {
        $user_id = 1;
        Expense::factory()->create(['user_id' => $user_id, 'amount' => 200]);
        Expense::factory()->regular()->create(['user_id' => $user_id, 'amount' => 500]);
        Expense::factory()->regular()->create(['user_id' => $user_id, 'amount' => 1500]);

        $this->assertEquals(
            2000,
            $this->service->getRegularTotalAmount($user_id)
        );
    }
}