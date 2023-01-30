<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nisn' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'phone' => $this->faker->phoneNumber(),
            // 'gender' => $this->faker->randomElement(['male', 'female']),
            // 'place_of_birth' => $this->faker->city(),
            // 'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            // 'religion' => $this->faker->randomElement(['islam', 'hindu', 'protestan', 'katholik', 'buddha', 'konghucu']),
            'address' => $this->faker->streetAddress(),
            // 'last_ip' => $this->faker->ipv4(),
            // 'last_login' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => $this->faker->randomElement(['0', '1']),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 12345,
            'created_at' => now()
        ];
    }
}
