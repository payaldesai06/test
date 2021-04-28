<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Str::macro('getNextAutoNumber', function ($char) {
            if($char == 'Category'){
                $num = Category::orderBy('id','desc')->value('id') + 1;
            }elseif($char == 'Product'){
                $num =  Product::orderBy('id','desc')->value('id') + 1;
            }
            return $char.'-'.rand(10,1000).$num;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
