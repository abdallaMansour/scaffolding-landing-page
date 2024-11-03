<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Role\PermissionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::prefix('dashboard')->group(function () {

        Route::post('login', [LoginController::class, 'login']);

        Route::post('check-token', [LoginController::class, 'check_token']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [LoginController::class, 'logout']);
            
            Route::get('profile', [UserController::class, 'getProfile']);
            Route::post('/change-password', [UserController::class, 'changePassword']);
            Route::post('/change-image', [UserController::class, 'changeImage']);
            Route::post('/change-info', [UserController::class, 'changeInfo']);
            // Route::post('/settings/{settingId}', [SettingController::class, 'changeSettings']);
        });
        Route::prefix('roles')->middleware('hasPermission:role')->group(function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::get('/{role_id}', [RoleController::class, 'show']);
            Route::post('/', [RoleController::class, 'store']);
            Route::post('user-permission', [PermissionController::class, 'user_permission']);
            Route::post('/{roleId}', [RoleController::class, 'update']);
            Route::delete('/{roleId}', [RoleController::class, 'destroy']);
        });
        Route::prefix('permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index']);
            Route::post('/assign/{roleId}', [PermissionController::class, 'assign']);
        });
    });

    require __DIR__ . '/seo.php';
    require __DIR__ . '/contact_us.php';
    require __DIR__ . '/admin.php';
    require __DIR__ . '/setting.php';
});
