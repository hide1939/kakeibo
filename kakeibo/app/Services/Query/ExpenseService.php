<?php

namespace App\Services\Query;

use App\Models\Expense;

class ExpenseService 
{
    /** 
     * 定期支出の合計値を取得する
     */
    public function getRegularTotalAmount($user_id)
    {
        return Expense::userIs($user_id)->regular()->sum('amount');
    }

    /**
     * コレクションに包まれた、is_rugularが1のExpenseモデルオブジェクトを取得する
     */
    public function getRegular($user_id)
    {
        return Expense::userIs($user_id)->regular()->get();
    }

    /** 
     * 指定した年・月の支出の合計値を取得する(is_regularは0)
     */
    public function getMonthTotalAmount($user_id, $year, $month)
    {
        return Expense::userIs($user_id)->unregular()->yearIs($year)->monthis($month)->sum('amount');
    }

    /**
     * コレクションに包まれた、指定した年月のis_rugularが0のExpenseモデルオブジェクトを取得する
     */
    public function getByYearAndMonth($user_id, $year, $month)
    {
        return Expense::userIs($user_id)->unregular()->yearIs($year)->monthIs($month)->get();
    }
}
