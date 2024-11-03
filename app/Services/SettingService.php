<?php

namespace App\Services;

use App\Models\Setting;
use App\Utils\ImageUpload;
use Illuminate\Support\Facades\DB;

class SettingService
{
    public function changeSettings(array $data)
    {
        return DB::transaction(function () use ($data) {
            $setting = Setting::findOrFail(1);

            $setting->update([
                'name' => $data['name'],
                'phone' => $data['phone'] ?? $setting->phone,
                'email' => $data['email'] ?? $setting->email,
                'facebook' => $data['facebook'] ?? $setting->facebook,
                'instagram' => $data['instagram'] ?? $setting->instagram,
                'linkedin' => $data['linkedin'] ?? $setting->linkedin,
                'whatsapp' => $data['whatsapp'] ?? $setting->whatsapp,
                'logo' => isset($data['logo']) ? ImageUpload::uploadImage($data['logo'], 'images/settings') : $setting->logo,
            ]);

            $translationEn = $setting->translations()->where('locale', 'en')->first();
            $translationAr = $setting->translations()->where('locale', 'ar')->first();

            $setting->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'address' => $data['address_en'] ?? $translationEn->address,
                    'footer_description' => $data['footer_description_en'] ?? $translationEn->footer_description,
                ]
            );

            $setting->translations()->updateOrCreate(
                ['locale' => 'ar'],
                [
                    'address' => $data['address_ar'] ?? $translationAr->address,
                    'footer_description' => $data['footer_description_ar'] ?? $translationAr->footer_description,
                ]
            );

            return $setting;
        });
    }
}
