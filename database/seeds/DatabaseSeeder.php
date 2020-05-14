<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(PageItemSeeder::class);
        $this->call(AssignmentsSeeder::class);
        $this->call(UserHasCoursesSeeder::class);
    }
}
