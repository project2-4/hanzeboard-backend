<?php

use Illuminate\Database\Seeder;

class UserHasCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Course::all()->each(function ($course) {
            App\Models\User::all()->each(function ($user) use ($course) {
                DB::table('user_has_courses')->insert([
                    ['course_id' => $course->id, 'user_id' => $user->id],
                ]);
            });
        });
    }
}
