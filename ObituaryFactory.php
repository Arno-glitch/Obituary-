<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ObituaryFactory extends Factory
{
    protected $model = \App\Models\Obituary::class;

    public function definition(): array
    {
        $dob = $this->faker->dateTimeBetween('-95 years', '-60 years');
        $dod = $this->faker->dateTimeBetween($dob, 'now');

        return [
            'name' => $this->faker->name(),
            'date_of_birth' => $dob->format('Y-m-d'),
            'date_of_death' => $dod->format('Y-m-d'),
            'content' => $this->faker->paragraphs(3, true),
            'author' => $this->faker->name(),
        ];
    }
}
