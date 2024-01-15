<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {

        $data['page_title'] = 'Carts';
        $data['carts'] = session('cart', []);
        $cart = $data['carts'];
        foreach ($cart as $r) {
            if (isset($r['product']) && isset($r['product']->image)) {
                $product = $r['product'];
                $product->image_url = asset('storage/app/public/products/' . $product->image ?? "") ?? "";
            }
        }
        $data['user'] = auth()->user();
        $data['page_title'] = 'Carts';
        return view('public/carts', $data);
    }

    public function addToCart(Request $request)
    {
        $pdtId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($pdtId);

        if (!$product) {
            return response()->json(['message' => 'Not found' . $pdtId], 404);
        }

        $cart = session('cart', []);


        $totalPrice = (int)$quantity * (float)$product->price;

        $cart[$pdtId] = [
            'product' => $product,
            'quantity' => $quantity,
            'total_price' => $totalPrice
        ];

        session(['cart' => $cart]);

        return response()->json(['message' => 'Added to cart'], 400);
    }


    public function removeCart(Request $request)
    {
        $pdtId = $request->get('product_id');
        // echo($pdtId);

        session()->forget('cart.' . $pdtId);
        return response()->json(['message' => 'Cart is Removed'], 400);
    }
}
