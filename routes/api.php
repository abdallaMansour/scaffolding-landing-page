<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    require __DIR__ . '/auth.php';
    require __DIR__ . '/roles.php';
    require __DIR__ . '/seo.php';
    require __DIR__ . '/contact_us.php';
    require __DIR__ . '/admin.php';
    require __DIR__ . '/setting.php';
    require __DIR__ . '/about_us.php';
});
