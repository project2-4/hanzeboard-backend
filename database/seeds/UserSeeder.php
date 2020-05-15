<?php

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
        foreach (GroupsSeeder::$groups as $group) {
            for ($i = 0; $i < 30; $i++) {
                factory(App\Models\User::class)->create([
                    'profile_id' => factory(App\Models\Student::class)->create([
                        'group_id' => \App\Models\Group::where('name', $group)->first()->id
                    ])
                ]);
            }
        }

        factory(App\Models\User::class, 2)->state('teaching-fellow')->create([
            'profile_type' => 'staff',
            'profile_id' => factory(\App\Models\Staff::class)
        ]);

        factory(App\Models\User::class, 20)->state('teacher')->create([
            'profile_type' => 'staff',
            'profile_id' => factory(\App\Models\Staff::class)
        ]);

        factory(App\Models\User::class, 1)->state( 'admin')->create([
            'profile_type' => 'staff',
            'profile_id' => factory(\App\Models\Staff::class)
        ]);
    }
}
