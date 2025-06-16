<?php

use App\Helpers\MyLibrary;
// use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Cache;

$segmentArr = [];
$segmentArr = Request::segments();

if (!empty(Request::segment(1)) && Request::segment(1) != "powerpanel") {

    Route::get('googlecontact/thankyou', ['as' => 'googlecontact/thankyou', 'uses' => 'ThankyouController@index']);
                // Route::get('/email/google-apps',  ['as' => 'contact', 'uses' => 'GoogleContactController@create']);
                Route::post('/email/google-apps', ['as' => 'contact', 'uses' => 'GoogleContactController@store']);

    $slug = Request::segment(1);
    $arrModule = MyLibrary::setFrontRoutes($slug);

    if (isset($arrModule->modules->varModuleName)) {
        switch ($arrModule->modules->varModuleName) {
            case "blogs":
                Route::get($arrModule->alias->varAlias, ['as' => 'blogs', 'uses' => 'BlogsController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'blogs', 'uses' => 'BlogsController@detail']);
                Route::get($arrModule->alias->varAlias . '/pagination', ['as' => 'blogs', 'uses' => 'BlogsController@pagelist']);
                break;
            case "general-faq":
                Route::get($arrModule->alias->varAlias, ['as' => 'faq', 'uses' => 'FaqController@index']);
                break;
            case "tld":
                Route::get($arrModule->alias->varAlias, ['as' => 'tld', 'uses' => 'TldController@index']);
                break;
            case "deals":
                Route::get($arrModule->alias->varAlias, ['as' => 'deals', 'uses' => 'DealsController@index'])->middleware('prevent-back-history');
                break;
            case "services":
                Route::get($arrModule->alias->varAlias, ['as' => 'services', 'uses' => 'ServicesController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'ServicesController@detail']);
                break;
            case "testimonial":
                Route::get('/' . $arrModule->alias->varAlias, ['as' => 'testimonial', 'uses' => 'TestimonialController@index']);
                Route::post('testimonial', ['as' => 'testimonial', 'uses' => 'TestimonialController@store', 'middleware' => ['badwords']]);
                Route::get('/pagination/' . $arrModule->alias->varAlias, ['as' => 'testimonial', 'uses' => 'TestimonialController@pagelist']);
                break;
            case "testimonials":
                Route::get($arrModule->alias->varAlias, ['as' => 'casestudy', 'uses' => 'TestimonialsController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'TestimonialsController@detail']);
                break;
            case "team":
                Route::get('/' . $arrModule->alias->varAlias, ['as' => 'team', 'uses' => 'TeamController@index']);
                Route::get('/pagination/' . $arrModule->alias->varAlias, ['as' => 'team', 'uses' => 'TeamController@pagelist']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'details', 'uses' => 'TeamController@detail']);
                Route::get('/vcard', ['uses' => 'TeamController@download_vcard']);
                break;
            case "news":
                Route::get($arrModule->alias->varAlias, ['as' => 'news', 'uses' => 'NewsController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'NewsController@detail']);
                break;
            case "casestudy":
                Route::get($arrModule->alias->varAlias, ['as' => 'casestudy', 'uses' => 'CasestudiesController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'CasestudiesController@detail']);
            break;    
            case "photo-album":
                Route::get($arrModule->alias->varAlias, ['as' => 'photo-album', 'uses' => 'PhotoAlbumController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'photo_gallery', 'uses' => 'PhotoAlbumController@photo_gallery']);
                break;
            case "video-album":
                Route::get($arrModule->alias->varAlias, ['as' => 'video-album', 'uses' => 'VideoAlbumController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'video_gallery', 'uses' => 'VideoAlbumController@video_gallery']);
                break;
            case "events":
                Route::get($arrModule->alias->varAlias, ['as' => 'events', 'uses' => 'EventsController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'EventsController@detail']);
                Route::get($arrModule->alias->varAlias . '/pagination', ['as' => 'events', 'uses' => 'EventsController@pagelist']);
                break;
            case "shows":
                Route::get($arrModule->alias->varAlias, ['as' => 'shows', 'uses' => 'ShowsController@index']);
                Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'ShowsController@detail']);
                break;
            case "contact-us":
                Route::get('contact/thankyou', ['as' => 'contact/thankyou', 'uses' => 'ThankyouController@index']);
                Route::get('/' . $arrModule->alias->varAlias, ['as' => 'contact', 'uses' => 'ContactController@create']);
                Route::post('/' . $arrModule->alias->varAlias, ['as' => 'contact', 'uses' => 'ContactController@store']);
                break;
             case "reseller-center":
                Route::get('reseller-program/thankyou', ['as' => 'reseller-program/thankyou', 'uses' => 'ThankyouController@index']);
                Route::get('/' . $arrModule->alias->varAlias, ['as' => 'reseller-center', 'uses' => 'ResellerCenterController@create']);
                Route::post('/' . $arrModule->alias->varAlias, ['as' => 'reseller-center', 'uses' => 'ResellerCenterController@store']);
                break;    
            case "appointment-lead":
                Route::get('book-appointment/thankyou', ['as' => 'book-appointment/thankyou', 'uses' => 'ThankyouController@index']);
                Route::get('/book-appointment', ['as' => 'book-appointment', 'uses' => 'AppointmentController@create']);
                Route::post('/book-appointment', ['as' => 'book-appointment', 'uses' => 'AppointmentController@store']);
                break;

            case "restaurant-reservations":
                Route::get('reservations/thankyou', ['as' => 'reservations/thankyou', 'uses' => 'ThankyouController@index']);
                Route::get('/reservations', ['as' => 'reservations', 'uses' => 'ReservationController@create']);
                Route::post('/reservations', ['as' => 'reservations', 'uses' => 'ReservationController@store']);
                break;

            case "careers":
                Route::get($arrModule->alias->varAlias, ['as' => 'careers', 'uses' => 'CareersController@index']);
                // Route::get($arrModule->alias->varAlias . '/{alias}', ['as' => 'detail', 'uses' => 'CareersController@detail']);
                break;
            default:

                Route::get('/' . $arrModule->alias->varAlias, ['as' => $arrModule->alias->varAlias, 'uses' => 'PagesController@index'])->middleware('prevent-back-history');
                break;
        }
    }
    $CategoryAlias = MyLibrary::getCategoryAliasRoutes();

    Route::get('/home', function() {
       
        return redirect(Config::get('app.url'));
    });

    if (in_array($slug, $CategoryAlias)) {

//        Route::get('{product_category}/domain-transfer', ['as' => 'domain-transfer', 'uses' => 'ProductCategoryController@domaintransfer']);
//        Route::post('{product_category}/domain-transfer', ['as' => 'domain-transfer', 'uses' => 'ProductCategoryController@domaintransfer']);
//        Route::get('{product_category}/bulk-domain-search', ['as' => 'bulk-domain-search', 'uses' => 'ProductCategoryController@bulksearch']);
//        Route::post('{product_category}/bulk-domain-search', ['as' => 'bulk-domain-search', 'uses' => 'ProductCategoryController@bulksearch']);

        Route::get('/{product_category}', ['as' => 'product_category', 'uses' => 'ProductCategoryController@index'])->middleware('prevent-back-history');

        Route::get('/{product_category}/{product}', ['as' => 'product_landing', 'uses' => 'ProductsController@index'])->middleware('prevent-back-history');
        Route::post('/{product_category}/{product}', ['as' => 'product_landing', 'uses' => 'ProductsController@index'])->middleware('prevent-back-history');
    }
}

Route::get('currency/{currency_id}', 'CurrencyController@set');

//Auth::routes();
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/session-expired',function(){  return view('SessionExpired'); });
Route::post('news-letter', ['as' => 'news-letter', 'uses' => 'SubscriptionController@store']);
Route::post('aws-support-services', ['as' => 'aws-support-services', 'uses' => 'AwsSupportController@store']);
Route::get('aws-support-services/thankyou', ['as' => 'aws-support-services/thankyou', 'uses' => 'ThankyouController@index']);
Route::get('news-letter/subscription/subscribe/{id}', ['as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe']);
Route::get('news-letter/subscription/unsubscribe/{id}', ['as' => 'unsubscribe', 'uses' => 'SubscriptionController@unsubscribe']);
Route::get('/news-letter/thankyou', ['as' => 'news-letter/thankyou', 'uses' => 'ThankyouController@index']);
Route::get('xmlsitemap', ['as' => 'xmlsitemap', 'uses' => 'PagesController@xmlsitemap']);
//Route::get('sitemap', ['as' => 'sitemap', 'uses' => 'SiteMapController@index']);
//Route::get('generateSitemap', ['as' => 'generateSitemap', 'uses' => 'SiteMapController@generateSitemap']);
Route::post('/front/search', ['as' => 'search', 'uses' => 'FrontController@search']);
Route::post('/front/popupvalue', ['as' => 'popupvalue', 'uses' => 'FrontController@popup']);
Route::post('/email', ['as' => 'email', 'uses' => 'EmailController@send_email']);
Route::get('/email', ['as' => 'email', 'uses' => 'EmailController@index']);
Route::get('/fetchrss/{start}/{offset}', ['as' => 'fetchrss', 'uses' => 'FetchrssController@index']);
Route::post('/front/search', ['as' => 'search', 'uses' => 'FrontController@search']);
Route::post('/front/popupvalue', ['as' => 'popupvalue', 'uses' => 'FrontController@popup']);
Route::post('/email', ['as' => 'email', 'uses' => 'EmailController@send_email']);
Route::get('/email', ['as' => 'email', 'uses' => 'EmailController@index']);
Route::get('/fetchrss/{start}/{offset}', ['as' => 'fetchrss', 'uses' => 'FetchrssController@index']);

//Route::get('/fetchrss/{start}/{offset}', ['as' => 'fetchrss', 'uses' => 'FetchrssController@index']);
Route::post('domain-checker', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@DomainAvailibity']);
Route::get('domain-checker', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@DomainAvailibity']);
Route::get('domainsuggestion', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@domainsuggestion']);
Route::post('domaintransferdata', ['as' => 'fetchrss', 'uses' => 'CartController@store']);
Route::get('pricefilter', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@pricefilterdata']);

Route::post('addtocart', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@addtocart']);
Route::post('removecart', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@removecart']);
Route::post('whois', ['as' => 'whois', 'uses' => 'PagesController@index']);
Route::post('removeallcart', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@removeallcart']);
Route::get('gettldpricing', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@gettldpricing']);
Route::post('inquirydata', ['as' => 'fetchrss', 'uses' => 'ProductCategoryController@inquiryformdata']);
Route::get('thankyou', ['as' => 'fetchrss', 'uses' => 'ThankyouController@index']);

/*------------------------ Spin Wheel Start -----------------------------------------------------*/
/*Route::post('/cart/spinWheelPostData', 'CartController@spinWheelPostData')->name('spinWheelPostData');
Route::get('/cart/spinWheelGetCookie', 'CartController@spinWheelGetCookie')->name('spinWheelGetCookie');
Route::post('/cart/spinWheelUpdateData', 'CartController@spinWheelUpdateData')->name('spinWheelUpdateData');
Route::post('/cart/spinWheelIsEmailExists', 'CartController@spinWheelIsEmailExists')->name('spinWheelIsEmailExists');
Route::post('/cart/spinWheelIsPhoneExists', 'TesthitsController@spinWheelIsPhoneExists')->name('spinWheelIsPhoneExists');
Route::get('/cart/spinwheel_sendopt', 'TesthitsController@spinwheel_sendopt')->name('spinwheel_sendopt');
Route::get('/cart/spinwheel_verifyopt', 'TesthitsController@spinwheel_verifyopt')->name('spinwheel_verifyopt');*/

/*------------------------ black friday Spin Wheel Start -----------------------------------------------------*/
/*Route::post('/cart/bfSpinWheelPostData', 'TesthitsController@bfSpinWheelPostData')->name('bfSpinWheelPostData');

Route::post('/cart/bfSpinWheelIsEmailExists', 'TesthitsController@bfSpinWheelIsEmailExists')->name('bfSpinWheelIsEmailExists');
Route::post('/cart/bfSpinWheelIsPhoneExists', 'TesthitsController@bfSpinWheelIsPhoneExists')->name('bfSpinWheelIsPhoneExists');
Route::get('/bfSpinWheelRemoveData', 'TesthitsController@bfSpinWheelRemoveData')->name('bfSpinWheelRemoveData');*/
/*Route::get('/bfSpinWheelGetReportXL', 'TesthitsController@bfSpinWheelGetReportXL')->name('bfSpinWheelGetReportXL');*/
/*------------------------ black friday Spin Wheel End -----------------------------------------------------*/

/*--------------------------------*/
/*Route::post('/cart/vpsExtraOffer26Feb', 'TesthitsController@vpsExtraOffer26Feb')->name('spinWheelPostData');
Route::get('/cart/vpsExtraOffer26FebChangeCounters', 'TesthitsController@vpsExtraOffer26FebChangeCounters')->name('spinWheelPostData');*/
/*--------------------------------*/

/*------------------------ Spin Wheel End -----------------------------------------------------*/

Route::post('front-login', 'Userauth\FrontRegisterController@frontlogin');
Route::get('otp-verification', 'Userauth\FrontRegisterController@optverification');
Route::post('otp-send', 'Userauth\FrontRegisterController@otpsend');
Route::get('otp-verify', 'Userauth\FrontRegisterController@otpverify');
Route::post('otp-doverification', 'Userauth\FrontRegisterController@otpdoverification');
Route::get('user-logout', 'Userauth\FrontRegisterController@userlogout')->name('user-logout');
Route::post('front-register', 'Userauth\FrontRegisterController@frontregister');
Route::post('front/password/reset', 'Userauth\FrontRegisterController@forgotpassword');
Route::get('user-email-exit', 'Userauth\FrontRegisterController@emailexit');
Route::get('email-not-exit', 'Userauth\FrontRegisterController@emailnotexit');
Route::get('checkpassword', 'Userauth\FrontRegisterController@checkpassword');
Route::get('reset-passwod/{token}', 'Userauth\FrontRegisterController@resetpassword');
Route::post('user/update/password', 'Userauth\FrontRegisterController@updatepassword');
Route::get('user/whmcs/password', 'Userauth\FrontRegisterController@whmcsupdatepassword');
Route::get('email-confirm/{token}', 'Userauth\FrontRegisterController@confirmemail');
//Route::post('password/reset', 'Userauth\ResetPasswordController@reset');
Route::get('userauth/{provider}', ['uses' => 'Userauth\FrontRegisterController@redirectToProvider']);
Route::get('userauth/{provider}/callback', ['uses' => 'Userauth\FrontRegisterController@handleProviderCallback']);
Route::get('/login', 'Userauth\FrontRegisterController@loginpage');
Route::get('forgot-password', 'Userauth\FrontRegisterController@newresetpassword');
Route::get('powerpanel/', 'Auth\LoginController@showLoginForm');
Route::get('powerpanel/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('powerpanel/login', 'Auth\LoginController@login');
Route::post('powerpanel/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('powerpanel/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('powerpanel/register', 'Auth\RegisterController@register');
Route::get('powerpanel/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('powerpanel/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('powerpanel/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('powerpanel/password/reset', 'Auth\ResetPasswordController@reset');

Route::post('/powerpanel/aliasGenerate', ['as' => 'powerpanel/aliasGenerate', 'uses' => 'PowerpanelController@aliasGenerate']);
Route::get('powerpanel/install/{file}', 'PowerpanelController@install');

#Alias Module Routes#####################
Route::post('/powerpanel/aliasGenerate', ['as' => 'powerpanel/aliasGenerate', 'uses' => 'PowerpanelController@aliasGenerate']);
Route::post('/powerpanel/generate-seo-content', ['as' => 'powerpanel/generate-seo-content', 'uses' => 'PowerpanelController@generateSeoContent']);
#Alias Module Routes#####################

Route::group(['namespace' => 'Powerpanel', 'middleware' => ['auth','prevent-back-history']], function ($request) {

    #Dashboard Module Routes#####################
    Route::get('powerpanel', 'DashboardController@index');
    Route::get('/powerpanel/dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
    Route::post('/powerpanel/dashboard/ajax', ['as' => 'dashboard.index', 'uses' => 'DashboardController@ajaxcall']);
    #Dashboard Module Routes#####################
    #Menu Module Routes#####################
    Route::get('/powerpanel/menu', ['uses' => 'MenuController@index', 'middleware' => ['permission:menu-list']]);
    Route::post('/powerpanel/menu/getMenuType', ['uses' => 'MenuController@getMenuType', 'middleware' => ['permission:menu-list']]);
    Route::post('/powerpanel/menu/addMenuType', ['uses' => 'MenuController@addMenuType', 'middleware' => ['permission:menu-create']]);
    Route::post('/powerpanel/menu/saveMenu', ['uses' => 'MenuController@saveMenu', 'middleware' => ['permission:menu-create']]);
    Route::post('/powerpanel/menu/addMenuItem', ['uses' => 'MenuController@addMenuItem', 'middleware' => ['permission:menu-create']]);
    Route::post('/powerpanel/menu/addMenuItems', ['uses' => 'MenuController@addMenuItems', 'middleware' => ['permission:menu-create']]);
    Route::post('/powerpanel/menu/reload', 'MenuController@reload');
    Route::post('/powerpanel/menu/deleteMenuItem', ['uses' => 'MenuController@deleteMenuItem', 'middleware' => ['permission:menu-delete']]);
    Route::post('/powerpanel/menu/deleteMenu', ['uses' => 'MenuController@deleteMenu', 'middleware' => ['permission:menu-delete']]);
    Route::post('/powerpanel/menu/getMenuItem', ['uses' => 'MenuController@getMenuItem', 'middleware' => ['permission:menu-edit']]);
    Route::post('/powerpanel/menu/updateMenuItem', ['uses' => 'MenuController@updateMenuItem', 'middleware' => ['permission:menu-edit']]);
    Route::post('/powerpanel/menu/aliasGenerate', ['as' => 'powerpanel/menu/aliasGenerate', 'uses' => 'MenuController@aliasGenerate']);
    Route::post('/powerpanel/menu/megaMenu', ['uses' => 'MenuController@megaMenu', 'middleware' => ['permission:menu-edit']]);
    #Menu Module Routes#####################
    #Media Manager Module Routes#####################
    Route::post('/powerpanel/media/set_image_html', ['as' => 'powerpanel/media/set_image_html', 'uses' => 'MediaController@set_image_html']);
    Route::post('/powerpanel/media/set_video_html', ['as' => 'powerpanel/media/set_video_html', 'uses' => 'MediaController@set_video_html']);
    Route::post('/powerpanel/media/upload_image', ['as' => 'powerpanel/media/upload_image', 'uses' => 'MediaController@upload_image']);
    Route::post('/powerpanel/media/upload_video', ['as' => 'powerpanel/media/upload_video', 'uses' => 'MediaController@upload_video']);
    Route::post('/powerpanel/media/user_uploaded_video', ['as' => 'powerpanel/media/user_uploaded_video', 'uses' => 'MediaController@user_uploaded_video']);
    Route::post('/powerpanel/media/get_trash_videos', ['as' => '/powerpanel/media/get_trash_videos', 'uses' => 'MediaController@get_trash_videos']);
    Route::post('/powerpanel/media/user_uploaded_image', ['as' => '/powerpanel/media/user_uploaded_image', 'uses' => 'MediaController@user_uploaded_image']);
    Route::post('/powerpanel/media/load_more_images/{user_id}', ['as' => '/powerpanel/media/load_more_images', 'uses' => 'MediaController@load_more_images']);
    Route::post('/powerpanel/media/remove_image', ['as' => '/powerpanel/media/remove_image', 'uses' => 'MediaController@remove_image']);
    Route::post('/powerpanel/media/get_recent_uploaded_images', ['as' => '/powerpanel/media/get_recent_uploaded_images', 'uses' => 'MediaController@get_recent_uploaded_images']);
    Route::post('/powerpanel/media/get_trash_images', ['as' => '/powerpanel/media/get_trash_images', 'uses' => 'MediaController@get_trash_images']);
    Route::post('/powerpanel/media/insert_image_by_url', ['as' => '/powerpanel/media/insert_image_by_url', 'uses' => 'MediaController@insert_image_by_url']);
    Route::post('/powerpanel/media/insert_video_by_url', ['as' => '/powerpanel/media/insert_video_by_url', 'uses' => 'MediaController@insert_video_by_url']);
    Route::post('/powerpanel/media/remove_multiple_image', ['as' => '/powerpanel/media/remove_multiple_image', 'uses' => 'MediaController@remove_multiple_image']);
    Route::post('/powerpanel/media/remove_multiple_videos', ['as' => '/powerpanel/media/remove_multiple_videos', 'uses' => 'MediaController@remove_multiple_videos']);
    Route::post('/powerpanel/media/restore_multiple_image', ['as' => '/powerpanel/media/restore_multiple_image', 'uses' => 'MediaController@restore_multiple_image']);

    Route::post('/powerpanel/media/restore-multiple-videos', ['as' => '/powerpanel/media/restore-multiple-videos', 'uses' => 'MediaController@restore_multiple_videos']);

    Route::post('/powerpanel/media/set_document_uploader', ['as' => 'powerpanel/media/set_document_uploader', 'uses' => 'MediaController@set_document_uploader']);
    Route::post('/powerpanel/media/upload_documents', ['as' => 'powerpanel/media/upload_documents', 'uses' => 'MediaController@upload_documents']);
    Route::post('/powerpanel/media/user_uploaded_docs', ['as' => '/powerpanel/media/user_uploaded_docs', 'uses' => 'MediaController@user_uploaded_docs']);
    Route::post('/powerpanel/media/remove_multiple_documents', ['as' => '/powerpanel/media/remove_multiple_documents', 'uses' => 'MediaController@remove_multiple_documents']);
    Route::post('/powerpanel/media/get_trash_documents', ['as' => '/powerpanel/media/get_trash_documents', 'uses' => 'MediaController@get_trash_documents']);

    Route::post('/powerpanel/media/check-img-inuse', ['as' => '/powerpanel/media/check-img-inuse', 'uses' => 'MediaController@checkedUsedImg']);
    Route::post('/powerpanel/media/restore-multiple-document', ['as' => '/powerpanel/media/restore_multiple_document', 'uses' => 'MediaController@restore_multiple_document']);
    Route::post('/powerpanel/media/check-document-inuse', ['as' => '/powerpanel/media/check-document-inuse', 'uses' => 'MediaController@checkedUsedDocument']);
    #Media Manager Routes#####################
    #Photo Gallery Module Routes#####################
    Route::post('/powerpanel/photo-gallery/update', ['as' => '/powerpanel/photo-gallery/update', 'uses' => 'PhotoGalleryController@store', 'middleware' => ['permission:photo-gallery-edit']]);
    Route::post('/powerpanel/photo-gallery/update_status', ['as' => '/powerpanel/photo-gallery/update_status', 'uses' => 'PhotoGalleryController@update_status', 'middleware' => ['permission:photo-gallery-edit']]);
    Route::post('/powerpanel/photo-gallery/destroy', ['as' => '/powerpanel/photo-gallery/destroy', 'uses' => 'PhotoGalleryController@destroy', 'middleware' => ['permission:photo-gallery-delete']]);
    #Photo Gallery Module Routes#####################
    #Video Gallery Module Routes#####################
    Route::post('/powerpanel/video-gallery/update', ['as' => '/powerpanel/video-gallery/update', 'uses' => 'VideoGalleryController@store', 'middleware' => ['permission:video-gallery-edit']]);
    Route::post('/powerpanel/video-gallery/update_status', ['as' => '/powerpanel/video-gallery/update_status', 'uses' => 'VideoGalleryController@update_status', 'middleware' => ['permission:video-gallery-edit']]);
    Route::post('/powerpanel/video-gallery/destroy', ['as' => '/powerpanel/video-gallery/destroy', 'uses' => 'VideoGalleryController@destroy', 'middleware' => ['permission:video-gallery-delete']]);
    Route::post('/powerpanel/media/check-video-inuse', ['as' => '/powerpanel/media/check-video-inuse', 'uses' => 'MediaController@checkedUsedVideo']);
    #Video Gallery Module Routes#####################
    #Banner Module Routes#####################
    Route::post('/powerpanel/banners/selectRecords', ['uses' => 'BannerController@selectRecords']);
    #End Banner Module Routes#################
    // vikram 10-10-2019 for banner
    Route::get('/powerpanel/banners/viewurltrue', "BannerController@checkurl"); 
    // end
    

    Route::post('/settings/testMail', ['as' => '/settings/testMail', 'uses' => 'SettingsController@testMail']);
    Route::post('/settings/save-module-settings', ['as' => '/settings/save-module-settings', 'uses' => 'SettingsController@saveModuleSettings']);
    Route::post('/settings/get-save-module-settings', ['as' => '/settings/get-save-module-settings', 'uses' => 'SettingsController@getModuleSettings']);
    Route::post('/settings/get-filtered-modules', ['as' => '/settings/get-filtered-modules', 'uses' => 'SettingsController@getModulesAjax']);
    Route::get('/powerpanel/roles/show/{id}', ['as' => 'powerpanel.roles.show', 'uses' => 'RoleController@show']);
    Route::patch('/powerpanel/roles/{id}', ['as' => 'powerpanel.roles.update', 'uses' => 'RoleController@handlePost', 'middleware' => ['permission:roles-edit']]);

    Route::get('/powerpanel/changepassword', array('as' => 'powerpanel/changepassword', 'uses' => 'ProfileController@changepassword', 'middleware' => 'permission:changeprofile-change-password'));
    Route::post('/powerpanel/changepassword', array('as' => 'powerpanel/changepassword', 'uses' => 'ProfileController@handle_changepassword'));

    Route::post('/powerpanel/media/empty_trash_Image', ['as' => 'powerpanel/media/empty_trash_image', 'uses' => 'MediaController@empty_trash_image']);

    Route::post('/powerpanel/media/empty_trash_Video', ['as' => 'powerpanel/media/empty_trash_video', 'uses' => 'MediaController@empty_trash_video']);

    Route::post('/powerpanel/media/empty_trash_Document', ['as' => 'powerpanel/media/empty_trash_document', 'uses' => 'MediaController@empty_trash_document']);
});

$setConstants = MyLibrary::setConstants($segmentArr);
// echo '<pre>'; print_r($setConstants); exit;

if ($setConstants) {
    Route::group(['namespace' => 'Powerpanel', 'middleware' => ['auth','prevent-back-history']], function ($request) {

        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME'), ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.index', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@index', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/get_list', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@get_list', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/add', ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.add', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@edit', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-create']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/add', ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.handleAddPost', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@handlePost', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-create']);
        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/{alias}/edit', ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.edit', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@edit', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-edit']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/{alias}/edit', ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.handleEditPost', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@handlePost', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-edit']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/DeleteRecord', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@DeleteRecord', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-delete']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/publish', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@publish', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-edit']);
        Route::post('powerpanel/' . Config::get('Constant.MODULE.NAME') . '/reorder', ['as' => Config::get('Constant.MODULE.NAME') . '.reorder', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@reorder', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::post('powerpanel/' . Config::get('Constant.MODULE.NAME') . '/destroy', ['as' => Config::get('Constant.MODULE.NAME') . '.destroy', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@destroy', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-delete']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/makeDefault', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@makeDefault']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/ajax', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@ajax', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME'), ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.index', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@index', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME'), ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.handleEditPost', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@handleEditPost', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-edit']);
        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/ExportRecord', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@ExportRecord', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::get('powerpanel/newsletter/send_email', ['as' => 'newsletters/send_email', 'uses' => 'NewsletterController@send_email']);
        Route::get('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/show/{$id}', ['as' => 'powerpanel.' . Config::get('Constant.MODULE.NAME') . '.show', 'uses' => Config::get('Constant.MODULE.CONTROLLER') . '@show', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-list']);
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/makeFeatured', ['uses' => Config::get('Constant.MODULE.CONTROLLER') . '@makeFeatured', 'middleware' => 'permission:' . Config::get('Constant.MODULE.NAME') . '-edit']);

        Route::get('/powerpanel/settings', ['as' => 'powerpanel/settings', 'uses' => 'SettingsController@index', 'middleware' => 'permission:settings-general-setting-management']);
        Route::post('/powerpanel/settings', ['as' => 'powerpanel/settings', 'uses' => 'SettingsController@update_settings', 'middleware' => 'permission:settings-general-setting-management']);
        Route::get('/powerpanel/settings/getDBbackUp', ['as' => 'powerpanel/settings/getDBbackUp', 'uses' => 'SettingsController@getDBbackUp']);

        Route::get('/powerpanel/changeprofile', array('as' => 'powerpanel/changeprofile', 'uses' => 'ProfileController@index', 'middleware' => 'permission:changeprofile-edit'));
        Route::post('/powerpanel/changeprofile', array('as' => 'powerpanel/changeprofile', 'uses' => 'ProfileController@changeprofile'));
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/swaporder', Config::get('Constant.MODULE.CONTROLLER') . '@reorder');
        Route::post('/powerpanel/' . Config::get('Constant.MODULE.NAME') . '/ajaxCatAdd', Config::get('Constant.MODULE.CONTROLLER') . '@addCatAjax');
        Route::post('/powerpanel/appointment-lead/saveComment', 'AppointmentLeadController@saveComment');
        Route::post('/powerpanel/faq/getProductAjax', 'FaqController@getProductAjax');
        Route::post('/powerpanel/deals/getProductAjax', 'DealsController@getProductAjax');
        Route::post('/powerpanel/testimonial/getProductAjax', 'TestimonialController@getProductAjax');
        Route::post('/powerpanel/products-package/getProductAjax', 'ProductsPackageController@getProductAjax');
        Route::post('/powerpanel/products-package/getWHMCSProductAjax', 'ProductsPackageController@getWHMCSProductAjax');
        Route::post('/powerpanel/product-features/getProductAjax', 'ProductFeaturesController@getProductAjax');
        Route::post('/powerpanel/featured-products/getProductAjax', 'FeaturedProductsController@getProductAjax');
        Route::post('/powerpanel/products/getProductAliasAjax', 'ProductController@getProductAliasAjax');
    });
}

Route::post('/powerpanel/share', ['uses' => 'OnePushController@ShareonSocialMedia']);
Route::post('/powerpanel/share/getrec', ['uses' => 'OnePushController@getRecord']);
Route::get('/powerpanel/share/gPlusCallBack', ['uses' => 'OnePushController@gPlusCallBack']);

Route::group(['namespace' => 'Powerpanel', 'middleware' => ['auth','prevent-back-history']], function ($request) {

    Route::get('/powerpanel/tpl/{view}', array('as' => 'view', 'uses' => 'TplController@index'));
    Route::get('/powerpanel/email_log', array('as' => 'email_log', 'uses' => 'EmailLogController@index'));
    Route::post('/powerpanel/email_log/get_email_log_list', array('uses' => 'EmailLogController@get_email_log_list'));
    Route::post('/powerpanel/notification', array('uses' => 'NotificationController@index'));
    Route::post('/powerpanel/notification/update_read_status', array('uses' => 'NotificationController@update_read_status'));
    Route::post('/powerpanel/notification/get_read_notification_count', array('uses' => 'NotificationController@get_read_notification_count'));
    Route::post('/powerpanel/global', array('uses' => 'GlobalSearchController@index'));
    Route::get('/powerpanel/calender', array('uses' => 'CalenderController@index'));
    Route::get('/powerpanel/calender/get_activity', array('uses' => 'CalenderController@get_activity'));
    Route::post('/powerpanel/message', array('uses' => 'MessageController@index'));
    Route::post('/powerpanel/message/update_read_status', array('uses' => 'MessageController@update_read_status'));
    Route::post('/powerpanel/message/get_read_message_count', array('uses' => 'MessageController@get_read_message_count'));

    Route::get('/powerpanel/analytics', ['as' => 'powerpanel.analytics.index', 'uses' => 'AnalyticsController@index', 'middleware' => 'permission:analytics-list']);
    Route::post('analytics/get_range_analysis', ['as' => 'analytics.get_range_analysis', 'uses' => 'AnalyticsController@get_range_analysis', 'middleware' => 'permission:analytics-list']);
    Route::get('/powerpanel/plugins', array('uses' => 'PluginController@index'));
    Route::get('/powerpanel/plugins/get_module/{module}', array('uses' => 'PluginController@get_module'));
    Route::get('/powerpanel/plugins/update_module/{module}', array('uses' => 'PluginController@update_module'));
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//---------------------- Shopping Cart -------------------------
Route::get('/cart', ['as' => 'cart', 'uses' => 'CartController@index']);
Route::get('/cart/add', ['as' => 'cart.add', 'uses' => 'CartController@add']);
Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
Route::post('/cart/store', ['as' => 'cart.store', 'uses' => 'CartController@store']);

Route::get('/cart/empty', ['as' => 'cart.empty', 'uses' => 'CartController@emptycart']);
Route::post('/cart/remove', ['as' => 'cart.remove', 'uses' => 'CartController@removecart']);

Route::post('/cart/createorder', ['as' => 'cart.createorder', 'uses' => 'CartController@createorder']);
Route::get('/cart/generateorder', ['as' => 'cart.generateorder', 'uses' => 'CartController@generateorder']);

Route::post('/cart/updatedomain', ['as' => 'cart.updatedomain', 'uses' => 'CartController@updatedomain']);
Route::post('/cart/updatehosting', ['as' => 'cart.updateserver', 'uses' => 'CartController@updatehosting']);
Route::post('/cart/updateserver', ['as' => 'cart.updateserver', 'uses' => 'CartController@updateserver']);
Route::get('/cart/config', ['as' => 'cart.config', 'uses' => 'CartController@config']);
Route::post('/cart/getconfigfinalprice', ['as' => 'cart.getconfigfinalprice', 'uses' => 'CartController@getconfigfinalprice']);
Route::post('/cart/setconfigoptionvalue', ['as' => 'cart.setconfigoptionvalue', 'uses' => 'CartController@setconfigoptionvalue']);
Route::post('/cart/setcustomoptionvalue', ['as' => 'cart.setcustomoptionvalue', 'uses' => 'CartController@setcustomoptionvalue']);
Route::get('/cart/getrecommandation', ['as' => 'cart.getrecommandation', 'uses' => 'CartController@getrecommandation']);
Route::get('/cart/suggesteddomains', ['as' => 'cart.suggesteddomains', 'uses' => 'CartController@suggesteddomains']);
Route::post('/cart/adddomainaddons', ['as' => 'cart.adddomainaddons', 'uses' => 'CartController@adddomainaddons']);
Route::post('/cart/hidedomainaddons', ['as' => 'cart.hidedomainaddons', 'uses' => 'CartController@hidedomainaddons']); 
Route::post('/cart/removeaddon', ['as' => 'cart.removeaddon', 'uses' => 'CartController@removeaddon']);
Route::get('/cart/featchplansmessage', 'CartController@featchplansmessage');
Route::post('/cart/removedomainaddon', ['as' => 'cart.removedomainaddon', 'uses' => 'CartController@removedomainaddon']);
Route::post('/cart/converttowhmcs', ['as' => 'cart.converttowhmcs', 'uses' => 'CartController@converttowhmcs']);
Route::get('/cart/getordersummary', ['as' => 'cart.getordersummary', 'uses' => 'CartController@getordersummary']);
Route::post('/cart/configdomain', ['as' => 'cart.configdomain', 'uses' => 'CartController@configdomain']);
Route::post('/cart/checkconfigdomainname', ['as' => 'cart.checkconfigdomainname', 'uses' => 'CartController@checkconfigdomainname']);
Route::get('/cart/signin', ['as' => 'cart.cartsignin', 'uses' => 'CartController@cartsignin']);
Route::get('/cart/thankyou', function(){ return view("errors.404"); });
Route::post('/cart/thankyou', ['as' => 'cart.thankyou', 'uses' => 'CartController@thankyou']); 
Route::get('/cart/thankyou1', ['as' => 'cart.thankyou', 'uses' => 'TesthitsController@thankyoutest']); 
Route::get('/contact/thankyou', ['as' => 'contact/thankyou', 'uses' => 'ThankyouController@index']);
Route::post('/cart/paymentfail', ['as' => 'cart.paymentfail', 'uses' => 'CartController@paymentfail']);
Route::get('/cart/paymentfail', ['as' => 'cart.paymentfail', 'uses' => 'CartController@paymentfail']);

Route::get('/cart/billinginfo', ['as' => 'cart.cartbillinginfo', 'uses' => 'CartController@billinginfo'])->middleware('prevent-back-history');
Route::post('/cart/updatebillinginfo', ['as' => 'cart.updatebillinginfo', 'uses' => 'CartController@updatebillinginfo']);
Route::get('/cart/paymentoptions', ['as' => 'cart.paymentoptions', 'uses' => 'CartController@paymentoptions'])->middleware('prevent-back-history');
Route::post('/cart/updatepromo', ['as' => 'cart.updatepromo', 'uses' => 'CartController@updatepromo']);
Route::post('/cart/getfreedomain', ['as' => 'cart.getfreedomain', 'uses' => 'CartController@getfreedomain']);
Route::post('/cart/reloadcart', ['as' => 'cart.reloadcart', 'uses' => 'CartController@reloadcart']);
Route::post('/cart/getsearchcartdomain', ['as' => 'cart.getsearchcartdomain', 'uses' => 'CartController@getsearchcartdomain']);
Route::post('/cart/paypalsuccess', ['as' => 'cart.paypalsuccess', 'uses' => 'CartController@paypalsuccess']);
Route::get('/cart/paypalsuccess', ['as' => 'cart.paypalsuccess', 'uses' => 'CartController@paypalsuccess']);
Route::post('/cart/ccavenuesuccess', ['as' => 'cart.ccavenuesuccess', 'uses' => 'CartController@ccavenuesuccess']);
Route::get('/cart/orderemail', ['as' => 'cart.orderemail', 'uses' => 'CartController@orderemail']);
Route::post('/cart/addbulkdomain', ['as' => 'cart.addbulkdomain', 'uses' => 'CartController@addbulkdomain']);
Route::post('/cart/removebulkdomain', ['as' => 'cart.removebulkdomain', 'uses' => 'CartController@removebulkdomain']);
Route::get('/cart/testapi', ['as' => 'cart.testapi', 'uses' => 'CartController@testapi']);
Route::get('/cart/setcurrency', ['as' => 'cart.setcurrency', 'uses' => 'CartController@setcurrency']);

Route::get('/cron/', ['as' => 'cron', 'uses' => 'CronController@index']);
Route::get('/marketingcron/', ['as' => 'cron', 'uses' => 'MarketingCronController@index']);
Route::post('/cart/getvpsconfig', ['as' => 'cart.getvpsconfig', 'uses' => 'CartController@getvpsconfig']);
Route::get('/cart/counter', ['as' => 'cart.getitemscounter', 'uses' => 'CartController@getitemscounter']);
Route::get('/cart/newconfig', ['as' => 'cart.config', 'uses' => 'CartController@newconfig']);
Route::get('/testhits/removeclient', ['as' => 'testhits.removeclient', 'uses' => 'TesthitsController@removeclient']);
Route::get('/testhits/whmcspricing', ['as' => 'testhits.whmcspricing', 'uses' => 'TesthitsController@whmcspricing']);
Route::get('/testhits/testaction', ['as' => 'testhits.testaction', 'uses' => 'TesthitsController@testaction']);



Route::get('/orderrating', ['as' => 'rating', 'uses' => 'TesthitsController@index']);
Route::post('/get_products_data', ['as' => 'product_details', 'uses' => 'TesthitsController@get_products_data']);



Route::get('/user/whmcs/password', 'Userauth\FrontRegisterController@whmcsupdatepassword');

// S Vk 29/9/2020 for check terms
Route::post('/cart/removeCartItemAnalytices', 'TesthitsController@removeCartItemAnalytices')->name('removeCartItemAnalytices');
Route::post('/cart/check_terms', 'CartController@check_terms')->name('check_terms');
Route::get('/cart/viewallsession', function(){ return Session::all(); });
Route::get('/cart/removesession', function(){ Session::flush(); return redirect('/'); });
// E Vk 29/9/2020 for check terms

Route::get('/career/details', function(){ return redirect('/careers'); })->name('careerDetails');
Route::post('/career/details','CareersController@careerDetails')->name('careerDetails');
Route::post('/career/details-store','CareersController@careerDetailsStore')->name('careerDetailsStore');
Route::post('/career/details-fileupload','CareersController@careerDetailsFileupload')->name('careerDetailsFileupload');
Route::get('/careers/thankyou', ['as' => 'career/thankyou', 'uses' => 'CareersController@thankyou']);


Route::get('/secure/whmcs-products', function () {
    $filePath = storage_path('app/whmcsproduct/whmcs_response.js');

    // Check if the file exists
    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->file($filePath, [
        'Content-Type' => 'application/javascript',
    ]);
});

Route::get('/clear-cache', function(){ 
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Cache::flush();
    return redirect('/');
});