<?php

namespace Tests\Services\Query;

use App\Models\Income;
use App\Services\Query\IncomeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IncomeServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new IncomeService;
    }

    /** @test */
    public function 定期収入の合計値を取得できる()
    {
        $user_id = 1;
        Income::factory()->create(['user_id' => $user_id, 'amount' => 200]);
        Income::factory()->regular()->create(['user_id' => $user_id, 'amount' => 500]);
        Income::factory()->regular()->create(['user_id' => $user_id, 'amount' => 1500]);

        $this->assertEquals(
            2000,
            $this->service->getRegularTotalAmount($user_id)
        );
    }
}