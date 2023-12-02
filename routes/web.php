<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ListUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\WalletController;

use App\Http\Livewire\MyShops;
use App\Http\Livewire\PagePay;
use App\Http\Livewire\SocioActivo;
use App\Http\Livewire\Shipping;
use App\Http\Livewire\LoginComponent;
use App\Http\Livewire\NextregisterComponent;
use App\Http\Livewire\PayComponent;
use App\Http\Livewire\Products;
use App\Http\Livewire\Register\Register;
use App\Http\Livewire\ShippingView;
use App\Http\Livewire\AffiliateEdit;
use App\Http\Livewire\WalletWeekUser;
use App\Http\Livewire\WalletMonthUser;

Route::get('/home',function(){ return view('inicio'); })->name('home');
Route::get('lenguage/{locale}',function ($locale) {
    if (!in_array($locale, ['en', 'es'])) {
        abort(404);
    } 
        session()->put('locale', $locale);
        App::setLocale(session()->get('locale'));
        return back();
})->name('changelanguage');


//components
Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');
Route::get('login', LoginComponent::class)->name('login');

//wallet
Route::get('wallet/{id}',[WalletController::class,'edit'])->middleware(['auth','isafiliado'])->name('wallet.edit');
Route::get('WeekList', [WalletController::class,'WeekList'])->middleware(['auth','isafiliado'])->name('weeklist');
Route::get('MonthList', [WalletController::class,'MonthList'])->middleware(['auth','isafiliado'])->name('monthlist');
Route::get('/walletRequest',[WalletController::class,'walletRequest'])->middleware(['auth','isafiliado'])->name('walletRequest');
Route::get('/walletWeek/{id}',WalletWeekUser::class)->middleware(['auth','isafiliado'])->name('walletWeekDataUser');
Route::get('/walletMonth/{id}',WalletMonthUser::class)->middleware(['auth','isafiliado'])->name('walletMonthDataUser');
Route::post('week',[WalletController::class,'Week'])->middleware(['auth','isafiliado'])->name('wallet.week');
Route::post('month',[WalletController::class,'Month'])->middleware(['auth','isafiliado'])->name('wallet.month');
Route::post('btnAprobarWeek', [WalletController::class,'btnAprobarWeek'])->middleware(['auth','isafiliado'])->name('btnAprobarWeek');
Route::post('solicitaWeek', [PageController::class,'solicitaWeek'])->middleware(['auth','isafiliado'])->name('solicitaWeek');
Route::post('solicitaMonth', [PageController::class,'solicitaMonth'])->middleware(['auth','isafiliado'])->name('solicitaMonth');


//my shopping
// Route::get('myShops', MyShops::class )->middleware(['auth','afiliado'])->name('myshops');
Route::get('myShops', MyShops::class )->middleware(['auth','isafiliado'])->name('myshops');

//affiliates
Route::get('ListUsers', [ListUserController::class, 'index'])->middleware(['auth','isafiliado'])->name('ListUsers');
Route::get('/ListUsers/{id}', AffiliateEdit::class)->middleware(['auth','isafiliado'])->name('affiliateEdit');

//products
Route::get('/addproduct',[ProductController::class,'index'])->middleware('auth')->name('addproduct');
Route::post('/addproduct',[ProductController::class,'store'])->middleware('auth')->name('addproduct.create');
Route::get('/products',Products::class )->middleware(['auth','isafiliado'])->name('products');

//registers
Route::get('register/{id}',Register::class)->name('login.register.afiliate');
Route::get('/register/verify/{code}', [Register::class, 'verify']);
Route::get('register', Register::class)->name('login.register');

//shipping
Route::get('/shipping', Shipping::class)->middleware(['auth','isafiliado'])->name('shipping');
Route::get('/shipping/{id}', ShippingView::class)->middleware(['auth','isafiliado'])->name('shippingView');

//dashboard
Route::get('/dash',[PageController::class,'dashboardOverview1'] )->middleware(['auth','isafiliado'])->name('dash');
// Route::get('/dash',[PageController::class,'dashboardOverview1'] )->middleware(['auth','isafiliado'])->name('dash');

//active partners register
Route::get('/socioactivo', SocioActivo::class)->middleware(['auth','isafiliado'])->name('socioactivo');

//partners tree
// Route::get('/partner-tree',[PartnersController::class,'index'] )->middleware(['auth','isafiliado'])->name('partnertree');
Route::get('/partner-tree',[PartnersController::class,'index'] )->middleware(['auth','isafiliado'])->name('partnertree');

//packages
Route::get('/addpackage',NextregisterComponent::class )->middleware(['auth'])->name('addpackage');
// Route::get('/', [PageController::class,'dashboardOverview1'])->middleware(['auth'])->name('dashboard');

//shopping
Route::get('shop',[PageController::class,'productGrid'])->middleware(['auth','isafiliado'])->name('shop');
Route::get('profile', [PageController::class,'updateProfile'])->middleware(['auth','isafiliado'])->name('profile');
Route::get('modal', [PageController::class,'modal'])->middleware(['auth','isafiliado'])->name('modal');

//payment gateway
Route::get('payment', PayComponent::class)->middleware('auth')->name('payment');
Route::get('cart-pay', PagePay::class)->middleware('auth')->name('cart-pay');

//change password
Route::get('change-password',[PageController::class,'changePassword'])->middleware('auth')->name('change-password');
Route::post('change-password',[PageController::class,'sendEmailPassword'])->middleware('auth')->name('sendEmailPassword');


Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    // Route::get('login', 'loginView')->name('login.index');
    // Route::post('login', 'login')->name('login.check');
});

Route::middleware(['auth','isafiliado'])->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {

        //dashboard Page
        Route::get('/', 'dashboardOverview1')->name('dashboard-overview-1');

        // promoters Page
        Route::get('/socios-promotores', 'sociospromotor')->name('sociospromotores');

        // customers Page
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');

        //active partners Page
        Route::get('/active-partners', 'activePartners')->name('active-partners');

        //file manager
        Route::get('file-manager-page', 'fileManager')->name('file-manager');

        //OTHERS Page
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
