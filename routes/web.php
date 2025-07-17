<?php
use App\Helpers\MyLibrary;

$segmentArr = [];
$segmentArr = Request::segments();
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ThankyouController;
use App\Http\Controllers\GoogleContactController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TldController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CasestudiesController;
use App\Http\Controllers\PhotoAlbumController;
use App\Http\Controllers\VideoAlbumController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResellerCenterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;

if (!empty(Request::segment(1)) && Request::segment(1) != "powerpanel") {
    Route::get('googlecontact/thankyou', [ThankyouController::class, 'index'])->name('googlecontact/thankyou');
    Route::post('/email/google-workspace-india', [GoogleContactController::class, 'store'])->name('contact');

    $slug = Request::segment(1);
    $arrModule = MyLibrary::setFrontRoutes($slug);

    if (isset($arrModule->modules->varModuleName)) {
        switch ($arrModule->modules->varModuleName) {
            case "blogs":
                Route::get($arrModule->alias->varAlias, [BlogsController::class, 'index'])->name('blogs');
                Route::get($arrModule->alias->varAlias . '/{alias}', [BlogsController::class, 'detail'])->name('blogs.detail');
                Route::get($arrModule->alias->varAlias . '/pagination', [BlogsController::class, 'pagelist'])->name('blogs.pagelist');
                break;
            
            // Continue converting other cases the same way...

            default:
                Route::get('/' . $arrModule->alias->varAlias, [PagesController::class, 'index'])->name($arrModule->alias->varAlias)->middleware('prevent-back-history');
                break;
        }
    }

    Route::get('/home', function () {
        return redirect(config('app.url'));
    });

    $CategoryAlias = MyLibrary::getCategoryAliasRoutes();
    if (in_array($slug, $CategoryAlias)) {
        Route::get('/{product_category}', [ProductCategoryController::class, 'index'])->name('product_category')->middleware('prevent-back-history');
        Route::get('/{product_category}/{product}', [ProductsController::class, 'index'])->name('product_landing')->middleware('prevent-back-history');
        Route::post('/{product_category}/{product}', [ProductsController::class, 'index'])->middleware('prevent-back-history');
    }
}


use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AwsSupportController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Userauth\FrontRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PowerpanelController;

Route::get('currency/{currency_id}', [CurrencyController::class, 'set']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/session-expired', function () {
    return view('SessionExpired');
});


Route::post('aws-support-services', [AwsSupportController::class, 'store'])->name('aws-support-services');
Route::get('aws-support-services/thankyou', [ThankyouController::class, 'index'])->name('aws-support-services.thankyou');

Route::get('/news-letter/thankyou', [ThankyouController::class, 'index'])->name('news-letter.thankyou');

Route::get('xmlsitemap', [PagesController::class, 'xmlsitemap'])->name('xmlsitemap');
Route::post('/front/search', [FrontController::class, 'search'])->name('front.search');
Route::post('/front/popupvalue', [FrontController::class, 'popup'])->name('front.popup');


Route::post('domain-checker', [ProductCategoryController::class, 'DomainAvailibity'])->name('domain.checker.post');
Route::get('domain-checker', [ProductCategoryController::class, 'DomainAvailibity'])->name('domain.checker.get');
Route::post('domainsuggestion', [ProductCategoryController::class, 'DomainSuggestion'])->name('domain.suggestion.post');

Route::post('domaintransferdata', [CartController::class, 'store'])->name('cart.transferdata');
Route::get('pricefilter', [ProductCategoryController::class, 'pricefilterdata'])->name('price.filter');
Route::post('addtocart', [ProductCategoryController::class, 'addtocart'])->name('cart.add');
Route::post('removecart', [ProductCategoryController::class, 'removecart'])->name('cart.remove');
Route::post('removeallcart', [ProductCategoryController::class, 'removeallcart'])->name('cart.removeall');
Route::get('gettldpricing', [ProductCategoryController::class, 'gettldpricing'])->name('tld.pricing');
Route::post('inquirydata', [ProductCategoryController::class, 'inquiryformdata'])->name('inquiry.data');

Route::get('thankyou', [ThankyouController::class, 'index'])->name('thankyou');

Route::get('front-login', function () {
    return view('errors.404');
});

Route::post('front-login', [FrontRegisterController::class, 'frontlogin']);
Route::get('otp-verification', [FrontRegisterController::class, 'optverification']);
Route::post('otp-send', [FrontRegisterController::class, 'otpsend']);
Route::get('otp-verify', [FrontRegisterController::class, 'otpverify']);
Route::post('otp-doverification', [FrontRegisterController::class, 'otpdoverification']);
Route::get('user-logout', [FrontRegisterController::class, 'userlogout'])->name('user.logout');
Route::post('front-register', [FrontRegisterController::class, 'frontregister']);
Route::post('front/password/reset', [FrontRegisterController::class, 'forgotpassword']);
Route::get('user-email-exit', [FrontRegisterController::class, 'emailexit']);
Route::get('email-not-exit', [FrontRegisterController::class, 'emailnotexit']);
Route::get('checkpassword', [FrontRegisterController::class, 'checkpassword']);
Route::get('reset-passwod/{token}', [FrontRegisterController::class, 'resetpassword']);
Route::post('user/update/password', [FrontRegisterController::class, 'updatepassword']);
Route::get('user/whmcs/password', [FrontRegisterController::class, 'whmcsupdatepassword']);
Route::get('email-confirm/{token}', [FrontRegisterController::class, 'confirmemail']);
Route::get('userauth/{provider}', [FrontRegisterController::class, 'redirectToProvider']);
Route::get('userauth/{provider}/callback', [FrontRegisterController::class, 'handleProviderCallback']);
Route::get('/login', [FrontRegisterController::class, 'loginpage']);
Route::get('forgot-password', [FrontRegisterController::class, 'newresetpassword']);




$setConstants = MyLibrary::setConstants($segmentArr);

if ($setConstants) {
    Route::group(['namespace' => 'Powerpanel', 'middleware' => ['auth', 'prevent-back-history']], function () {
        $moduleName = Config::get('Constant.MODULE.NAME');
        $controller = Config::get('Constant.MODULE.CONTROLLER');

        Route::get("/powerpanel/$moduleName", [
            'as' => "powerpanel.$moduleName.index",
            'uses' => "$controller@index",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::post("/powerpanel/$moduleName/get_list", [
            'uses' => "$controller@get_list",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::get("/powerpanel/$moduleName/add", [
            'as' => "powerpanel.$moduleName.add",
            'uses' => "$controller@edit",
            'middleware' => "permission:$moduleName-create"
        ]);

        Route::post("/powerpanel/$moduleName/add", [
            'as' => "powerpanel.$moduleName.handleAddPost",
            'uses' => "$controller@handlePost",
            'middleware' => "permission:$moduleName-create"
        ]);

        Route::get("/powerpanel/$moduleName/{alias}/edit", [
            'as' => "powerpanel.$moduleName.edit",
            'uses' => "$controller@edit",
            'middleware' => "permission:$moduleName-edit"
        ]);

        Route::post("/powerpanel/$moduleName/{alias}/edit", [
            'as' => "powerpanel.$moduleName.handleEditPost",
            'uses' => "$controller@handlePost",
            'middleware' => "permission:$moduleName-edit"
        ]);

        Route::post("/powerpanel/$moduleName/DeleteRecord", [
            'uses' => "$controller@DeleteRecord",
            'middleware' => "permission:$moduleName-delete"
        ]);

        Route::post("/powerpanel/$moduleName/publish", [
            'uses' => "$controller@publish",
            'middleware' => "permission:$moduleName-edit"
        ]);

        Route::post("/powerpanel/$moduleName/reorder", [
            'as' => "$moduleName.reorder",
            'uses' => "$controller@reorder",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::post("/powerpanel/$moduleName/destroy", [
            'as' => "$moduleName.destroy",
            'uses' => "$controller@destroy",
            'middleware' => "permission:$moduleName-delete"
        ]);

        Route::post("/powerpanel/$moduleName/makeDefault", [
            'uses' => "$controller@makeDefault"
        ]);

        Route::post("/powerpanel/$moduleName/ajax", [
            'uses' => "$controller@ajax",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::post("/powerpanel/$moduleName", [
            'as' => "powerpanel.$moduleName.handleEditPost",
            'uses' => "$controller@handleEditPost",
            'middleware' => "permission:$moduleName-edit"
        ]);

        Route::get("/powerpanel/$moduleName/ExportRecord", [
            'uses' => "$controller@ExportRecord",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::get("/powerpanel/$moduleName/show/{id}", [
            'as' => "powerpanel.$moduleName.show",
            'uses' => "$controller@show",
            'middleware' => "permission:$moduleName-list"
        ]);

        Route::post("/powerpanel/$moduleName/makeFeatured", [
            'uses' => "$controller@makeFeatured",
            'middleware' => "permission:$moduleName-edit"
        ]);

        Route::get("/powerpanel/settings", [
            'as' => 'powerpanel/settings',
            'uses' => 'SettingsController@index',
            'middleware' => 'permission:settings-general-setting-management'
        ]);

        Route::post("/powerpanel/settings", [
            'as' => 'powerpanel/settings',
            'uses' => 'SettingsController@update_settings',
            'middleware' => 'permission:settings-general-setting-management'
        ]);

        Route::get("/powerpanel/settings/getDBbackUp", [
            'as' => 'powerpanel/settings/getDBbackUp',
            'uses' => 'SettingsController@getDBbackUp'
        ]);

        Route::get("/powerpanel/changeprofile", [
            'as' => 'powerpanel/changeprofile',
            'uses' => 'ProfileController@index',
            'middleware' => 'permission:changeprofile-edit'
        ]);

        Route::post("/powerpanel/changeprofile", [
            'as' => 'powerpanel/changeprofile',
            'uses' => 'ProfileController@changeprofile'
        ]);

        Route::post("/powerpanel/$moduleName/swaporder", "$controller@reorder");
        Route::post("/powerpanel/$moduleName/ajaxCatAdd", "$controller@addCatAjax");

        // Other specific routes
        Route::post('/powerpanel/appointment-lead/saveComment', 'AppointmentLeadController@saveComment');
        Route::post('/powerpanel/faq/getProductAjax', 'FaqController@getProductAjax');
        Route::post('/powerpanel/deals/getProductAjax', 'DealsController@getProductAjax');
        Route::post('/powerpanel/testimonial/getProductAjax', 'TestimonialController@getProductAjax');
        Route::post('/powerpanel/products-package/getProductAjax', 'ProductsPackageController@getProductAjax');
        Route::post('/powerpanel/products-package/getWHMCSProductAjax', 'ProductsPackageController@getWHMCSProductAjax');
        Route::post('/powerpanel/product-features/getProductAjax', 'ProductFeaturesController@getProductAjax');
        Route::post('/powerpanel/featured-products/getProductAjax', 'FeaturedProductsController@getProductAjax');
        Route::post('/powerpanel/products/getProductAliasAjax', 'ProductController@getProductAliasAjax');
        Route::get('powerpanel/newsletter/send_email', ['as' => 'newsletters/send_email', 'uses' => 'NewsletterController@send_email']);
    });
}



$setConstants = MyLibrary::setConstants($segmentArr);

if ($setConstants) {
    Route::group(['namespace' => 'Powerpanel', 'middleware' => ['auth', 'prevent-back-history']], function () {
        $moduleName = Config::get('Constant.MODULE.NAME');
        $controller = Config::get('Constant.MODULE.CONTROLLER');

        Route::post('/powerpanel/share', ['uses' => 'OnePushController@ShareonSocialMedia']);
        Route::post('/powerpanel/share/getrec', ['uses' => 'OnePushController@getRecord']);
        Route::get('/powerpanel/share/gPlusCallBack', ['uses' => 'OnePushController@gPlusCallBack']);

        Route::get('/powerpanel/tpl/{view}', ['as' => 'view', 'uses' => 'TplController@index']);
        Route::get('/powerpanel/email_log', ['as' => 'email_log', 'uses' => 'EmailLogController@index']);
        Route::post('/powerpanel/email_log/get_email_log_list', ['uses' => 'EmailLogController@get_email_log_list']);
        Route::post('/powerpanel/notification', ['uses' => 'NotificationController@index']);
        Route::post('/powerpanel/notification/update_read_status', ['uses' => 'NotificationController@update_read_status']);
        Route::post('/powerpanel/notification/get_read_notification_count', ['uses' => 'NotificationController@get_read_notification_count']);
        Route::post('/powerpanel/global', ['uses' => 'GlobalSearchController@index']);
        Route::get('/powerpanel/calender', ['uses' => 'CalenderController@index']);
        Route::get('/powerpanel/calender/get_activity', ['uses' => 'CalenderController@get_activity']);
        Route::post('/powerpanel/message', ['uses' => 'MessageController@index']);
        Route::post('/powerpanel/message/update_read_status', ['uses' => 'MessageController@update_read_status']);
        Route::post('/powerpanel/message/get_read_message_count', ['uses' => 'MessageController@get_read_message_count']);

        Route::get('/powerpanel/analytics', ['as' => 'powerpanel.analytics.index', 'uses' => 'AnalyticsController@index', 'middleware' => 'permission:analytics-list']);
        Route::post('analytics/get_range_analysis', ['as' => 'analytics.get_range_analysis', 'uses' => 'AnalyticsController@get_range_analysis', 'middleware' => 'permission:analytics-list']);

        Route::get('/powerpanel/plugins', ['uses' => 'PluginController@index']);
        Route::get('/powerpanel/plugins/get_module/{module}', ['uses' => 'PluginController@get_module']);
        Route::get('/powerpanel/plugins/update_module/{module}', ['uses' => 'PluginController@update_module']);
    });
}

// Route::get('/clear-cache', function() {
//     \Artisan::call('config:clear');
//     \Artisan::call('cache:clear');
//     \Artisan::call('view:clear');
//     \Artisan::call('route:clear');
    
//     return "Cache cleared successfully!";
// });
use Illuminate\Support\Facades\Response;
Route::get('/robots.txt', function () {
    $content = file_get_contents(public_path('robots.txt'));
    return Response::make($content, 200, [
        'Content-Type' => 'text/plain',
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Thu, 01 Jan 1970 00:00:00 GMT',
    ]);
});
