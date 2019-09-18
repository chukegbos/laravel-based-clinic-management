<?php

namespace App\Providers;

use View;
use App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Setting;
use App\Medicat;
use App\Expensecat;
use App\Department;
use DB;
use App\Hot;
use App\Report;
use App\Bed;
use App\User;
use App\Service;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*', function($view)
        {
            $view->with('setting', Setting::find(1));
            $view->with('departmentss', Department::where('deleted_at', NULL)->get());
            $view->with('beds', Bed::where('deleted_at', NULL)->where('occupant', '!=', NULL)->get());
            $view->with('user1', User::where('deleted_at', NULL)->get());
            $view->with('medicats', Medicat::where('deleted_at', NULL)->get());
            $view->with('expensecat', Expensecat::where('deleted_at', NULL)->get());
            $view->with('services', Service::where('deleted_at', NULL)->get());
            $view->with('admission_order', Report::where('admission', 'Yes')->where('admission_booked', NULL)->where('deleted_at', NULL)->orderBy('created_at', 'desc')->count());
            $view->with('drugorder', Report::where('prescription', '!=', NULL)->where('prescription_billed', NULL)->where('deleted_at', NULL)->count());
        });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
