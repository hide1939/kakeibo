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
        return Income::userIs($user_id)->regular()->sum('amount');
    }

    /** 
     * コレクションに包まれた、is_rugularが1のIncomeモデルオブジェクトを取得する
     */
    public function getRegular($user_id)
    {
        return Income::userIs($user_id)->regular()->get();
    }

    /** 
     * 指定した年・月の収入の合計値を取得する(is_regularは0)
     */
    public function getMonthTotalAmount($user_id, $year, $month)
    {
        return Income::userIs($user_id)->unregular()->yearIs($year)->monthIs($month)->sum('amount');
    }

    /**
     * コレクションに包まれた、指定した年月のis_rugularが0のIncomeモデルオブジェクトを取得する
     */
    public function getByYearAndMonth($user_id, $year, $month)
    {
        return Income::userIs($user_id)->unregular()->yearIs($year)->monthIs($month)->get();
    }
}