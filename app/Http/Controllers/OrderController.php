<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Cart;

class OrderController extends Controller
{
    public function create()
    {
        return view('order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->full_name = $request->input('full_name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->total = Cart::instance('cart')->total();
        $order->status = 'pending';
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->quantity = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->save();
        }

        Cart::instance('cart')->destroy();

        return redirect()->route('order.create')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.invoice', compact('order'));
    }
}