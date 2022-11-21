<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Ariel Recto', 
            'Email' => 'arielrecto@pogi.com',
            'password' => bcrypt('ariel123'),
            'is_admin' => true
        ];
    }
}
