<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('isActive', function ($route) {
            return "<?php echo Request::is($route) ? 'bg-primary text-white' : ''; ?>";
        });
    
        Blade::directive('isParentActive', function ($routes) {
            return "<?php echo collect(explode(',', $routes))->contains(fn(\$r) => Request::is(trim(\$r))) ? 'bg-primary text-white' : ''; ?>";
        });
    }
    
}
