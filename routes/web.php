<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmailController;
use App\Models\ApplicationType;
use App\Models\BusinessUnit;
use App\Models\ProductType;
use App\Models\ProductTypeCategory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ApplicationController::class, 'index']);

Route::post('/application/store', [ApplicationController::class, 'store']);
Route::post('/application/update', [ApplicationController::class, 'update']);

Route::get('/application/getProductTypeCategory',[ApplicationController::class, 'getProductTypeCategory']);
Route::get('/application/checkProductNo',[ApplicationController::class, 'checkProductNo']);

Route::get('/application/reply/{application}',[ApplicationController::class, 'reply']);
Route::get('/application/getUser', [ApplicationController::class, 'getUser']);

Route::post('/email/{application}', [EmailController::class, 'sendEmailRequirement']);
Route::get('/email/sendEmailBroadCastSubmitPermintaan/{application}', [EmailController::class, 'sendEmailBroadCastSubmitPermintaan']);


