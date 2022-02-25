<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Constants\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => Roles::ADMIN,
        ]);

        Role::create([
            'name' => Roles::CUSTOMER,
        ]);
    }
}
