<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Site;
use App\Models\Payment;

use \Stripe as Stripe;

class UserController extends Controller
{
    public function checkout($uuid, Request $request)
    {
        $user = Auth::guard('web')->user();
        $order = Order::where("uuid", $uuid)->where("user_id", $user->id)->first();
        if ($order) {
            if (isset($_POST['checkout'])) {

                try {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $price = Stripe\Price::create([
                        'currency' => 'usd',
                        'unit_amount' => $order->total_amount * 100,
                        'product_data' => ['name' => $order->uuid],
                    ]);

                    $payment = new Payment();
                    $payment->order_id = $order->id;
                    $payment->amount = $order->total_amount;
                    $payment->save();

                    $link = Stripe\CheckOut\Session::create([
                        'line_items' => [
                            [
                                'price' => $price->id,
                                'quantity' => 1,
                            ],
                        ],
                        'metadata' => ['order_uuid' => $order->uuid],
                        'cancel_url' => route("hook.verify", $payment->id),
                        'success_url' => route("hook.verify", $payment->id),
                        'mode' => 'payment',
                        'customer_email' => $user->email,

                    ]);


                    if ($link) {
                        $payment->stripe_link_id = $link->id;
                        $payment->stripe_payment_link = $link->url;
                        $payment->save();

                        return redirect($link->url);
                    } else {
                        $payment->delete();
                        return back()->with("error", "Payment Failed");
                    }
                } catch (\Throwable $e) {
                    return back()->with("error", "Payment Failed");
                }
            } 
            
            
            if (isset($_POST['refund'])) {
                
                $img = "";
                
                if ($request->file('receipt')) {
                    $picture = $request->file('receipt');
    
                    $ext = strtolower($picture->getClientOriginalExtension());
                    if (($ext != 'png') and ($ext != 'jpg') and ($ext != 'jpeg') and ($ext != 'pdf')) {
                        return ["status" => false, "data" => "Invalid file format Upload. Only jpg, jpeg, png and pdf supported."];
                    }

                    $pic = $picture->store("refunds");
                    $img = url("storage/app/$pic");
                }
                
                $order->refund = 1;
                $order->save();

                $msg = "<p>
                            Hello Admin,
                            <br>
                            You just receive a refund request from
                            <br/>
                            <br/>
                            <b>Customer details</b>
                            OrderID: $order->uuid
                            <br/>
                            Name: $user->fullname
                            <br/>
                            Phone number: $user->mobile
                            <br/>
                            Email: $user->email
                             <br/>
                            Note: $request->note
                             <br/>
                            Image: <a href='$img'>The Image</a>
                            
                        </p>";
                                
                Site::send_email("treatsbybeats@gmail.com", "Refund Request $order->uuid", $msg);
                Site::send_email("support@treatsbybeats.com", "Refund Request $order->uuid", $msg);
                return redirect()->back()->with("success", "Refund Request Submitted");
            } 
            
            
        }
        else {
            return redirect()->route("user.order");
        }

        $data['order'] = $order;
        $data['user'] = $user;
        $data['page_title'] = "My Order";
        return view('public/checkout', $data);
    }

    public function orders()
    {
        $user = auth()->user();
        $data['page_title'] = 'My Orders';
        $data['user'] = $user;
        // dd($user->orders());
        return view('user/myorders', $data);
    }

    public function profile(Request $request)
    {

        $user = auth()->user();

        if (isset($_POST['update'])) {

            $id = User::find($user->id);
            if ($id) {
                $id->update([
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'mobile' => $request->phone
                ]);

                $id->save();

                return back()->with('success', 'Personal Details Successfully updated');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }

        $data['page_title'] = 'Profile';
        $data['user'] = auth()->user();
        return view('user/profile', $data);
    }
}
