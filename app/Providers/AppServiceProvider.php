<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // blade directives
        Blade::directive('status', function ($expression){
            return "<?php echo($expression ? 'Aktif' : 'Tidak Aktif') ;?>";
        });

        Blade::directive('stringify', function ($expression){
            return "<?php echo(ucwords(str_replace('_', ' ', $expression))) ;?>";
        });

        Blade::directive('time', function ($expression) {
            return "<?php echo(date('H:i', strtotime($expression))); ?>";
        });

        //observers
        // \App\Models\User::observe(new \App\Observers\userObserver);
        \App\Models\Article::observe(new \App\Observers\articleObserver);
        \App\Models\Promotion::observe(new \App\Observers\promotionObserver);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //observers
        // \App\Models\User::observe(new \App\Observers\userObserver);
        \App\Models\Article::observe(new \App\Observers\articleObserver);
        \App\Models\Promotion::observe(new \App\Observers\promotionObserver);
    }
}
