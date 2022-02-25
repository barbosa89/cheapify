<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Constants\Roles;
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
        $admin = Role::where('name', Roles::ADMIN)->first();
        $customer = Role::where('name', Roles::CUSTOMER)->first();


        User::factory()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ])->roles()->attach($admin);

        User::factory(40)
            ->create()
            ->each(function (User $user) use ($customer) {
                $user->roles()->attach($customer);
            });
    }
}
