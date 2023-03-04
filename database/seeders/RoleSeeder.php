<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'admin'
            ]
        ];

        Role::insert($roles);
    }
}
