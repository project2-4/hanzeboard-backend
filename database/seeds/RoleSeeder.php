<?php

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
        \App\Models\Role::create([
            'name' => 'Admin',
        ]);

        \App\Models\Role::create([
            'name' => 'Instructor',
        ]);

        \App\Models\Role::create([
            'name' => 'Teacher',
        ]);

        \App\Models\Role::create([
            'name' => 'Teaching fellow',
        ]);

        \App\Models\Role::create([
            'name' => 'Student',
        ]);
    }
}
