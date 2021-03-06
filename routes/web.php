<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;
use App\Http\AdminAuthController;

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

Route::redirect('/', '/index');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::post('/post_login', [\App\Http\Controllers\LoginController::class,'process_login'])->name('postLogin');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');

Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

//Route::get('/login-example', LoginExample::class);
Route::get('/alogin', LoginExample::class)->name('login-example');
Route::post('admin/login', [\App\Http\Controllers\AdminAuthController::class,'postLogin'])->name('adminLoginPost');
Route::get('admin/logout', [\App\Http\Controllers\AdminAuthController::class,'logout'])->name('adminLogout');

Route::group(['middleware' => ['web', 'admins']], function () {
    Route::prefix('admin')->group(function(){
        Route::get('tables', [\App\Http\Controllers\AdminController::class,'tableList'])->name('tables');
        Route::get('/logout', [\App\Http\Controllers\AdminAuthController::class,'logout'])->name('adminLogout');
        Route::get('profile', [\App\Http\Controllers\AdminController::class,'profile'])->name('profile.edit');
        Route::get('/members',[\App\Http\Controllers\AdminController::class,'members'])->name('members');
        Route::get('/mileage_charge',[\App\Http\Controllers\AdminController::class,'mileage_charge'])->name('mileage_charge');
        Route::get('/mileage_used',[\App\Http\Controllers\AdminController::class,'mileage_used'])->name('mileage_used');
        Route::post('/member_control',[\App\Http\Controllers\AdminController::class,'member_control'])->name('member_control');
        Route::post('/mileage_control',[\App\Http\Controllers\AdminController::class,'mileage_control'])->name('mileage_control');
        Route::get('/member/edit',[\App\Http\Controllers\AdminController::class,'member_edit'])->name('member_edit');
        Route::post('/member_update',[\App\Http\Controllers\AdminController::class,'member_update'])->name('member.update');
        Route::post('/member_password',[\App\Http\Controllers\AdminController::class,'member_password'])->name('member.password');
        Route::get('/order_list',[\App\Http\Controllers\AdminController::class,'order_list'])->name('order_list');
        Route::get('/order_list_request',[\App\Http\Controllers\AdminController::class,'order_list_request'])->name('order_list_request');
        Route::get('orderContent',[\App\Http\Controllers\AdminController::class,'orderContent'])->name('orderContent');
        Route::get('orderRequestContent',[\App\Http\Controllers\AdminController::class,'orderRequestContent'])->name('orderRequestContent');
        Route::post('processOrderRequest',[\App\Http\Controllers\AdminController::class,'processOrderRequest'])->name('processOrderRequest');
        Route::get('use_relative',[\App\Http\Controllers\AdminController::class,'use_relative'])->name('use_relative');
        Route::get('new_gaming',[\App\Http\Controllers\AdminController::class,'new_gaming'])->name('new_gaming');
        Route::get('publish_msg',[\App\Http\Controllers\AdminController::class,'publish_msg'])->name('publish_msg');
        Route::get('noticeOpen',[\App\Http\Controllers\AdminController::class,'noticeOpen'])->name('noticeOpen');
        Route::post('updateNotice',[\App\Http\Controllers\AdminController::class,'updateNotice'])->name('updateNotice');
        Route::get('shoppingmal',[\App\Http\Controllers\AdminController::class,'shoppingmal'])->name('shoppingmal');
        Route::get('editShop',[\App\Http\Controllers\AdminController::class,'editShop'])->name('editShop');
        Route::post('shopping_update',[\App\Http\Controllers\AdminController::class,'shopping_update'])->name('shopping_update');
        Route::get("shoppingmal_list",[\App\Http\Controllers\AdminController::class,'shoppingmal_list'])->name('shoppingmal_list');
        Route::get("game_management",[\App\Http\Controllers\AdminController::class,'game_management'])->name('game_management');
        Route::get('notice_list',[\App\Http\Controllers\AdminController::class,'notice_list'])->name('notice_list_admin');
        Route::get('msg_content',[\App\Http\Controllers\AdminController::class,'msg_content'])->name('msg_content');
        Route::post('sendMsg',[\App\Http\Controllers\AdminController::class,'sendMsg'])->name('sendMsg');
        Route::get('gamemake',[\App\Http\Controllers\AdminController::class,'gamemake'])->name('gamemake');
        Route::post('UpdateMGame',[\App\Http\Controllers\AdminController::class,'UpdateMGame'])->name('UpdateMGame');
    });

    Route::post('/updateProfile', [\App\Http\Controllers\AdminController::class,'updateProfile'])->name('profile.update');
    Route::post('/passwordProfile', [\App\Http\Controllers\AdminController::class,'passwordProfile'])->name('profile.password');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class,'userList'])->name('users');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');

});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [\App\Http\Controllers\ManiaController::class,'logout'])->name('logout');
    Route::post('/sell/application_ba_ok',[\App\Http\Controllers\ManiaController::class,'applicationiBa']);
    Route::post('/addService',[\App\Http\Controllers\ManiaController::class,'addservice']);
    Route::post('/sell/application_ok',[\App\Http\Controllers\ManiaController::class,'application_ok']);
    Route::post('/buy_ing_ok' , [\App\Http\Controllers\ManiaController::class,'buy_ing_ok']);
    Route::post('/sell_ing_ok' ,  [\App\Http\Controllers\ManiaController::class,'sell_ing_ok']);
    Route::post('/myroom/buy/buy_pay_wait_ok' ,  [\App\Http\Controllers\ManiaController::class,'buy_pay_wait_ok']);
    Route::post('/sell_check_ok',[\App\Http\Controllers\ManiaController::class,'sell_check_ok']);
    Route::post('/buy_check_ok',[\App\Http\Controllers\ManiaController::class,'buy_check_ok']);
    Route::get('myinfo_bank', [\App\Http\Controllers\VMyRoomController::class,'myinfo_bank'])->name('myinfo_bank');
    Route::post('updatebank', [\App\Http\Controllers\VMyRoomController::class,'updatebank'])->name('updatebank');
    Route::get('allgame',[\App\Http\Controllers\ManiaController::class,'allgame'])->name('allgame');
    /**
     * By Jong
     */

    Route::prefix('customer')->group(function () {
        Route::any('/', [\App\Http\Controllers\VCustomerController::class, 'customer'])->name('main_customer');
        Route::get('/faq', [\App\Http\Controllers\VCustomerController::class, 'faq'])->name('customer_faq');

        Route::any('/report', [\App\Http\Controllers\VCustomerController::class, 'report'])->name('customer_report');
        Route::any('/report_end', [\App\Http\Controllers\VCustomerController::class, 'report_end'])->name('customer_report_end');
        Route::any('/ask_guide', [\App\Http\Controllers\VCustomerController::class, 'ask_guide'])->name('customer_ask_guide');
        Route::any('/report_complete', [\App\Http\Controllers\VCustomerController::class, 'report_complete'])->name('customer_report_complete');

        Route::any('/newgame', [\App\Http\Controllers\VCustomerController::class, 'newgame'])->name('customer_newgame');
        Route::get('/safety', [\App\Http\Controllers\VCustomerController::class, 'safety'])->name('customer_safety');

        Route::get('/myqna/list', [\App\Http\Controllers\VCustomerController::class, 'myqna_list'])->name('myqna_list');
        Route::get('/myqna/view', [\App\Http\Controllers\VCustomerController::class, 'myqna_view'])->name('myqna_view');
    });
    Route::get('/chat/agree', [\App\Http\Controllers\VCustomerController::class, 'chat_agree'])->name('chat_agree');

    Route::prefix('myroom')->group(function () {
        Route::get('/', [\App\Http\Controllers\VMyRoomController::class, 'index'])->name('myroom');
        Route::get('/message', [\App\Http\Controllers\VMyRoomController::class, 'message'])->name('message');
        Route::get('/goods_alarm/alarm_sell_list', [\App\Http\Controllers\VMyRoomController::class, 'alarm_sell_list'])->name('alarm_sell_list');
        Route::get('/goods_alarm/alarm_add', [\App\Http\Controllers\VMyRoomController::class, 'alarm_add'])->name('alarm_add');
        Route::get('/mileage/charge/{giftid}',[\App\Http\Controllers\VMyRoomController::class, 'mileage_charge_home'])->name('mileage_charge_home');
        Route::post('/message/save_all',[\App\Http\Controllers\VMyRoomController::class, 'save_all'])->name('save_all');
        Route::post('/message/delete_all',[\App\Http\Controllers\VMyRoomController::class, 'delete_all'])->name('delete_all');

        Route::get('/cash_receipt/cash_receipt_list',[\App\Http\Controllers\VMyRoomController::class, 'cash_receipt_list'])->name('cash_receipt_list');

        Route::get('/user_leave/user_leave_form',[\App\Http\Controllers\VMyRoomController::class, 'user_leave_form'])->name('user_leave_form');

        Route::prefix('customer')->group(function (){
            Route::get('/', [\App\Http\Controllers\VMyRoomController::class, 'customer'])->name('customer_myroom');
            Route::get('/search',[\App\Http\Controllers\VMyRoomController::class, 'search'])->name('search');
            Route::get('/private',[\App\Http\Controllers\VMyRoomController::class, 'customer_private'])->name('customer_private');
            Route::post('/search_add',[\App\Http\Controllers\VMyRoomController::class, 'search_add'])->name('search_add');
            Route::get('/search_startpage',[\App\Http\Controllers\VMyRoomController::class, 'search_startpage'])->name('search_startpage');
            Route::get('/search_delete',[\App\Http\Controllers\VMyRoomController::class, 'search_delete'])->name('search_delete');
            Route::post('/search_order',[\App\Http\Controllers\VMyRoomController::class, 'search_order'])->name('search_order');
            Route::post('/search_update',[\App\Http\Controllers\VMyRoomController::class, 'search_update'])->name('search_update');
        });

        Route::prefix('coupon')->group(function () {
            Route::get('free_remainder_list',[\App\Http\Controllers\VMyRoomController::class, 'free_remainder_list'])->name('free_remainder_list');
        });

        Route::prefix('complete')->group(function () {
            Route::get('/sell', [\App\Http\Controllers\VMyRoomController::class, 'complete_sell'])->name('complete_sell');
            Route::get('/buy', [\App\Http\Controllers\VMyRoomController::class, 'complete_buy'])->name('complete_buy');
            Route::get('/report', [\App\Http\Controllers\VMyRoomController::class, 'complete_report'])->name('complete_report');
            Route::get('/cancel_sell', [\App\Http\Controllers\VMyRoomController::class, 'complete_cancel_sell'])->name('complete_cancel_sell');
            Route::get('/cancel_buy', [\App\Http\Controllers\VMyRoomController::class, 'complete_cancel_buy'])->name('complete_cancel_buy');
        });

        Route::prefix('sell')->group(function () {
            Route::get('/sell_check', [\App\Http\Controllers\VMyRoomController::class, 'sell_check'])->name('sell_check');
            Route::get('/sell_ing', [\App\Http\Controllers\VMyRoomController::class, 'sell_ing'])->name('sell_ing');
            Route::get('/sell_pay_wait_view', [\App\Http\Controllers\VMyRoomController::class, 'sell_pay_wait_view'])->name('sell_pay_wait_view');
            Route::get('/sell_regist', [\App\Http\Controllers\VMyRoomController::class, 'sell_regist'])->name('sell_regist');
            Route::get('/sell_regist_view', [\App\Http\Controllers\VMyRoomController::class, 'sell_regist_view'])->name('sell_regist_view');
            Route::get('/sell_re_reg', [\App\Http\Controllers\VMyRoomController::class, 'sell_re_reg'])->name('sell_re_reg');
            Route::get('/sell_ing_view',[\App\Http\Controllers\VMyRoomController::class, 'sell_ing_view'])->name('sell_ing_view');
            Route::get('/sell_check_view', [\App\Http\Controllers\VMyRoomController::class, 'sell_check_view'])->name('sell_check_view');
            Route::get('/sell_check',[\App\Http\Controllers\VMyRoomController::class, 'sell_check'])->name('sell_check');
            Route::get('/sell_pay_wait',[\App\Http\Controllers\VMyRoomController::class, 'sell_pay_wait'])->name('sell_pay_wait');
        });

        Route::prefix('buy')->group(function () {
            Route::get('/buy_check', [\App\Http\Controllers\VMyRoomController::class, 'buy_check'])->name('buy_check');
            Route::get('/buy_ing', [\App\Http\Controllers\VMyRoomController::class, 'buy_ing'])->name('buy_ing');
            Route::get('/buy_pay_wait', [\App\Http\Controllers\VMyRoomController::class, 'buy_pay_wait'])->name('buy_pay_wait');
            Route::get('/buy_pay_wait_view', [\App\Http\Controllers\VMyRoomController::class, 'buy_pay_wait_view'])->name('buy_pay_wait_view');
            Route::get('/buy_regist_view', [\App\Http\Controllers\VMyRoomController::class, 'buy_regist_view'])->name('buy_regist_view');
            Route::get('/buy_re_reg', [\App\Http\Controllers\VMyRoomController::class, 'buy_re_reg'])->name('buy_re_reg');
            Route::get('/buy_ing_view', [\App\Http\Controllers\VMyRoomController::class, 'buy_ing_view'])->name('buy_ing_view');
            Route::get('/buy_check_view', [\App\Http\Controllers\VMyRoomController::class, 'buy_check_view'])->name('buy_check_view');
            Route::get('/buy_regist', [\App\Http\Controllers\VMyRoomController::class, 'buy_regist'])->name('buy_regist');
        });

        Route::prefix('my_mileage')->group(function(){
            Route::get('/index_c', [\App\Http\Controllers\VMyRoomController::class, 'my_mileage_index_c'])->name('my_mileage_index_c');
            Route::get('/index_e', [\App\Http\Controllers\VMyRoomController::class, 'my_mileage_index_e'])->name('my_mileage_index_e');
            Route::any('/calendar', [\App\Http\Controllers\VMyRoomController::class, 'my_mileage_calendar'])->name('my_mileage_calendar');
            Route::any('/detail_list', [\App\Http\Controllers\VMyRoomController::class, 'my_mileage_detail_list'])->name('my_mileage_detail_list');
            Route::get('/popup/mile_detail', [\App\Http\Controllers\VMyRoomController::class, 'popup_mile_detail'])->name('popup_mile_detail');
            Route::get('/charge', [\App\Http\Controllers\VMyRoomController::class, 'mileage_payment_charge'])->name('mileage_payment_charge');
            Route::get('/exchange', [\App\Http\Controllers\VMyRoomController::class, 'mileage_payment_exchange'])->name('mileage_payment_exchange');

            Route::prefix('guide')->group(function (){
                Route::get('/charge', [\App\Http\Controllers\VMyRoomController::class, 'mileage_guide_charge'])->name('mileage_guide_charge');
            });

            Route::prefix('payment')->group(function (){
                Route::get('/index', [\App\Http\Controllers\VMyRoomController::class, 'payment_index'])->name('payment_index');
                Route::get('/payment_phone', [\App\Http\Controllers\VMyRoomController::class, 'payment_phone'])->name('payment_phone');
                Route::get('/payment_list', [\App\Http\Controllers\VMyRoomController::class, 'payment_list'])->name('payment_list');
                Route::get('/payment_phone_list', [\App\Http\Controllers\VMyRoomController::class, 'payment_phone_list'])->name('payment_phone_list');
                Route::get('/culturecash', [\App\Http\Controllers\VMyRoomController::class, 'culturecash'])->name('culturecash');
            });
        });

        Route::prefix('myinfo')->group(function  (){
            Route::get('/myinfo_check', [\App\Http\Controllers\VMyRoomController::class, 'myinfo_check'])->name('myinfo_check');
            Route::post('/myinfo_alter', [\App\Http\Controllers\VMyRoomController::class, 'myinfo_alter'])->name('myinfo_alter');
            Route::get('/myinfo_passwd_modify', [\App\Http\Controllers\VMyRoomController::class, 'myinfo_passwd_modify'])->name('myinfo_passwd_modify');
            Route::get('/credit_rating', [\App\Http\Controllers\VMyRoomController::class, 'credit_rating'])->name('credit_rating');

            Route::get('/my_login_plus', [\App\Http\Controllers\VMyRoomController::class, 'my_login_plus'])->name('my_login_plus');
            Route::get('/my_login_prevent', [\App\Http\Controllers\VMyRoomController::class, 'my_login_prevent'])->name('my_login_prevent');
        });
    });

    Route::prefix('sell')->group(function () {
        Route::any('/', [\App\Http\Controllers\VSellController::class, 'index'])->name('sell');
        Route::get('/index_view', [\App\Http\Controllers\VSellController::class, 'index_view'])->name('sell_index_view');
        Route::get('/view', [\App\Http\Controllers\VSellController::class, 'sell_view'])->name('sell_view');
        Route::get('/application', [\App\Http\Controllers\VSellController::class, 'sell_application'])->name('sell_application');
        Route::post('/list_search', [\App\Http\Controllers\VSellController::class, 'list_search'])->name('sell_list_search');
        Route::get('/list_search', [\App\Http\Controllers\VSellController::class, 'list_search'])->name('sell_list_search');
        Route::post('/list', [\App\Http\Controllers\VSellController::class, 'sell_list'])->name('sell_list');
        Route::get('/fixed_trade_subject',[\App\Http\Controllers\VSellController::class, 'fixed_trade_subject']);
        Route::post('/fixed_trade_subject',[\App\Http\Controllers\VSellController::class, 'addFixed']);
    });

    Route::prefix('buy')->group(function (){
        Route::any('/', [\App\Http\Controllers\VBuyController::class, 'index'])->name('buy');
        Route::get('/index_view', [\App\Http\Controllers\VBuyController::class, 'index_view'])->name('buy_index_view');
        Route::post('/list', [\App\Http\Controllers\VBuyController::class, 'buy_list'])->name('buy_list');
        Route::post('/list_search', [\App\Http\Controllers\VBuyController::class, 'list_search'])->name('buy_list_search');
        Route::get('/list_search', [\App\Http\Controllers\VBuyController::class, 'list_search'])->name('buy_list_search');
        Route::get('/application', [\App\Http\Controllers\VBuyController::class, 'buy_application'])->name('buy_application');
        Route::get('/trade_cancel',[\App\Http\Controllers\VBuyController::class, 'trade_cancel'])->name('trade_cancel');
        Route::post('/include/index_template',[\App\Http\Controllers\VBuyController::class, 'index_template']);
        Route::post('/application_ok',[\App\Http\Controllers\ManiaController::class,'application_ok_buy']);
    });


    Route::prefix('user')->group(function() {
        Route::get('/contact_edit', [\App\Http\Controllers\VSellController::class, 'user_contact_edit']);
        Route::post('/contact_edit', [\App\Http\Controllers\VSellController::class, 'addContact']);
    });


    Route::get('/notice/list', [\App\Http\Controllers\VNoticeController::class, 'notice_list'])->name('notice_list');
    Route::post('buy_pay_wait_cancel', [\App\Http\Controllers\ManiaController::class, 'buy_pay_wait_cancel']);
    Route::post('/certify/payment/user_certify', [\App\Http\Controllers\VCertifyController::class, 'user_certify'])->name('user_certify');
    Route::post('buy_re_reg_ok',[\App\Http\Controllers\ManiaController::class, 'buy_re_reg_ok'])->name('buy_re_reg_ok');
    Route::post('/sell_re_reg_ok',[\App\Http\Controllers\ManiaController::class, 'sell_re_reg_ok'])->name('sell_re_reg_ok');
    Route::post('/buy_regist',[\App\Http\Controllers\ManiaController::class, 'buy_regist'])->name('buy_regist');
    Route::post('/sell_regist',[\App\Http\Controllers\ManiaController::class, 'sell_regist']);
    Route::get('/portal/giftcard', [\App\Http\Controllers\VMainController::class, 'giftcard'])->name('giftcard');
    Route::get('/portal/giftcard/{giftid}', [\App\Http\Controllers\VMainController::class, 'viewGift'])->name('viewGift');
    Route::post('/portal/giftcard/{giftid}', [\App\Http\Controllers\VMainController::class, 'viewGift_Post'])->name('viewGift_Post');
    Route::post('sell_re_reg_auto_ok',[\App\Http\Controllers\ManiaController::class, 'sell_re_reg_auto_ok'])->name('sell_re_reg_auto_ok');
    Route::post('sell_regist_post',[\App\Http\Controllers\ManiaController::class, 'sell_regist_post'])->name('sell_regist_post');
    Route::post('/certify/ini_modi_authcenter/user_certify',[\App\Http\Controllers\ManiaController::class, 'user_certify_myinfo'])->name('user_certify_myinfo');
    Route::get('cash_receipt_confirm',[\App\Http\Controllers\ManiaController::class, 'cash_receipt_confirm'])->name('cash_receipt_confirm');
    Route::get('cash_receipt_confirm2',[\App\Http\Controllers\ManiaController::class, 'cash_receipt_confirm2'])->name('cash_receipt_confirm2');
    Route::get('search_update_form',[\App\Http\Controllers\ManiaController::class, 'search_update_form'])->name('search_update_form');

    /**
     * By Jong
     */
    Route::get('/favorite', [\App\Http\Controllers\VMainController::class, 'favorite'])->name('favorite');
    Route::get('/notice', [\App\Http\Controllers\VMainController::class, 'notice'])->name('m_notice');

});

Route::prefix('game_info')->group(function() {
    Route::get('/money/index', [\App\Http\Controllers\VGameinfoController::class, 'money'])->name('gameinfo_money');
    Route::get('/rank_game/index', [\App\Http\Controllers\VGameinfoController::class, 'rank_game'])->name('gameinfo_rank_game');
    Route::get('/calendar/index', [\App\Http\Controllers\VGameinfoController::class, 'calendar'])->name('gameinfo_calendar');
});

/**
 * By Jong
 */
Route::get('/index', [\App\Http\Controllers\VMainController::class, 'first'])->name('index');
Route::get('/homepage', [\App\Http\Controllers\VMainController::class, 'index'])->name('homepage');
Route::get('/character', [\App\Http\Controllers\VChrController::class, 'index'])->name('character');
Route::get('/event', [\App\Http\Controllers\VEventController::class, 'index'])->name('event');

Route::prefix('guide')->group(function() {
    Route::get('/', [\App\Http\Controllers\VGuideController::class, 'index'])->name('guide');
    Route::get('/howto', [\App\Http\Controllers\VGuideController::class, 'howto'])->name('guide_howto');
    Route::get('/howto2', [\App\Http\Controllers\VGuideController::class, 'howto2'])->name('guide_howto2');
    Route::get('/movie', [\App\Http\Controllers\VGuideController::class, 'movie'])->name('guide_movie');
    Route::get('/safe', [\App\Http\Controllers\VGuideController::class, 'safe'])->name('guide_safe');
    Route::get('/trade', [\App\Http\Controllers\VGuideController::class, 'trade'])->name('guide_trade');
    Route::get('/failed', [\App\Http\Controllers\VGuideController::class, 'failed'])->name('guide_failed');
    Route::get('/join', [\App\Http\Controllers\VGuideController::class, 'join'])->name('guide_join');
    Route::get('/charge', [\App\Http\Controllers\VGuideController::class, 'charge'])->name('guide_charge');
    Route::get('/cancel', [\App\Http\Controllers\VGuideController::class, 'cancel'])->name('guide_cancel');
    Route::get('/myroom', [\App\Http\Controllers\VGuideController::class, 'myroom'])->name('guide_myroom');
    Route::get('/safe_grade/point', [\App\Http\Controllers\VGuideController::class, 'safe_grade_point'])->name('safe_grade_point');
    Route::get('/safe_grade/certify', [\App\Http\Controllers\VGuideController::class, 'safe_grade_certify'])->name('safe_grade_certify');

    Route::prefix('cancel')->group(function() {
        Route::get('/cancel', [\App\Http\Controllers\VGuideController::class, 'cancel_cancel'])->name('guide_cancel_cancel');
        Route::get('/bad_report', [\App\Http\Controllers\VGuideController::class, 'cancel_bad'])->name('guide_cancel_bad');
    });

    Route::get('/char_trade', [\App\Http\Controllers\VGuideController::class, 'safe_char_trade'])->name('safe_char_trade');
    Route::get('/deposit_check', [\App\Http\Controllers\VGuideController::class, 'safe_deposit_check'])->name('safe_deposit_check');
    Route::get('/buyer_info', [\App\Http\Controllers\VGuideController::class, 'safe_buyer_info'])->name('safe_buyer_info');
    Route::get('/char_transfer', [\App\Http\Controllers\VGuideController::class, 'safe_char_transfer'])->name('safe_char_transfer');
    Route::get('/sell_end', [\App\Http\Controllers\VGuideController::class, 'safe_sell_end'])->name('safe_sell_end');

    Route::get('/buy_reg', [\App\Http\Controllers\VGuideController::class, 'safe_buy_reg'])->name('safe_buy_reg');
    Route::get('/seller_info', [\App\Http\Controllers\VGuideController::class, 'safe_seller_info'])->name('safe_seller_info');
    Route::get('/take_over', [\App\Http\Controllers\VGuideController::class, 'safe_take_over'])->name('safe_take_over');
    Route::get('/buy_end', [\App\Http\Controllers\VGuideController::class, 'safe_buy_end'])->name('safe_buy_end');

    Route::prefix('bar_trade')->group(function() {
        Route::get('/sell_reg', [\App\Http\Controllers\VGuideController::class, 'bar_sell_reg'])->name('bar_sell_reg');
        Route::get('/sell', [\App\Http\Controllers\VGuideController::class, 'bar_sell'])->name('bar_sell');
        Route::get('/buyer_req', [\App\Http\Controllers\VGuideController::class, 'bar_buyer_req'])->name('bar_buyer_req');
        Route::get('/seller_app', [\App\Http\Controllers\VGuideController::class, 'bar_seller_app'])->name('bar_seller_app');
        Route::get('/buyer_pay', [\App\Http\Controllers\VGuideController::class, 'bar_buyer_pay'])->name('bar_buyer_pay');
        Route::get('/re_bargain', [\App\Http\Controllers\VGuideController::class, 'bar_re_bargain'])->name('bar_re_bargain');
    });
    Route::get('/withdraw', [\App\Http\Controllers\VGuideController::class, 'guide_withdraw'])->name('guide_withdraw');
    Route::get('/g_charge', [\App\Http\Controllers\VGuideController::class, 'guide_charge'])->name('guide_charge');

    Route::prefix('convnce')->group(function() {
        Route::get('/talk_box', [\App\Http\Controllers\VGuideController::class, 'talk_box'])->name('talk_box');
        Route::get('/hide_func', [\App\Http\Controllers\VGuideController::class, 'hide_func'])->name('hide_func');
        Route::get('/howto_search', [\App\Http\Controllers\VGuideController::class, 'howto_search'])->name('howto_search');
    });

    Route::prefix('add')->group(function() {
        Route::get('/security_number', [\App\Http\Controllers\VGuideController::class, 'security_number'])->name('security_number');
        Route::get('/security_number_plus', [\App\Http\Controllers\VGuideController::class, 'security_number_plus'])->name('security_number_plus');
    });


});

Route::prefix('/portal/user')->group(function() {
    Route::get('/', [\App\Http\Controllers\VGuideController::class, 'user_reg_step1'])->name('user_reg_step1');
    Route::any('/join_agreement', [\App\Http\Controllers\VGuideController::class, 'user_reg_step2'])->name('user_reg_step2');
    Route::any('/profile', [\App\Http\Controllers\VGuideController::class, 'user_reg_step3'])->name('user_reg_step3');
    Route::any('/complete', [\App\Http\Controllers\VGuideController::class, 'user_reg_step4'])->name('user_reg_step4');
    Route::any('/lose/find_id', [\App\Http\Controllers\VGuideController::class, 'user_lose_id'])->name('user_lose_id');
    Route::any('/lose/find_pwd', [\App\Http\Controllers\VGuideController::class, 'user_lose_pwd'])->name('user_lose_pwd');
});

Route::get('/news/view', [\App\Http\Controllers\VGuideController::class, 'view'])->name('view');
Route::get('/news', [\App\Http\Controllers\VGuideController::class, 'news'])->name('news');

Route::get('/_xml/gamemoney_avg',[\App\Http\Controllers\VSellController::class, 'gamemoney_avg']);
Route::get('/angel_export_xml',[\App\Http\Controllers\AdminController::class, 'exportXML']);
Route::get('/box_chatting',[\App\Http\Controllers\VMainController::class, 'box_chatting']);

