<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

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
     * 定期収入
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
