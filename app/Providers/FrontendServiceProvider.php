<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Blog;

class FrontendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('sidebar.blogsidebar',function($view){
            $categories=Category::with(['blogs'=>function($query){
                $query->published();
            }])->orderBy('title','asc')->get();
            return $view->with('categories',$categories);
        });
        view()->composer('sidebar.recent-post',function($view){
            $blogs=Blog::published()->orderBy('created_at','desc')->limit(3)->get();
            return $view->with('blogs',$blogs);
        });
    }
}
