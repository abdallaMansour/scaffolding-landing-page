<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;
use App\Http\Requests\Settings\UpdateSettingsRequest;

class SettingController extends Controller
{
    /**
     * Show the specified resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        return new SettingResource(Setting::first());
    }


    public function logo()
    {
        return response()->json(['logo' => Setting::first()->getFirstMediaUrl()]);
    }
}
