<?php

namespace App\Http\Controllers;

use App\Services\Command\ExpenseService as CommandExpenseService;
use App\Services\Command\IncomeService as CommandIncomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    private $command_expense_service;
    private $command_income_service;

    public function __construct(CommandExpenseService $command_expense_service, CommandIncomeService $command_income_service) 
    {
        $this->command_expense_service = $command_expense_service;
        $this->command_income_service = $command_income_service;
    }

    /**
     * メイン画面を表示する
     */
    public function index(Request $request)
    {
        // TODO:この辺のパラメータはviewで直接取れるならそうしたい
        return view('layouts.main', ['login_user_name' => Auth::user()->name]);
    }

    /** 
     * メイン画面で収支の削除を行う
     */
    public function destroy(Request $request) 
    {
        if ($request->query('param') === 'e') {
            $this->command_expense_service->delete($request->query('id'));
        }
        if ($request->query('param') === 'i') {
            $this->command_income_service->delete($request->query('id'));
        }

        return redirect(action([MainController::class, 'index']));
    }
}
