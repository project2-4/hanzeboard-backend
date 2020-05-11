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
        User::create([
            'name' => 'Dylan Hiemstra',
            'email' => 'dylan@hanzeboard.nl',
            'password' => bcrypt('hanzeboard')
        ]);

        User::create([
            'name' => 'Jordi Mellema',
            'email' => 'jordi@hanzeboard.nl',
            'password' => bcrypt('ditiseenwachtwoord')
        ]);
    }
}
