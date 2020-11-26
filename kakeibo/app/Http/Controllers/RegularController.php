<?php

namespace App\Http\Controllers;

use App\Services\Query\ExpenseService;
use App\Services\Query\IncomeService;
use App\UseCases\RegularUseCase;
use Illuminate\Http\Request;
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
        return view('layouts.regular', [
            'regular_total_amount' => $this->income_service->getRegularTotalAmount(Auth::id()) 
                - $this->expense_service->getRegularTotalAmount(Auth::id()),
            'regular_expenses' => $this->expense_service->getRegular(Auth::id()),
            'regular_incomes' => $this->income_service->getRegular(Auth::id())
        ]);
    }

    /**
     * 定期収支を登録する
     */
    public function store(Request $request, RegularUseCase $regular_usecase)
    {
        $regular_usecase->store(Auth::id(), $request->query('param'), $request->item, $request->amount);

        return redirect(action([RegularController::class, 'edit']));
    }
}