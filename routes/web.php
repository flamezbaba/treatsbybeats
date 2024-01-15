<?php

use App\Http\Controllers\Web\{PublicController, AjaxController, StripeController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\User\{AuthCon, MainController, CartController};
use App\Http\Controllers\Web\Admin\{AuthController};
use App\Http\Controllers\Web\UserController;

/*s
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//public routes
Route::any('/', [PublicController::class, 'index'])->name('welcome');
Route::any('/hooks/stripe', [StripeController::class, 'hook'])->name('hook.stripe');
Route::any('/payment/verify/{payment_id}', [StripeController::class, 'verify'])->name('hook.verify');
Route::any('/menu', [PublicController::class, 'menu'])->name('menu');
Route::any('/about-us', [PublicController::class, 'about'])->name('about');
Route::any('/contact-us', [PublicController::class, 'contact'])->name('contact');
Route::any('/carts', [CartController::class, 'index'])->name('carts');

Route::post('/record-cart', [AjaxController::class, 'record_cart'])->name('ajax.cart.record');


Route::any('/login', [AuthCon::class, 'login'])->name('user.login');
Route::any('/register', [AuthCon::class, 'register'])->name('user.register');

Route::any('admin/login', [AuthController::class, 'adminLogin'])->name(
    'admin.login'
);


Route::prefix('admin')
    ->name('admin.')
    ->namespace('App\Http\Controllers\Web\Admin')
    ->group(function () {
        Route::middleware('manager')->group(__DIR__ . '/manager.php');
    });

Route::group(['middleware' => 'auth:web'], function(){
    
    Route::any('/orders', [UserController::class, 'orders'])->name(
        'user.order'
    );
    
    
    Route::any('/profile', [UserController::class, 'profile'])->name(
        'user.profile'
    );
    Route::any('/order/{uuid}', [UserController::class, 'checkout'])->name(
        'user.checkout'
    );

});
