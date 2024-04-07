<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'passport_number' =>$this->faker->unique()->regexify('[A-Z]{2}[0-9]{7}'),
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'father_name' => $this->faker->lastName,
            'positon' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'company_id' => Company::inRandomOrder()->first()->id
        ];
    }
}
