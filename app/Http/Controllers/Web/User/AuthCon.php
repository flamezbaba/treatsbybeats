<?php

namespace App\Http\Controllers\Web\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCon extends Controller
{
    public function login(Request $request)
    {

        if (isset($_POST['login'])) {

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                if ($request->password == $user->password) {
                    Auth::guard('web')->login($user);
                    $user->last_login = now();
                    $user->save();

                    $user = auth()->user();

                    return redirect()
                        ->intended(route('carts'));
                        
                    // if ($request->via) {
                    //     return redirect()
                    //         ->intended(route('carts'))
                    //         ->with(
                    //             'popsuccess',
                    //             "Welcome Back"
                    //         );
                    // } else {
                    //     return redirect()
                    //         ->intended(route('welcome'))
                    //         ->with(
                    //             'popsuccess',
                    //             "Welcome Back"
                    //         );
                    // }
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

        Auth::guard('web')->logout();

        $data['page_title'] = 'Login';

        return view('public/login', $data);
    }

    public function register(Request $request)
    {
        if (isset($_POST['register'])) {
            $this->validate($request, [
                'fullname' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required',
            ]);

            $user = User::create([
                'fullname' => $request->fullname,
                'mobile' => $request->phone,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($user) {
                Auth::guard('web')->login($user);
                $user->last_login = now();
                $user->save();

                // return redirect()->intended(route('welcome'));

                return redirect()
                    ->intended(route('carts'));
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Something went wrong');
            }
        }

        $data['page_title'] = 'register';
        return view('public/register', $data);
    }
}
