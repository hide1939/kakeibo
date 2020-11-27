<?php

namespace Tests\Services\Command;

use App\Models\Income;
use App\Services\Command\IncomeService;
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
    public function deleteは指定したidのデータを削除する()
    {
        $income = Income::factory()->regular()->create();

        $this->service->delete($income->id);

        $this->assertNull(Income::find($income->id));
    }
}