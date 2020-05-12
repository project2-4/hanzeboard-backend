<?php

use Illuminate\Database\Seeder;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Subject::all()->each(function ($subject) {
            $subject->assignments()->save(factory(App\Models\Assignment::class)->make([
                'name' => $subject->name
            ]));
        });
    }
}
