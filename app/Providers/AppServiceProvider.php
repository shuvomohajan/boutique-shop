<?php

namespace App\Providers;

use App\Model\CompanySetting;
use App\User;
use App\Model\Subject;
use App\Model\Category;
use App\Model\Language;
use App\Model\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);

        $data['categories'] = Category::where('status', 1)->get();
        $data['subjects']   = Subject::where('status', 1)->get();
        $data['authors']    = User::where('status', 1)->where('type', 'author')->get();
        $data['publishers'] = User::where('status', 1)->where('type', 'publisher')->get();
        $data['languages']  =  Language::where('status', 1)->get();
        $data['minPrice']  = Product::min('regular_price');
        $data['maxPrice']  = Product::max('regular_price');
        $data['companyInfo']  = CompanySetting::first();

        View::share($data);
    }
}
