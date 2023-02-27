<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $type = $this->faker->randomElement(['I', 'B']);
        $first_name = $type == 'I' ? $this->faker->firstName() : $this->faker->company();
        $last_name = $type == 'I' ? $this->faker->lastName() : NULL;


        return [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'type' => $type,
            'email' => $this->faker->email(),
            'phone' => $this->faker->e164PhoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
