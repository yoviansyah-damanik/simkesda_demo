<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Paginator::useBootstrap();

        Blade::directive('numb', function ($numb) {
            return "<?php echo number_format($numb, 0, ',','.'); ?>";
        });

        Blade::directive('decimal', function ($numb) {
            return "<?php echo number_format($numb, 2, ',','.'); ?>";
        });
    }
}
