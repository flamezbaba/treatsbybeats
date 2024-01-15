<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Site;
use App\Models\Payment;

use \Stripe as Stripe;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        
    }
    
    public function index(Request $request)
    {

        if (isset($_POST['update_status'])) {

            $this->validate($request, [
                'id' => 'required',
                'order_status' => 'required',
            ]);

            $id = Order::find($request->id);

            if ($id) {
                $id->update([
                    'order_status' => strtolower($request->order_status)
                ]);
                
                $user = $id->user;
                    
                    if(strtolower($request->order_status) == "ready"){
                    
                         $msg = "<p>
                            Hello $user->fullname,
                            <br>
                            
                            <b>ORDER NUMBER: $id->uuid</b>
                            <br/>
                            Your order is ready for pickup
                            <br/>
                            <br/>
                            Vibe with every bite.
                        </p>";
                        
                        Site::send_email($user->email, "Order $id->uuid is ready for pickup", $msg);
                    }

                return back()->with('success', 'Successfully Updated');
            } else {
                return back()->with('error', 'Error updating order');
            }
        }

        $data['page_title'] = 'Orders';
        $data['orders'] = Order::orderBy('id', 'desc')->get();
        return view('admin/orders', $data);
    }

    public function view($uuid, Request $request)
    {
        $order = Order::where("uuid", $uuid)->first();
        if ($order) {
            
            if (isset($_POST['update_status'])) {

                $this->validate($request, [
                    'id' => 'required',
                    'order_status' => 'required',
                ]);
    
                $id = Order::find($request->id);
    
                if ($id) {
                    $id->update([
                        'order_status' => strtolower($request->order_status)
                    ]);
                    
                    $user = $id->user;
                    
                    if(strtolower($request->order_status) == "ready"){
                    
                         $msg = "<p>
                            Hello $user->fullname,
                            <br>
                            
                            <b>ORDER NUMBER: $id->uuid</b>
                            <br/>
                            Your order is ready for pickup
                            <br/>
                            <br/>
                            Vibe with every bite.
                        </p>";
                        
                        Site::send_email($user->email, "Order $id->uuid is ready for pickup", $msg);
                    }
    
                    return back()->with('success', 'Successfully Updated');
                } else {
                    return back()->with('error', 'Error updating order');
                }
            }
            
            if (isset($_POST['verify_payment'])) {

                $this->validate($request, [
                    'id' => 'required',
                ]);
    
                $payment = Payment::find($request->id);
    
                if ($payment) {
                    if($payment->is_confirmed == 0){
                    
                        try{
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
                                    return back()->with('success', 'Payment Confirmed');
                                }
                            }
                            
                            return back()->with('error', 'No payment Yet');
                        }
                        catch(\Throwable $e){
                            return back()->with('error', 'Stripe No response');
                        }
                    }
                    else{
                        return back()->with('success', 'Payment Already Confirmed');
                    }
                    
                } else {
                    return back()->with('error', 'Payment not found');
                }
            }
            
        } else {
            return redirect()->route("admin.orders");
        }

        $data['order'] = $order;
        $data['page_title'] = "Order $uuid";
        $data['payments'] = Payment::where('order_id', $order->id)->get();
        return view('admin/view_order', $data);
    }

    public function payments(Request $request)
    {

        if (isset($_POST['update_status'])) {

            $this->validate($request, [
                'id' => 'required',
                'order_status' => 'required',
            ]);

            $id = Order::find($request->id);

            if ($id) {
                $id->update([
                    'order_status' => strtolower($request->order_status)
                ]);
                
                $user = $id->user;
                    
                    if(strtolower($request->order_status) == "ready"){
                    
                         $msg = "<p>
                            Hello $user->fullname,
                            <br>
                            
                            <b>ORDER NUMBER: $id->uuid</b>
                            <br/>
                            Your order is ready for pickup
                            <br/>
                            <br/>
                            Vibe with every bite.
                        </p>";
                        
                        Site::send_email($user->email, "Order $id->uuid is ready for pickup", $msg);
                    }

                return back()->with('success', 'Successfully Updated');
            } else {
                return back()->with('error', 'Error updating order');
            }
        }

        $data['page_title'] = 'Orders';
        $data['orders'] = Payment::orderBy('id', 'desc')->get();
        return view('admin/payments', $data);
    }
}
