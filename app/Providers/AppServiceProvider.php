<?php

namespace App\Providers;

use App\Models\Staff;
use App\Models\Student;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'student' => Student::class,
            'staff' => Staff::class,
        ]);

        /** @soure https://github.com/laravel/docs/blob/7.x/migrations.md#index-lengths--mysql--mariadb */
        Schema::defaultStringLength(191);
    }
}
