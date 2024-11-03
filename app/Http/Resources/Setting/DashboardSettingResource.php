<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translationEn = $this->translations->where('locale', 'en')->first();
        $translationAr = $this->translations->where('locale', 'ar')->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'whatsapp' => $this->whatsapp,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'x' => $this->x,
            'logo' => $this->getFirstMediaUrl(),
            'translate_description_en' => $translationEn ? $translationEn->footer_description : null,
            'translate_description_ar' => $translationAr ? $translationAr->footer_description : null,
            'translate_address_en' => $translationEn ? $translationEn->address : null,
            'translate_address_ar' => $translationAr ? $translationAr->address : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
