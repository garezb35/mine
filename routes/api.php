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
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/_include/_SafetyNumber_Category_Check_AJAX',[\App\Http\Controllers\ManiaController::class,'checkSafety']);
    Route::post('/_include/_get_free_use',[\App\Http\Controllers\ManiaController::class,'getFreeUse']);
    Route::post('/power/_AJAX_power_check',[\App\Http\Controllers\ManiaController::class,'getPowerCheck']);
    Route::post('/sell/include/index_template', [\App\Http\Controllers\ManiaController::class,'getSellIndexTemplate']);
    Route::post('/lineagem/_ajax_item_all', [\App\Http\Controllers\ManiaController::class,'getAjaxItemAll']);
    Route::post('/_include/_user_contact_restrict', [\App\Http\Controllers\ManiaController::class,'getUserContactRestrict']);
    Route::post('/sell/include/reg_info', [\App\Http\Controllers\ManiaController::class,'getRegInfo']);
    Route::post('/sell/include/reg_info_character', [\App\Http\Controllers\ManiaController::class,'getRegInfoCharacter']);
    Route::post('/lineagem/_ajax_item_desc', [\App\Http\Controllers\ManiaController::class,'getAjaxItemDesc']);
    Route::post('/_include/_remocon_mileage', [\App\Http\Controllers\ManiaController::class,'getRemoconMileage']);
    Route::post('ajax_list_search',[\App\Http\Controllers\VAjaxController::class, 'ajax_list_search']);
    Route::post('ajax_list',[\App\Http\Controllers\VAjaxController::class, 'ajax_list']);
});

Route::get('/sell/include/index_template', [\App\Http\Controllers\VSellController::class, 'ajax_template']);
Route::get("/json/gameserverlist.json",[\App\Http\Controllers\ManiaController::class,'gameList']);
Route::get('/mySearch',[\App\Http\Controllers\ManiaController::class,'getMySearch']);
/**
 * Created api by Jong
 */
Route::post('/quicklinkuser', [\App\Http\Controllers\VAjaxController::class, 'quicklinkuser']);
Route::get('/character', [\App\Http\Controllers\VAjaxController::class, 'character']);

