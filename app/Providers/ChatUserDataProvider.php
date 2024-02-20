<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Category;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class ChatUserDataProvider extends ServiceProvider
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
        $specialist_category_array = [];
        $this->specialist_category_array_unique = [];
    
        $usersList = User::with('specialist_category')->where('role','specialist')->get(["id","specialist_category_id"]);
        foreach ($usersList as $userItem) {
            if($userItem->specialist_category_id != NULL) {
                $specialist_category_array[] = $userItem->specialist_category;
            }
        }
    
        if($specialist_category_array) {
            $this->specialist_category_array_unique = array_unique($specialist_category_array);
        }
        
        view()->composer(['frontend.master_dashboard', 'frontend.main_theme'], function($view) {
            $view->with([
                'specialist_category_array_unique' => $this->specialist_category_array_unique
            ]);
        });
    }
}
