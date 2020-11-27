<?php

namespace App\Services\Command;

use App\Models\Expense;

class ExpenseService
{
    public function delete($id)
    {
        Expense::findOrFail($id)->delete();
    }
}