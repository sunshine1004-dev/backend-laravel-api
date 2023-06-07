<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\GuardianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'newsapi'], function () {
    Route::post('/', [NewsApiController::class, 'getTopHeadlines']);
    Route::post('everything', [NewsApiController::class,'getEverything']);
    Route::post('/source', [NewsApiController::class, 'fetchAllNewsSources']);
});

Route::post('/guardian', [GuardianController::class, 'getArticles']);


// Route::post('login', [AuthController::class,'login']);
// Route::post('register', [AuthController::class,'register']);
// Route::get('/', [ApiController::class, 'displayNews']);
// Route::post('/sourceId', [ApiController::class, 'displayNews']);


Route::group(['middleware'=>'api'],function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});
