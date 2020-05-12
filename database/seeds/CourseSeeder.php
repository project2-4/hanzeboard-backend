<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * @var string[]
     */
    public static $courses = [
        'ICTVT SE/NSE 2.1 Computer Systems 2019-2020',
        'ICTVT 2.2 Infrastructuren 2019-2020',
        'ICTVT SE 2.3 Software Engineering 2019-2020',
        'ICTVT SE 2.4 Web & Mobile 2019-2020'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$courses as $course) {
            $course = factory(App\Models\Course::class)->create([
                'name' => $course,
            ]);

            $course->subjects()->createMany(
                factory(App\Models\Subject::class, 5)->make([
                    'course_id' => $course->id
                ])->toArray()
            );

            $course->pages()->createMany(
                factory(App\Models\Page::class, 5)->make([
                    'course_id' => $course->id
                ])->toArray()
            );

            $course->announcements()->createMany(
                factory(App\Models\Announcement::class, 10)->make([
                    'course_id' => $course->id,
                    'posted_by' => \App\Models\Staff::inRandomOrder()->first()->id
                ])->toArray()
            );
        }
    }
}
