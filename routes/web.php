<?php

use App\Mail\FileMail;
use App\Models\Trans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect()->route('front.index');
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

            //MERCH
            Route::group(['prefix' => 'merch-foto', 'as' => 'merch-foto.'], function () {
                Route::get('get-data',      'Master\MerchFotoController@ajaxData')->name('get-data');
            });
            Route::resource('merch-foto',        'Master\MerchFotoController')->middleware('can:master_merch');
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


            //CREW
            Route::group(['prefix' => 'crew', 'as' => 'crew.'], function () {
                Route::get('get-data',      'Master\CrewController@ajaxData')->name('get-data');
            });
            Route::resource('crew',        'Master\CrewController')->middleware('can:master_crew');
            //CREW


            //EVENT
            Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
                Route::get('get-data',      'Master\EventController@ajaxData')->name('get-data');
            });
            Route::resource('event',        'Master\EventController')->middleware('can:master_event');
            //EVENT


            //ACTIVITY
            Route::group(['prefix' => 'activity', 'as' => 'activity.'], function () {
                Route::get('get-data',      'Master\ActivityController@ajaxData')->name('get-data');
            });
            Route::resource('activity',        'Master\ActivityController')->middleware('can:master_activity');
            //ACTIVITY


            //SPONSOR
            Route::group(['prefix' => 'sponsor', 'as' => 'sponsor.'], function () {
                Route::get('get-data',      'Master\SponsorController@ajaxData')->name('get-data');
            });
            Route::resource('sponsor',        'Master\SponsorController')->middleware('can:master_sponsor');
            //SPONSOR

            //FG
            Route::group(['prefix' => 'fg-support', 'as' => 'fg-support.'], function () {
                Route::get('get-data',      'Master\FgSupportController@ajaxData')->name('get-data');
            });
            Route::resource('fg-support',        'Master\FgSupportController')->middleware('can:master_fg_support');
            //FG

            //FG
            Route::group(['prefix' => 'team-support', 'as' => 'team-support.'], function () {
                Route::get('get-data',      'Master\TeamSupportController@ajaxData')->name('get-data');
            });
            Route::resource('team-support',        'Master\TeamSupportController')->middleware('can:master_team_support');
            //FG


            //SETTINGS
            Route::resource('setting',        'Master\SettingController')->middleware('can:master_setting');
            //SETTINGS
        });
        //MASTER

        //TRANSACTION
        Route::group(['prefix' => 'trans', 'as' => 'trans.'], function () {
            Route::get('get-data',      'TransController@ajaxData')->name('get-data');
            Route::get('button-option',      'TransController@buttonOption')->name('button-option');

            Route::get('form-create',      'TransController@formCreate')->name('form-create');


            Route::get('confirm-view/{id}',      'TransController@confirmView')->name('confirm-view');
            Route::post('confirm/{id}',         'TransController@confirm')->name('confirm');
            Route::post('unconfirm/{id}',         'TransController@unconfirm')->name('unconfirm');

            Route::post('closed/{id}',         'TransController@closed')->name('closed');
            Route::post('unclosed/{id}',         'TransController@unclosed')->name('unclosed');

            Route::post('rejected/{id}',         'TransController@rejected')->name('rejected');
            Route::post('unrejected/{id}',         'TransController@unrejected')->name('unrejected');

            Route::post('resend/{id}',         'TransController@resend')->name('resend');
            Route::get('print/{id}',         'TransController@print')->name('print');

            Route::group(['prefix' => 'lines', 'as' => 'lines.'], function () {});
        });
        Route::resource('trans',        'TransController');
        //TRANSACTION

        //REPORT
        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::get('transaksi',             'ReportController@transaksiIndex')->name('transaksi.index');
            Route::post('transaksi/result',     'ReportController@transaksiResult')->name('transaksi.result');

            Route::get('stock-merch',             'ReportController@stokMerchIndex')->name('stok-merch.index');
            Route::post('stock-merch/result',     'ReportController@stokMerchResult')->name('stok-merch.result');
        });
        //REPORT

    });

    // STATE
    Route::get('get-kota', 'AjaxController@listKota')->name('get.kota');
    Route::get('get-kecamatan', 'AjaxController@listKecamatan')->name('get.kecamatan');
    Route::get('get-kelurahan', 'AjaxController@listKelurahan')->name('get.kelurahan');
    //STATE

    //FRONT LOGIN
    Route::get('profile',           'FrontController@profile')->name('front.profile');
    Route::get('order',             'FrontController@order')->name('front.order');
    Route::post('order-store',      'FrontController@orderStore')->name('front.order-store');
    Route::get('payment',           'FrontController@payment')->name('front.payment');
    Route::post('payment-store',    'FrontController@paymentStore')->name('front.payment-store');
    Route::get('history/{id}',       'FrontController@history')->name('front.history');
    Route::get('reject/{id}',       'FrontController@reject')->name('front.reject');

    Route::get('profile-edit',          'FrontController@profileEdit')->name('front.profile-edit');
    Route::post('profile-update/{id}',   'FrontController@profileUpdate')->name('front.profile-update');
    //FRONT LOGIN
});




Route::get('/',                 'FrontController@index')->name('front.index');
Route::get('merchandise',       'FrontController@merchandise')->name('front.merchandise');
Route::get('crew',              'FrontController@crew')->name('front.crew');
Route::get('register',          'FrontController@register')->name('front.register');
Route::post('register-store',   'FrontController@registerStore')->name('front.register-store');
