<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
class OrdersController extends BaseController
{

    //listing function of order
    public function order_index(){

        // $orders = Order::where('user_id', Auth::id())->get();
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.pages.order.index',compact('orders'));
    }

    //order view function
    public function order_show($id)
    {
        $order = Order::with(['user'])->find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $cartIds = explode(',', $order->cart_id);
        $carts = Cart::whereIn('id', $cartIds)->with('product')->get();

        return view('admin.pages.order.view', compact('order', 'carts'));
    }


     // order store function
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits:10',
            'country_id' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'postcode' => 'required|min:3|string',
            'address' => 'required|string|max:255',
        ]);


        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();


        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(uniqid());
        $order->user_id = $user->id;
        $cartIds = explode(',', $request->cart_id[0]);
        $cartJson = json_encode($cartIds);
        $cartArrayIds = implode(',', $cartIds);
          $order->cart_id = $cartArrayIds;
        $order->sub_total = $request->sub_total;
        $order->total_amount = $request->total_amount;
        $order->quantity = $request->quantity;
        $order->delivery_fee = $request->delivery_fee ?? 10;
        $order->payment_method = $request->payment_method ?? 'cod';
        $order->payment_status = 'unpaid';
        $order->status = 'new';
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->country = $request->country_id;
        $order->state = $request->state_id;
        $order->city = $request->city_id;
        $order->post_code = $request->postcode;
        $order->address1 = $request->address;
        $order->address2 = $request->apartment ?? '';
        $order->save();


        return redirect()->back()->with('success','order saved successfully');
    }

   //order delete function
    public function order_destroy($id)
    {
        $product=Order::find($id);
        $product->softDeletes();
        return redirect()->back()->with('success','Product deleted successfully');
    }

    //download invoice and sending mail
    public function downloadInvoice($id)
    {
        $order = Order::with(['user'])->find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $cartIds = explode(',', $order->cart_id);
        $carts = Cart::whereIn('id', $cartIds)->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'No products found in this order.');
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $html = view('admin.pages.order.invoice', compact('order', 'carts'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfOutput = $dompdf->output();

        Mail::to($order->user->email)->send(new InvoiceMail($order, $carts, $pdfOutput));

        return response()->stream(function () use ($pdfOutput) {
            echo $pdfOutput;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice_' . $order->order_number . '.pdf"',
        ]);
    }

}
