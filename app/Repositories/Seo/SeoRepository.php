<?php

namespace App\Repositories\Seo;

use Exception;
use App\Models\Seo;
use App\Contracts\CrudRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SeoRepository implements CrudRepository
{

    /**
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return response()->json(['error' => 'Not Found'], 404);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return response()->json(['error' => 'Not Found'], 404);
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find($model)
    {
        return response()->json(['error' => 'Not Found'], 404);
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return Model|Seo|void
     */
    public function update($seo_id, array $data)
    {
        $seo = Seo::where('name_id', $seo_id)->first();

        $dataToUpdate = [
            'title:ar' => $data['title_ar'],
            'title:en' => $data['title_en'],
            'description:ar' => $data['description_ar'],
            'description:en' => $data['description_en'],
            'keyword:ar' => $data['keyword_ar'],
            'keyword:en' => $data['keyword_en'],
        ];

        // Add additional fields for 'home' type if necessary
        if ($seo_id == 'home') {
            $dataToUpdate['site_name:ar'] = $data['site_name_ar'];
            $dataToUpdate['site_name:en'] = $data['site_name_en'];
        }

        if ($seo) {
            // Update existing record
            $seo->update($dataToUpdate);
        } else {
            // Create a new record
            Seo::create(array_merge(['name_id' => $seo_id], $dataToUpdate));
        }

        if (isset($data['image'])) {

            $seo->clearMediaCollection('image');

            $seo->addMedia($data['image'])->toMediaCollection('image');
        }

        if (isset($data['icon'])) {

            $seo->clearMediaCollection('icon');

            $seo->addMedia($data['icon'])->toMediaCollection('icon');
        }

        return $seo;
    }

    /**
     * @param mixed $model
     * @throws Exception
     */
    public function delete($model)
    {
        return response()->json(['error' => 'Not Found'], 404);
    }
}
