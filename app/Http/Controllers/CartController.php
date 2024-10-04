<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    {
       $cartItems = Cart::instance('cart')->content();
       return view('cart', ['cartItems'=> $cartItems]);
    }

    public  function addToCard(Request $request)
    {

        $product = Product::find($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart')->add($request->id, $product->name,$request->quantity,$price)->associate('App\Models\Product');
        return redirect()->back()->with('message','Succes ! Items has been added succes');
    }
    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }
    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');

    }

    public function clearCart()
        {
            Cart::instance('cart')->destroy();
            return redirect()->route('cart.index');
        }


}
