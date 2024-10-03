<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Product;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        // You can register bindings here if needed
    }
}
