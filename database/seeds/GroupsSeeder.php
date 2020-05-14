<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * @var string[]
     */
    public static $groups = ['ITV2A', 'ITV2B', 'ITV2C', 'ITV2D'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$groups as $group) {
            factory(App\Models\Group::class)->create([
                'name' => $group,
            ]);
        }
    }
}
