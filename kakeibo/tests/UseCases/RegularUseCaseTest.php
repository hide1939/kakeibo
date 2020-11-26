<?php

namespace Tests\UseCases;

use App\UseCases\RegularUseCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegularUseCaseTest extends TestCase
{
    use DatabaseTransactions;

    private $usecase;

    public function setUp():void
    {
        parent::setUp();
        $this->usecase = new RegularUseCase;
    }

    /** @test */
    public function storeはクエリパラメータでeが渡ってきたらExpenseテーブルに項目と金額を登録する()
    {
        $this->usecase->store(1, 'e', 'item_name', 200);

        $this->assertDatabaseHas('expenses', [
            'user_id' => 1,
            'item' => 'item_name',
            'amount' => 200,
            'is_regular' => 1
        ]);
    }

    /** @test */
    public function storeはクエリパラメータでiが渡ってきたらIncomeテーブルに項目と金額を登録する()
    {
        $this->usecase->store(1, 'i', 'item_name', 200);

        $this->assertDatabaseHas('incomes', [
            'user_id' => 1,
            'item' => 'item_name',
            'amount' => 200,
            'is_regular' => 1
        ]);
    }
}