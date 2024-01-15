<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Models\Branch;
use App\Models\LoanPackage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            "name" => 'main branch',
            "full_address" => 'headquaters',
        ]);

        StaffRole::create([
            'name' => 'ceo',
            'title' => 'ceo',
            'rank' => '1',
        ]);

        StaffRole::create([
            'name' => 'branch_manager',
            'title' => 'branch manager',
            'rank' => '4',
        ]);

        StaffRole::create([
            'name' => 'loan_officer',
            'title' => 'loan officer',
            'rank' => '5',
        ]);

        LoanPackage::create([
            'name' => '30% interest',
            'interest_type' => 'percentage',
            'interest_value' => '30'
        ]);

        LoanPackage::create([
            'name' => 'fixed interest',
            'interest_type' => 'fixed_amount',
            'interest_value' => '5000'
        ]);

        Staff::create([
            'fullname' => 'the ceo',
            'email' => 'ceo@gmail.com',
            'mobile' => '1234',
            'staff_role_id' => 1,
            'branch_id' => Branch::all()->random()->id,
            'password' => Hash::make('password')
        ]);

        // $this->call([
        //     StaffsSeeder::class
        // ]);
    }
}
