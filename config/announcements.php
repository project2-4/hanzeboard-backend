<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Send mail announcements to all users or just one test account
    |--------------------------------------------------------------------------
    */
    'debug' => env('ANNOUNCEMENTS_MAIL_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Url in mail
    |--------------------------------------------------------------------------
    */
    'url' => 'https://dev.learnandbelieve.nl/courses/{course}/announcements'
];
