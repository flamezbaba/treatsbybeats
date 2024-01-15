<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\StaffRole;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->unique()->phoneNumber(),
            'staff_role_id' => StaffRole::all()->random()->id,
            'branch_id' => Branch::all()->random()->id,
            'password' => Hash::make('password')
        ];
    }
}
