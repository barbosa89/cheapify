<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = Role::where('name', 'seller')->first();
        $customer = Role::where('name', 'customer')->first();

        User::factory()
            ->count(6)
            ->create()
            ->each(function (User $user) use ($seller) {
                $user->roles()->attach($seller);
            });

        User::factory()
            ->count(6)
            ->create()
            ->each(function (User $user) use ($customer) {
                $user->roles()->attach($customer);
            });
    }
}
