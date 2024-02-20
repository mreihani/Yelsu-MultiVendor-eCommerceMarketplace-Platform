<?php

namespace App\Providers;

use App\Models\Category;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Services\Categories\GetMegaMenuCategories\GetDynamicMegaMenuMobile;
use App\Services\Categories\GetMegaMenuCategories\GetDynamicMegaMenuDesktop;
use Illuminate\Support\Facades\View;


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
    public function boot(
        GetDynamicMegaMenuDesktop $megaMenuCategoriesDesktop,
        GetDynamicMegaMenuMobile $megaMenuCategoriesMobile): void
    {
        $this->megaMenuCategoriesDesktop = $megaMenuCategoriesDesktop->execute();
        $this->megaMenuCategoriesMobile = $megaMenuCategoriesMobile->execute();
        
        view()->composer(['frontend.master_dashboard', 'frontend.main_theme', 'frontend.shop'], function($view) {
            $view->with([
                'megaMenuCategoriesDesktop' => $this->megaMenuCategoriesDesktop,
                'megaMenuCategoriesMobile' => $this->megaMenuCategoriesMobile,
            ]);
        });
    }
}
