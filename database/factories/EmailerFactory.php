<?php

namespace Database\Factories;

use App\Models\Emailer; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmailerFactory extends Factory
{

    protected $model = Emailer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>  $this->faker->words(3, true),
            'status' => 'active',
            'link' =>  "N/A",
            'author_id' => 1, 
        ];
    }
 
}
 