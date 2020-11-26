<?php 

namespace App\UseCases;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class RegularUseCase
{
    /**
     * 定期収支の項目と金額を登録する
     */
    public function store($user_id, $param, $item, $amount)
    {
        DB::transaction(function () use ($user_id, $param, $item, $amount){
            if ($param === 'e') {
                Expense::create([
                    'user_id' => $user_id,
                    'item' => $item,
                    'amount' => $amount,
                    'is_regular' => config('const.is_regular.true')
                ]);
            }
            if ($param === 'i') {
                Income::create([
                    'user_id' => $user_id,
                    'item' => $item,
                    'amount' => $amount,
                    'is_regular' => config('const.is_regular.true')
                ]);
            }
        });
    }
}