<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\Admin;

class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        if ($request->has('login')) {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);

            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                if ($request->password == $admin->password) {
                    Auth::guard('admin')->login($admin);
                    $admin->last_login = now();
                    $admin->ip_address = $request->ip();
                    $admin->meta_data = $request->server('HTTP_USER_AGENT');
                    $admin->save();

                    // dd("got here");

                    return redirect()
                    ->intended(route('admin.dashboard'))
                    ->with(
                        'popsuccess',
                        "Welcome Back"
                    );
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Wrong Password');
                }
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Invalid Login Details');
            }
        }

        Auth::guard('admin')->logout();

        $data['page_title'] = "Administrator Login";

        return view('auth/admin_login', $data);

      
    }
}
