<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\FrontViewController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\NoTransactionPurposeController;
use App\Http\Controllers\OffenderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TranPurposeController;
use App\Http\Controllers\TranProofController;
use App\Http\Controllers\TranNatureController;
use App\Http\Controllers\HistoriesController;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\Admin\FaviconController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\WhyusController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AboutDescriptionController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\SearchPropertiesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ReviewsandRatingsController;
use App\Http\Controllers\Admin\FavoritesController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\TermsAndConditionsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;

use App\Models\Offer;

Auth::routes();

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

// Route to handle form submission
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get("/member", function () {
    return view("frontend.member");

});
Route::get("services", function () {
    return view('frontend.include.blog.php'); });
Route::get("whyuss", function () {
    return view("frontend.include.advantage.php"); });
Route::get("aboutuss", function () {
    return view("frontend.include.about.blade.php"); });
Route::get("services", function () {
    return view("frontend.include.indexbanner.php"); });
Route::get("testimonials", function () {
    return view("frontend.testimonial.blade.php"); });
Route::get("service", function () {
    return view("frontend.include.project.blade.php"); });



Route::get('/hello', function () {
    return view('frontend.singleproducts');
})->name('hello');
Route::get('/', [FrontViewController::class, 'index'])->name('index');
// Route::get('/properties/{categoryId?}', [FrontViewController::class, 'properties'])->name('properties');
// Route::get('/properties/search', [FrontViewController::class, 'search'])->name('frontend.search');

Auth::routes(['verify' => true]);

// Route to handle the verification when the user clicks the link in the email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Route to resend the verification email
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');


    Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('verified');


    // User Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('update', [UsersController::class, 'update'])->name('update');
        Route::get('delete/{id}', [UsersController::class, 'destroy'])->name('destroy');
        Route::get('deleted', [UsersController::class, 'viewDeleted'])->name('viewDeleted');
        Route::get('restore/{id}', [UsersController::class, 'restore'])->name('restore');
        Route::get('deletePermanent/{id}', [UsersController::class, 'permanentDestroy'])->name('permanentDestroy');
    });

    // Roles Routes
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::get('create', [RolesController::class, 'create'])->name('create');
        Route::post('store', [RolesController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RolesController::class, 'edit'])->name('edit');
        Route::post('update', [RolesController::class, 'update'])->name('update');
        Route::get('delete/{id}', [RolesController::class, 'destroy'])->name('destroy');
    });

    // Permissions Routes
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('index');
        Route::get('create', [PermissionsController::class, 'create'])->name('create');
        Route::post('store', [PermissionsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PermissionsController::class, 'edit'])->name('edit');
        Route::post('update', [PermissionsController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PermissionsController::class, 'destroy'])->name('destroy');
    });
        Route::resource('team', TeamController::class);
        Route::resource('faqs', FAQController::class);
        

        // Blog Routes
        Route::resource('blogs', BlogController::class);
        Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('uploadImage');
});


   //Product, Category, Subcategories Routes

   Route::resource('admin/product', ProductController::class);
   Route::resource('admin/categories', CategoryController::class);
   Route::resource('admin/subcategories', SubCategoryController::class);
   Route::get('/subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('subcategories');
   Route::put('/product/{id}/update-images', [ProductController::class, 'updateImages'])->name('product.updateImages');

   Route::resource('favicons', FaviconController::class);

   
   //Sitesetting route
   Route::resource('sitesettings', SiteSettingController::class);

   //Sociallinks route
   Route::resource('social-links', SocialLinkController::class);

    

   //Offer-Feature route
   Route::resource('offers', OfferController::class);

   // Contact routes
    Route::prefix('admin')->group(function () {
    Route::get('/contact', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact/store', [App\Http\Controllers\Admin\ContactController::class, 'store'])->name('contact.store');
});

 // Review routes
 Route::prefix('admin')->group(function () {
    Route::get('/review', [ReviewsandRatingsController::class, 'index'])->name('review.index');
    Route::post('/review/store', [ReviewsandRatingsController::class, 'store'])->name('reviews.store');
    Route::post('/submit-review', [ReviewsandRatingsController::class, 'store'])->name('submit.review');
    Route::patch('/reviews/{review}', [ReviewsandRatingsController::class, 'update'])->name('admin.reviews.update');
   


});

   //Favorites Route
   Route::get('/favourite', [SingleController::class, 'render_favourite'])->name('favourite');
   
   Route::post('/favorites', [FavoritesController::class, 'store'])->name('favorites.store');
   Route::delete('favorites/{id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');
   Route::get('/admin/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
   



  




   // Frontend Routes
   Route::view("/member", "frontend.member")->name('member');
   Route::view("/contact", "frontend.contact")->name('contact');
   Route::get('/about', [SingleController::class, 'render_about'])->name('about');
   Route::get('/contact', [SingleController::class, 'render_contact'])->name('contact');
   Route::get('/blog', [SingleController::class, 'render_blog'])->name('blog');
   Route::get('/singleblogpost/{id}', [SingleController::class, 'singlePost'])->name('singleblogpost');
// Route::get('/properties', [SingleController::class, 'render_products'])->name('properties');
   Route::get('/products', [SingleController::class, 'products'])->name('products');
   Route::get('/singleproducts/{id}', [SingleController::class, 'render_singleProducts'])->name('singleproducts');
   
   Route::get('/favourite', [SingleController::class, 'render_favourite'])->name('favourite');
   Route::get('/cart', action: [SingleController::class, 'render_cart'])->name('cart');
   Route::get('/account', [SingleController::class, 'render_account'])->name('account');
   Route::get('/chat' ,[SingleController::class ,"render_chat"])->name('chat');
   Route::get('/terms' ,[SingleController::class ,"render_termsandcondition"])->name('terms');
   Route::get('/singlecatogories/{id}', [SingleController::class, 'render_singlecatogories'])->name('singlecatogories');

   Route::prefix('/profile')->name('profile.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\ProfilesController::class, 'index'])->name('index');
    Route::post('/update/info', [App\Http\Controllers\ProfilesController::class, 'updateInfo'])->name('update.info');
    Route::post('/update/password', [App\Http\Controllers\ProfilesController::class, 'updatePassword'])->name('update.password');
});



//Cart Routes

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/clear-items', [CartController::class, 'clearCartItems']);
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
Route::post('/cart/remove-selected', [CartController::class, 'removeSelected']);

//Review

Route::get('/product/{id}/reviews', [SingleController::class, 'showProductReviews'])->name('product.reviews');

Route::get('/get-header-counts', [SingleController::class, 'getHeaderCounts'])->name('get.header.counts');

//Ad Route
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('advertisements', AdvertisementController::class);
});

//TermsnConditions

Route::prefix('admin')->group(function () {
    Route::resource('termsandconditions', TermsAndConditionsController::class);
});

//Order
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::patch('/admin/orders/{order}', [OrderController::class, 'update'])->name('orders.update');


