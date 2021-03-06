<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item', 'amount', 'is_regular'];

    protected $attributes = [
        'is_regular' => false,
    ];

    public function scopeUserIs($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeRegular($query)
    {
        return $query->where('is_regular', config('const.is_regular.true'));
    }

    public function scopeUnregular($query)
    {
        return $query->where('is_regular', config('const.is_regular.false'));
    }

    public function scopeYearIs($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }

    public function scopeMonthIs($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }
}
