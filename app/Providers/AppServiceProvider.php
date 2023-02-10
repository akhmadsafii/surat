<?php

namespace App\Providers;

use App\Models\Type;
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
        View()->composer('content.types.layout.v_main', function ($view) {
            $type = Type::where('status', '!=', 0)->get();
            $view->with(['type' => $type]);
        });
    }
}
