<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BlogCategoryController;

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Route::get('/admin/home',[HomeController::class,'admin'])->name('admin.home')->middleware('is_admin');
Route::get('/admin-login',[LoginController::class,'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function(){
    Route::get('admin/home',[AdminController::class,'admin'])->name('admin.home');
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('admin/password/change',[AdminController::class,'Password_Change'])->name('admin.password.change');
    Route::post('admin/password/update',[AdminController::class,'Password_Update'])->name('admin.password.update');

    // Category routes
    Route::group(['prefix'=>'category'],function(){
        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('/edit/{id}',[CategoryController::class,'edit']);
        Route::post('update/',[CategoryController::class,'update'])->name('category.update');
    });
    // Global routes
    Route::get('/get-child-category/{id}',[CategoryController::class,'GetChildCategory']);

    // Subcategory routes
    Route::group(['prefix'=>'subcategory'],function(){
        Route::get('/',[SubcategoryController::class,'index'])->name('subcategory.index');
        Route::post('/store',[SubcategoryController::class,'store'])->name('subcategory.store');
        Route::get('/delete/{id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');
        Route::get('/edit/{id}',[SubcategoryController::class,'edit']);
        Route::post('update/',[SubcategoryController::class,'update'])->name('subcategory.update');
    });

    // Childcategory routes
    Route::group(['prefix'=>'childcategory'],function(){
        Route::get('/',[ChildcategoryController::class,'index'])->name('childcategory.index');
        Route::post('/store',[ChildcategoryController::class,'store'])->name('childcategory.store');
        Route::get('/delete/{id}',[ChildcategoryController::class,'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}',[ChildcategoryController::class,'edit']);
        Route::post('update/',[ChildcategoryController::class,'update'])->name('childcategory.update');
    });

    // Brand routes
    Route::group(['prefix'=>'brand'],function(){
        Route::get('/',[BrandController::class,'index'])->name('brand.index');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/delete/{id}',[BrandController::class,'destroy'])->name('brand.delete');
        Route::get('/edit/{id}',[BrandController::class,'edit']);
        Route::post('update/',[BrandController::class,'update'])->name('brand.update');
    });

    // warehouse routes
    Route::group(['prefix'=>'warehouse'],function(){
        Route::get('/',[WarehouseController::class,'index'])->name('warehouse.index');
        Route::post('/store',[WarehouseController::class,'store'])->name('warehouse.store');
        Route::get('/delete/{id}',[WarehouseController::class,'destroy'])->name('warehouse.delete');
        Route::get('/edit/{id}',[WarehouseController::class,'edit']);
        Route::post('update/',[WarehouseController::class,'update'])->name('warehouse.update');
    });

    // campaign routes
    Route::group(['prefix'=>'campaign'],function(){
        Route::get('/',[CampaignController::class,'index'])->name('campaign.index');
        Route::post('/store',[CampaignController::class,'store'])->name('campaign.store');
        Route::get('/delete/{id}',[CampaignController::class,'destroy'])->name('campaign.delete');
        Route::get('/edit/{id}',[CampaignController::class,'edit']);
        Route::post('update/',[CampaignController::class,'update'])->name('campaign.update');
    });
    // campaign products  routes
    Route::group(['prefix'=>'campaign'],function(){
        Route::get('/products/{id}',[CampaignController::class,'campaign_products_index'])->name('campaign.products.all');
        Route::get('/products/campaigned/{campaign_id}',[CampaignController::class,'campaigned_products_index'])->name('campaigned.products.all');
        Route::get('/add/{id}/{campaign_id}',[CampaignController::class,'campaign_products_add'])->name('campaign.products.add');
        Route::get('/destroy/{id}',[CampaignController::class,'campaign_products_delete'])->name('campaigned.product.delete');
        // Route::get('/edit/{id}',[CampaignController::class,'edit']);
        // Route::post('update/',[CampaignController::class,'update'])->name('campaign.update');
    });

    // coupon routes
    Route::group(['prefix'=>'coupon'],function(){
        Route::get('/',[CouponController::class,'index'])->name('coupon.index');
        Route::post('/store',[CouponController::class,'store'])->name('coupon.store');
        Route::get('/delete/{id}/',[CouponController::class,'destroy'])->name('coupon.delete');
        Route::get('/edit/{id}/',[CouponController::class,'edit']);
        Route::post('update/',[CouponController::class,'update'])->name('coupon.update');
    });

    // pickup_point routes
    Route::group(['prefix'=>'pickup_point'],function(){
        Route::get('/',[PickupPointController::class,'index'])->name('pickup_point.index');
        Route::post('/store',[PickupPointController::class,'store'])->name('pickup_point.store');
        Route::get('/delete/{id}',[PickupPointController::class,'destroy'])->name('pickup_point.delete');
        Route::get('/edit/{id}',[PickupPointController::class,'edit']);
        Route::post('update/',[PickupPointController::class,'update'])->name('pickup_point.update');
    });

    // orders.list routes
    Route::group(['prefix'=>'orders'],function(){
        Route::get('/',[OrderController::class, 'index'])->name('orders.index');
        Route::get('/admin/edit/{id}',[OrderController::class,'edit']);
        Route::post('update/',[OrderController::class,'update'])->name('order.status.update');
    });

    // product routes
    Route::group(['prefix'=>'product'],function(){
        Route::get('/',[ProductController::class,'index'])->name('product.index');
        Route::get('/create',[ProductController::class,'create'])->name('product.create');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/not-featured/{id}',[ProductController::class,'deactive_featured']);
        Route::get('/featured/{id}',[ProductController::class,'active_featured']);
        Route::get('/not-today-deal/{id}',[ProductController::class,'today_deal_deactive']);
        Route::get('/today-deal/{id}',[ProductController::class,'today_deal_active']);
        Route::get('/status-deactive/{id}',[ProductController::class,'status_deactive']);
        Route::get('/status-active/{id}',[ProductController::class,'status_active']);
        Route::get('/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/update',[ProductController::class,'update'])->name('product.update');
        // Route::post('update/',[PickupPointController::class,'update'])->name('pickup_point.update');

    });

    // Settings routes
    Route::group(['prefix'=>'settings'],function(){
        //user roles
        Route::group(['prefix'=>'roles'],function(){
            Route::get('/',[UserRoleController::class,'index'])->name('user.roles.index');
            Route::get('/edit/{id}',[UserRoleController::class,'edit']);
            Route::post('/update',[UserRoleController::class,'update'])->name('user.roles.update');
        });
        //seo settings
        Route::group(['prefix'=>'seo'],function(){
            Route::get('/',[SettingController::class,'seo'])->name('seo.setting');
            Route::post('/update/{id}',[SettingController::class,'update'])->name('seo.setting.update');
        });
        //smtp settings
        Route::group(['prefix'=>'smtp'],function(){
            Route::get('/',[SettingController::class,'smtp'])->name('smtp.setting');
            Route::post('/update/{id}',[SettingController::class,'smtp_update'])->name('smtp.setting.update');
        });
        //payment gateway
        Route::group(['prefix'=>'payment'],function(){
            Route::get('/',[SettingController::class,'payment_gateway'])->name('payment.gateway');
            Route::post('/aamarpay',[SettingController::class,'aamarpay_payment_gateway'])->name('aamarpay.payment.gateway');
            Route::post('/surjopay',[SettingController::class,'surjopay_payment_gateway'])->name('surjopay.payment.gateway');
            Route::post('/ssl',[SettingController::class,'ssl_payment_gateway'])->name('ssl.payment.gateway');
        });
        //website settings
        Route::group(['prefix'=>'website'],function(){
            Route::get('/',[SettingController::class,'website'])->name('website.index');
            Route::post('/update/{id}',[SettingController::class,'web_update'])->name('website.update');
        });
        //page settings
        Route::group(['prefix'=>'page'],function(){
            Route::get('/',[PageController::class,'index'])->name('page.index');
            Route::get('create/',[PageController::class,'create'])->name('page.create');
            Route::post('store/',[PageController::class,'store'])->name('page.store');
            Route::get('delete/{id}/',[PageController::class,'destroy'])->name('page.delete');
            Route::get('edit/{id}/',[PageController::class,'edit'])->name('page.edit');
            Route::post('update/{id}/',[PageController::class,'update'])->name('page.update');
        });
    });

    //ticket
    Route::group(['prefix'=>'ticket'],function(){
        Route::get('/admin-ticket',[TicketController::class,'index'])->name('admin.ticket.index');
        Route::get('/admin-ticket-show/{id}',[TicketController::class,'ticket_show'])->name('ticket.show');
        Route::post('/admin-ticket-reply',[TicketController::class,'ticket_reply'])->name('ticket.reply');
        Route::get('/admin-ticket-close/{id}',[TicketController::class,'ticket_close'])->name('admin.ticket.close');
        Route::get('/ticket-delete/{id}/',[TicketController::class,'destroy'])->name('ticket.delete');
        // Route::get('edit/{id}/',[PageController::class,'edit'])->name('page.edit');
        // Route::post('update/{id}/',[PageController::class,'update'])->name('page.update');
    });

    //blog category
    Route::group(['prefix'=>'blog-category'],function(){
        Route::get('/', [BlogCategoryController::class, 'category_index'])->name('blog.categories');
        Route::post('/store', [BlogCategoryController::class, 'category_store'])->name('blog.category.store');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'category_edit']);
        Route::post('/update', [BlogCategoryController::class, 'category_update'])->name('blog.category.update');
    });

    //blog
    Route::group(['prefix'=>'blog'],function(){
        Route::get('/', [BlogController::class, 'blog_index'])->name('blog.index');
        Route::post('/store', [BlogController::class, 'blog_store'])->name('blog.store');
        Route::get('/delete/{id}', [BlogController::class, 'blog_delete'])->name('blog.delete');
        Route::get('/edit/{id}', [BlogController::class, 'blog_edit']);
        Route::post('/update', [BlogController::class, 'blog_update'])->name('blog.update');
        // Route::post('/update', [BlogController::class, 'category_update'])->name('blog.category.update');
    });

    //reports
    Route::group(['prefix'=>'reports'],function(){
        Route::get('/orders', [OrderController::class, 'order_reports'])->name('order.reports.index');
        Route::get('/orders/print', [OrderController::class, 'order_print'])->name('report.order.print');
        // Route::post('/store', [BlogController::class, 'blog_store'])->name('blog.store');
        // Route::get('/delete/{id}', [BlogController::class, 'blog_delete'])->name('blog.delete');
        // Route::get('/edit/{id}', [BlogController::class, 'blog_edit']);
        // Route::post('/update', [BlogController::class, 'blog_update'])->name('blog.update');
        // Route::post('/update', [BlogController::class, 'category_update'])->name('blog.category.update');
    });
});