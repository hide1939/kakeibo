<?php

namespace App\Http\Controllers;

use App\Services\Query\ExpenseService as QueryExpenseService;
use App\Services\Query\IncomeService as QueryIncomeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    private $query_expense_service;
    private $query_income_service;

    public function __construct(
        QueryExpenseService $query_expense_service,
        QueryIncomeService $query_income_service
    ) {
        $this->query_expense_service = $query_expense_service;
        $this->query_income_service = $query_income_service;
    }

    /**
     * メイン画面を表示する
     */
    public function index(Request $request)
    {
        // TODO:この辺のロジックはコントローラではなくRequestクラスに移したい
        $year = is_null($request->query('y')) ? Carbon::now()->year : $request->query('y');
        $month = is_null($request->query('m')) ? Carbon::now()->month : $request->query('m');

        return view('layouts.main', [
            'month_total_amount' => $this->query_income_service->getMonthTotalAmount(Auth::id(), $year, $month) 
                - $this->query_expense_service->getMonthTotalAmount(Auth::id(), $year, $month),
            'month_expenses' => $this->query_income_service->getByYearAndMonth(Auth::id(), $year, $month),
            'month_incomes' => $this->query_income_service->getByYearAndMonth(Auth::id(), $year, $month)
        ]);
    }
}
