<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\MainController;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'laravelkun'
        ]);
    }

    /** @test */
    public function indexはメイン画面を表示する()
    {
        $this->actingAs($this->user)->get('/main')
            ->assertViewIs('layouts.main');
    }

    /** @test */
    public function indexでログインユーザー名がviewに渡る()
    {
        $this->actingAs($this->user)->get(action([MainController::class, 'index']))
            ->assertViewHas('login_user_name', 'laravelkun');
    }

    /** @test */
    public function destroyで指定した支出項目を削除できる()
    {
        $expense = Expense::factory()->create();
        $this->actingAs($this->user)->delete(action([MainController::class, 'destroy'], [
            'param' => 'e', 
            'id' => $expense->id
        ]));

        $this->assertNull(Expense::find($expense->id));
    }

    /** @test */
    public function destroyで指定した収入項目を削除できる()
    {
        $income = Income::factory()->create();
        $this->actingAs($this->user)->delete(action([MainController::class, 'destroy'], [
            'param' => 'i', 
            'id' => $income->id
        ]));

        $this->assertNull(Income::find($income->id));
    }

    /** @test */
    public function destroyで項目を削除した後はメイン画面にリダイレクトする()
    {
        $income = Income::factory()->create();
        $response = $this->actingAs($this->user)->delete(action([MainController::class, 'destroy'], [
            'param' => 'i', 
            'id' => $income->id
        ]));
        $response->assertRedirect(action([MainController::class, 'index']));
    }
}