<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\Models\Site;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data['page_title'] = "Customers";
        $data['users'] = User::orderBy("id", "desc")->get();
        return view('admin/users', $data);
    }

    public function dashboard(Request $request)
    {
        $data['page_title'] = "Dashboard";
        $data['users'] = User::orderBy("id", "desc")->get();
        $data['orders'] = Order::orderBy("id", "desc")->get();
        return view('admin/dashboard', $data);
    }
}
