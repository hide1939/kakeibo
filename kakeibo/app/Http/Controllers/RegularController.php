<?php

namespace App\Http\Controllers;

use App\Services\Query\ExpenseService;
use App\Services\Query\IncomeService;
use Illuminate\Support\Facades\Auth;

class RegularController extends Controller
{
    private $expense_service;
    private $income_service;

    public function __construct(ExpenseService $expense_service, IncomeService $income_service)
    {
        $this->expense_service = $expense_service;
        $this->income_service = $income_service;
    }

    /**
     * 定期収支登録画面
     */
    public function edit()
    {
        $regular_total_amount = $this->income_service->getRegularTotalAmount(Auth::id()) 
            - $this->expense_service->getRegularTotalAmount(Auth::id());

        $regular_expense = $this->expense_service->getRegular(Auth::id());

        $regular_income = $this->income_service->getRegular(Auth::id());

        return view('layouts.regular', [
            'regular_total_amount' => $regular_total_amount,
            'regular_expense' => $regular_expense,
            'regular_income' => $regular_income
        ]);
    }
}