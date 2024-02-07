<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Login;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Login>
 */
class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => random_int(1, 200),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
