<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Advert;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){

        $data['page_title'] = 'welcome';
        $data['products'] = Product::where("is_active", 1)->orderBy('id','desc')->take(6)->get();
        $data['ads'] = Advert::orderBy('position','asc')->get();
        return view('public/welcome', $data);
    }
    public function menu(Request $request){
        $products = Product::where("is_active", 1)->orderBy('id','desc')->get();

        if (isset($_GET['search'])) {
            $validator = Validator::make($request->all(), [
                'search' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with("error", $validator->messages()->first());
            }
            else{
                $products = Product::where("is_active", 1)->where('name', 'like', "%$request->search%")->get();
            }
        }

        $data['page_title'] = 'Our menu';
        $data['products'] = $products;
        $data['request'] = $request;
        return view('public/menu', $data);
    }
    public function about(){

        $data['page_title'] = 'about us ';

        return view('public/about_us', $data);
    }
    public function contact(){

        $data['contacts'] = Contact::orderBy('id','ASC')->take(1)->first();
        $data['page_title'] = 'contact us';

        return view('public/contact_us', $data);
    }
}
