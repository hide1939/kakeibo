<?php 

namespace App\Services\Query;

use App\Models\Income;

class IncomeService 
{
    /** 
     * 定期収入の合計値を取得する
     */
    public function getRegularTotalAmount($user_id)
    {
        return Income::where('user_id', $user_id)
            ->where('is_regular', config('const.is_regular.true'))
            ->sum('amount');
    }

    /** 
     * コレクションに包まれた、is_rugularが1のIncomeモデルオブジェクトを取得する
     */
    public function getRegular($user_id)
    {
        return Income::where('user_id', $user_id)
            ->where('is_regular', config('const.is_regular.true'))
            ->get();
    }
}