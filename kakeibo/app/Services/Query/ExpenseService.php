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
        return Expense::where('user_id', $user_id)
            ->where('is_regular', config('const.is_regular.true'))
            ->sum('amount');
    }

    /**
     * コレクションに包まれた、is_rugularが1のExpenseモデルオブジェクトを取得する
     */
    public function getRegular($user_id)
    {
        return Expense::where('user_id', $user_id)
            ->where('is_regular', config('const.is_regular.true'))
            ->get();
    }
}
