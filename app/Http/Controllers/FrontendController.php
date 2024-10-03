<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends BaseController
{
    //frontend index page
    public function front_index(){
        return view('home');
    }

    //about page function
    public function front_about(){
            return view('about');
        }

   //contact page function
        public function front_contact(){
            return view('contact');
        }

    //shop page function
    public function front_shop(Request $request)
    {
        $data = Category::where('is_parent', null)->orWhere('status', 'active')->get();

        $product = Product::filter($request)
            ->with(['galleries'])
            ->where('status', 'active')
            ->get();

        return view('shop', compact('data', 'product'));
    }

        // cart page view function
        public function front_cart($id)
        {
            $data = Product::find($id);
            return view('cart' ,compact('data'));
        }

}
