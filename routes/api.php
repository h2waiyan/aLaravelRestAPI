<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\VolController;
use App\Http\Controllers\PatientsController;

// route - api/user
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => ['api', 'cors'],
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::group([
    'middleware' => 'auth',
], function ($router) {

    // accounts
    Route::get('accounts', [AccountsController::class, 'index']);
    Route::post('accounts', [AccountsController::class, 'store']);
    Route::get('accounts/{id}', [AccountsController::class, 'show']);
    Route::put('accounts/{id}/edit', [AccountsController::class, 'edit']);
    Route::delete('accounts/{id}/delete', [AccountsController::class, 'destroy']);

    // volunteers
    Route::get('volunteers', [VolController::class, 'index']);
    Route::post('volunteers', [VolController::class, 'store']);
    Route::get('volunteers/{id}', [VolController::class, 'show']);
    Route::put('volunteers/{id}/edit', [VolController::class, 'edit']);
    Route::delete('volunteers/{id}/delete', [VolController::class, 'destroy']);

    // patients
    Route::get('patients', [PatientsController::class, 'index']);
    Route::post('patients', [PatientsController::class, 'store']);
    Route::get('patients/{id}', [PatientsController::class, 'show']);
    Route::put('patients/{id}/edit', [PatientsController::class, 'edit']);
    Route::delete('patients/{id}/delete', [PatientsController::class, 'destroy']);
});
