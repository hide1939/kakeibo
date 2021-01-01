<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        // TODO:クエリパラメータで年月を渡した場合のテストも書く
        $year = is_null($request->query('y')) ? Carbon::now()->year : $request->query('y');
        $month = is_null($request->query('m')) ? Carbon::now()->month : $request->query('m');

        // table.jsで使うjsonデータを返す
        return response()->json([
            'month_expenses' => $this->query_expense_service->getByYearAndMonth(Auth::id(), $year, $month),
            'month_incomes' => $this->query_income_service->getByYearAndMonth(Auth::id(), $year, $month)
        ]);
    }
}