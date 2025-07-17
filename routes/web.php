<?php
use App\Helpers\MyLibrary;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\ThankyouController;
use App\Http\Controllers\GoogleContactController;
use App\Http\Controllers\MarketingCronController;
use App\Http\Controllers\TesthitsController;
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
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AwsSupportController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PowerpanelController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Userauth\FrontRegisterController;
use App\Http\Controllers\Powerpanel\DashboardController;
use App\Http\Controllers\Powerpanel\MenuController;
use App\Http\Controllers\Powerpanel\MediaController;
use App\Http\Controllers\Powerpanel\PhotoGalleryController;
use App\Http\Controllers\Powerpanel\VideoGalleryController;
use App\Http\Controllers\Powerpanel\BannerController;
use App\Http\Controllers\Powerpanel\SettingsController;
use App\Http\Controllers\Powerpanel\RoleController;
use App\Http\Controllers\Powerpanel\ProfileController;
use App\Http\Controllers\Powerpanel\OnePushController;
use App\Http\Controllers\Powerpanel\TplController;
use App\Http\Controllers\Powerpanel\EmailLogController;
use App\Http\Controllers\Powerpanel\NotificationController;
use App\Http\Controllers\Powerpanel\GlobalSearchController;
use App\Http\Controllers\Powerpanel\CalenderController;
use App\Http\Controllers\Powerpanel\MessageController;
use App\Http\Controllers\Powerpanel\AnalyticsController;
use App\Http\Controllers\Powerpanel\PluginController;

$segmentArr = Request::segments();
if (!empty(Request::segment(1)) && Request::segment(1) !== 'powerpanel') {
    Route::get('googlecontact/thankyou', [ThankyouController::class, 'index'])->name('googlecontact.thankyou');
    Route::post('/email/google-workspace-india', [GoogleContactController::class, 'store'])->name('contact');
    $slug = Request::segment(1);
    $arrModule = MyLibrary::setFrontRoutes($slug);
    if (isset($arrModule->modules->varModuleName)) {
        switch ($arrModule->modules->varModuleName) {
            case 'blogs':
                Route::get($arrModule->alias->varAlias, [BlogsController::class, 'index'])->name('blogs');
                Route::get($arrModule->alias->varAlias . '/{alias}', [BlogsController::class, 'detail'])->name('blogs.detail');
                Route::get($arrModule->alias->varAlias . '/pagination', [BlogsController::class, 'pagelist'])->name('blogs.pagination');
                break;
            case 'general-faq':
                Route::get($arrModule->alias->varAlias, [FaqController::class, 'index'])->name('faq');
                break;
            case 'tld':
                Route::get($arrModule->alias->varAlias, [TldController::class, 'index'])->name('tld');
                break;
            case 'deals':
                Route::get($arrModule->alias->varAlias, [DealsController::class, 'index'])->name('deals')->middleware('prevent-back-history');
                break;
            case 'services':
                Route::get($arrModule->alias->varAlias, [ServicesController::class, 'index'])->name('services');
                Route::get($arrModule->alias->varAlias . '/{alias}', [ServicesController::class, 'detail'])->name('services.detail');
                break;
            case 'testimonial':
                Route::get('/' . $arrModule->alias->varAlias, [TestimonialController::class, 'index'])->name('testimonial');
                Route::post('testimonial', [TestimonialController::class, 'store'])->middleware('badwords')->name('testimonial.store');
                Route::get('/pagination/' . $arrModule->alias->varAlias, [TestimonialController::class, 'pagelist'])->name('testimonial.pagelist');
                break;
            case 'testimonials':
                Route::get($arrModule->alias->varAlias, [TestimonialsController::class, 'index'])->name('casestudy');
                Route::get($arrModule->alias->varAlias . '/{alias}', [TestimonialsController::class, 'detail'])->name('casestudy.detail');
                break;
            case 'team':
                Route::get('/' . $arrModule->alias->varAlias, [TeamController::class, 'index'])->name('team');
                Route::get('/pagination/' . $arrModule->alias->varAlias, [TeamController::class, 'pagelist'])->name('team.pagelist');
                Route::get($arrModule->alias->varAlias . '/{alias}', [TeamController::class, 'detail'])->name('team.detail');
                Route::get('/vcard', [TeamController::class, 'download_vcard']);
                break;
            case 'news':
                Route::get($arrModule->alias->varAlias, [NewsController::class, 'index'])->name('news');
                Route::get($arrModule->alias->varAlias . '/{alias}', [NewsController::class, 'detail'])->name('news.detail');
                break;
            case 'casestudy':
                Route::get($arrModule->alias->varAlias, [CasestudiesController::class, 'index'])->name('casestudy');
                Route::get($arrModule->alias->varAlias . '/{alias}', [CasestudiesController::class, 'detail'])->name('casestudy.detail');
                break;
            case 'photo-album':
                Route::get($arrModule->alias->varAlias, [PhotoAlbumController::class, 'index'])->name('photo-album');
                Route::get($arrModule->alias->varAlias . '/{alias}', [PhotoAlbumController::class, 'photo_gallery'])->name('photo_gallery');
                break;
            case 'video-album':
                Route::get($arrModule->alias->varAlias, [VideoAlbumController::class, 'index'])->name('video-album');
                Route::get($arrModule->alias->varAlias . '/{alias}', [VideoAlbumController::class, 'video_gallery'])->name('video_gallery');
                break;
            case 'events':
                Route::get($arrModule->alias->varAlias, [EventsController::class, 'index'])->name('events');
                Route::get($arrModule->alias->varAlias . '/{alias}', [EventsController::class, 'detail'])->name('events.detail');
                Route::get($arrModule->alias->varAlias . '/pagination', [EventsController::class, 'pagelist'])->name('events.pagination');
                break;
            case 'shows':
                Route::get($arrModule->alias->varAlias, [ShowsController::class, 'index'])->name('shows');
                Route::get($arrModule->alias->varAlias . '/{alias}', [ShowsController::class, 'detail'])->name('shows.detail');
                break;
            case 'contact-us':
                Route::get('contact/thankyou', [ThankyouController::class, 'index'])->name('contact.thankyou');
                Route::get('/' . $arrModule->alias->varAlias, [ContactController::class, 'create'])->name('contact');
                Route::post('/' . $arrModule->alias->varAlias, [ContactController::class, 'store'])->name('contact.store');
                break;
            case 'reseller-center':
                Route::get('reseller-program/thankyou', [ThankyouController::class, 'index'])->name('reseller-program.thankyou');
                Route::get('/' . $arrModule->alias->varAlias, [ResellerCenterController::class, 'create'])->name('reseller-center');
                Route::post('/' . $arrModule->alias->varAlias, [ResellerCenterController::class, 'store'])->name('reseller-center.store');
                break;
            case 'appointment-lead':
                Route::get('book-appointment/thankyou', [ThankyouController::class, 'index'])->name('book-appointment.thankyou');
                Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('book-appointment');
                Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('book-appointment.store');
                break;
            case 'restaurant-reservations':
                Route::get('reservations/thankyou', [ThankyouController::class, 'index'])->name('reservations.thankyou');
                Route::get('/reservations', [ReservationController::class, 'create'])->name('reservations');
                Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
                break;
            case 'careers':
                Route::get($arrModule->alias->varAlias, [CareersController::class, 'index'])->name('careers');
                break;
            default:
                Route::get('/' . $arrModule->alias->varAlias, [PagesController::class, 'index'])->name($arrModule->alias->varAlias)->middleware('prevent-back-history');
                break;
        }
    }
    $CategoryAlias = MyLibrary::getCategoryAliasRoutes();
    Route::get('/home', function () {
        return redirect(Config::get('app.url'));
    });
    if (in_array($slug, $CategoryAlias)) {
        Route::get('/{product_category}', [ProductCategoryController::class, 'index'])->name('product_category')->middleware('prevent-back-history');
        Route::get('/{product_category}/{product}', [ProductsController::class, 'index'])->name('product_landing')->middleware('prevent-back-history');
        Route::post('/{product_category}/{product}', [ProductsController::class, 'index'])->name('product_landing.post')->middleware('prevent-back-history');
    }
}
Route::get('currency/{currency_id}', [CurrencyController::class, 'set']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/session-expired', 'SessionExpired');
Route::post('aws-support-services', [AwsSupportController::class, 'store'])->name('aws-support-services');
Route::get('aws-support-services/thankyou', [ThankyouController::class, 'index'])->name('aws-support-services.thankyou');
Route::get('/news-letter/thankyou', [ThankyouController::class, 'index'])->name('news-letter.thankyou');
Route::get('xmlsitemap', [PagesController::class, 'xmlsitemap'])->name('xmlsitemap');
Route::post('/front/search', [FrontController::class, 'search'])->name('search');
Route::post('/front/popupvalue', [FrontController::class, 'popup'])->name('popupvalue');
Route::post('domain-checker', [ProductCategoryController::class, 'DomainAvailibity'])->name('domain-checker');
Route::get('domain-checker', [ProductCategoryController::class, 'DomainAvailibity']);
Route::get('domainsuggestion', [ProductCategoryController::class, 'domainsuggestion'])->name('domainsuggestion');
Route::post('domaintransferdata', [CartController::class, 'store'])->name('domaintransferdata');
Route::get('pricefilter', [ProductCategoryController::class, 'pricefilterdata'])->name('pricefilter');
Route::post('addtocart', [ProductCategoryController::class, 'addtocart'])->name('addtocart');
Route::post('removecart', [ProductCategoryController::class, 'removecart'])->name('removecart');
Route::post('whois', [PagesController::class, 'index'])->name('whois');
Route::post('removeallcart', [ProductCategoryController::class, 'removeallcart'])->name('removeallcart');
Route::get('gettldpricing', [ProductCategoryController::class, 'gettldpricing'])->name('gettldpricing');
Route::post('inquirydata', [ProductCategoryController::class, 'inquiryformdata'])->name('inquirydata');
Route::get('thankyou', [ThankyouController::class, 'index'])->name('thankyou');
Route::post('front-login', [FrontRegisterController::class, 'frontlogin']);
Route::view('front-login', 'errors.404');
Route::get('otp-verification', [FrontRegisterController::class, 'optverification']);
Route::post('otp-send', [FrontRegisterController::class, 'otpsend']);
Route::get('otp-verify', [FrontRegisterController::class, 'otpverify']);
Route::post('otp-doverification', [FrontRegisterController::class, 'otpdoverification']);
Route::get('user-logout', [FrontRegisterController::class, 'userlogout'])->name('user-logout');
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
Route::get('powerpanel/', [LoginController::class, 'showLoginForm']);
Route::get('powerpanel/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('powerpanel/login', [LoginController::class, 'login']);
Route::post('powerpanel/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('powerpanel/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('powerpanel/register', [RegisterController::class, 'register']);
Route::get('powerpanel/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('powerpanel/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('powerpanel/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('powerpanel/password/reset', [ResetPasswordController::class, 'reset']);
Route::post('/powerpanel/aliasGenerate', [PowerpanelController::class, 'aliasGenerate'])->name('powerpanel.aliasGenerate');
Route::get('powerpanel/install/{file}', [PowerpanelController::class, 'install']);
Route::post('/powerpanel/generate-seo-content', [PowerpanelController::class, 'generateSeoContent'])->name('powerpanel.generateSeoContent');
Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
    Route::get('powerpanel', [DashboardController::class, 'index']);
    Route::get('/powerpanel/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/powerpanel/dashboard/ajax', [DashboardController::class, 'ajaxcall'])->name('dashboard.index');
    Route::prefix('powerpanel/menu')->middleware('permission:menu-list')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::post('/getMenuType', [MenuController::class, 'getMenuType']);
        Route::post('/addMenuType', [MenuController::class, 'addMenuType'])->middleware('permission:menu-create');
        Route::post('/saveMenu', [MenuController::class, 'saveMenu'])->middleware('permission:menu-create');
        Route::post('/addMenuItem', [MenuController::class, 'addMenuItem'])->middleware('permission:menu-create');
        Route::post('/addMenuItems', [MenuController::class, 'addMenuItems'])->middleware('permission:menu-create');
        Route::post('/reload', [MenuController::class, 'reload']);
        Route::post('/deleteMenuItem', [MenuController::class, 'deleteMenuItem'])->middleware('permission:menu-delete');
        Route::post('/deleteMenu', [MenuController::class, 'deleteMenu'])->middleware('permission:menu-delete');
        Route::post('/getMenuItem', [MenuController::class, 'getMenuItem'])->middleware('permission:menu-edit');
        Route::post('/updateMenuItem', [MenuController::class, 'updateMenuItem'])->middleware('permission:menu-edit');
        Route::post('/aliasGenerate', [MenuController::class, 'aliasGenerate'])->name('powerpanel.menu.aliasGenerate');
        Route::post('/megaMenu', [MenuController::class, 'megaMenu'])->middleware('permission:menu-edit');
    });
    Route::prefix('powerpanel/media')->group(function () {
        Route::post('/set_image_html', [MediaController::class, 'set_image_html'])->name('powerpanel.media.set_image_html');
        Route::post('/set_video_html', [MediaController::class, 'set_video_html'])->name('powerpanel.media.set_video_html');
        Route::post('/upload_image', [MediaController::class, 'upload_image'])->name('powerpanel.media.upload_image');
        Route::post('/upload_video', [MediaController::class, 'upload_video'])->name('powerpanel.media.upload_video');
        Route::post('/user_uploaded_video', [MediaController::class, 'user_uploaded_video'])->name('powerpanel.media.user_uploaded_video');
        Route::post('/get_trash_videos', [MediaController::class, 'get_trash_videos'])->name('powerpanel.media.get_trash_videos');
        Route::post('/user_uploaded_image', [MediaController::class, 'user_uploaded_image'])->name('powerpanel.media.user_uploaded_image');
        Route::post('/load_more_images/{user_id}', [MediaController::class, 'load_more_images'])->name('powerpanel.media.load_more_images');
        Route::post('/remove_image', [MediaController::class, 'remove_image'])->name('powerpanel.media.remove_image');
        Route::post('/get_recent_uploaded_images', [MediaController::class, 'get_recent_uploaded_images'])->name('powerpanel.media.get_recent_uploaded_images');
        Route::post('/get_trash_images', [MediaController::class, 'get_trash_images'])->name('powerpanel.media.get_trash_images');
        Route::post('/insert_image_by_url', [MediaController::class, 'insert_image_by_url'])->name('powerpanel.media.insert_image_by_url');
        Route::post('/insert_video_by_url', [MediaController::class, 'insert_video_by_url'])->name('powerpanel.media.insert_video_by_url');
        Route::post('/remove_multiple_image', [MediaController::class, 'remove_multiple_image'])->name('powerpanel.media.remove_multiple_image');
        Route::post('/remove_multiple_videos', [MediaController::class, 'remove_multiple_videos'])->name('powerpanel.media.remove_multiple_videos');
        Route::post('/restore_multiple_image', [MediaController::class, 'restore_multiple_image'])->name('powerpanel.media.restore_multiple_image');
        Route::post('/restore-multiple-videos', [MediaController::class, 'restore_multiple_videos'])->name('powerpanel.media.restore_multiple_videos');
        Route::post('/set_document_uploader', [MediaController::class, 'set_document_uploader'])->name('powerpanel.media.set_document_uploader');
        Route::post('/upload_documents', [MediaController::class, 'upload_documents'])->name('powerpanel.media.upload_documents');
        Route::post('/user_uploaded_docs', [MediaController::class, 'user_uploaded_docs'])->name('powerpanel.media.user_uploaded_docs');
        Route::post('/remove_multiple_documents', [MediaController::class, 'remove_multiple_documents'])->name('powerpanel.media.remove_multiple_documents');
        Route::post('/get_trash_documents', [MediaController::class, 'get_trash_documents'])->name('powerpanel.media.get_trash_documents');
        Route::post('/check-img-inuse', [MediaController::class, 'checkedUsedImg'])->name('powerpanel.media.check_img_inuse');
        Route::post('/restore-multiple-document', [MediaController::class, 'restore_multiple_document'])->name('powerpanel.media.restore_multiple_document');
        Route::post('/check-document-inuse', [MediaController::class, 'checkedUsedDocument'])->name('powerpanel.media.check_document_inuse');
        Route::post('/check-video-inuse', [MediaController::class, 'checkedUsedVideo'])->name('powerpanel.media.check_video_inuse');
        Route::post('/empty_trash_Image', [MediaController::class, 'empty_trash_image'])->name('powerpanel.media.empty_trash_image');
        Route::post('/empty_trash_Video', [MediaController::class, 'empty_trash_video'])->name('powerpanel.media.empty_trash_video');
        Route::post('/empty_trash_Document', [MediaController::class, 'empty_trash_document'])->name('powerpanel.media.empty_trash_document');
    });
    Route::prefix('powerpanel/photo-gallery')->group(function () {
        Route::post('/update', [PhotoGalleryController::class, 'store'])->middleware('permission:photo-gallery-edit')->name('powerpanel.photo-gallery.update');
        Route::post('/update_status', [PhotoGalleryController::class, 'update_status'])->middleware('permission:photo-gallery-edit')->name('powerpanel.photo-gallery.update_status');
        Route::post('/destroy', [PhotoGalleryController::class, 'destroy'])->middleware('permission:photo-gallery-delete')->name('powerpanel.photo-gallery.destroy');
    });
    Route::prefix('powerpanel/video-gallery')->group(function () {
        Route::post('/update', [VideoGalleryController::class, 'store'])->middleware('permission:video-gallery-edit')->name('powerpanel.video-gallery.update');
        Route::post('/update_status', [VideoGalleryController::class, 'update_status'])->middleware('permission:video-gallery-edit')->name('powerpanel.video-gallery.update_status');
        Route::post('/destroy', [VideoGalleryController::class, 'destroy'])->middleware('permission:video-gallery-delete')->name('powerpanel.video-gallery.destroy');
    });
    Route::prefix('powerpanel/banners')->group(function () {
        Route::post('/selectRecords', [BannerController::class, 'selectRecords']);
        Route::get('/viewurltrue', [BannerController::class, 'checkurl']);
    });
    Route::prefix('settings')->group(function () {
        Route::post('/testMail', [SettingsController::class, 'testMail'])->name('settings.testMail');
        Route::post('/save-module-settings', [SettingsController::class, 'saveModuleSettings'])->name('settings.save_module_settings');
        Route::post('/get-save-module-settings', [SettingsController::class, 'getModuleSettings'])->name('settings.get_module_settings');
        Route::post('/get-filtered-modules', [SettingsController::class, 'getModulesAjax'])->name('settings.get_filtered_modules');
    });
    Route::get('/powerpanel/roles/show/{id}', [RoleController::class, 'show'])->name('powerpanel.roles.show');
    Route::patch('/powerpanel/roles/{id}', [RoleController::class, 'handlePost'])->middleware('permission:roles-edit')->name('powerpanel.roles.update');
    Route::get('/powerpanel/changepassword', [ProfileController::class, 'changepassword'])->middleware('permission:changeprofile-change-password')->name('powerpanel.changepassword');
    Route::post('/powerpanel/changepassword', [ProfileController::class, 'handle_changepassword']);
});
if (MyLibrary::setConstants($segmentArr)) {
    Route::group(['namespace' => 'App\\Http\\Controllers\\Powerpanel', 'middleware' => ['auth', 'prevent-back-history']], function () {
        $module = Config::get('Constant.MODULE.NAME');
        $controller = 'App\\Http\\Controllers\\Powerpanel\\' . Config::get('Constant.MODULE.CONTROLLER');

        Route::get("/powerpanel/$module", [ $controller, 'index' ])->name("powerpanel.$module.index")->middleware("permission:$module-list");
        Route::post("/powerpanel/$module/get_list", [ $controller, 'get_list' ])->middleware("permission:$module-list");
        Route::get("/powerpanel/$module/add", [ $controller, 'edit' ])->name("powerpanel.$module.add")->middleware("permission:$module-create");
        Route::post("/powerpanel/$module/add", [ $controller, 'handlePost' ])->name("powerpanel.$module.handleAddPost")->middleware("permission:$module-create");
        Route::get("/powerpanel/$module/{alias}/edit", [ $controller, 'edit' ])->name("powerpanel.$module.edit")->middleware("permission:$module-edit");
        Route::post("/powerpanel/$module/{alias}/edit", [ $controller, 'handlePost' ])->name("powerpanel.$module.handleEditPost")->middleware("permission:$module-edit");
        Route::post("/powerpanel/$module/DeleteRecord", [ $controller, 'DeleteRecord' ])->middleware("permission:$module-delete");
        Route::post("/powerpanel/$module/publish", [ $controller, 'publish' ])->middleware("permission:$module-edit");
        Route::post("/powerpanel/$module/reorder", [ $controller, 'reorder' ])->name("$module.reorder")->middleware("permission:$module-list");
        Route::post("/powerpanel/$module/destroy", [ $controller, 'destroy' ])->name("$module.destroy")->middleware("permission:$module-delete");
        Route::post("/powerpanel/$module/makeDefault", [ $controller, 'makeDefault' ]);
        Route::post("/powerpanel/$module/ajax", [ $controller, 'ajax' ])->middleware("permission:$module-list");
        Route::post("/powerpanel/$module", [ $controller, 'handleEditPost' ])->name("powerpanel.$module.handleEditPost")->middleware("permission:$module-edit");
        Route::get("/powerpanel/$module/ExportRecord", [ $controller, 'ExportRecord' ])->middleware("permission:$module-list");
        Route::get("/powerpanel/newsletter/send_email", [ App\Http\Controllers\Powerpanel\NewsletterController::class, 'send_email' ])->name("newsletters.send_email");
        Route::get("/powerpanel/$module/show/{id}", [ $controller, 'show' ])->name("powerpanel.$module.show")->middleware("permission:$module-list");
        Route::post("/powerpanel/$module/makeFeatured", [ $controller, 'makeFeatured' ])->middleware("permission:$module-edit");
        Route::get("/powerpanel/settings", [ App\Http\Controllers\Powerpanel\SettingsController::class, 'index' ])->name("powerpanel.settings")->middleware('permission:settings-general-setting-management');
        Route::post("/powerpanel/settings", [ App\Http\Controllers\Powerpanel\SettingsController::class, 'update_settings' ])->name("powerpanel.settings")->middleware('permission:settings-general-setting-management');
        Route::get("/powerpanel/settings/getDBbackUp", [ App\Http\Controllers\Powerpanel\SettingsController::class, 'getDBbackUp' ])->name("powerpanel.settings.getDBbackUp");
        Route::get("/powerpanel/changeprofile", [ App\Http\Controllers\Powerpanel\ProfileController::class, 'index' ])->name("powerpanel.changeprofile")->middleware('permission:changeprofile-edit');
        Route::post("/powerpanel/changeprofile", [ App\Http\Controllers\Powerpanel\ProfileController::class, 'changeprofile' ])->name("powerpanel.changeprofile");
        Route::post("/powerpanel/$module/swaporder", [ $controller, 'reorder' ]);
        Route::post("/powerpanel/$module/ajaxCatAdd", [ $controller, 'addCatAjax' ]);
        Route::post('/powerpanel/appointment-lead/saveComment', [App\Http\Controllers\Powerpanel\AppointmentLeadController::class, 'saveComment']);
        Route::post('/powerpanel/faq/getProductAjax', [App\Http\Controllers\Powerpanel\FaqController::class, 'getProductAjax']);
        Route::post('/powerpanel/deals/getProductAjax', [App\Http\Controllers\Powerpanel\DealsController::class, 'getProductAjax']);
        Route::post('/powerpanel/testimonial/getProductAjax', [App\Http\Controllers\Powerpanel\TestimonialController::class, 'getProductAjax']);
        Route::post('/powerpanel/products-package/getProductAjax', [App\Http\Controllers\Powerpanel\ProductsPackageController::class, 'getProductAjax']);
        Route::post('/powerpanel/products-package/getWHMCSProductAjax', [App\Http\Controllers\Powerpanel\ProductsPackageController::class, 'getWHMCSProductAjax']);
        Route::post('/powerpanel/product-features/getProductAjax', [App\Http\Controllers\Powerpanel\ProductFeaturesController::class, 'getProductAjax']);
        Route::post('/powerpanel/featured-products/getProductAjax', [App\Http\Controllers\Powerpanel\FeaturedProductsController::class, 'getProductAjax']);
        Route::post('/powerpanel/products/getProductAliasAjax', [App\Http\Controllers\Powerpanel\ProductController::class, 'getProductAliasAjax']);
    });
}
// Outside middleware group
Route::post('/powerpanel/share', [OnePushController::class, 'ShareonSocialMedia']);
Route::post('/powerpanel/share/getrec', [OnePushController::class, 'getRecord']);
Route::get('/powerpanel/share/gPlusCallBack', [OnePushController::class, 'gPlusCallBack']);
// Powerpanel routes
Route::group(['namespace' => 'App\\Http\\Controllers\\Powerpanel', 'middleware' => ['auth', 'prevent-back-history']], function () {
    Route::get('/powerpanel/tpl/{view}', [TplController::class, 'index'])->name('view');
    Route::get('/powerpanel/email_log', [EmailLogController::class, 'index'])->name('email_log');
    Route::post('/powerpanel/email_log/get_email_log_list', [EmailLogController::class, 'get_email_log_list']);
    Route::post('/powerpanel/notification', [NotificationController::class, 'index']);
    Route::post('/powerpanel/notification/update_read_status', [NotificationController::class, 'update_read_status']);
    Route::post('/powerpanel/notification/get_read_notification_count', [NotificationController::class, 'get_read_notification_count']);
    Route::post('/powerpanel/global', [GlobalSearchController::class, 'index']);
    Route::get('/powerpanel/calender', [CalenderController::class, 'index']);
    Route::get('/powerpanel/calender/get_activity', [CalenderController::class, 'get_activity']);
    Route::post('/powerpanel/message', [MessageController::class, 'index']);
    Route::post('/powerpanel/message/update_read_status', [MessageController::class, 'update_read_status']);
    Route::post('/powerpanel/message/get_read_message_count', [MessageController::class, 'get_read_message_count']);
    Route::get('/powerpanel/analytics', [AnalyticsController::class, 'index'])->name('powerpanel.analytics.index')->middleware('permission:analytics-list');
    Route::post('analytics/get_range_analysis', [AnalyticsController::class, 'get_range_analysis'])->name('analytics.get_range_analysis')->middleware('permission:analytics-list');
    Route::get('/powerpanel/plugins', [PluginController::class, 'index']);
    Route::get('/powerpanel/plugins/get_module/{module}', [PluginController::class, 'get_module']);
    Route::get('/powerpanel/plugins/update_module/{module}', [PluginController::class, 'update_module']);
});
//---------------------- Shopping Cart -------------------------
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/view', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/empty', [CartController::class, 'emptycart'])->name('cart.empty');
Route::post('/cart/remove', [CartController::class, 'removecart'])->name('cart.remove');
Route::post('/cart/createorder', [CartController::class, 'createorder'])->name('cart.createorder');
Route::get('/cart/generateorder', [CartController::class, 'generateorder'])->name('cart.generateorder');
Route::post('/cart/updatedomain', [CartController::class, 'updatedomain'])->name('cart.updatedomain');
Route::post('/cart/updatehosting', [CartController::class, 'updatehosting'])->name('cart.updateserver');
Route::post('/cart/updateserver', [CartController::class, 'updateserver'])->name('cart.updateserver');
Route::get('/cart/config', [CartController::class, 'config'])->name('cart.config');
Route::post('/cart/getconfigfinalprice', [CartController::class, 'getconfigfinalprice'])->name('cart.getconfigfinalprice');
Route::post('/cart/setconfigoptionvalue', [CartController::class, 'setconfigoptionvalue'])->name('cart.setconfigoptionvalue');
Route::post('/cart/setcustomoptionvalue', [CartController::class, 'setcustomoptionvalue'])->name('cart.setcustomoptionvalue');
Route::get('/cart/getrecommandation', [CartController::class, 'getrecommandation'])->name('cart.getrecommandation');
Route::get('/cart/suggesteddomains', [CartController::class, 'suggesteddomains'])->name('cart.suggesteddomains');
Route::post('/cart/adddomainaddons', [CartController::class, 'adddomainaddons'])->name('cart.adddomainaddons');
Route::post('/cart/hidedomainaddons', [CartController::class, 'hidedomainaddons'])->name('cart.hidedomainaddons');
Route::post('/cart/removeaddon', [CartController::class, 'removeaddon'])->name('cart.removeaddon');
Route::get('/cart/featchplansmessage', [CartController::class, 'featchplansmessage']);
Route::post('/cart/removedomainaddon', [CartController::class, 'removedomainaddon'])->name('cart.removedomainaddon');
Route::post('/cart/converttowhmcs', [CartController::class, 'converttowhmcs'])->name('cart.converttowhmcs');
Route::get('/cart/getordersummary', [CartController::class, 'getordersummary'])->name('cart.getordersummary');
Route::post('/cart/configdomain', [CartController::class, 'configdomain'])->name('cart.configdomain');
Route::post('/cart/checkconfigdomainname', [CartController::class, 'checkconfigdomainname'])->name('cart.checkconfigdomainname');
Route::get('/cart/signin', [CartController::class, 'cartsignin'])->name('cart.cartsignin');
Route::get('/cart/thankyou', fn() => view('errors.404'));
Route::post('/cart/thankyou', [CartController::class, 'thankyou'])->name('cart.thankyou');
Route::get('/contact/thankyou', [ThankyouController::class, 'index'])->name('contact/thankyou');
Route::match(['get', 'post'], '/cart/paymentfail', [CartController::class, 'paymentfail'])->name('cart.paymentfail');
Route::get('/cart/billinginfo', [CartController::class, 'billinginfo'])->name('cart.cartbillinginfo')->middleware('prevent-back-history');
Route::post('/cart/updatebillinginfo', [CartController::class, 'updatebillinginfo'])->name('cart.updatebillinginfo');
Route::get('/cart/paymentoptions', [CartController::class, 'paymentoptions'])->name('cart.paymentoptions')->middleware('prevent-back-history');
Route::post('/cart/updatepromo', [CartController::class, 'updatepromo'])->name('cart.updatepromo');
Route::post('/cart/getfreedomain', [CartController::class, 'getfreedomain'])->name('cart.getfreedomain');
Route::post('/cart/reloadcart', [CartController::class, 'reloadcart'])->name('cart.reloadcart');
Route::post('/cart/getsearchcartdomain', [CartController::class, 'getsearchcartdomain'])->name('cart.getsearchcartdomain');
Route::match(['get', 'post'], '/cart/paypalsuccess', [CartController::class, 'paypalsuccess'])->name('cart.paypalsuccess');
Route::post('/cart/ccavenuesuccess', [CartController::class, 'ccavenuesuccess'])->name('cart.ccavenuesuccess');
Route::get('/cart/orderemail', [CartController::class, 'orderemail'])->name('cart.orderemail');
Route::post('/cart/addbulkdomain', [CartController::class, 'addbulkdomain'])->name('cart.addbulkdomain');
Route::post('/cart/removebulkdomain', [CartController::class, 'removebulkdomain'])->name('cart.removebulkdomain');
Route::get('/cart/testapi', [CartController::class, 'testapi'])->name('cart.testapi');
Route::get('/cart/setcurrency', [CartController::class, 'setcurrency'])->name('cart.setcurrency');
Route::get('/cron/', [CronController::class, 'index'])->name('cron');
Route::get('/marketingcron/', [MarketingCronController::class, 'index'])->name('cron');
Route::post('/cart/getvpsconfig', [CartController::class, 'getvpsconfig'])->name('cart.getvpsconfig');
Route::get('/cart/counter', [CartController::class, 'getitemscounter'])->name('cart.getitemscounter');
Route::get('/cart/newconfig', [CartController::class, 'newconfig'])->name('cart.config');
Route::get('/testhits/removeclient', [TesthitsController::class, 'removeclient'])->name('testhits.removeclient');
Route::get('/testhits/whmcspricing', [TesthitsController::class, 'whmcspricing'])->name('testhits.whmcspricing');
Route::get('/testhits/testaction', [TesthitsController::class, 'testaction'])->name('testhits.testaction');
Route::get('/testhits/testapi', [TesthitsController::class, 'testapi'])->name('testhits.testaction');
Route::get('/orderrating', [TesthitsController::class, 'index'])->name('rating');
Route::post('/get_products_data', [TesthitsController::class, 'get_products_data'])->name('product_details');
Route::get('/user/whmcs/password', [FrontRegisterController::class, 'whmcsupdatepassword']);
// Check terms
Route::post('/cart/removeCartItemAnalytices', [TesthitsController::class, 'removeCartItemAnalytices'])->name('removeCartItemAnalytices');
Route::post('/cart/check_terms', [CartController::class, 'check_terms'])->name('check_terms');
Route::get('/cart/viewallsession', fn() => Session::all());
Route::get('/cart/removesession', fn() => Session::flush() && redirect('/'));
// Careers
Route::get('/career/details', fn() => redirect('/careers'))->name('careerDetails');
Route::post('/career/details', [CareersController::class, 'careerDetails'])->name('careerDetails');
Route::post('/career/details-store', [CareersController::class, 'careerDetailsStore'])->name('careerDetailsStore');
Route::post('/career/details-fileupload', [CareersController::class, 'careerDetailsFileupload'])->name('careerDetailsFileupload');
Route::get('/careers/thankyou', [CareersController::class, 'thankyou'])->name('career/thankyou');
Route::get('/whmcsdata', [TesthitsController::class, 'whmcspdata'])->name('whmcsdata');
// Serve WHMCS Product JS
Route::get('/secure/whmcs-products', function () {
    $filePath = storage_path('app/whmcsproduct/whmcs_response.js');
    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }
    return response()->file($filePath, [
        'Content-Type' => 'application/javascript',
    ]);
});
// Serve robots.txt
Route::get('/robots.txt', function () {
    $content = file_get_contents(public_path('robots.txt'));

    return Response::make($content, 200, [
        'Content-Type' => 'text/plain',
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Thu, 01 Jan 1970 00:00:00 GMT',
    ]);
});