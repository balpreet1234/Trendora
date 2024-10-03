<?php

// app/Http/Controllers/ShippingController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::orderBy('id','desc')->get();
        return view('admin.pages.shipping.index', compact('shippings'));
    }

    public function create()
    {

        return view('admin.pages.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_area' => 'required',
            'shipping_method' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        Shipping::create($request->all());
        return redirect()->route('shippings.index')->with('success', 'Shipping information added successfully.');
    }

    public function edit(Shipping $shipping)
    {

        return view('admin.pages.shipping.create', compact('shipping'));
    }

    public function update(Request $request, Shipping $shipping)
    {
        $request->validate([
            'shipping_area' => 'required',
            'shipping_method' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        $shipping->update($request->all());
        return redirect()->route('shippings.index')->with('success', 'Shipping information updated successfully.');
    }

    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->route('shippings.index')->with('success', 'Shipping information deleted successfully.');
    }
}
