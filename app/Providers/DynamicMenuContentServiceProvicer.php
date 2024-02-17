<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class DynamicMenuContentServiceProvicer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->parentCategories = Category::with('child')->where('parent', 0)->get();

        view()->composer('frontend.master_dashboard', function($view) {
            $view->with([
                'parentCategories' => $this->parentCategories
            ]);
        });
    }
}
