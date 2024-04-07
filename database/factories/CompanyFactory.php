<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'director_name' => $this->faker->name,
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->companyEmail,
            'website' => $this->faker->domainName,
            'phone' => $this->faker->phoneNumber
        ];
    }
}
