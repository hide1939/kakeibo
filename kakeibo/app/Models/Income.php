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
}
