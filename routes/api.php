<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [\App\Http\Controllers\api\C_Overview::class, 'index']);
Route::post('/login', [\App\Http\Controllers\api\C_Overview::class, 'login']);
Route::get('/register', [\App\Http\Controllers\api\C_Overview::class, 'register']);
Route::post('/register', [\App\Http\Controllers\api\C_User::class, 'registerProcess']);
Route::get('/logout', [\App\Http\Controllers\api\C_Overview::class, 'logout']);

Route::get('/detail/{id}', [\App\Http\Controllers\api\C_Product::class, 'detail'])->whereNumber('id');
Route::post('/verify-email', [\App\Http\Controllers\api\C_User::class, 'verifyEmail']);
Route::post('/forgot-password', [\App\Http\Controllers\api\C_Overview::class, 'forgotPassword']);
Route::get('/reset-password', [\App\Http\Controllers\api\C_Overview::class, 'resetPasswordCheckToken']);
Route::post('/reset-password', [\App\Http\Controllers\api\C_Overview::class, 'resetPasswordProcess']);
Route::get('/resend-email-token', [\App\Http\Controllers\api\C_Overview::class, 'resendEmailToken']);

Route::get('/profile', [\App\Http\Controllers\api\C_User::class, 'profile']);
Route::post('/profile', [\App\Http\Controllers\api\C_User::class, 'updateProfile']);
Route::get('/change-password', [\App\Http\Controllers\api\C_User::class, 'changePasswordV']);
Route::post('/change-password', [\App\Http\Controllers\api\C_User::class, 'changePassword']);
Route::get('/address', [\App\Http\Controllers\api\C_User::class, 'address']);
Route::post('/address', [\App\Http\Controllers\api\C_User::class, 'saveAddress']);
Route::get('/wishlist/{id}', [\App\Http\Controllers\api\C_User::class, 'wishlist']);
Route::get('/r-wishlist/{id}', [\App\Http\Controllers\api\C_User::class, 'removeWishlist']);
Route::get('/shop', [\App\Http\Controllers\api\C_Product::class, 'shop']);
Route::post('/shop', [\App\Http\Controllers\api\C_Product::class, 'shopFilter']);
Route::get('/contact', [\App\Http\Controllers\api\C_Overview::class, 'contact']);
Route::get('/wishlist', [\App\Http\Controllers\api\C_User::class, 'showWishlist']);
Route::get('/add-to-cart/{id}', [\App\Http\Controllers\api\C_User::class, 'addToCart']);
Route::get('/minus-item-cart/{id}', [\App\Http\Controllers\api\C_User::class, 'minusItemCart']);
Route::get('/plus-item-cart/{id}', [\App\Http\Controllers\api\C_User::class, 'plusItemCart']);
Route::get('/remove-cart/{id}', [\App\Http\Controllers\api\C_User::class, 'removeCart']);
Route::get('/billing', [\App\Http\Controllers\api\C_Transaction::class, 'billing']);
Route::post('/checkout', [\App\Http\Controllers\api\C_Transaction::class, 'checkout']);
Route::get('/remove-all-cart', [\App\Http\Controllers\api\C_User::class, 'removeAllCart']);

Route::view('login', 'user.login');
Route::get('cart', [\App\Http\Controllers\api\C_User::class, 'cart']);
Route::view('verify-email', 'user.verify-email');
Route::view('complete-data', 'user.complete-data');
Route::get('forgot-password', [\App\Http\Controllers\api\C_User::class, 'forgotPassword']);


Route::get('transaction/payment-pending', [\App\Http\Controllers\api\C_Transaction::class, 'paymentPending']);
Route::get('transaction/shipment-pending', [\App\Http\Controllers\api\C_Transaction::class, 'shipmentPending']);
Route::get('transaction/shipment-process', [\App\Http\Controllers\api\C_Transaction::class, 'shipmentProcess']);
Route::get('transaction/confirm/{id}', [\App\Http\Controllers\api\C_Transaction::class, 'confirmTransaction']);
Route::get('transaction/order-completed', [\App\Http\Controllers\api\C_Transaction::class, 'orderCompleted']);
Route::get('transaction/order-canceled', [\App\Http\Controllers\api\C_Transaction::class, 'orderCanceled']);
Route::get('transaction/detail/{id}', [\App\Http\Controllers\api\C_Transaction::class, 'detailTransaction']);
Route::get('privacy-policy', [\App\Http\Controllers\api\C_Overview::class, 'privacyPolicy']);
Route::get('terms-conditions', [\App\Http\Controllers\api\C_Overview::class, 'termsConditions']);
Route::get('about-us', [\App\Http\Controllers\api\C_Overview::class, 'aboutUs']);

//Admin
Route::get('/adm', [\App\Http\Controllers\admin\C_Overview::class, 'index']);
Route::get('/adm/user-management', [\App\Http\Controllers\admin\C_UserManagement::class, 'manageUser']);
Route::get('/adm/user-management/add', [\App\Http\Controllers\admin\C_UserManagement::class, 'manageUserAdd']);
Route::get('/adm/user-management/edit/{id}', [\App\Http\Controllers\admin\C_UserManagement::class, 'manageUserEdit'])->whereNumber('id');
Route::post('/adduser', [\App\Http\Controllers\admin\C_UserManagement::class, 'addUser']);
Route::post('/edit-user', [\App\Http\Controllers\admin\C_UserManagement::class, 'editUser']);
Route::get('/delete-user/{id}', [\App\Http\Controllers\admin\C_UserManagement::class, 'deleteUser'])->whereNumber('id');

Route::get('adm/admin-management', [\App\Http\Controllers\admin\C_AdminManagement::class, 'index']);
Route::get('adm/admin-management/add', [\App\Http\Controllers\admin\C_AdminManagement::class, 'manageAdminAdd']);
Route::get('adm/admin-management/edit/{id}', [\App\Http\Controllers\admin\C_AdminManagement::class, 'manageAdminEdit'])->whereNumber('id');
Route::post('/addadmin', [\App\Http\Controllers\admin\C_AdminManagement::class, 'addUser']);
Route::post('/edit-admin', [\App\Http\Controllers\admin\C_AdminManagement::class, 'editUser']);
Route::get('/delete-admin/{id}', [\App\Http\Controllers\admin\C_AdminManagement::class, 'deleteAdmin'])->whereNumber('id');

Route::get('adm/product', [\App\Http\Controllers\admin\C_Product::class, 'index']);
Route::post('adm/product/add', [\App\Http\Controllers\admin\C_Product::class, 'addProcess']);
Route::get('adm/product/add', [\App\Http\Controllers\admin\C_Product::class, 'add']);
Route::get('adm/product/delete/{id}', [\App\Http\Controllers\admin\C_Product::class, 'delete']);
Route::get('adm/product/edit/{id}', [\App\Http\Controllers\admin\C_Product::class, 'edit']);
Route::post('adm/product/edit/{id}', [\App\Http\Controllers\admin\C_Product::class, 'editProcess']);

Route::get('adm/category', [\App\Http\Controllers\admin\C_Category::class, 'index']);
Route::get('adm/category/delete/{id}', [\App\Http\Controllers\admin\C_Category::class, 'delete'])->whereNumber('id');
Route::get('adm/category/edit/{id}', [\App\Http\Controllers\admin\C_Category::class, 'edit'])->whereNumber('id');
Route::post('adm/category/edit/{id}', [\App\Http\Controllers\admin\C_Category::class, 'editProcess'])->whereNumber('id');
Route::post('adm/category/add', [\App\Http\Controllers\admin\C_Category::class, 'addProcess']);
Route::get('adm/category/add', [\App\Http\Controllers\admin\C_Category::class, 'add']);

Route::get('adm/payment-pending', [\App\Http\Controllers\admin\C_Transaction::class, 'paymentPending']);
Route::view('adm/payment-approval', 'admin/transaction.payment-approval');
Route::get('adm/shipment-pending', [\App\Http\Controllers\admin\C_Transaction::class, 'shipmentPending']);
Route::get('adm/shipment-process', [\App\Http\Controllers\admin\C_Transaction::class, 'shipmentProcess']);
Route::get('adm/order-completed', [\App\Http\Controllers\admin\C_Transaction::class, 'orderCompleted']);
Route::get('adm/order-canceled', [\App\Http\Controllers\admin\C_Transaction::class, 'orderCanceled']);
Route::get('adm/all-transaction', [\App\Http\Controllers\admin\C_Transaction::class, 'allTransaction']);

Route::get('adm/detail-transaction/{id}', [\App\Http\Controllers\admin\C_Transaction::class, 'detailTransaction']);
Route::get('cancel-transaction/{id}', [\App\Http\Controllers\api\C_Transaction::class, 'cancelTransaction']);
Route::get('confirm-payment/{id}', [\App\Http\Controllers\admin\C_Transaction::class, 'confirmPayment']);
Route::get('confirm-shipment/{id}', [\App\Http\Controllers\admin\C_Transaction::class, 'confirmShipment']);
Route::get('transaction-finish/{id}', [\App\Http\Controllers\admin\C_Transaction::class, 'transactionFinish']);
