<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Order;
use App\Models\Site;

class AjaxController extends Controller
{
    public function record_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' =>  $validator->messages()->first()], 404);
        } else {
            // return response()->json(['data' =>  $request->products[0]['name']], 200);
            $user = Auth::guard('web')->user();
            $products = [];
            $total_amount = 0;

            foreach($request->products as $p){
                $prod = Product::find($p['id']);

                if($prod){
                    $total = (int)$p['qty'] * (float)$prod->price;
                    // $total = number_format($total, 2, '.', null);
                    // $total = round((float)$total, 1);

                    $pp = [
                        "id" => $prod->id,
                        "name" => $p['name'],
                        "image_url" => $p['image_url'],
                        "description" => $p['description'],
                        "qty" => $p['qty'],
                        "price" => $prod->price,
                        "total_price" => $total,
                    ];

                    $total_amount = $total_amount + $total;
                    array_push($products, $pp);
                }
            }

            if(count($products) < 1){
                return response()->json(['data' => "no products selected"], 404);
            }

            $order = new Order();
            $order->uuid = strtoupper(Str::random(5));
            $order->user_id = $user->id;
            $order->products = $products;
            
            $order->total_amount = $total_amount;
            $order->save();
            
            

            $url = route("user.checkout", $order->uuid);

            return response()->json(['data' => $url], 200);
        }
        
    }
}
