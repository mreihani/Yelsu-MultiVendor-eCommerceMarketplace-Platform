<?php

namespace App\Providers;

use App\Models\Category;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Services\Categories\GetMegaMenuCategories\GetDynamicMegaMenuMobile;
use App\Services\Categories\GetMegaMenuCategories\GetDynamicMegaMenuDesktop;


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
        $agent = new Agent();
   
        if($this->app->request->getRequestUri() != "/" && $agent->isDesktop()) {
            $this->megaMenuCategories = $megaMenuCategoriesDesktop->execute();
        } elseif($this->app->request->getRequestUri() != "/" && !$agent->isDesktop()) {
            $this->megaMenuCategories = $megaMenuCategoriesMobile->execute();
        } else {
            $this->megaMenuCategories = $megaMenuCategoriesDesktop->execute();
        }
        
        view()->composer(['frontend.master_dashboard', 'frontend.main_theme'], function($view) {
            $view->with([
                'megaMenuCategories' => $this->megaMenuCategories
            ]);
        });
    }
}
