<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EnrollmentController;

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

Route::get('/', function () {
    return redirect()->route('auth#loginPage');
});
Route::middleware(['AuthMiddleware'])->group(function () {
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});


Route::middleware(['auth:sanctum','MessageMiddleware'])->group(function () {

    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');


    Route::post('/profile/update/{id}',[AuthController::class,'update'])->name('profile#Update');

    Route::post('/profile/changePassword',[AuthController::class,'changePassword'])->name('profile#changePassword');

    // admin
    Route::middleware(['adminAuth'])->group(function () {

        //profile
        Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin#profile');
        Route::get('admin/view/profile/{id}',[AdminController::class,'viewProfile'])->name('admin#viewProfile');
        Route::get('/admin/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('profile#changePasswordPage');
        Route::get('/profile/Edit/{id}',[AdminController::class,'edit'])->name('profile#Edit');

        //user
        Route::get('/admin/user/list',[AdminController::class,'userList'])->name('admin#userList');
        Route::get('/admin/user/addPage',[AdminController::class,'addUserPage'])->name('admin#addUserPage');
        Route::post('admin/user/add',[AdminController::class,'addUser'])->name('admin#addUser');
        Route::get('admin/user/edit/{id}',[AdminController::class,'editUser'])->name('admin#editUser');
        Route::post('admin/user/update/{id}',[AdminController::class,'updateUser'])->name('admin#updateUser');
        Route::get('admin/user/delete/{id}',[AdminController::class,'deleteUser'])->name('admin#deleteUser');

        // admin list page
        Route::get('admin/admin/list',[AdminController::class,'adminList'])->name('admin#adminList');
        Route::get('admin/admin/addPage',[AdminController::class,'addAdminPage'])->name('admin#addAdminPage');
        Route::post('admin/admin/add',[Admincontroller::class,'addAdmin'])->name('admin#addAdmin');
        Route::get('admin/admin/edit/{id}',[AdminController::class,'editAdmin'])->name('admin#editAdmin');
        Route::post('admin/admin/update/{id}',[AdminController::class,'updateAdmin'])->name('admin#updateAdmin');
        Route::get('admin/admin/delete/{id}',[AdminController::class,'deleteAdmin'])->name('admin#deleteAdmin');

        //enrollments
        Route::get('admin/enrollment/list',[EnrollmentController::class,'list'])->name('admin#enrollmentList');
        Route::get('admin/enrollment/start',[EnrollmentController::class,'start'])->name('admin#enrollmentStart');
        Route::get('admin/enrollment/end',[EnrollmentController::class,'end'])->name('admin#enrollmentEnd');
        Route::get('admin/enrollment/page/{id}',[EnrollmentController::class,'enrollments'])->name('admin#enrollments');
        Route::get('admin/enrollment/delete/{id}',[EnrollmentController::class,'delete'])->name('admin#enrollmentsDelete');

        // work list
        Route::get('admin/work/list',[WorkController::class,'list'])->name('admin#workList');
        Route::get('admin/work/createPage',[WorkController::class,'createWorkPage'])->name('admin#createWorkPage');
        Route::post('admin/work/create',[WorkController::class,'createWork'])->name('admin#createWork');
        Route::get('admin/work/viewPage/{id}',[WorkController::class,'viewPage'])->name('admin#workViewPage');
        Route::get('admin/work/editPage/{id}',[WorkController::class,'editPage'])->name('admin#workEditPage');
        Route::post('admin/work/upadte/{id}',[WorkController::class,'workUpdate'])->name('admin#workUpdate');
        Route::get('admin/work/delete/{id}',[WorkController::class,'workDelete'])->name('admin#workDelete');

        //category
        Route::get('admin/category/list',[CategoryController::class,'list_admin'])->name('admin#categoryList');
        Route::get('admin/category/addCategoryPage',[CategoryController::class,'addCategoryPage_admin'])->name('admin#addCategoryPage');
        Route::post('admin/category/addCategory',[CategoryController::class,'addCategory_admin'])->name('admin#addCategory');
        Route::get('admin/category/edit/{id}',[CategoryController::class,'editCategory_admin'])->name('admin#editCategory');
        Route::post('admin/category/update/{id}',[CategoryController::class,'updateCategory_admin'])->name('admin#updateCategory');
        Route::get('admin/category/delete/{id}',[CategoryController::class,'deleteCategory_admin'])->name('admin#deleteCategory');

        //product
        Route::get('admin/product/list',[ProductController::class,'list_admin'])->name('admin#productList');
        Route::get('admin/product/createPage',[ProductController::class,'createProductPage_admin'])->name('admin#productCreatePage');
        Route::post('admin/product/create',[ProductController::class,'createProduct_admin'])->name('admin#productCreate');
        Route::get('admin/product/view/{id}',[ProductController::class,'viewProduct_admin'])->name('admin#viewProduct');
        Route::get('admin/product/edit/{id}',[ProductController::class,'editProduct_admin'])->name('admin#editProduct');
        Route::post('admin/product/update/{id}',[ProductController::class,'updateProduct_admin'])->name('admin#productUpdate');
        Route::get('admin/product/delete/{id}',[ProductController::class,'deleteProduct_admin'])->name('admin#deleteProduct');

        //customer
        Route::get('/admin/customer/list',[AdminController::class,'customerList'])->name('admin#customerList');
        Route::get('admin/customer/delete/{id}',[AdminController::class,'deleteCustomer'])->name('admin#deleteCustomer');
        Route::get('admin/customer/view/profile/{id}',[AdminController::class,'viewProfile_customer'])->name('admin#viewProfileCustomer');

        //message
        Route::get('admin/message/list',[MessageController::class,'list_admin'])->name('admin#messageList');
        Route::get('admin/message/send/page',[MessageController::class,'sendPage_admin'])->name('admin#messageSendPage');
        Route::post('admin/message/send',[MessageController::class,'send_admin'])->name('admin#messageSend');
        Route::get('admin/message/view/{id}/{user_id}',[MessageController::class,'viewMessage_admin'])->name('admin#viewMessage');
        Route::get('admin/message/delete/{id}',[MessageController::class,'deleteMessage_admin'])->name('admin#deleteMessage');

        //order
        Route::get('admin/order/history',[OrderController::class,'orderHistory_admin'])->name('admin#orderHistory');
        Route::get('admin/order/lilst/{order_id}',[OrderController::class,'orderList_admin'])->name('admin#orderList');
        Route::get('admin/order/changeStatus/{id}/{status}',[OrderController::class,'changeStatus_admin'])->name('admin#orderChangeStatus');
        Route::get('admin/order/history/delete/{id}',[OrderController::class,'orderDelete_admin'])->name('admin#orderDelete');
    });

    // user
    Route::middleware(['userAuth','EnrollmentMiddleware','UserWorkMiddleware','OrderMiddleware'])->group(function () {
        //profile
        Route::get('/user/profile',[UserController::class,'profile'])->name('user#profile');
        Route::get('user/changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::get('user/profile/edit/{id}',[UserController::class,'editProfile'])->name('user#editProfile');

        // admin
        Route::get('/user/admin',[UserController::class,'adminList'])->name('user#adminList');

        // work
        Route::get('user/work/list',[WorkController::class,'workList'])->name('user#workList');
        Route::get('user/work/view/{id}',[WorkController::class,'viewWork'])->name('user#viewWork');
        Route::get('user/work/done/{id}',[WorkController::class,'doneWork'])->name('user#doneWork');

        //category
        Route::get('user/category/list',[CategoryController::class,'list_user'])->name('user#categoryList');
        Route::get('user/category/addCategoryPage',[CategoryController::class,'addCategoryPage_user'])->name('user#addCategoryPage');
        Route::post('user/category/addCategory',[CategoryController::class,'addCategory_user'])->name('user#addCategory');
        Route::get('user/category/edit/{id}',[CategoryController::class,'editCategory_user'])->name('user#editCategory');
        Route::post('user/category/update/{id}',[CategoryController::class,'updateCategory_user'])->name('user#updateCategory');
        Route::get('user/category/delete/{id}',[CategoryController::class,'deleteCategory_user'])->name('user#deleteCategory');

        //product
        Route::get('user/product/list',[ProductController::class,'list_user'])->name('user#productList');
        Route::get('user/product/createPage',[ProductController::class,'createProductPage_user'])->name('user#productCreatePage');
        Route::post('user/product/create',[ProductController::class,'createProduct_user'])->name('user#productCreate');
        Route::get('user/product/view/{id}',[ProductController::class,'viewProduct_user'])->name('user#viewProduct');
        Route::get('user/product/edit/{id}',[ProductController::class,'editProduct_user'])->name('user#editProduct');
        Route::post('user/product/update/{id}',[ProductController::class,'updateProduct_user'])->name('user#productUpdate');
        Route::get('user/product/delete/{id}',[ProductController::class,'deleteProduct_user'])->name('user#deleteProduct');

        //customer
        Route::get('/user/customer/list',[UserController::class,'customerList'])->name('user#customerList');
        Route::get('user/view/profile/{id}',[UserController::class,'viewProfile'])->name('user#viewProfile');
        Route::get('user/customer/delete/{id}',[UserController::class,'deleteCustomer'])->name('user#deleteCustomer');

        // enrollment
        Route::get('user/enrollment/page',[EnrollmentController::class,'userEnrollmentPage'])->name('user#EnrollmentPage');
        Route::post('user/enrollment',[EnrollmentController::class,'userEnrollment'])->name('user#Enrollment');

        //order
        Route::get('user/order/history',[OrderController::class,'orderHistory_user'])->name('user#orderHistory');
        Route::get('user/order/lilst/{order_id}',[OrderController::class,'orderList_user'])->name('user#orderList');
        Route::get('user/order/changeStatus/{id}/{status}',[OrderController::class,'changeStatus_user'])->name('user#orderChangeStatus');
        Route::get('user/order/history/delete/{id}',[OrderController::class,'orderDelete_user'])->name('user#orderDelete');

        //message
        Route::get('user/message/list',[MessageController::class,'list_user'])->name('user#messageList');
        Route::get('user/message/send/page',[MessageController::class,'sendPage_user'])->name('user#messageSendPage');
        Route::post('user/message/send',[MessageController::class,'send_user'])->name('user#messageSend');
        Route::get('user/message/view/{id}/{user_id}',[MessageController::class,'viewMessage_user'])->name('user#viewMessage');
        Route::get('user/message/delete/{id}',[MessageController::class,'deleteMessage_user'])->name('user#deleteMessage');

    });

    // customer
    Route::middleware(['customerAuth'])->group(function () {
        Route::get('/customer/product', function () {
            return redirect()->route('customer#home');
        });

        //profile
        Route::get('/customer/profile',[CustomerController::class,'profile'])->name('customer#profile');
        Route::get('customer/profile/edit',[CustomerController::class,'profileEdit'])->name('customer#profileEdit');
        Route::get('/customer/changePasswordPage',[CustomerController::class,'changePasswordPage'])->name('customer#changePasswordPage');
        Route::post('customer/update/profile/{id}',[CustomerController::class,'update_customer'])->name('customer#updateProfile');
        Route::get('customer/delete/profilePicture/{id}',[CustomerController::class,'clearPP'])->name('customer#clearPP');
        Route::get('customer/delete/account',[CustomerController::class,'deleteAcc'])->name('customer#deleteAcc');

        //product
        Route::get('/customer/home',[ProductController::class,'list_customer'])->name('customer#home');
        Route::get('customer/product/view/{id}',[ProductController::class,'viewProduct_customer'])->name('customer#viewProduct');

        //cart
        Route::get('customer/cart/add/{id}',[CartController::class,'addCart'])->name('customer#addCart');
        Route::get('customer/cart/list',[CartController::class,'cartList'])->name('customer#cartList');
        Route::get('customer/cart/remove',[CartController::class,'remove'])->name('customer#cartRemove');
        Route::get('customer/cart/removeAll',[CartController::class,'removeAll'])->name('customer#removeAll');

        //order
        Route::get('customer/order/add',[OrderController::class,'addOrder'])->name('customer#addOrder');
        Route::get('customer/order/history',[OrderController::class,'orderHistory_customer'])->name('customer#orderHistory');
        Route::get('customer/order/list/{order_id}',[OrderController::class,'orderList_customer'])->name('customer#orderList');
        Route::get('customer/order/history/delete/{id}',[OrderController::class,'orderDelete_customer'])->name('customer#orderDelete');

        //message
        Route::get('customer/message/list',[MessageController::class,'list_customer'])->name('customer#messageList');
        Route::get('customer/message/send/page',[MessageController::class,'sendPage_customer'])->name('customer#messageSendPage');
        Route::post('customer/message/send',[MessageController::class,'send_customer'])->name('customer#messageSend');
        Route::get('customer/message/view/{id}/{user_id}',[MessageController::class,'viewMessage_customer'])->name('customer#viewMessage');
        Route::get('customer/message/delete/{id}',[MessageController::class,'deleteMessage_customer'])->name('customer#deleteMessage');


    });



});
