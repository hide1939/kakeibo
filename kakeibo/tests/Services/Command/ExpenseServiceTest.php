<?php

namespace Tests\Services\Command;

use App\Models\Expense;
use App\Services\Command\ExpenseService;
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
    public function deleteは指定したidのデータを削除する()
    {
        $expense = Expense::factory()->regular()->create();

        $this->service->delete($expense->id);
        
        $this->assertNull(Expense::find($expense->id));
    }
}