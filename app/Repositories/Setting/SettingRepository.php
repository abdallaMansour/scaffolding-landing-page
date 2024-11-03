<?php

namespace App\Repositories\Setting;

use Exception;
use App\Models\Setting;
use App\Contracts\CrudRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Contact\DashboardSettingResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettingRepository implements CrudRepository
{

    /**
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return new DashboardSettingResource(Setting::first());
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find($model)
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return Model|Setting|void
     */
    public function update($setting_id, array $data)
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
                'site_name:ar'          => $data['site_name_ar']          ?? null,
                'footer_description:en' => $data['footer_description_en'] ?? null,
                'site_name:en'          => $data['site_name_en']          ?? null,
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

    /**
     * @param mixed $model
     * @throws Exception
     */
    public function delete($model)
    {
        return response()->json(['message' => 'Not found'], 404);
    }
}
