<?php

use App\Models\ProductReview;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PolicyController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});




// pages

Route::get('/',[HomeController::class,'HomePage']);
Route::get('/by-category', [CategoryController::class, 'ByCategoryPage']);
Route::get('/by-brand', [BrandController::class, 'ByBrandPage']);
Route::get('/policy', [PolicyController::class, 'PolicyPage']);
Route::get('/details', [ProductController::class, 'Details']);
Route::get('/login', [UserController::class, 'LoginPage']);
Route::get('/verify', [UserController::class, 'VerifyPage']);
Route::get('/wish', [ProductController::class, 'WishList']);
Route::get('/cart', [ProductController::class, 'CartListPage']);
Route::get('/profile-page', [ProfileController::class, 'ProfilePage']);










// brand list
Route::get('/brandList',[BrandController::class,'BrandList']);

//category list
Route::get('/categoryList',[CategoryController::class,'CategoryList']);

// Product list
Route::get('/ListProductByCategory/{id}',[ProductController::class,'ListProductByCategory']);
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ListProductByBrand']);
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ListProductByRemark']);
Route::get('/ListProductSlider',[ProductController::class,'ListProductSlider']);
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById']);
Route::get('/ListReviewByProduct/{id}',[ProductController::class,'ListReviewByProduct']);

// Policy
Route::get('/PolicyByType/{type}',[PolicyController::class,'PolicyByType']);


// User login Auth
Route::get('/login/{email}',[UserController::class,'UserLogin']);
Route::get('/veryfyLogin/{email}/{otp}',[UserController::class,'VerifyLogin']);
Route::get('/logout',[UserController::class,'UserLogout']);

// user profile
Route::post('/createProfile',[ProfileController::class,'createProfile'])->middleware(TokenAuthenticate::class);
Route::get('/readProfile',[ProfileController::class,'readProfile'])->middleware(TokenAuthenticate::class);

// Product Review
Route::post('/createReview',[ProductController::class,'createReview'])->middleware(TokenAuthenticate::class);
Route::get('/listReview',[ProductController::class,'listReview'])->middleware(TokenAuthenticate::class);

// Product Wish
Route::get('/listWish',[ProductController::class,'productWishList'])->middleware(TokenAuthenticate::class);
Route::get('/createWish/{product_id}',[ProductController::class,'createWishList'])->middleware(TokenAuthenticate::class);
Route::get('/deleteWish/{product_id}',[ProductController::class,'deleteWishList'])->middleware(TokenAuthenticate::class);

// Product Cart
Route::post('/CreateCartList', [ProductController::class, 'CreateCartList'])->middleware([TokenAuthenticate::class]);
Route::get('/CartList', [ProductController::class, 'CartList'])->middleware([TokenAuthenticate::class]);
Route::get('/DeleteCartList/{product_id}', [ProductController::class, 'DeleteCartList'])->middleware([TokenAuthenticate::class]);

// Invoice and payment
Route::get("/InvoiceCreate",[InvoiceController::class,'InvoiceCreate'])->middleware([TokenAuthenticate::class]);
Route::get("/InvoiceList",[InvoiceController::class,'InvoiceList'])->middleware([TokenAuthenticate::class]);
Route::get("/InvoiceProductList/{invoice_id}",[InvoiceController::class,'InvoiceProductList'])->middleware([TokenAuthenticate::class]);



//payment success cancel and fail url
Route::post("/PaymentSuccess",[InvoiceController::class,'PaymentSuccess']);
Route::post("/PaymentCancel",[InvoiceController::class,'PaymentCancel']);
Route::post("/PaymentFail",[InvoiceController::class,'PaymentFail']);

// profile
Route::get("/profile",function(){
    return "user profile page";
});