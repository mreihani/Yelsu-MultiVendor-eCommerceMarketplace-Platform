<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot() : void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/web/assets.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/web/front-dashboard.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/cart.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/frontend.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/blog.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/payment.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/web/checkout.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/chat.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/sms.php'));

            Route::middleware(['web'])
                ->group(base_path('routes/web/geomarketing.php'));

            Route::middleware(['web', 'auth', 'role:admin'])
                ->prefix('admin')
                ->group(base_path('routes/web/admin.php'));

            Route::middleware(['web', 'auth', 'role:vendor'])
                ->prefix('vendor')
                ->group(base_path('routes/web/vendor.php'));

            Route::middleware(['web', 'auth', 'role:merchant'])
                ->prefix('merchant')
                ->group(base_path('routes/web/merchant.php'));

            Route::middleware(['web', 'auth', 'role:editor'])
                ->prefix('editor')
                ->group(base_path('routes/web/editor.php'));

            Route::middleware(['web', 'auth', 'role:specialist'])
                ->prefix('specialist')
                ->group(base_path('routes/web/specialist.php'));

            Route::middleware(['web', 'auth', 'role:retailer'])
                ->prefix('retailer')
                ->group(base_path('routes/web/retailer.php'));

            Route::middleware(['web', 'auth', 'role:financial'])
                ->prefix('financial')
                ->group(base_path('routes/web/financial.php'));
            Route::middleware(['web', 'auth', 'role:freightage'])
                ->prefix('freightage')
                ->group(base_path('routes/web/freightage.php'));
            Route::middleware(['web', 'auth', 'role:driver'])
                ->prefix('driver')
                ->group(base_path('routes/web/driver.php'));    
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting() : void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}