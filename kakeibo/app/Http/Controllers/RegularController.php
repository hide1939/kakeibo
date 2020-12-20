<?php

namespace App\Http\Controllers;

use App\Services\Command\IncomeService as CommandIncomeService;
use App\Services\Command\ExpenseService as CommandExpenseService;
use App\Services\Query\ExpenseService as QueryExpenseService;
use App\Services\Query\IncomeService as QueryIncomeService;
use App\UseCases\RegularUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegularController extends Controller
{
    private $query_expense_service;
    private $query_income_service;
    private $command_expense_service;
    private $command_income_service;
    private $regular_usecase;

    public function __construct(
        QueryExpenseService $query_expense_service, 
        QueryIncomeService $query_income_service, 
        CommandExpenseService $command_expense_service,
        CommandIncomeService $command_income_service,
        RegularUseCase $regular_usecase
    ) {
        $this->query_expense_service = $query_expense_service;
        $this->query_income_service = $query_income_service;
        $this->command_expense_service = $command_expense_service;
        $this->command_income_service = $command_income_service;
        $this->regular_usecase = $regular_usecase;
    }

    /**
     * 定期収支登録画面
     */
    public function edit()
    {
        return view('layouts.regular', [
            'regular_total_amount' => $this->query_income_service->getRegularTotalAmount(Auth::id()) 
                - $this->query_expense_service->getRegularTotalAmount(Auth::id()),
            'regular_expenses' => $this->query_expense_service->getRegular(Auth::id()),
            'regular_incomes' => $this->query_income_service->getRegular(Auth::id()),
            'login_user_name' => Auth::user()->name
        ]);
    }

    /**
     * 定期収支を登録する
     */
    public function store(Request $request)
    {
        $this->regular_usecase->store(Auth::id(), $request->query('param'), $request->item, $request->amount);

        return redirect(action([RegularController::class, 'edit']));
    }

    /**
     * 定期収支を削除する
     */
    public function destroy(Request $request)
    {
        if ($request->query('param') === 'e') {
            $this->command_expense_service->delete($request->query('id'));
        }
        if ($request->query('param') === 'i') {
            $this->command_income_service->delete($request->query('id'));
        }

        return redirect(action([RegularController::class, 'edit']));
    }
}