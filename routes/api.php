<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\WebsiteController;

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

Route::prefix('v1')->group(function () {
    Route::apiResource('websites', WebsiteController::class)->only('index');
    Route::post('websites/{website}/subscribe', [WebsiteController::class, 'subscribe']);
    Route::apiResource('websites.posts', PostController::class)->only('index', 'store');
});
