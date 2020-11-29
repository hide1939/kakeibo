<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'item' => $this->faker->word,
            'amount' => $this->faker->numberBetween(1),
            'is_regular' => false,
        ];
    }

    /**
     * 定期支出
     */
    public function regular()
    {
        return $this->state(function () {
            return [
                'is_regular' => true
            ];
        });
    }
}
