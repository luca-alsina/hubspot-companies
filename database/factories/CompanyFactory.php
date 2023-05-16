<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'industry' => $this->faker->word(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'website' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'number_employees' => $this->faker->randomNumber(),
            'annual_revenue' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
