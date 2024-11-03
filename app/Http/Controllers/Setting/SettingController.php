<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;
use App\Http\Requests\Settings\UpdateSettingsRequest;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }


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

    public function changeSettings(UpdateSettingsRequest $request)
    {
        $data = $request->validated();

        $setting = $this->settingService->changeSettings($data);

        return response()->json([
            'message' => 'Settings updated successfully.',
            'data' => new SettingResource($setting),
        ]);
    }
}
