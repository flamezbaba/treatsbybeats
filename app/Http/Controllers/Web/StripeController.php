<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use App\Models\Site;
// use \Stripe as Stripe;
use \Stripe as Stripe;

class StripeController extends Controller
{
    public function hook(Request $request)
    {
        
    }

    public function verify($payment_id, Request $request)
    {
        $payment = Payment::find($payment_id);
        if ($payment) {
            try{
                if ($payment->is_confirmed == 0) {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $link = Stripe\Checkout\Session::Retrieve([
                        'id' => $payment->stripe_link_id
                    ]);
    
                    if ($link) {
    
                        if ($link->payment_status == 'paid') {
                            $payment->is_confirmed = 1;
                            $payment->order->payment_status = 1;
                            $payment->order->payment_method = 'stripe';
                            $payment->order->save();
                            $payment->save();
                            
                            $order =  $payment->order;
                            $user =  $payment->user();
                            
                            $msg = "<p>
                                    Hello $user->fullname,
                                    <br>
                                    
                                    <b>ORDER NUMBER: $order->uuid</b>
                                    <br/>
                                    Just a heads up, your order is being prepared, you will get a follow up notification when it’s ready
                                    <br/>
                                    <br/>
                                    Vibe with every bite.
                                </p>";
                                
                            Site::send_email($user->email, "Order $order->uuid is being prepared", $msg);
                            
                            // kitchen email
                            $url = route("admin.order.view", $order->uuid);
                            $msg = "<p>
                                    Hello Chef,
                                    <br>
                                    You just receive an order and should be ready in 15minutes
                                    <br/>
                                    <br/>
                                    <b>Customer details</b>
                                    OrderID: $order->uuid
                                    <br/>
                                    Name: $user->fullname
                                    <br/>
                                    Phone number: $user->mobile
                                    <br/>
                                        <a href='$url'>View order</a>
                                    <br/>
                                    <br/>
                                    Vibe with every bite.
                                </p>";
                                
                            Site::send_email("treatsbybeats@gmail.com", "New Order $order->uuid", $msg);
                            
                            return redirect()->route("user.checkout", $payment->order->uuid)->with("success", "Payment Successful");
                        }
                    }
                }
                
                // dd("already confirmed");
                
                return redirect()->route("user.checkout", $payment->order->uuid);
            }
            catch(\Throwable $e){
                // dd($e);
                return redirect()->route("user.checkout", $payment->order->uuid);
            }
            
        } else {
            return redirect()->route("user.order");
        }
    }
}
