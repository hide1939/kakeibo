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
    public function getRegularTotalAmountで定期支出の合計値を取得できる()
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

    /** @test */
    public function getRegularTotalAmountは定期支出に何も登録していない場合は0が返る()
    {
        $user_id = 1;
        Expense::factory()->create(['user_id' => $user_id, 'amount' => 200]);

        $this->assertEquals(
            0,
            $this->service->getRegularTotalAmount($user_id)
        );
    }

    /** @test */
    public function getRegularでコレクションに包まれたExpenseモデルオブジェクトを取得できる()
    {
        $user_id = 1;
        Expense::factory()->regular()->create(['user_id' => $user_id]);

        $this->assertInstanceOf(Expense::class, $this->service->getRegular($user_id)->first());
    }

    /** @test */
    public function getRegularでis_regularが1のExpenseモデルオブジェクトを取得できる()
    {
        $user_id = 1;
        Expense::factory()->regular()->create(['user_id' => $user_id]);

        $this->assertEquals(1, $this->service->getRegular($user_id)->first()->is_regular);
    }

    /** @test */
    public function 定期支出カラムに何も入っていない場合getRegularは空のコレクションを返す()
    {
        $user_id = 1;
        Expense::factory()->create(['user_id' => $user_id]);

        $this->assertTrue($this->service->getRegular($user_id)->isEmpty());
    }

    /** @test */
    public function getMonthTotalAmountは指定した年月の支出の合計値を返す()
    {
        $user_id = 1;
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 200,
            'created_at' => '2010-10-01 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 500,
            'created_at' => '2020-10-01 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 1500,
            'created_at' => '2020-10-21 10:00:00'
        ]);

        $this->assertEquals(
            2000,
            $this->service->getMonthTotalAmount($user_id, '2020', '10')
        );
    }

    /** @test */
    public function getMonthTotalAmountはis_regularが0のデータ支出の合計値を返す()
    {
        $user_id = 1;
        Expense::factory()->regular()->create([
            'user_id' => $user_id,
            'amount' => 200,
            'created_at' => '2020-10-01 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 500,
            'created_at' => '2020-10-09 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 1500,
            'created_at' => '2020-10-21 10:00:00'
        ]);

        $this->assertEquals(
            2000,
            $this->service->getMonthTotalAmount($user_id, '2020', '10')
        );
    }

    /** @test */
    public function getMonthTotalAmountは指定したユーザーの支出の合計値を返す()
    {
        $user_id = 1;
        Expense::factory()->create([
            'user_id' => 2,
            'amount' => 200,
            'created_at' => '2020-10-01 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 500,
            'created_at' => '2020-10-09 10:00:00'
        ]);
        Expense::factory()->create([
            'user_id' => $user_id,
            'amount' => 1500,
            'created_at' => '2020-10-21 10:00:00'
        ]);

        $this->assertEquals(
            2000,
            $this->service->getMonthTotalAmount($user_id, '2020', '10')
        );
    }
}
