<?php

use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\AdminAtuthController;
use App\Http\Controllers\admin\AdminBecomeADealerController;
use App\Http\Controllers\admin\AdminBlogController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminDealerController;
use App\Http\Controllers\admin\AdminFindADealerController;
use App\Http\Controllers\admin\AdminGalleryController;
use App\Http\Controllers\admin\AdminGroupController;
use App\Http\Controllers\admin\AdminHeaderContentController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AdminSessionController;
use App\Http\Controllers\admin\AdminSubcategoryController;
use App\Http\Controllers\admin\AdminTestimoialController;
use App\Http\Controllers\admin\AdminVideogalleryController;
use App\Http\Controllers\admin\AdminSubscribeContoller;
use App\Http\Controllers\admin\AdminFarmerCardController;
use App\Http\Controllers\admin\AdminAreaController;

// for reports

use App\Http\Controllers\front\HomePageController;


// home page
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\SitemapController;



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

/***********************************************ADMIN*****************************************************/


Route::get('/view-clear', function () {
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});




// Route::match(['get','post'],'/',[AdminAtuthController::class,'Index']);
Route::match(['get', 'post'], '/admin-login', [AdminAtuthController::class, 'Index']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'AdminAuth'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'Index'])->name('dashboard');
    Route::get('/logout', [AdminAtuthController::class, 'logout'])->name('logout');
    Route::match(['get', 'post'], '/change-password', [AdminDashboardController::class, 'adminChangePassword']);
    Route::post('PsswordChange', [AdminDashboardController::class, 'PsswordChange'])->name('PsswordChange');


    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {

        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminCategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => 'sub-category', 'as' => 'sub_category.'], function () {

        Route::get('/create', [AdminSubcategoryController::class, 'create'])->name('create');
        Route::post('/store', [AdminSubcategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminSubcategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminSubcategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminSubcategoryController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => 'session', 'as' => 'session.'], function () {

        Route::get('/create', [AdminSessionController::class, 'create'])->name('create');
        Route::post('/store', [AdminSessionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminSessionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminSessionController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminSessionController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'group', 'as' => 'group.'], function () {

        Route::get('/create', [AdminGroupController::class, 'create'])->name('create');
        Route::post('/store', [AdminGroupController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminGroupController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminGroupController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminGroupController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {

        Route::get('/create', [AdminGalleryController::class, 'create'])->name('create');
        Route::post('/store', [AdminGalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminGalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminGalleryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminGalleryController::class, 'delete'])->name('delete');
        Route::post('/loadgroup', [AdminGalleryController::class, 'loadgroup'])->name('loadgroup');
    });

    Route::group(['prefix' => 'video-gallery', 'as' => 'video_gallery.'], function () {

        Route::get('/create', [AdminVideogalleryController::class, 'create'])->name('create');
        Route::post('/store', [AdminVideogalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminVideogalleryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminVideogalleryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminVideogalleryController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {

        Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/store', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminBlogController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminBlogController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminBlogController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {

        Route::get('/create', [AdminTestimoialController::class, 'create'])->name('create');
        Route::post('/store', [AdminTestimoialController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminTestimoialController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminTestimoialController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminTestimoialController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {

        Route::get('/list', [AdminProductController::class, 'list'])->name('list');
        Route::get('/create', [AdminProductController::class, 'create'])->name('create');
        Route::post('/store', [AdminProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('delete');
        Route::post('loadSubcategory', [AdminProductController::class, 'loadSubcategory'])->name('loadSubcategory');
        Route::get('/deleteProductImage', [AdminProductController::class, 'deleteProductImage'])->name('deleteProductImage');

        Route::post('showinhome', [AdminProductController::class, 'showinhome'])->name('showinhome');

    });


    Route::group(['prefix' => 'dealer', 'as' => 'dealer.'], function () {

        Route::get('/create', [AdminDealerController::class, 'create'])->name('create');
        Route::post('/store', [AdminDealerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminDealerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminDealerController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminDealerController::class, 'delete'])->name('delete');
        Route::post('/import', [AdminDealerController::class, 'importExcel'])->name('import');
    });


    Route::group(['prefix' => 'header-content', 'as' => 'header_content.'], function () {

        Route::get('/create', [AdminHeaderContentController::class, 'create'])->name('create');
        Route::get('/get', [AdminHeaderContentController::class, 'get'])->name('get');
        Route::post('/store', [AdminHeaderContentController::class, 'store'])->name('store');
        // Route::get('/edit/{id}', [AdminHeaderContentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminHeaderContentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminHeaderContentController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
        Route::get('/index', [AdminAreaController::class, 'index'])->name('index');
        Route::get('/create', [AdminAreaController::class, 'create'])->name('create');
        Route::post('/store', [AdminAreaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminAreaController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminAreaController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AdminAreaController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'subscribe', 'as' => 'subscribe.'], function () {
        Route::get('/subscribe', [AdminSubscribeContoller::class, 'index'])->name('subscribe');
        Route::get('delete-subscribe/{id}', [AdminSubscribeContoller::class, 'deleteSubscribe'])->name('delete_subscribe');
    });



    Route::get('enquiry', [AdminDashboardController::class, 'EnquryList'])->name('enquriy_list');
    Route::get('enquiry-export', [AdminDashboardController::class, 'EnquiryDataexport'])->name('enquiry_export');
    Route::get('delete-enquiry/{id}', [AdminDashboardController::class, 'DeleteEnquiry'])->name('delete_enquiry');

    // become-a-dealer.
    Route::get('become-a-dealer', [AdminBecomeADealerController::class, 'index'])->name('become_a_dealer');
    Route::get('become-a-dealer-export', [AdminBecomeADealerController::class, 'BecomeDealerDataexport'])->name('become_a_dealer_export');
    Route::get('delete-become-a-dealeer/{id}', [AdminBecomeADealerController::class, 'DeleteBecomeDealer'])->name('delete_become_dealer');


    // find-a-dealer
    Route::get('find-a-dealer', [AdminFindADealerController::class, 'index'])->name('find_a_dealer');
    Route::get('find-a-dealer-export', [AdminFindADealerController::class, 'FindDealerDataexport'])->name('find_a_dealer_export');
    Route::get('delete-find-a-dealer/{id}', [AdminFindADealerController::class, 'DeleteFindADealer'])->name('delete_find_a_dealer');


    Route::get('farmer-registration', [AdminFarmerCardController::class, 'FarmerRegistrationList'])->name('farmer_registration_list');
    Route::get('ganrate-farmer-card/{id}', [AdminFarmerCardController::class, 'ganrateFarmerCard'])->name('ganrate_farmer_card');
    Route::get('view-farmer-card/{id}', [AdminFarmerCardController::class, 'ViewFarmerCard'])->name('view_farmer_card');
    // Route::get('delete-enquiry/{id}', [AdminDashboardController::class, 'DeleteEnquiry'])->name('delete_enquiry');

});


// Home page

Route::get('/', [HomeController::class, 'home'])->name('home');

// Company
Route::get('company/about-us', [HomeController::class, 'AboutUs'])->name('home.about_us');
Route::get('company/time-line', [HomeController::class, 'TimeLine'])->name('home.time_line');


// product listing
Route::get('p/{category_slug}/{subcategory_slug}', [HomeController::class, 'ProductListing'])->name('home.product_listing');

Route::get('p/{category_slug}', [HomeController::class, 'ProductListingCategory'])->name('home.product_listing_category');

// Product Datels
Route::get('product-details/{product_slug}', [HomeController::class, 'productDatels'])->name('home.product_datels');

// Media
Route::get('media/image-gallery', [HomeController::class, 'ImageGallery'])->name('home.image_gallery');
Route::get('media/video-gallery', [HomeController::class, 'VideoGallery'])->name('home.video_gallery');
Route::get('media/blog', [HomeController::class, 'Blog'])->name('home.blog');
Route::get('blog-details/{slug}', [HomeController::class, 'BlogDatels'])->name('home.blog_datels');

// Network
Route::get('network/become-dealer', [HomeController::class, 'BecomeADealer'])->name('home.become_a_dealer');
Route::post('netwrk/save-become-form', [HomeController::class, 'SaveBecomeForm'])->name('home.save_becom_form');

Route::get('network/find-a-dealer', [HomeController::class, 'FindADealer'])->name('home.find_a_dealer');
Route::post('network/save-find-dealer-form', [HomeController::class, 'SaveFindDealerForm'])->name('home.save_find_a_dealer_form');


Route::get('testimonials', [HomeController::class, 'testimonials'])->name('home.testimonials');

Route::get('contact-us', [HomeController::class, 'Contactus'])->name('home.contact_us');
Route::post('contact-form', [HomeController::class, 'saveContactForm'])->name('home.contact_form');


Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');



Route::get('farmer-registration', [HomeController::class, 'FarmerRegistration'])->name('home.farmer_registration');
Route::post('save-farmer-registration', [HomeController::class, 'SaveFarmerRegistraion'])->name('home.save_farmer_registration');
Route::get('find-a-farmer-card', [HomeController::class, 'FindAfarmerCard'])->name('home.find_a_farmer_card');
Route::post('find-farmer-card-form', [HomeController::class, 'FindFarmerCardForm'])->name('home.find_a_farmer_card_form');



Route::post('/loaddistrict', [HomeController::class, 'loaddistrict'])->name('home.loaddistrict');
Route::post('/loadcity', [HomeController::class, 'loadcity'])->name('home.loadcity');


Route::get('privacy-policy', function () {
    return view('front.privacy-policy');
});



Route::get('delete-account', function () {
    return view('front.delete-account');
});

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('areas-we-cover', [HomeController::class, 'AreasWeCover'])->name('home.areas_we_cover');
Route::get('areas-we-cover/{slug}', [HomeController::class, 'AreaDetail'])->name('home.area_detail');

Route::get('update-area-slugs', function () {
    $areas = \App\Models\Area::all();
    foreach ($areas as $area) {
        if (empty($area->slug)) {
            $area->slug = \Illuminate\Support\Str::slug($area->name);
            $area->save();
        }
    }
    return 'Slugs updated!';
});