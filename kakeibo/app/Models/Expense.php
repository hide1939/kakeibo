<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * 複数代入できる(createメソッドを使える)属性
     */
    protected $fillable = ['user_id', 'item', 'amount', 'is_regular'];

    /**
     * 定期収支判定フラグにはデフォルトでfalseを指定
     */
    protected $attributes = [
        'is_regular' => false,
    ];
}
