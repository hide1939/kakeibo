<?php

namespace App\UseCases;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class MainUseCase 
{
    /**
     * メイン画面で収支を登録する
     */
    public function store($user_id, $param, $item, $amount)
    {
        DB::transaction(function () use ($user_id, $param, $item, $amount) {
            if ($param === 'e') {
                Expense::create([
                    'user_id' => $user_id,
                    'item' => $item,
                    'amount' => $amount
                ]);
            }
            if ($param === 'i') {
                Income::create([
                    'user_id' => $user_id,
                    'item' => $item,
                    'amount' => $amount
                ]);
            }
        });
    }
}