<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Support\Str;
class CouponController extends Controller
{

    //index function
    public function index()
    {
        $coupons = Coupon::with('category')->orderBy('id','desc')->get();

        return view('admin.pages.coupon.index', compact('coupons'));
    }

    public function create()
    {
        $categories = Category::where('is_parent',null)->where('status','active')->get();
        return view('admin.pages.coupon.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
        ]);

        Coupon::create($request->all());
        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $categories = Category::where('is_parent',null)->where('status','active')->get();
        return view('admin.pages.coupon.create', compact('coupon', 'categories'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'status' => 'nullable',
        ]);

        $coupon->update($request->all());
        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}

