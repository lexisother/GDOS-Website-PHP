<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactItemFactory extends Factory
{
    /**
     * Define the mode's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'author_name' => \App\Models\User::all()->random()->name,
        ];
    }
}
