<?php

namespace Tests\UseCases;

use App\UseCases\MainUseCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MainUseCaseTest extends TestCase
{
    use DatabaseTransactions;

    private $usecase;

    public function setUp(): void
    {
        parent::setUp();
        $this->usecase = new MainUseCase;
    }

    /** @test */
    public function storeはクエリパラメータでeが渡ってきた場合はExpenseテーブルにデータを保存する()
    {
        $this->usecase->store(1, 'e', 'テストitem', 500);

        $this->assertDatabaseHas('expenses', [
            'user_id' => 1,
            'item' => 'テストitem',
            'amount' => 500,
            'is_regular' => 0
        ]);
    }

    /** @test */
    public function storeはクエリパラメータでiが渡ってきた場合はIncomeテーブルにデータを保存する()
    {
        $this->usecase->store(1, 'i', 'テストitem', 500);

        $this->assertDatabaseHas('incomes', [
            'user_id' => 1,
            'item' => 'テストitem',
            'amount' => 500,
            'is_regular' => 0
        ]);
    }
}
