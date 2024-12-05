<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SettingRepository
{
    /**
     * @param mixed $model
     * @param array $data
     * @return Model|Setting|void
     */
    public function update(array $data)
    {
        try {
            DB::beginTransaction();

            $setting = Setting::first();
            $setting->update([
                'address:ar'            => $data['address_ar']            ?? null,
                'address:en'            => $data['address_en']            ?? null,
                'phone'                 => $data['phone']                 ?? null,
                'email'                 => $data['email']                 ?? null,
                'whatsapp'              => $data['whatsapp']              ?? null,
                'facebook'              => $data['facebook']              ?? null,
                'instagram'             => $data['instagram']             ?? null,
                'x'                     => $data['x']                     ?? null,
                'linkedin'              => $data['linkedin']              ?? null,
                'footer_description:ar' => $data['footer_description_ar'] ?? null,
                'footer_description:en' => $data['footer_description_en'] ?? null,
            ]);

            if (isset($data['logo'])) {
                $setting->clearMediaCollection();

                $setting->addMedia($data['logo'])->toMediaCollection();
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'setting updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
