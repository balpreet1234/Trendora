<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class BaseController extends Controller
{
    public function __construct()
    {
        $data = Category::where('is_parent', null)->orWhere('status', 'active')->get();
        $products = Product::where('status', 'active')->get();

        view()->share(compact('data', 'products'));
    }
}

