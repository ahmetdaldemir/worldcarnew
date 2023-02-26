<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\M\MHomeController;
use App\Http\Controllers\ProfilController;
use App\Service\Payment\Vakifbank;
use Firebase\JWT\JWT;
use http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;
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

Route::group(['where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['setlocale','removepublic']], function () {
    Route::get('/', 'HomeController@index')->name('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/', function () {
    return redirect('/tr');
});

//************ Customer Panel   *******************************************************************//

Route::post('/auth', [LoginController::class, 'login']);
Route::post('/forgetpassword', [LoginController::class, 'forgetpassword']);
Route::post('password.updateNew', [LoginController::class, 'passwordupdate'])->name('password.updateNew');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/mail-send', [HomeController::class, 'mail_send']);
Route::get('/exchangeupdate', [HomeController::class, 'exchangeupdate']);


Route::get('/w', [HomeController::class, 'widget']);


//************ Customer Panel   *******************************************************************//
//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['setlocale','removepublic'],'domain' => 'https://worldcarrental.com'], function () {

    Route::get('/resetpassword', [LoginController::class, 'resetpassword']);

    Route::get('/survey', 'HomeController@survey')->name('survey');
    Route::get('/policedata', 'HomeController@policedata')->name('policedata');

    Route::get('/currency', 'ListController@get_list_cars');
    Route::get('/get_list_cars/{id}', 'ListController@get_list_cars');

    Route::get('profil/info', 'ProfilController@index')->name('info')->middleware('auth:web');
    Route::get('profil/download', 'ProfilController@download')->name('profil.download')->middleware('auth:web');
    Route::get('profil/printview', 'ProfilController@printview')->name('profil.printview')->middleware('auth:web');
    Route::post('profil/info/update', 'ProfilController@update')->name('update')->middleware('auth:web');
    Route::get('profil/reservations', 'ProfilController@reservations')->name("reservations")->middleware('auth:web');
    Route::get('profil/reservations/edit', 'ProfilController@reservationedit')->name("profil/reservations/edit")->middleware('auth:web');
    Route::get('profil/reservations/reservationeditsave', 'ProfilController@reservationeditsave')->name("profil/reservations/reservationeditsave")->middleware('auth:web');
    Route::get('profil/reservations/cancel/{id}', 'ProfilController@reservationscancel')->name("reservations/cancel/{id}")->middleware('auth:web');
    Route::get('profil/reservations/getreservationinfo', 'ProfilController@getreservationinfo')->name("reservations/getreservationinfo")->middleware('auth:web');
    Route::get('profil/reservations/reservationcancel', 'ProfilController@reservationcancel')->name("reservations/reservationcancel")->middleware('auth:web');
    Route::get('profil/discount', 'ProfilController@discount')->name("discount")->middleware('auth:web');
    Route::get('profil/invitation', 'ProfilController@invitation')->name("invitation")->middleware('auth:web');
    Route::post('profil/invitation/invitationsend', 'ProfilController@invitationsend')->name("invitationsend")->middleware('auth:web');
    Route::get('profil/call_center', 'ProfilController@call_center')->name("call_center")->middleware('auth:web');
    Route::get('profil/call_center/ticket', 'ProfilController@ticket')->name("ticket")->middleware('auth:web');
    Route::get('profil/call_center/detail/{id}', 'ProfilController@detail')->name("detail")->middleware('auth:web');
    Route::post('profil/call_center/ticketsave', 'ProfilController@ticketsave')->name("ticket")->middleware('auth:web');
    Route::post('profil/call_center/detailsave', 'ProfilController@detailsave')->name("detail")->middleware('auth:web');
    Route::get('profil/anket', 'ProfilController@anket')->name("anket")->middleware('auth:web');
    Route::get('profil/logout', [LoginController::class, 'logout'])->name("logout");


    Route::get('/', 'HomeController@index')->name('welcome');
    Route::get('/lists', 'ListController@index')->name('lists');
    Route::get('/newlists', 'ListController@newlists')->name('newlists');
    Route::post('/reservation', 'ReservationController@index')->name('reservation');
    Route::post('/campainreservation', 'ReservationController@campainreservation')->name('campainreservation');
    Route::get('/lang/{id}', 'HomeController@lang')->name('lang');
    Route::get(trans('all_campain_url', [], request()->segment(1)), 'HomeController@all_campain');
    Route::get(trans('all_locations_url', [], request()->segment(1)), 'HomeController@all_destination');
    Route::get(trans('destination_url', [], request()->segment(1)) . '/{slug}/{id}', 'HomeController@destination_detail');
    Route::get('/bolge-hakkinda/{slug}/{id}', 'HomeController@info_destination')->name('bolge-hakkinda.slug.id');
    Route::get(trans('blogs', [], request()->segment(1)), 'HomeController@all_blogs')->name(trans('blogs', [], request()->segment(1)));
    Route::get(trans('blog', [], request()->segment(1)) . '/{slug}/{id}', 'HomeController@blogDetail');
    Route::get(trans('comments_url', [], request()->segment(1)), 'HomeController@all_comments')->name(trans('comments_url', [], request()->segment(1)));
    Route::get(trans('kurumsal_url', [], request()->segment(1)) . '/{slug}', 'HomeController@about');


//Route::get(__('blogs',[],'{locale}'), 'HomeController@all_blogs');
//dd(trans('car_rental_articles',[],request()->segment(1)));
//    dd(trans('car_rental_articles',[],request()->segment(1)).'/{slug}/{id}');
//Route::get('arac-kiralama-yazilar/{slug}/{id}', 'HomeController@texts')->name('arac-kiralama-yazilar.slug.id');
//dd(trans('car_rental_articles',[],request()->segment(1)).'/{slug}/{id}');


    Route::get(trans('car_rental_articles', [], request()->segment(1)) . '/{slug}/{id}', 'HomeController@texts');
    Route::get(trans('campain_url', [], request()->segment(1)) . '/{slug}/{id}', 'HomeController@campainDetail');
    Route::get(trans('contact_url', [], request()->segment(1)), 'HomeController@contact');
    Route::get('/gizlilik-politikasi', 'HomeController@police')->name('gizlilik.poliitikasi');
    Route::get('/kullanim-kosullari', 'HomeController@useProcess')->name('kullanim.kosullari');


    Route::post('/checkout', 'ReservationController@checkout')->name('checkout');
    Route::get('/comfirm', 'HomeController@comfirm');
    Route::get('/voucher', 'ReservationController@voucher')->name('voucher');

});

//Route::get('/en/voucher', 'ReservationController@voucher')->name('voucher');
//Route::get('/tr/voucher', 'ReservationController@voucher')->name('voucher');
//Route::get('/ru/voucher', 'ReservationController@voucher')->name('voucher');
//Route::get('/de/voucher', 'ReservationController@voucher')->name('voucher');


Route::post('/informationrender/{up}/{drop}', 'Admin\ReservationController@informationrender');
Route::post('/create_comment', 'HomeController@create_comment');
Route::get('/reloadcaptcha', 'HomeController@reloadCaptcha');
Route::get('/Calculate', 'Api\CalculateController@handle');
Route::get('/getPlate', 'Api\ApiController@getPlate');
Route::post('/get_customer', 'Api\ApiController@get_customer');
Route::post('/generalsearch', 'Api\SearchController@search');
Route::get('getDropLocation', 'HomeController@getDropLocation');
Route::get('getMounthReservation', 'HomeController@getMounthReservation');

Route::get('/get_customer_blacklist', 'Admin\ReservationController@get_customer_blacklist');
Route::get('/payment', 'PaymentController@index');
Route::post('/checkoutSucces', 'PaymentController@checkoutSucces');
Route::post('/checkoutFail', 'PaymentController@checkoutFail');
Route::get('/testpayment', 'PaymentController@testpayment');
Route::post('/odemeyap', 'PaymentController@odemeyap')->name('odemeyap');
Route::post('/surveysave', 'HomeController@surveysave')->name('surveysave');


Auth::routes(['verify' => true]);


Route::get('/confirmed', function () {
    return 'password confirmed';
})->middleware(['auth', 'password.confirm']);


Route::get('/createreservationtoken', function () {
    $tokenarray = array(
        'id_reservation' => "12162",
        'id_customer' => "35492",
    );
    $key = "worldcar.com";
    echo base64_encode(JWT::encode($tokenarray, $key));
});




Route::get('/verified', function () {
    return 'email verified';
})->middleware('verified');

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('/', function () {
       return view('admin.auth.login');
    })->name('login');
//    Auth::routes(['verify' => true]);
    Route::post('/login', 'LoginController@login')->name('loginPost');
    Route::get('/logout', 'LoginController@logout')->name('logout');



    Route::get('/confirmed', function () {
        return 'password confirmed';
    })->middleware(['auth:admin-web', 'password.confirm:admin.password.confirm']);
    Route::get('/verified', function () {
        return 'email verified';
    })->middleware('verified:admin.verification.notice,admin-web');

//    Route::get('/home', function () {   dd('dsda');} )->name('home')->middleware('auth:admin-web');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin/categories', 'CategoryController@index')->name('admin.categories');
    Route::post('/admin/categories/save', 'CategoryController@save')->name('admin.categories.save');
    Route::get('/admin/categories/edit', 'CategoryController@edit')->name('admin.categories.edit');
    Route::get('/admin/categories/create', 'CategoryController@create')->name('admin.categories.create');
    Route::post('/admin/categories/update', 'CategoryController@update')->name('admin.categories.update');
    Route::get('/admin/categories/delete', 'CategoryController@delete')->name('admin.categories.delete');

    Route::get('/admin/cars', 'CarController@index')->name('admin.cars');
    Route::get('/admin/cars/create', 'CarController@create')->name('admin.cars.create');
    Route::post('/admin/cars/save', 'CarController@save')->name('admin.cars.save');
    Route::get('/admin/cars/image', 'CarController@image')->name('admin.cars.image');
    Route::get('/admin/cars/delete', 'CarController@delete')->name('admin.cars.delete');
    Route::get('/admin/cars/is_active', 'CarController@is_active')->name('admin.cars.is_active');
    Route::get('/admin/cars/edit', 'CarController@edit')->name('admin.cars.edit');
    Route::post('/admin/cars/update', 'CarController@update')->name('admin.cars.update');
    Route::post('/admin/cars/upload', 'CarController@uploadImage')->name('admin.cars.upload');
    Route::post('/admin/cars/defaultupload', 'CarController@defaultImage')->name('admin.cars.defaultupload');
    Route::get('/admin/cars/imageDelete', 'CarController@imageDelete')->name('admin.cars.imageDelete');

    Route::get('/admin/plates', 'PlateController@index')->name('admin.plates');
    Route::get('/admin/plates/create', 'PlateController@create')->name('admin.plates.create');
    Route::post('/admin/plates/save', 'PlateController@save')->name('admin.plates.save');
    Route::post('/admin/plates/update', 'PlateController@update')->name('admin.plates.update');
    Route::get('/admin/plates/status/{id}/{code}', 'PlateController@status')->name('admin.plates.status/{id}/{code}');
    Route::get('/admin/plates/edit', 'PlateController@edit')->name('admin.plates.edit');
    Route::get('/admin/plates/delete', 'PlateController@delete')->name('admin.plates.delete');
    Route::get('/admin/plates/archive', 'PlateController@archive')->name('admin.plates.archive');
    Route::get('/admin/plates/get', 'PlateController@get')->name('admin.plates.get');
    Route::get('/admin/plates/show', 'PlateController@show')->name('admin.plates.show');
    Route::get('/admin/plates/getAvaiblePlate', 'PlateController@getAvaiblePlate')->name('admin.plates.getAvaiblePlate');


    Route::get('/admin/language', 'LanguageController@index')->name('admin.language');
    Route::get('/admin/language/create', 'LanguageController@create')->name('admin.language.create');
    Route::post('/admin/language/save', 'LanguageController@save')->name('admin.language.save');
    Route::get('/admin/language/edit', 'LanguageController@edit')->name('admin.language.edit');
    Route::post('/admin/language/delete', 'LanguageController@delete')->name('admin.language.delete');
    Route::get('/admin/language/translate', 'LanguageController@translate')->name('admin.language.translate');
    Route::post('/admin/language/translatesave', 'LanguageController@translatesave')->name('admin.language.translatesave');
    Route::post('/admin/language/update', 'LanguageController@update')->name('admin.language.update');

    Route::get('/admin/currency', 'CurrencyController@index')->name('admin.currency');
    Route::get('/admin/currency/create', 'CurrencyController@create')->name('admin.currency.create');
    Route::post('/admin/currency/save', 'CurrencyController@save')->name('admin.currency.save');
    Route::post('/admin/currency/delete', 'CurrencyController@delete')->name('admin.currency.delete');

    Route::get('/admin/settings', 'SettingsController@index')->name('admin.settings');
    Route::get('/admin/settings/mailtest', 'SettingsController@mailtest')->name('admin.settings.mailtest');
    Route::post('/admin/settings/mailtestsend', 'SettingsController@mailtestsend')->name('admin.settings.mailtestsend');
    Route::post('/admin/settings/uploadtest', 'SettingsController@uploadtest')->name('admin.settings.uploadtest');
    Route::post('/admin/settings/save', 'SettingsController@save')->name('admin.settings.save');

    Route::get('/admin/customer', 'CustomerController@index')->name('admin.customer');
    Route::get('/admin/customer/create', 'CustomerController@create')->name('admin.customer.create');
    Route::get('/admin/customer/search', 'CustomerController@search')->name('admin.customer.search');
    Route::get('/admin/customer/edit', 'CustomerController@edit')->name('admin.customer.edit');
    Route::post('/admin/customer/save', 'CustomerController@save')->name('admin.customer.save');
    Route::post('/admin/customer/update', 'CustomerController@update')->name('admin.customer.update');
    Route::post('/admin/customer/save_api', 'CustomerController@save_api')->name('admin.customer.save_api');
    Route::get('/admin/customer/delete', 'CustomerController@delete')->name('admin.customer.delete');
    Route::get('/admin/customer/get_note', 'CustomerController@get_note')->name('admin.customer.get_note');
    Route::post('/admin/customer/addsavenote', 'CustomerController@addsavenote')->name('admin.customer.addsavenote');
    Route::get('/admin/customer/reservations', 'CustomerController@reservations')->name('admin.customer.reservations');

    Route::get('/admin/ekstra', 'EkstraController@index')->name('admin.ekstra');
    Route::get('/admin/ekstra/create', 'EkstraController@create')->name('admin.ekstra.create');
    Route::post('/admin/ekstra/save', 'EkstraController@save')->name('admin.ekstra.save');
    Route::get('/admin/ekstra/delete', 'EkstraController@delete')->name('admin.ekstra.delete');
    Route::get('/admin/ekstra/edit', 'EkstraController@edit')->name('admin.ekstra.edit');
    Route::post('/admin/ekstra/update', 'EkstraController@update')->name('admin.ekstra.update');
    Route::post('/admin/ekstra/lists', 'EkstraController@lists')->name('admin.ekstra.lists');
    Route::get('/admin/ekstra/editlists/{id}', 'EkstraController@editlists')->name('admin.ekstra.editlists');
    Route::get('/admin/ekstra/status', 'EkstraController@status')->name('admin.ekstra.status');
    Route::get('/admin/ekstra/mandatoryInContractStatus', 'EkstraController@mandatoryInContractStatus')->name('admin.ekstra.mandatoryInContractStatus');

    Route::get('/admin/locations', 'LocationController@index')->name('admin.locations');
    Route::get('/admin/locations/create', 'LocationController@create')->name('admin.locations.create');
    Route::get('/admin/locations/edit', 'LocationController@edit')->name('admin.locations.edit');
    Route::post('/admin/locations/save', 'LocationController@save')->name('admin.locations.save');
    Route::get('/admin/locations/delete', 'LocationController@destroy')->name('admin.locations.delete');
    Route::get('/admin/locations/sub', 'LocationController@sub')->name('admin.locations.sub');
    Route::post('/admin/locations/update', 'LocationController@update')->name('admin.locations.update');
    Route::get('/admin/locations/price', 'LocationController@price')->name('admin.locations.price');
    Route::get('/admin/locations/return-zone', 'LocationController@return_zone')->name('admin.locations.return-zone');
    Route::get('/admin/locations/return_zone_add', 'LocationController@return_zone_add')->name('admin.locations.return_zone_add');

    // Location Get
    Route::get('/admin/getdeliveryArea/{id}', 'LocationController@getdeliveryArea')->name('admin.getdeliveryArea/{id}');
    Route::get('/admin/getCity/{id}', 'LocationController@getCity')->name('admin.getCity/{id}');
    Route::get('/admin/getTransferZoneFee/{id}/{code}', 'LocationController@getTransferZoneFee')->name('admin.getTransferZoneFee/{id}/{code}');


    // Location Save
    Route::post('/admin/setdeliveryArea', 'LocationController@setdeliveryArea')->name('admin.setdeliveryArea');
    Route::post('/admin/locations/settransferZoneFee', 'LocationController@settransferZoneFee')->name('admin.locations.settransferZoneFee');
    Route::get('/admin/locations/showTransferZone', 'LocationController@showTransferZone')->name('admin.locations.showTransferZone');

    // Location Delete
    Route::delete('/admin/deleteDeliveryArea/{id}', 'LocationController@deleteDeliveryArea')->name('admin.deleteDeliveryArea/{id}');

    Route::get('/admin/getModel', 'ModelController@getModel')->name('admin/getModel');


    //Camping
    Route::get('/admin/camping', 'CampingController@index')->name('admin.camping');
    Route::get('/admin/camping/create', 'CampingController@create')->name('admin.camping.create');
    Route::post('/admin/camping/save', 'CampingController@save')->name('admin.camping.save');
    Route::get('/admin/camping/delete', 'CampingController@delete')->name('admin.camping.delete');
    Route::get('/admin/camping/edit', 'CampingController@edit')->name('admin.camping.edit');
    Route::post('/admin/camping/update', 'CampingController@update')->name('admin.camping.update');
    Route::post('/admin/camping/statusChange', 'CampingController@statusChange')->name('admin.camping.statusChange');


    //destinations
    Route::get('/admin/destinations', 'DestinationController@index')->name('admin.destinations');
    Route::get('/admin/destinations/create', 'DestinationController@create')->name('admin.destinations.create');
    Route::post('/admin/destinations/save', 'DestinationController@save')->name('admin.destinations.save');
    Route::get('/admin/destinations/delete', 'DestinationController@destroy')->name('admin.destinations.delete');
    Route::get('/admin/destinations/edit', 'DestinationController@edit')->name('admin.destinations.edit');
    Route::post('/admin/destinations/update', 'DestinationController@update')->name('admin.destinations.update');

    //blogs
    Route::get('/admin/blogs', 'BlogController@index')->name('admin.blogs');
    Route::get('/admin/blogs/create', 'BlogController@create')->name('admin.blogs.create');
    Route::post('/admin/blogs/save', 'BlogController@save')->name('admin.blogs.save');
    Route::get('/admin/blogs/delete', 'BlogController@destroy')->name('admin.blogs.delete');
    Route::get('/admin/blogs/edit', 'BlogController@edit')->name('admin.blogs.edit');
    Route::post('/admin/blogs/update', 'BlogController@update')->name('admin.blogs.update');
    Route::get('/admin/blogs/view', 'BlogController@view')->name('admin.blogs.view');

    //texts
    Route::get('/admin/texts', 'TextController@index')->name('admin.texts');
    Route::get('/admin/texts/create', 'TextController@create')->name('admin.texts.create');
    Route::post('/admin/texts/save', 'TextController@save')->name('admin.texts.save');
    Route::get('/admin/texts/delete/', 'TextController@delete')->name('admin.texts.delete');
    Route::get('/admin/texts/edit/', 'TextController@edit')->name('admin.texts.edit');
    Route::post('/admin/texts/update/', 'TextController@update')->name('admin.texts.update');


    //Add Price

    Route::post('/admin/locations/addPeriodPrice', 'LocationController@addPeriodPrice')->name('admin.locations.addPeriodPrice');
    Route::get('/admin/getAllCar/{id}', 'CarController@getAll')->name('admin.getAllCar/{id}');
    Route::get('/admin/locations/getPrice', 'LocationController@getPrice')->name('admin.locations.getPrice');
    Route::get('/admin/locations/deleteZone', 'LocationController@deleteZone')->name('admin.locations.deleteZone');
    Route::get('/admin/locations/deleteZoneSub', 'LocationController@deleteZoneSub')->name('admin.locations.deleteZoneSub');
    Route::get('/admin/locations/updatetransferZoneFee', 'LocationController@updatetransferZoneFee')->name('admin.locations.updatetransferZoneFee');
    Route::get('/admin/locations/editZone', 'LocationController@editZone')->name('admin.locations.editZone');
    Route::get('/admin/locations/updateLocationStatus', 'LocationController@updateLocationStatus')->name('admin.locations.updateLocationStatus');
    Route::get('/admin/locations/rentalPeriod', 'LocationController@rentalPeriod')->name('admin.locations.rentalPeriod');


//Text Category
    Route::get('/admin/text_category', 'TextCategoryController@index')->name('admin.text_category');
    Route::get('/admin/text_category/create', 'TextCategoryController@create')->name('admin.text_category.create');
    Route::get('/admin/text_category/edit', 'TextCategoryController@edit')->name('admin.text_category.edit');
    Route::post('/admin/text_category/save', 'TextCategoryController@store')->name('admin.text_category.save');
    Route::post('/admin/text_category/update', 'TextCategoryController@update')->name('admin.text_category.update');
    Route::get('/admin/text_category/delete', 'TextCategoryController@delete')->name('admin.text_category.delete');
    Route::post('/admin/tinymiceupload', 'TinymiceUploadController@index')->name('admin.tinymiceupload');

    // Marka Save
    Route::get('/admin/brand', 'BrandController@index')->name('admin.brand');
    Route::get('/admin/brand/create', 'BrandController@create')->name('admin.brand.create');
    Route::post('/admin/brand/save', 'BrandController@save')->name('admin.brand.save');
    Route::get('/admin/brand/delete', 'BrandController@destroy')->name('admin.brand.delete');
    Route::get('/admin/brand/edit', 'BrandController@edit')->name('admin.brand.edit');
    Route::post('/admin/brand/update', 'BrandController@update')->name('admin.brand.update');

    // Model Save
    Route::get('/admin/car_model', 'ModelController@index')->name('admin.car_model');
    Route::get('/admin/car_model/create', 'ModelController@create')->name('admin.car_model.create');
    Route::post('/admin/car_model/save', 'ModelController@save')->name('admin.car_model.save');
    Route::get('/admin/car_model/delete', 'ModelController@delete')->name('admin.car_model.delete');
    Route::get('/admin/car_model/edit', 'ModelController@edit')->name('admin.car_model.edit');
    Route::post('/admin/car_model/update', 'ModelController@update')->name('admin.car_model.update');

    //Yorumlarr
    Route::get('/admin/comment', 'CommentController@index')->name('admin.comment');
    Route::get('/admin/comment/create', 'CommentController@create')->name('admin.comment.create');
    Route::post('/admin/comment/save', 'CommentController@save')->name('admin.comment.save');
    Route::get('/admin/comment/delete', 'CommentController@delete')->name('admin.comment.delete');
    Route::get('/admin/comment/edit', 'CommentController@edit')->name('admin.comment.edit');
    Route::post('/admin/comment/update', 'CommentController@update')->name('admin.comment.update');
    Route::get('/admin/comment/change_status', 'CommentController@change_status')->name('admin.comment.change_status');

    //Page
    Route::get('/admin/page', 'PageController@index')->name('admin.page');
    Route::post('/admin/page/save', 'PageController@save')->name('admin.page.save');
    Route::get('/admin/page/create', 'PageController@create')->name('admin.page.create');
    Route::get('/admin/page/edit', 'PageController@edit')->name('admin.page.edit');
    Route::post('/admin/page/update', 'PageController@update')->name('admin.page.update');
    Route::get('/admin/page/delete/id', 'PageController@delete')->name('admin.page.delete');

    Route::get('/admin/mobil_slider', 'MobilSliderController@index')->name('admin.mobil_slider');
    Route::post('/admin/mobil_slider/save', 'MobilSliderController@save')->name('admin.mobil_slider.save');
    Route::get('/admin/mobil_slider/create', 'MobilSliderController@create')->name('admin.mobil_slider.create');
    Route::get('/admin/mobil_slider/edit', 'MobilSliderController@edit')->name('admin.mobil_slider.edit');
    Route::post('/admin/mobil_slider/update', 'MobilSliderController@update')->name('admin.mobil_slider.update');
    Route::get('/admin/mobil_slider/delete/id', 'MobilSliderController@delete')->name('admin.mobil_slider.delete');



    //Reservation
    Route::get('/admin/reservation/index/status', 'ReservationController@index')->name('admin.reservation');
    Route::post('/admin/reservation/save', 'ReservationController@save')->name('admin.reservation.save');
    Route::get('/admin/reservation/statusChange', 'ReservationController@statusChange')->name('admin.reservation.statusChange');
    Route::get('/admin/reservation/create', 'ReservationController@create')->name('admin.reservation.create');
    Route::get('/admin/reservation/edit', 'ReservationController@edit')->name('admin.reservation.edit');
    Route::post('/admin/reservation/update', 'ReservationController@update')->name('admin.reservation.update');
    Route::get('/admin/reservation/returnback', 'ReservationController@returnback')->name('admin.reservation.returnback');
    Route::get('/admin/reservation/waitupreservation', 'ReservationController@waitupreservation')->name('admin.reservation.waitupreservation');
    Route::get('/admin/reservation/waitdropreservation', 'ReservationController@waitdropreservation')->name('admin.reservation.waitdropreservation');
    Route::get('/admin/reservation/delete', 'ReservationController@delete')->name('admin.reservation.delete');
    Route::get('/admin/reservation/operation', 'ReservationController@operation')->name('admin.reservation.operation');
    Route::post('/admin/reservation/process', 'ReservationController@process')->name('admin.reservation.process');
    Route::post('/admin/reservation/addplate', 'ReservationController@addplate')->name('admin.reservation.addplate');
    Route::post('/admin/reservation/addcomment', 'ReservationController@addcomment')->name('admin.reservation.addcomment');
    Route::post('/admin/reservation/changedays', 'ReservationController@changedays')->name('admin.reservation.changedays');
//    Route::get('/admin/reservation/get_data', 'ReservationController@get_data')->name('admin.reservation.get_data');
    Route::post('/admin/reservation/get_data', 'ReservationController@get_data')->name('admin.reservation.get_data');
    Route::post('/admin/reservation/get_operation', 'ReservationController@get_operation')->name('admin.reservation.get_operation');
    Route::get('/admin/reservation/welcome_print', 'ReservationController@welcome_print')->name('admin.reservation.welcome_print');
    Route::post('/admin/reservation/addmail', 'ReservationController@addmail')->name('admin.reservation.addmail');
    Route::get('/admin/reservation/getcomment/{id}', 'ReservationController@getcomment')->name('admin.reservation.getcomment/{id}');
    Route::post('/admin/reservation/changepaymentmethod', 'ReservationController@changepaymentmethod')->name('admin.reservation.changepaymentmethod');
    Route::post('/admin/reservation/changecurrency', 'ReservationController@changecurrency')->name('admin.reservation.changecurrency');
    Route::post('/admin/reservation/changeprice', 'ReservationController@changeprice')->name('admin.reservation.changeprice');
    Route::post('/admin/reservation/changerest', 'ReservationController@changerest')->name('admin.reservation.changerest');
    Route::post('/admin/reservation/changedate', 'ReservationController@changedate')->name('admin.reservation.changedate');
    Route::post('/admin/reservation/changelocation', 'ReservationController@changelocation')->name('admin.reservation.changelocation');
    Route::post('/admin/reservation/changedetail', 'ReservationController@changedetail')->name('admin.reservation.changedetail');
    Route::post('/admin/reservation/changeekstra', 'ReservationController@changeekstra')->name('admin.reservation.changeekstra');
    Route::get('/admin/reservation/getPage', 'ReservationController@getPage')->name('admin.reservation.getPage');
    Route::get('/admin/reservation/get_entry_exit/{id}', 'ReservationController@get_entry_exit')->name('admin.reservation.get_entry_exit');
    Route::get('/admin/reservation/get_log_list/{id}', 'ReservationController@get_log_list')->name('admin.reservation.get_log_list');
    Route::get('/admin/reservation/get_note_list', 'ReservationController@get_note_list')->name('admin.reservation.get_note_list');
    Route::get('/admin/reservation/getEncode/{id}', 'ReservationController@getEncode')->name('admin.reservation.getEncode');
    Route::get('/admin/reservation/deletereservation', 'ReservationController@deletereservation')->name('admin.reservation.deletereservation');
    Route::get('/admin/reservation/cancelreservation', 'ReservationController@cancelreservation')->name('admin.reservation.cancelreservation');
    Route::get('/admin/reservation/noncomfirmreservation', 'ReservationController@noncomfirmreservation')->name('admin.reservation.noncomfirmreservation');
    Route::get('/admin/reservation/newreservation', 'ReservationController@newreservation')->name('admin.reservation.newreservation');
    Route::get('/admin/reservation/checked', 'ReservationController@checked')->name('admin.reservation.checked');
    Route::post('/admin/reservation/searchlist', 'ReservationController@searchlist')->name('admin.reservation.searchlist');
    Route::get('/admin/reservation/searchlist', 'ReservationController@searchlist')->name('admin.reservation.searchlist');
    Route::get('/admin/reservation/systemlogread/{id}', 'ReservationController@systemlogread')->name('admin.reservation.systemlogread');
    Route::get('/admin/reservation/customerreservation/{id}', 'ReservationController@customerreservation')->name('admin.reservation.customerreservation');
    Route::get('/admin/reservation/media', 'ReservationController@mediamodal')->name('admin.reservation.media');
    Route::get('/admin/reservation/mediadownload', 'ReservationController@mediadownload')->name('admin.reservation.mediadownload');
    Route::get('/admin/reservation/kmcontrol', 'ReservationController@kmcontrol')->name('admin.reservation.kmcontrol');
    Route::get('/admin/reservation/get_operation_redis_data', 'ReservationController@get_operation_redis_data')->name('admin.reservation.get_operation_redis_data');
    Route::get('/admin/reservation/get_single_reservation', 'ReservationController@get_single_reservation')->name('admin.reservation.get_single_reservation');
    Route::get('/admin/reservation/forceDeletereservation', 'ReservationController@forceDeletereservation')->name('admin.reservation.forceDeletereservation');
    Route::get('/admin/reservation/deletecomment', 'ReservationController@deletecomment')->name('admin.reservation.deletecomment');
    Route::get('/admin/reservation/survey_answers', 'ReservationController@survey_answers')->name('admin.reservation.survey_answers');
    Route::get('/admin/reservation/operationcontrol', 'ReservationController@operationcontrol')->name('admin.reservation.operationcontrol');
    Route::post('/admin/reservation/updaterest', 'ReservationController@updaterest')->name('admin.reservation.updaterest');
    Route::post('/admin/reservation/addcommentapi', 'ReservationController@addcommentapi')->name('admin.reservation.addcommentapi');
    Route::get('/admin/reservation/access', 'AccessController@index')->name('admin.reservation.access');
    Route::get('/admin/reservation/access.list', 'AccessController@list')->name('admin.reservation.access.list');



    //Operation

    //Reservation
    Route::get('/admin/operation/index', 'OperationController@index')->name('admin.operation.index');
    Route::get('/admin/operation/search', 'OperationController@search')->name('admin.operation.search');
    Route::post('/admin/operation/addplate', 'OperationController@addplate')->name('admin.operation.addplate');





    // Supplier Get
    Route::get('/admin/supplier', 'SupplierController@index')->name('admin.supplier');
    Route::post('/admin/supplier/store', 'SupplierController@store')->name('admin.supplier.store');
    Route::get('/admin/supplier/create', 'SupplierController@create')->name('admin.supplier.create');
    Route::get('/admin/supplier/edit', 'SupplierController@edit')->name('admin.supplier.edit');
    Route::post('/admin/supplier/update', 'SupplierController@update')->name('admin.supplier.update');
    Route::get('/admin/supplier/status', 'SupplierController@status')->name('admin.supplier.status');
    Route::get('/admin/supplier/token', 'SupplierController@token')->name('admin.supplier.token');
    Route::get('/admin/supplier/delete/id', 'SupplierController@delete')->name('admin.supplier.delete');


    // USER

    //Text Category
    Route::get('/admin/user', 'UserController@index')->name('admin.user')->middleware('role:Admin');
    Route::get('/admin/user/create', 'UserController@create')->name('admin.user.create')->middleware('role:Admin');
    Route::post('/admin/user/save', 'UserController@store')->name('admin.user.save')->middleware('role:Admin');
    Route::get('/admin/user/edit', 'UserController@edit')->name('admin.user.edit')->middleware('role:Admin');
    Route::post('/admin/user/update', 'UserController@update')->name('admin.user.update')->middleware('role:Admin');
    Route::get('/admin/user/delete', 'UserController@destroy')->name('admin.user.delete')->middleware('role:Admin');
    Route::get('/admin/user/memberlogout', 'UserController@memberlogout')->name('admin.user.memberlogout')->middleware('role:Admin');
    Route::get('/admin/user/status', 'UserController@is_status')->name('admin.user.status')->middleware('role:Admin');


    //Text Category
    Route::get('/admin/role', 'RoleController@index')->name('admin.role');
    Route::get('/admin/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/admin/role/save', 'RoleController@store')->name('admin.role.save');
    Route::get('/admin/role/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::post('/admin/role/update', 'RoleController@update')->name('admin.role.update');
    Route::get('/admin/role/delete', 'RoleController@destroy')->name('admin.role.delete');
    Route::post('/admin/role/permissionsupdate', 'RoleController@permissionsupdate')->name('admin.role.permissionsupdate');
    Route::get('/admin/role/permission', 'RoleController@permission')->name('admin.role.permission');

    //Text Category
    Route::get('/admin/permission', 'PermissionController@index')->name('admin.permission');
    Route::get('/admin/permission/create', 'PermissionController@create')->name('admin.permission.create');
    Route::post('/admin/permission/save', 'PermissionController@store')->name('admin.permission.save');
    Route::get('/admin/permission/edit', 'PermissionController@edit')->name('admin.permission.edit');
    Route::post('/admin/permission/update', 'PermissionController@update')->name('admin.permission.update');
    Route::get('/admin/permission/delete', 'PermissionController@destroy')->name('admin.permission.delete');


    //Survey
    Route::get('/admin/survey', 'SurveyController@index')->name('admin.survey');
    Route::get('/admin/survey/create', 'SurveyController@create')->name('admin.survey.create');
    Route::post('/admin/survey/store', 'SurveyController@store')->name('admin.survey.store');
    Route::get('/admin/survey/edit', 'SurveyController@edit')->name('admin.survey.edit');
    Route::post('/admin/survey/update', 'SurveyController@update')->name('admin.survey.update');
    Route::get('/admin/survey/delete', 'SurveyController@destroy')->name('admin.survey.delete');
    Route::get('/admin/survey/answer', 'SurveyController@answer')->name('admin.survey.answer');
    Route::post('/admin/survey/answerstore', 'SurveyController@answerstore')->name('admin.survey.answerstore');
    Route::get('/admin/survey/answerdelete', 'SurveyController@answerdelete')->name('admin.survey.answerdelete');
    Route::get('/admin/survey/send', 'SurveyController@send')->name('admin.survey.send');


    //Update
    Route::get('/admin/update/currency', 'CommandConsoleController@currencyupdate')->name('admin.update.currency');


    //Transfer
    Route::get('/admin/transfer', 'TransferController@index')->name('admin.transfer');
    Route::get('/admin/transfer/create', 'TransferController@create')->name('admin.transfer.create');
    Route::post('/admin/transfer/save', 'TransferController@save')->name('admin.transfer.save');
    Route::get('/admin/transfer/edit', 'TransferController@edit')->name('admin.transfer.edit');
    Route::post('/admin/transfer/update', 'TransferController@update')->name('admin.transfer.update');
    Route::get('/admin/transfer/delete', 'TransferController@delete')->name('admin.transfer.delete');
    Route::get('/admin/transfer/statuschange', 'TransferController@statuschange')->name('admin.transfer.statuschange');


    //StopSell
    Route::get('/admin/stopsell', 'StopSellController@index')->name('admin.stopsell');
    Route::get('/admin/stopsell/create', 'StopSellController@create')->name('admin.stopsell.create');
    Route::post('/admin/stopsell/save', 'StopSellController@save')->name('admin.stopsell.save');
    Route::get('/admin/stopsell/edit', 'StopSellController@edit')->name('admin.stopsell.edit');
    Route::post('/admin/stopsell/update', 'StopSellController@update')->name('admin.stopsell.update');
    Route::get('/admin/stopsell/delete', 'StopSellController@delete')->name('admin.stopsell.delete');

    //Accounting
    Route::get('/admin/accounting', 'AccountingController@index')->name('admin.accounting');
    Route::get('/admin/accounting/create', 'AccountingController@create')->name('admin.accounting.create');
    Route::post('/admin/accounting/save', 'AccountingController@save')->name('admin.accounting.save');
    Route::get('/admin/accounting/edit', 'AccountingController@edit')->name('admin.accounting.edit');
    Route::post('/admin/accounting/update', 'AccountingController@update')->name('admin.accounting.update');
    Route::get('/admin/accounting/delete', 'AccountingController@delete')->name('admin.accounting.delete');

    //AccountingCategory
    Route::get('/admin/accountingcategory', 'AccountingCategoryController@index')->name('admin.accountingcategory');
    Route::get('/admin/accountingcategory/create', 'AccountingCategoryController@create')->name('admin.accountingcategory.create');
    Route::post('/admin/accountingcategory/save', 'AccountingCategoryController@save')->name('admin.accountingcategory.save');
    Route::get('/admin/accountingcategory/edit', 'AccountingCategoryController@edit')->name('admin.accountingcategory.edit');
    Route::post('/admin/accountingcategory/update', 'AccountingCategoryController@update')->name('admin.accountingcategory.update');
    Route::get('/admin/accountingcategory/delete', 'AccountingCategoryController@delete')->name('admin.accountingcategory.delete');


    // Tour
    Route::get('/admin/tour', 'TourController@index')->name('admin.tour');
    Route::get('/admin/tour/create', 'TourController@create')->name('admin.tour.create');
    Route::post('/admin/tour/save', 'TourController@save')->name('admin.tour.save');
    Route::get('/admin/tour/delete', 'TourController@destroy')->name('admin.tour.delete');
    Route::get('/admin/tour/edit', 'TourController@edit')->name('admin.tour.edit');
    Route::post('/admin/tour/update', 'TourController@update')->name('admin.tour.update');
    Route::post('/admin/tour/reservations', 'TourController@reservations')->name('admin.tour.reservations');


    //Care
    Route::get('/admin/care', 'CareController@index')->name('admin.care');
    Route::post('/admin/care/save', 'CareController@save')->name('admin.care.save');
    Route::get('/admin/care/create', 'CareController@create')->name('admin.care.create');
    Route::get('/admin/care/edit', 'CareController@edit')->name('admin.care.edit');
    Route::post('/admin/care/update', 'CareController@update')->name('admin.care.update');
    Route::get('/admin/care/delete/id', 'CareController@delete')->name('admin.care.delete');


    // Model Save
    Route::get('/admin/blacklist', 'BlackListController@index')->name('admin.blacklist');
    Route::get('/admin/blacklist/create', 'BlackListController@create')->name('admin.blacklist.create');
    Route::post('/admin/blacklist/save', 'BlackListController@save')->name('admin.blacklist.save');
    Route::get('/admin/blacklist/add_customer', 'BlackListController@add_customer')->name('admin.blacklist.add_customer');
    Route::get('/admin/blacklist/delete', 'BlackListController@delete')->name('admin.blacklist.delete');
    Route::get('/admin/blacklist/edit', 'BlackListController@edit')->name('admin.blacklist.edit');
    Route::post('/admin/blacklist/update', 'BlackListController@update')->name('admin.blacklist.update');
    Route::get('/admin/blacklist/rollback', 'BlackListController@rollback')->name('admin.blacklist.rollback');


    Route::get('/admin/emailtemplate', 'EmailTemplateController@index')->name('admin.emailtemplate');
    Route::post('/admin/emailtemplate/save', 'EmailTemplateController@store')->name('admin.emailtemplate.save');
    Route::get('/admin/emailtemplate/edit', 'EmailTemplateController@edit')->name('admin.emailtemplate.edit');
    Route::get('/admin/emailtemplate/create', 'EmailTemplateController@create')->name('admin.emailtemplate.create');
    Route::post('/admin/emailtemplate/update', 'EmailTemplateController@update')->name('admin.emailtemplate.update');
    Route::get('/admin/emailtemplate/delete', 'EmailTemplateController@delete')->name('admin.emailtemplate.delete');


    Route::get('/admin/api/droplocation', 'ApiController@droplocation')->name('admin.api.droplocation');
    Route::get('/admin/api/finance', 'ApiController@finance')->name('admin.api.finance');
    Route::post('/admin/api/weather', 'ApiController@weather')->name('admin.api.weather');



});


//Route::domain('m.worldcarental.com')->group(['prefix' => '{locale}','where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['setlocale','removepublic']], function(){

  //Route::get('/', 'MHomeController@index');
//
//
//});


