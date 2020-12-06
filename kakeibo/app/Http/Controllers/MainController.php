<?php

namespace App\Http\Controllers;

use App\Services\Query\ExpenseService as QueryExpenseService;
use App\Services\Query\IncomeService as QueryIncomeService;
use App\UseCases\MainUseCase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    private $query_expense_service;
    private $query_income_service;
    private $main_usecase;

    public function __construct(
        QueryExpenseService $query_expense_service,
        QueryIncomeService $query_income_service,
        MainUseCase $main_usecase
    ) {
        $this->query_expense_service = $query_expense_service;
        $this->query_income_service = $query_income_service;
        $this->main_usecase = $main_usecase;
    }

    /**
     * メイン画面を表示する
     */
    public function index(Request $request)
    {
        // TODO:この辺のロジックはコントローラではなくRequestクラスに移したい
        $year = is_null($request->query('y')) ? Carbon::now()->year : $request->query('y');
        $month = is_null($request->query('m')) ? Carbon::now()->month : $request->query('m');

        // TODO:この辺のパラメータはviewで直接取れるならそうしたい
        return view('layouts.main', [
            'month_total_amount' => $this->query_income_service->getMonthTotalAmount(Auth::id(), $year, $month) 
                - $this->query_expense_service->getMonthTotalAmount(Auth::id(), $year, $month),
            'month_expenses' => $this->query_income_service->getByYearAndMonth(Auth::id(), $year, $month),
            'month_incomes' => $this->query_income_service->getByYearAndMonth(Auth::id(), $year, $month),
            'login_user_name' => Auth::user()->name,
            'year' => $year,
            'month' => $month
        ]);
    }

    /** 
     * メイン画面で収支の登録をする
     */
    public function store(Request $request)
    {
        $this->main_usecase->store(Auth::id(), $request->query('param'), $request->item, $request->amount);
    }
}
