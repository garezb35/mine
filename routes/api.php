<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function(){

    Route::prefix('admin')->group(function(){
        Route::post('servers',[\App\Http\Controllers\AdminController::class, 'getServers']);
        Route::post('order_control',[\App\Http\Controllers\AdminController::class, 'order_control']);
        Route::post('controlOrder',[\App\Http\Controllers\AdminController::class, 'controlOrder']);
        Route::post('deleteOrderRequest',[\App\Http\Controllers\AdminController::class,'deleteOrderRequest'])->name('deleteOrderRequest');
        Route::post('deleteNotice',[\App\Http\Controllers\AdminController::class,'deleteNotice'])->name('deleteNotice');
        Route::post('insertPin',[\App\Http\Controllers\AdminController::class,'insertPin'])->name('insertPin');
        Route::post('checkNotice',[\App\Http\Controllers\AdminController::class,'checkNotice'])->name('checkNotice');
        Route::post('deleteNoticeAdmin',[\App\Http\Controllers\AdminController::class,'deleteNoticeAdmin'])->name('deleteNoticeAdmin');
        Route::post('stopShops',[\App\Http\Controllers\AdminController::class,'stopShops'])->name('stopShops');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('game_list',[\App\Http\Controllers\VAjaxController::class, 'game_list']);
    Route::post('servers',[\App\Http\Controllers\AdminController::class, 'getServers']);
    Route::post('third_category',[\App\Http\Controllers\VAjaxController::class,'third_category'])->name('third_category');
    Route::post('processUsing',[\App\Http\Controllers\VCustomerController::class,'processUsing'])->name('processUsing');
    Route::post('frm_game',[\App\Http\Controllers\VCustomerController::class,'frm_game'])->name('frm_game');
    Route::post('processReportEnd',[\App\Http\Controllers\VCustomerController::class,'processReportEnd'])->name('processReportEnd');
    Route::post('/_include/_SafetyNumber_Category_Check_AJAX',[\App\Http\Controllers\ManiaController::class,'checkSafety']);
    Route::post('/_include/_get_free_use',[\App\Http\Controllers\ManiaController::class,'getFreeUse']);
    Route::post('/power/_AJAX_power_check',[\App\Http\Controllers\ManiaController::class,'getPowerCheck']);
    Route::post('/sell/include/index_template', [\App\Http\Controllers\ManiaController::class,'getSellIndexTemplate']);
    Route::post('/lineagem/_ajax_item_all', [\App\Http\Controllers\ManiaController::class,'getAjaxItemAll']);
    Route::post('/_include/_user_contact_restrict', [\App\Http\Controllers\ManiaController::class,'getUserContactRestrict']);
    Route::post('/sell/include/reg_info', [\App\Http\Controllers\ManiaController::class,'getRegInfo']);
    Route::post('/sell/include/reg_info_character', [\App\Http\Controllers\ManiaController::class,'getRegInfoCharacter']);
    Route::post('/buy/include/reg_info_character', [\App\Http\Controllers\ManiaController::class,'getRegInfoCharacterBuy']);
    Route::post('/lineagem/_ajax_item_desc', [\App\Http\Controllers\ManiaController::class,'getAjaxItemDesc']);
    Route::post('/_include/_remocon_mileage', [\App\Http\Controllers\ManiaController::class,'getRemoconMileage']);
    Route::post('ajax_list_search',[\App\Http\Controllers\VAjaxController::class, 'ajax_list_search']);
    Route::post('ajax_list',[\App\Http\Controllers\VAjaxController::class, 'ajax_list']);
    Route::post('/buy/include/index_template', [\App\Http\Controllers\VBuyController::class,'getSellIndexTemplate']);
    Route::post('/myroom/customer/search_add',[\App\Http\Controllers\ManiaController::class,'search_add']);
    Route::post('/myroom/customer/search_delete',[\App\Http\Controllers\ManiaController::class,'search_delete']);
    Route::get('/mySearch',[\App\Http\Controllers\ManiaController::class,'getMySearch']);
    Route::get('/favoritedgames',[\App\Http\Controllers\ManiaController::class,'favoritedgames']);
    Route::post('_include/_list_search.ajax',[\App\Http\Controllers\ManiaController::class,'list_search_ajax']);
    Route::post('/ajax_trade_check',[\App\Http\Controllers\ManiaController::class,'ajax_trade_check']);
    Route::post('/myroom/message/view',[\App\Http\Controllers\VAjaxController::class,'message_view']);
    Route::post('/myroom/message/delete',[\App\Http\Controllers\VAjaxController::class,'message_delete']);
    Route::post('_ajax/my_service',[\App\Http\Controllers\VAjaxController::class,'my_service']);

    Route::post('/myroom/chat/msg_get',[\App\Http\Controllers\VAjaxController::class,'msg_get']);
    Route::post('/myroom/chat/msg_encrypt',[\App\Http\Controllers\VAjaxController::class,'msg_encrypt']);

    Route::post('/mileage/charge/proc', [\App\Http\Controllers\VMyRoomController::class, 'mileage_payment_charge_proc'])->name('mileage_payment_charge_proc');
    Route::post('/mileage/exchange/proc', [\App\Http\Controllers\VMyRoomController::class, 'mileage_payment_exchange_proc'])->name('mileage_payment_exchange_proc');
    Route::post('/_include/quicklinkuser',[\App\Http\Controllers\VAjaxController::class, 'quicklinkuser_home']);
    Route::post('/_xslt/gamelist.xsl', [\App\Http\Controllers\VAjaxController::class, 'gamelist']);
    Route::get('/angel/_xml/gamelist.xml', [\App\Http\Controllers\VAjaxController::class, 'gamelist_xml']);
    Route::get('/_xml/serverlist', [\App\Http\Controllers\VAjaxController::class, 'serverlist']);
    Route::get('/angel/_xslt/serverlist.xsl',[\App\Http\Controllers\VAjaxController::class, 'serverlist_xsl']);

    Route::get('/m_angle/bookmark',[\App\Http\Controllers\VAjaxController::class, 'bookmark']);

    Route::prefix('admin')->group(function () {
        Route::post('/graphOrdersByYear', [\App\Http\Controllers\AdminController::class, 'graphOrdersByYear']);
    });
});

Route::get('/sell/include/index_template', [\App\Http\Controllers\VSellController::class, 'ajax_template']);
Route::get("/json/gameserverlist.json",[\App\Http\Controllers\ManiaController::class,'gameList']);

/**
 * Created api by Jong
 */
Route::post('/quicklinkuser', [\App\Http\Controllers\VAjaxController::class, 'quicklinkuser']);
Route::get('/character', [\App\Http\Controllers\VAjaxController::class, 'character']);
Route::get('_xml/gamemoney_avg.xml' ,[\App\Http\Controllers\VAjaxController::class, 'gamemoney_avg']);
Route::post('getGamesByAjax',[\App\Http\Controllers\VAjaxController::class, 'getGamesByAjax']);
