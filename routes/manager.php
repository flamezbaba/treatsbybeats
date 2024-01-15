<?php

use App\Http\Controllers\Web\Admin\{
    UserController,
    SettingsController,
    ProductController,
    OrderController,
    ContactController,
    AdsController
};

Route::any('/dashboard', [UserController::class, 'dashboard'])->name(
    'dashboard'
);

Route::any('/users', [UserController::class, 'index'])->name(
    'user'
);
Route::any('/order/{uuid}', [OrderController::class, 'view'])->name(
    'order.view'
);

Route::any('/products', [ProductController::class, 'index'])->name(
    'products'
);

Route::any('/orders', [OrderController::class, 'index'])->name(
    'orders'
);

Route::any('/contact_settings', [ContactController::class, 'index'])->name(
    'contacts'
);

Route::any('/advert-settings', [AdsController::class, 'index'])->name(
    'adverts'
);
Route::any('/settings/payment', [SettingsController::class, 'payment_settings'])->name(
    'settings.payment'
);
