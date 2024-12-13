<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Favorites;
use Illuminate\Support\Facades\Auth;



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
        Schema::defaultStringLength(191);
        if(config('app.env') === 'production') {
            URL::forceScheme('https');

             // Share categories and subcategories with all views
        View::composer('*', function ($view) {
            // Fetch all categories and their associated subcategories
            $categories = Category::with('subcategories')->get();
            $view->with('categories', $categories);

            // Favorite count logic for the logged-in user
            $favoritesCount = 0; // Default count is 0
            if (Auth::check()) {
                // If the user is logged in, fetch their favorite count
                $favoritesCount = Favorites::where('email', Auth::user()->email)->count();
            }
            // Share the favorite count with all views
            $view->with('favoritesCount', $favoritesCount);
        });       
    }
}
       
}
