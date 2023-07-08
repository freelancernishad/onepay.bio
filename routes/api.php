<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use  App\Http\Controllers\api\authController;
use App\Http\Controllers\NotificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [authController::class,'login']);
    Route::post('register', [authController::class,'register']);
    Route::post('logout', [authController::class,'logout']);
    Route::post('refresh', [authController::class,'refresh']);
    Route::post('me', [authController::class,'login']);

});

Route::get('user/{status}/{id}',[UserController::class,'userbanned']);
Route::resources([
    'user' => UserController::class,
    'payment' => PaymentController::class,
]);



    Route::post('/admin/deposit', function (Request $request) {
        $log = json_encode($request->all());
        Log::info($log);
    });


    Route::post('/set/account/{id}', function (Request $request,$id) {

        $data = $request->except(['bkash','nagad','rocket']);

        $data['bkash'] = json_encode($request->bkash);
        $data['nagad'] = json_encode($request->nagad);
        $data['rocket'] = json_encode($request->rocket);

        $user = User::find($id);
       $user->update($data);
     return $user;
    });


