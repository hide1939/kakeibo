<?php

namespace App\Services\Command;

use App\Models\Income;

class IncomeService
{
    public function delete($id)
    {
        Income::findOrFail($id)->delete();
    }
}