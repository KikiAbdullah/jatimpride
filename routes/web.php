<?php

use App\Mail\FileMail;
use App\Models\Trans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------mo
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect()->route('siteurl');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AppController@index')->name('siteurl');


        Route::group(['prefix' => 'user-setup', 'as' => 'user-setup.'], function () {
            Route::middleware('can:view_users')->resource('user', 'UserController');
        });
        Route::get('/listuser', 'UserController@ajaxData')->name('get.user')->middleware('can:view_users');

        Route::get('/permission', 'AppController@permission')->name('permission')->middleware('can:view_permissions');
        Route::get('/permission-list', 'AppController@permissionlist')->name('permission.list');
        Route::get('/role', 'AppController@role')->name('role')->middleware('can:view_roles');
        Route::post('/getroles', 'AppController@getroles')->name('get.roles');
        Route::post('/addroles', 'AppController@saverole')->name('add.roles')->middleware('can:edit_roles');
        Route::delete('/deleteroles', 'AppController@deleteroles')->name('delete.roles')->middleware('can:edit_roles');
        Route::post('/getmenuoptionroles', 'AppController@menuoptionroles')->name('get.roles.menu');
        Route::post('/getlinesroles', 'AppController@lineroles')->name('get.roles.line');
        Route::post('/gethakakses', 'AppController@hakakses')->name('get.hakakses');
        Route::post('/gethakakses2', 'AppController@hakakses2')->name('get.hakakses2');
        Route::post('/addhakakses', 'AppController@addhakakses')->name('add.hakakses')->middleware('can:edit_roles');
        Route::post('/removehakakses', 'AppController@removehakakses')->name('remove.hakakses')->middleware('can:edit_roles');

        //others
        Route::get('get-button-option', 'AjaxController@getButtonOption')->name('get.button-option');
        Route::get('set-dark-theme', 'AppController@toggletheme')->name('toggle.theme');
        Route::post('changepassword', 'AppController@changepassword')->name('changepassword');

        //MASTER
        Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
            //MERCH
            Route::group(['prefix' => 'merch', 'as' => 'merch.'], function () {
                Route::get('get-data',      'Master\MerchController@ajaxData')->name('get-data');
            });
            Route::resource('merch',        'Master\MerchController')->middleware('can:master_merch');
            //MERCH

            //PAYMENT
            Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
                Route::get('get-data',      'Master\PaymentController@ajaxData')->name('get-data');
            });
            Route::resource('payment',        'Master\PaymentController')->middleware('can:master_payment');
            //PAYMENT


            //JENIS PENGIRIMAN
            Route::group(['prefix' => 'jenis-pengiriman', 'as' => 'jenis-pengiriman.'], function () {
                Route::get('get-data',      'Master\JenisPengirimanController@ajaxData')->name('get-data');
            });
            Route::resource('jenis-pengiriman',        'Master\JenisPengirimanController')->middleware('can:master_jenis_pengiriman');
            //JENIS PENGIRIMAN
        });
        //MASTER

        //TRANSACTION
        Route::group(['prefix' => 'trans', 'as' => 'trans.'], function () {
            Route::get('get-data',      'TransController@ajaxData')->name('get-data');
            Route::get('button-option',      'TransController@buttonOption')->name('button-option');

            Route::get('confirm-view/{id}',      'TransController@confirmView')->name('confirm-view');
            Route::post('confirm/{id}',         'TransController@confirm')->name('confirm');
            Route::post('unconfirm/{id}',         'TransController@unconfirm')->name('unconfirm');

            Route::post('closed/{id}',         'TransController@closed')->name('closed');
            Route::post('unclosed/{id}',         'TransController@unclosed')->name('unclosed');

            Route::post('rejected/{id}',         'TransController@rejected')->name('rejected');
            Route::post('unrejected/{id}',         'TransController@unrejected')->name('unrejected');


            Route::group(['prefix' => 'lines', 'as' => 'lines.'], function () {});
        });
        Route::resource('trans',        'TransController');
        //TRANSACTION
    });

    Route::group(['prefix' => 'mobile', 'as' => 'mobile.'], function () {
        Route::get('/',                 'Mobile\MobileWebController@index')->name('index');
        Route::get('/history',          'Mobile\MobileWebController@history')->name('history');
        Route::get('/history-detail/{id}',          'Mobile\MobileWebController@historyDetail')->name('history-detail');
        Route::get('/history-reject/{id}',          'Mobile\MobileWebController@historyReject')->name('history-reject');

        Route::get('/product-detail/{id}',   'Mobile\MobileWebController@productDetail')->name('product-detail');

        Route::post('/cart-store',              'Mobile\MobileWebController@cartStore')->name('cart-store');
        Route::post('/cart-update',              'Mobile\MobileWebController@cartUpdate')->name('cart-update');
        Route::get('/cart-delete/{id}',              'Mobile\MobileWebController@cartDelete')->name('cart-delete');
        Route::get('/cart',                     'Mobile\MobileWebController@cart')->name('cart');



        Route::get('/order',            'Mobile\MobileWebController@order')->name('order');
        Route::post('/order-store',     'Mobile\MobileWebController@orderStore')->name('order-store');

        Route::get('/profile',          'Mobile\MobileWebController@profile')->name('profile');
        Route::get('/profile-edit',     'Mobile\MobileWebController@profileEdit')->name('profile-edit');
        Route::post('profile-update/{id}',   'Mobile\MobileWebController@profileUpdate')->name('profile-update');
    });

    // STATE
    Route::get('get-kota', 'AjaxController@listKota')->name('get.kota');
    Route::get('get-kecamatan', 'AjaxController@listKecamatan')->name('get.kecamatan');
    Route::get('get-kelurahan', 'AjaxController@listKelurahan')->name('get.kelurahan');
    //STATE
});


Route::get('mobile/register',                 'Mobile\MobileWebController@register')->name('mobile.register');
Route::post('mobile/register-store',                 'Mobile\MobileWebController@registerStore')->name('mobile.register-store');


Route::get('/send-mail', function () {

    $trans = Trans::first();
    $filePath = storage_path('app/public/sample.pdf'); // Ganti dengan path file kamu
    $subject = "File Attachment Example";

    Mail::to('kikirabdullah@gmail.com')->send(new FileMail($subject, $filePath, $trans));

    return "Email sent successfully!";
});
