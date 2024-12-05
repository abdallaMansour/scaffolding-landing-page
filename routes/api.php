<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Role\PermissionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    require __DIR__ . '/auth.php';
    require __DIR__ . '/roles.php';
    require __DIR__ . '/seo.php';
    require __DIR__ . '/contact_us.php';
    require __DIR__ . '/admin.php';
    require __DIR__ . '/setting.php';
});
