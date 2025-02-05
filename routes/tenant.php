<?php

declare(strict_types=1);

use App\Models\Shop;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'tenant.check','web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    
])->group(function () {
    Route::get('/', [ShopController::class, 'showcategory'])->name('shop.home');
    Route::get('/category/{id}/products', [ShopController::class, 'getProducts'])->name('category.products');
});
