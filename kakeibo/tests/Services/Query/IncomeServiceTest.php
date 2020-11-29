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
    public function getRegularTotalAmountで定期収入の合計値を取得できる()
    {
        $user_id = 1;
        Income::factory()->regular()->create(['user_id' => $user_id, 'amount' => 500]);
        Income::factory()->regular()->create(['user_id' => $user_id, 'amount' => 1500]);

        $this->assertEquals(
            2000,
            $this->service->getRegularTotalAmount($user_id)
        );
    }

    /** @test */
    public function getRegularTotalAmountは定期支出に何も登録していない場合は0が返る()
    {
        $user_id = 1;
        Income::factory()->create(['user_id' => $user_id, 'amount' => 200]);

        $this->assertEquals(
            0,
            $this->service->getRegularTotalAmount($user_id)
        );
    }

    /** @test */
    public function getRegularでコレクションに包まれたIncomeモデルオブジェクトを取得できる()
    {
        $user_id = 1;
        Income::factory()->regular()->create(['user_id' => $user_id]);

        $this->assertInstanceOf(Income::class, $this->service->getRegular($user_id)->first());
    }

    /** @test */
    public function getRegularでis_regularが1のIncomeモデルオブジェクトを取得できる()
    {
        $user_id = 1;
        Income::factory()->regular()->create(['user_id' => $user_id]);

        $this->assertEquals(1, $this->service->getRegular($user_id)->first()->is_regular);
    }

    /** @test */
    public function 定期収入カラムに何も入っていない場合getRegularは空のコレクションを返す()
    {
        $user_id = 1;
        Income::factory()->create(['user_id' => $user_id]);

        $this->assertTrue($this->service->getRegular($user_id)->isEmpty());
    }
}