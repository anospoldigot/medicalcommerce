<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date =   $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'type'                  => 'in',
            'note'                  => $this->faker->sentence(),
            'paid_at'               => $date,
            'amount'                => rand(100000, 3000000),
            'status'                => 'paid',
            'created_at'            => $date
        ];
    }
}
