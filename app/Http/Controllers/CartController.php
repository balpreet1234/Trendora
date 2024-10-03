<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;
class CartController extends BaseController
{

    public function cart_index()
    {
        $userId = Auth::id() ?? 1;
        $data = Cart::with('product')->where('user_id', $userId)->get();

        return view('cart', compact('data'));
    }

    // Cart adding function
    public function cart_store(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id() ?? 1;
        $product = Product::findOrFail($productId);
        $discount = $product->discount ?? 0;
        $discountedPrice = $product->price - ($product->price * ($discount / 100));

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity');
            $cartItem->amount = $cartItem->quantity * $discountedPrice;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'quantity' => $request->input('quantity'),
                'amount' => $request->input('quantity') * $discountedPrice,
                'status' => 'new',
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    // Cart updating function
    public function cart_update_all(Request $request)
    {
        $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*.id' => 'required|exists:carts,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->input('cart_items') as $item) {
            $cartItem = Cart::findOrFail($item['id']);
            $product = $cartItem->product;
            $discount = $product->discount ?? 0;
            $discountedPrice = $product->price - ($product->price * ($discount / 100));
            $cartItem->quantity = $item['quantity'];
            $cartItem->amount = $cartItem->quantity * $discountedPrice;
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    // Cart remove function
    public function cart_destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['success' => 'Item removed from cart successfully!']);
    }


public function proceedToCheckout()
{
    $userId = Auth::id() ?? 1;
    $cartItems = Cart::where('user_id', $userId)->with('product')->get();


    session(['cart' => $cartItems]);

    return redirect()->route('cart.checkout');
}

// Checkout page function
public function cart_checkout()
{
    $cartItems = session('cart', []);
    $countries = DB::table('countries')->get();
    $subtotal = 0;
    $totalQuantity = 0;
    $cartIds = [];
    foreach ($cartItems as $item) {
        $subtotal += $item['amount'];
        $totalQuantity += $item['quantity'];
        $cartIds[] = $item['id'];
    }
    $cartIdsString = implode(',', $cartIds);
    $deliveryFee = 0;
    $total = $subtotal + $deliveryFee;

    return view('checkout', compact('cartItems', 'countries', 'subtotal', 'total', 'totalQuantity', 'cartIdsString'));
}



public function searchStates(Request $request)
{
    $countryId = $request->input('country_id');
    $states = DB::table('states')->where('country_id', $countryId)->get();

    return response()->json($states);
}

public function searchCities(Request $request)
{
    $stateId = $request->input('state_id');
    $cities = DB::table('cities')->where('state_id', $stateId)->get();

    return response()->json($cities);
}



}
