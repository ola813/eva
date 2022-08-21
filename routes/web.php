<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\ElectronicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\CouponsPointController;
use App\Http\Controllers\CompanyControll;
use App\Http\Controllers\CompanyinternetControll;
use App\Http\Controllers\internetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompanyElecPaymentController;
use App\Http\Controllers\MassegesController;
use App\Http\Controllers\ImageOfferController;
use App\Http\Controllers\orderoutController;
use App\Http\Controllers\FirstPaymentController;
use App\Http\Controllers\CachePaymentController;
use App\Http\Controllers\CodegameController;
use App\Exports\OrderExport;




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

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('logout', function () {return view('welcome');})->name('logout');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin Route

Route::group(['middleware'=>['auth','isAdmin']],function(){
    Route::get('/dashboard',[AdminController::class,'ShowPage'])->name('admin.index');
    Route::get('Show-admins',[AdminController::class,'getAllAdmin'])->name('admin.view');
    Route::get('Edit/{id}',[AdminController::class,'EditAdmin'])->name('Edit-admin');
    Route::get('view/{id}',[AdminController::class,'viewAdmin'])->name('view-admin');
    Route::post('update/{id}',[AdminController::class,'updateAdmin'])->name('update-admin');
    Route::get('delete-user/{id}',[AdminController::class,'deleteAdmin'])->name('delete-admin');

//Users
Route::group(['prefix'=>'User'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('Show',[UsersController::class,'getAllUsers'])->name('admin.view-user');
    Route::get('view/{id}',[UsersController::class,'viewUser'])->name('view-user');
    Route::get('Edit/{id}',[UsersController::class,'EditUsers'])->name('Edit-User');
    Route::post('update/{id}',[UsersController::class,'updateUsers'])-> name('Update-User');
    Route::get('delete/{id}',[UsersController::class,'deleteUser'])-> name('delete-User');
    Route::post('import_user',[UsersController::class,'import_user'])-> name('import_user');
});

Route::group(['prefix'=>'Categories'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('/',[CategoryController::class,'getAllCategory'])->name('Categories');
    Route::get('create',[CategoryController::class,'createCategory'])->name('create-Category');
    Route::post('Add',[CategoryController::class,'storeCategory'])->name('Add-Category');
    Route::get('Edit/{id}',[CategoryController::class,'EditCategory'])->name('edit-Category');
    Route::put('update/{id}',[CategoryController::class,'updateCategory'])->name('update-Category');
    Route::get('delete-Category/{id}',[CategoryController::class,'deleteCategory'])->name('delete-Category');
    Route::get('/{caregory_id}',[CategoryController::class,'ShowProductCategory'])->name('Categories.product');
});

//product in category
Route::group(['prefix'=>'products'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('New',[ProductController::class,'creatproduct'])->name('create-item');
    Route::post('Store',[ProductController::class,'storeproduct'])->name('Add-item');
    Route::get('Edit/{id}',[ProductController::class,'Editeproduct'])->name('Edit-product');
    Route::put('update/{id}',[ProductController::class,'updateproduct'])->name('update-product');
    Route::get('delete-Product/{id}',[ProductController::class,'deleteproduct'])->name('delete-product');
});
Route::group(['prefix'=>'orders'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('Allorder',[OrderController::class,'vieworder'])->name('view-new-order');
    Route::get('Accept-order',[OrderController::class,'Acceptorder'])->name('view-accept-order');
    Route::get('Cancel-order',[OrderController::class,'Cancelorder'])->name('view-cancel-order');
    Route::get('View/{id}',[OrderController::class,'detailsorder'])->name('detials-order');
    Route::get('View-details/{id}',[OrderController::class,'DetailsAllOrder'])->name('detials-All-order');
    Route::post('update/{id}',[OrderController::class,'updateorder'])->name('update-order');
});
Route::post('read',[OrderController::class,'readorder'])->name('readorder');
Route::group(['prefix'=>'Bills'],function(){
        Route::group(['prefix'=>'Electornic'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('orderElectornic',[ElectronicController::class,'OrderElectronic'])->name('ElectronicNewOrder');
        Route::get('order-Electornic/{id}',[ElectronicController::class,'detailsorder'])->name('order-Electornic');
        Route::post('update/{id}',[ElectronicController::class,'updateElectronic'])->name('updateElectronic');
        Route::get('Accept',[ElectronicController::class,'Acceptorder'])->name('AcceptOrderElectronic');
        Route::get('Cancel',[ElectronicController::class,'CancelElectronic'])->name('CancelOrderElectronic');
        Route::get('View-details-Electronic/{id}',[ElectronicController::class,'DetailsAllElectronic'])->name('detials-Electronic');
    
  
});
Route::group(['prefix'=>'Phone'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('orderPhone',[PhoneController::class,'OrderPending'])->name('PhoneNewOrder');
    Route::get('View-Order/{id}',[PhoneController::class,'detailsorder'])->name('ViewOrder');
    Route::post('update/{id}',[PhoneController::class,'updatePhone'])->name('updateorderPhone');
    Route::get('Accept',[PhoneController::class,'Acceptorder'])->name('AcceptOrderphone');
    Route::get('Cancel',[PhoneController::class,'CancelPhoneOrder'])->name('CancelPhoneOrder');
    Route::get('View-details-Phone/{id}',[PhoneController::class,'DetailsAllPhoorder'])->name('DetailsAllPhoorder');
    
});
Route::group(['prefix'=>'cache'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('order-cache-pending',[CachePaymentController::class,'OrderPending'])->name('CacheNewOrder');
    Route::get('View-Order-cache/{id}',[CachePaymentController::class,'detailsordercache'])->name('ViewOrdercache');
    Route::post('update/{id}',[CachePaymentController::class,'updatecache'])->name('updateordercache');
    Route::get('Accept',[CachePaymentController::class,'Acceptordercache'])->name('AcceptOrdercache');
    Route::get('Cancel',[CachePaymentController::class,'CancelcacheOrder'])->name('CancelcacheOrder');
    Route::get('View-details-cache/{id}',[CachePaymentController::class,'DetailsAllcacheorder'])->name('DetailsAllcacheorder');
    
});
Route::group(['prefix'=>'Internet'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('orderNet',[internetController::class,'OrderPending'])->name('netNewOrder');
    Route::get('View-Order/{id}',[internetController::class,'detailsorder'])->name('ViewOrderinternet');
    Route::post('update/{id}',[internetController::class,'updateinternet'])->name('updateorderinternet');
    Route::get('Accept',[internetController::class,'Acceptordernet'])->name('AcceptOrdernet');
    Route::get('Cancel',[internetController::class,'CancelInternetOrder'])->name('CancelInternetOrder');
    Route::get('View-details-internet/{id}',[internetController::class,'DetailsAllInterorder'])->name('DetailsAllInterorder');
  
});
Route::group(['prefix'=>'Mobile'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('orderMobile',[MobileController::class,'OrderPending'])->name('MobileNewOrder');
    Route::get('View-Order/{id}',[MobileController::class,'detailsorder'])->name('ViewOrderMobile');
    Route::post('update/{id}',[MobileController::class,'updateMobile'])->name('updateorderMobile');
    Route::get('Accept',[MobileController::class,'Acceptorder'])->name('AcceptOrderMobile');
    Route::get('Cancel',[MobileController::class,'CancelMobileOrder'])->name('CancelMobileOrder');
    Route::get('View-details-Phone/{id}',[MobileController::class,'DetailsAllMoborder'])->name('DetailsAllMoborder');
    
});
Route::group(['prefix'=>'Blance'],function(){
    Route::post('read',[OrderController::class,'readorder'])->name('readorder');
    Route::get('Account',[BalanceController::class,'AccountPage'])->name('AccountPage');
    Route::get('OrderBalance',[BalanceController::class,'OrderBalancepending'])->name('OrderBalance');
    Route::post('AddAccount',[BalanceController::class,'AddAccount'])->name('AddAccount');
    Route::get('AllAccount',[BalanceController::class,'AllAccount'])->name('AllAccount');
    Route::get('Accept',[BalanceController::class,'AcceptBalance'])->name('AcceptBalance');
    Route::get('delete-Blance/{id}',[BalanceController::class,'DeleteBalance'])->name('DeleteBalance');
    Route::get('View-Order/{id}',[BalanceController::class,'detailsBalance'])->name('ViewOrderBalance');
    Route::post('update/{id}',[BalanceController::class,'updateBalance'])->name('updateorderBalance');
    Route::get('Cancel',[BalanceController::class,'CancelBlanceOrder'])->name('CancelBlanceOrder');
    Route::get('View-details-balance/{id}',[BalanceController::class,'DetailsAllBalance'])->name('DetailsAllBalance');


  
});
});
Route::group(['prefix'=>'Payment'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('show',[RechargeController::class,'getAllcharge'])->name('Payments');
        Route::get('charge-order/{id}',[RechargeController::class,'detailscharge'])->name('ViewOrdercharge');
        Route::post('update/{id}',[RechargeController::class,'updateCharge'])->name('updateCharge');
        Route::get('Accept-Charge',[RechargeController::class,'Acceptcharge'])->name('Acceptcharge');
        Route::get('Cancel-Charge',[RechargeController::class,'Cancelcharge'])->name('view-cancel-Charge');
        Route::get('View-details-Charge/{id}',[RechargeController::class,'DetailsAllOrder'])->name('detials-All-Charge');

 });
Route::group(['prefix'=>'open-account'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('show',[FirstPaymentController::class,'getAllopenaccount'])->name('getAllopenaccount');
        Route::get('charge-order/{id}',[FirstPaymentController::class,'detailsopenaccount'])->name('detailsopenaccount');
        Route::post('update/{id}',[FirstPaymentController::class,'updateopenaccount'])->name('updateopenaccount');
        Route::get('Accept-Charge',[FirstPaymentController::class,'Acceptopenaccount'])->name('Acceptopenaccount');
        Route::get('Cancel-Charge',[FirstPaymentController::class,'Cancelopenaccount'])->name('view-cancel-openaccount');
        Route::get('View-details-Charge/{id}',[FirstPaymentController::class,'DetailsAllopenaccount'])->name('detials-All-openaccount');

 });
Route::group(['prefix'=>'Coupons'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('show',[CouponsController::class,'getAllcoupons'])->name('getAllcoupons');
        Route::post('update-coupon-status',[CouponsController::class,'updateCouponStatus'])->name('updateCouponStatus');
        Route::match(['get','post'],'add-edit-coupon/{id?}',[CouponsController::class,'EditCoupon'])->name('EditCoupon');
        Route::get('delete-coupon/{id}',[CouponsController::class,'DeleteCoupon'])->name('DeleteCoupon');
        Route::post('update-coupon-point-status',[CouponsPointController::class,'updateCouponPointStatus'])->name('updateCouponPointStatus');
    });
    Route::group(['prefix'=>'CouponPoints'],function(){
        Route::get('show-coupon-point',[CouponsPointController::class,'getAllcouponspoint'])->name('getAllcouponspoint');
        Route::match(['get','post'],'coupon-point/{id?}',[CouponsPointController::class,'EditpointCoupon'])->name('EditpointCoupon');
        Route::get('delete-coupon-point/{id}',[CouponsPointController::class,'DeletepointCoupon'])->name('DeletepointCoupon');
    });
    Route::group(['prefix'=>'Company'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::post('addCompany',[CompanyControll::class,'addCompany'])->name('addCompany');
        Route::get('Show',[CompanyControll::class,'showCompany'])->name('showCompany');
        Route::get('Addcopany',[CompanyControll::class,'Addcopany'])->name('Addcopany');
        Route::get('delete-Company-Mobile/{id}',[CompanyControll::class,'DeleteCompan'])->name('DeleteCompan');
 });
Route::group(['prefix'=>'CompanyInter'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::post('newComInter',[CompanyinternetControll::class,'newComInter'])->name('newComInter');
        Route::get('ShowComIner',[CompanyinternetControll::class,'showCompanyinter'])->name('showCompanyinter');
        Route::get('AddComInter',[CompanyinternetControll::class,'Addcopanyinter'])->name('Addcopanyinter');
        Route::get('delete-Company-internet/{id}',[CompanyinternetControll::class,'deleteCompanyInter'])->name('DeleteCompanyInter');
 });
Route::group(['prefix'=>'PaymentElectronic'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::post('newPayELec',[CompanyElecPaymentController::class,'newPayELec'])->name('newPayELec');
        Route::get('ShowPayELec',[CompanyElecPaymentController::class,'showPayELec'])->name('ShowPayELec');
        Route::get('AddPayELec',[CompanyElecPaymentController::class,'AddPayELectro'])->name('AddPayELec');
        Route::get('delete-Company-Pay/{id}',[CompanyElecPaymentController::class,'DeletePayELec'])->name('DeletePayElec');
 });
Route::group(['prefix'=>'Messages'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('message',[MassegesController::class,'showmessage'])->name('showmessage');
        Route::get('Add-message',[MassegesController::class,'Addmessage'])->name('Addmessage');
        Route::post('addMessage',[MassegesController::class,'newMessage'])->name('addMessage');
        Route::get('Editmessage/{id}',[MassegesController::class,'Editmessage'])->name('Editmessage');
        Route::post('update-message/{id}',[MassegesController::class,'UpdateMessage'])->name('UpdateMessage');
        Route::get('delete-message/{id}',[MassegesController::class,'Deletemessage'])->name('Deletemessage');
 });

Route::group(['prefix'=>'ImageOffer'],function(){
        Route::post('read',[OrderController::class,'readorder'])->name('readorder');
        Route::get('Show',[ImageOfferController::class,'showAllImage'])->name('showAllImage');
        Route::get('Create-new-image',[ImageOfferController::class,'CreateNewImage'])->name('CreateNewImage');
        Route::post('add-Image-Offer',[ImageOfferController::class,'addImageOffer'])->name('addImageOffer');
        Route::get('Edie-Image/{id}',[ImageOfferController::class,'EditeImage'])->name('EditeImage');
        Route::post('update-Image/{id}',[ImageOfferController::class,'UpdateImage'])->name('UpdateImage');
        Route::get('delete-Image/{id}',[ImageOfferController::class,'DeleteImage'])->name('DeleteImage');
 });
Route::group(['prefix'=>'orderOut'],function(){
        Route::get('AllorderOut',[orderoutController::class,'vieworderout'])->name('view-new-order-out');
        Route::get('Accept-order-out',[orderoutController::class,'Acceptorder'])->name('view-accept-order-out');
        Route::get('Cancel-order-out',[orderoutController::class,'Cancelorder'])->name('view-cancel-order-out');
        Route::get('View/{id}',[orderoutController::class,'detailsorderout'])->name('detials-order-out');
        Route::get('View-details/{id}',[orderoutController::class,'DetailsAllOrder'])->name('detials-All-order-out');
        Route::post('update/{id}',[orderoutController::class,'updateorderOut'])->name('update-order-out');
 });
 Route::group(['prefix'=>'Code-game'],function(){
        Route::get('code-games',[CodegameController::class,'getAllcodegame'])->name('getAllcodegame');
        Route::get('add-code-game',[CodegameController::class,'Addecodegame'])->name('Addecodegame');
        Route::post('new-code-game',[CodegameController::class,'newecodegame'])->name('newecodegame');
        Route::get('update-code-game/{id}',[CodegameController::class,'updatecodegame'])->name('updatecodegame');
        Route::get('delete-code-game/{id}',[CodegameController::class,'deletecodegame'])->name('deletecodegame');
});
 Route::get('/download-pdf',[ReportController::class,'download'])->name('download');

Route::get('/export',[UsersController::class,'export'])->name('export');
Route::get('SearchPage',[ReportController::class,'SearchPage'])->name('SearchPage');

Route::post('SearchPage',[ReportController::class,'SearchReport'])->name('Search_Report_Oreder');
Route::get('report-Electronic',[ReportController::class,'ReportElectronic'])->name('ReportElectronic');
Route::post('Search-report-Electronic',[ReportController::class,'SearchReportElectronic'])->name('Search_Report_Electronic');

Route::get('report-Mobile',[ReportController::class,'ReportMobile'])->name('ReportMobile');
Route::post('Search-report-Mobile',[ReportController::class,'SearchReportMobile'])->name('Search_Report_Mobile');

Route::get('report-Phone',[ReportController::class,'ReportPhone'])->name('ReportPhone');
Route::post('Search-report-Phone',[ReportController::class,'SearchReportPhone'])->name('Search_Report_Phone');

Route::get('report-internet',[ReportController::class,'Reportinternet'])->name('Reportinternet');
Route::post('Search-report-internet',[ReportController::class,'SearchReportinternet'])->name('Search_Report_internet');

Route::get('report-Balance',[ReportController::class,'ReportBalance'])->name('ReportBalance');
Route::post('Search-report-Balance',[ReportController::class,'SearchReportBalance'])->name('Search_Report_Balance');

Route::get('report-order-out',[ReportController::class,'ReportOrderOut'])->name('ReportOrderOut');
Route::post('Search-order-out',[ReportController::class,'SearchReportOrderOut'])->name('Search_Report_OrderOut');
});


    Route::group(['middleware'=>['auth','isUser']],function(){
       
        
        Route::get('home',[HomeController::class,'index'])->name('Home');
        // Route::get('myamount/{user_id}',[RechargeController::class,'myamount'])->name('myamount');
        Route::get('profile',function(){return view('front.home.profile');})->name('profile');
        Route::get('charge',[RechargeController::class,'AddCharge'])->name('recharge');
        Route::get('order',[OrderController::class,'Showorder'])->name('order');
        Route::get('show-details-order/{id}',[OrderController::class,'ShowOrderdetails'])->name('ShowOrderdetails');
        Route::post('add-to-cart',[CartController::class,'addTOCart']);
        Route::get('cart',[CartController::class,'viewCart'])->name('cart');
        Route::post('delete-cart-item',[CartController::class,'deleteProduct']);
        Route::post('update-cart',[CartController::class,'updateCart']);
        Route::post('orders',[CartController::class,'addorder'])->name('orders');
        Route::get('orders',[CartController::class,'vieworder'])->name('vieworder');
        Route::get('fatora',[ElectronicController::class,'vieworderfatora'])->name('vieworderfatora');
        
        //product and category
        Route::get('view-category/{title_en}',[CategoryController::class,'ShowProduct'])->name('view-product');
        Route::get('view-category/{title_en}/{peoduct_title}',[ProductController::class,'ShowdetailsProduct']);
        
        Route::group(['prefix'=>'Payment'],function(){
            Route::get('view',[RechargeController::class,'getAllPayment'])->name('Payment-view');
            Route::get('amount',[RechargeController::class,'operationAmount']);
            Route::post('Store',[RechargeController::class,'storePayment'])->name('Payment-store');
            
        });
        Route::group(['prefix'=>'Bills'],function(){
            Route::get('ordersBills',[BillsController::class,'vieworder'])->name('orderBills');
            Route::get('AllBills',[BillsController::class,'showBills'])->name('Billes');
            Route::group(['prefix'=>'electronic'],function(){
                    Route::get('electronic',[ElectronicController::class,'orderPower'])->name('orderElectronic');
                    Route::get('show-details-Electronic/{id}',[ElectronicController::class,'ShowElectronicdetails'])->name('ShowElectronicdetails');
                    Route::get('Electornice',[BillsController::class,'Electronic'])->name('Electronic');
                    Route::post('Add-Bills',[BillsController::class,'AddBills'])->name('Add-Bills');
                });
                Route::group(['prefix'=>'phone'],function(){
                    Route::get('Bill',[PhoneController::class,'phoneInternet'])->name('phoneinternet');
                    Route::get('show-order-phone/{id}',[PhoneController::class,'Showphonedetails'])->name('Showphonedetails');
                    Route::get('Bill-Phone',[PhoneController::class,'pagephone'])->name('pageBillphone');
                    Route::get('order-phone',[PhoneController::class,'orderPhone'])->name('orderPhone');
                    Route::post('Add-Bills-phone',[PhoneController::class,'AddBillsphoneorder'])->name('Add-Bills-phone-order');
                }); 
                Route::group(['prefix'=>'cache'],function(){
                    Route::get('Payment',[CachePaymentController::class,'cache'])->name('cache');
                    Route::get('show-order-cache/{id}',[CachePaymentController::class,'ShowCacheorder'])->name('ShowCacheorder');
                    Route::get('Bill-cache',[CachePaymentController::class,'pagecache'])->name('pageBillcache');
                    Route::get('order-cache',[CachePaymentController::class,'orderCache'])->name('orderCache');
                    Route::post('Add-Bills-cache',[CachePaymentController::class,'AddBillscahceorder'])->name('Add-Bills-cache-order');
                }); 
                Route::group(['prefix'=>'Internet'],function(){
                    Route::get('Internet',[internetController::class,'pageInternet'])->name('pageInternet');
                    Route::get('show-order-internet/{id}',[internetController::class,'Showinternetdetails'])->name('Showinternetdetails');
                    Route::get('order-internet',[internetController::class,'orderinternet'])->name('orderinternet');
                    Route::post('Bill-internet',[internetController::class,'Addinterne'])->name('Add-bill-interet');
                });
                Route::group(['prefix'=>'mobile'],function(){
                    Route::get('Bill',[MobileController::class,'pageindex'])->name('pageMobileBlance');
                    Route::get('show-details-mobile/{id}',[MobileController::class,'Showmobiledetails'])->name('Showmobiledetails');
                    Route::get('Bill-Mobile',[MobileController::class,'pageMobile'])->name('Bill-Mobile');
                    Route::post('order-Mobile',[MobileController::class,'BillMobile'])->name('Add-Bill-Mobile');
                    Route::get('order-Bill-Mobile',[MobileController::class,'orderBillMobile'])->name('order-Bill-Mobile');
            }); 
            Route::group(['prefix'=>'Balance'],function(){
                // Route::get('Balance',[BalanceController::class,'pageBalance'])->name('Balance');
                Route::get('Balance',[BalanceController::class,'view'])->name('drowpdown');
                Route::get('get-Balance',[BalanceController::class,'getBlance'])->name('pageBalance');
                Route::get('get-price',[BalanceController::class,'getprice'])->name('getprice');
                // Route::get('Balance',[BalanceController::class,'pageBalance'])->name('Balance');

                Route::get('orderBalance',[BalanceController::class,'orderBalance'])->name('orderBalance');
                Route::post('Balance-transfar',[BalanceController::class,'AddBlance'])->name('Add-Blance');
            });
            
        });
            
            
            // Route::get('orderBalance',[BalanceController::class,'orderBalance'])->name('orderBalance');
            // Route::post('Balance-transfar',[BalanceController::class,'AddBlance'])->name('Add-Blance');
        Route::post('apply-coupon',[CartController::class,'ApplyCoupon'])->name('ApplyCoupon');
        Route::post('apply-coupon-point',[CartController::class,'ApplyCouponpoint'])->name('ApplyCouponpoint');
        Route::get('order-out',[orderoutController::class,'orderOut'])->name('orderOut');
        Route::post('Add-Out',[orderoutController::class,'AddOrderOut'])->name('AddOrderOut');
        Route::get('show',[orderoutController::class,'ShowOrderOut'])->name('ShowOrderOut');

        
        
    });

    Route::group(['middleware'=>['auth','isGuest']],function(){
        Route::get('home-page',[FirstPaymentController::class,'gottohome'])->name('gottohome');
        Route::get('Pending',[FirstPaymentController::class,'pendingPayment'])->name('pendingPayment');
        Route::get('Pending-charge',[FirstPaymentController::class,'Paymentpending'])->name('Paymentpending');
        Route::post('Store-pending',[FirstPaymentController::class,'storePaymentpending'])->name('storePaymentpending');
        Route::get('charge-wallet',[FirstPaymentController::class,'chargewallet'])->name('chargewallet');
    });
        // Route::get('profile',function(){return view('front.home.profile');});
        // Route::get('index',function(){return view('front.home.index');});
        // Route::get('tesr',function(){return view('front.home.tesr');});

      
           
           
            
        

