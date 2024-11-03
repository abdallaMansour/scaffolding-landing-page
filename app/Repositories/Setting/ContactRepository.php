<?php

namespace App\Repositories\Setting;

use Exception;
use App\Models\Contact;
use App\Contracts\CrudRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Contact\DashboardContactResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactRepository implements CrudRepository
{

    /**
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return new DashboardContactResource(Contact::first());
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
     * @return Model|Contact|void
     */
    public function update($contact_id, array $data)
    {
        try {
            DB::beginTransaction();

            $contact = Contact::first();
            $contact->update([
                'address:ar' => $data['address_ar'] ?? null,
                'address:en' => $data['address_en'] ?? null,
                'phone'      => $data['phone']      ?? null,
                'email'      => $data['email']      ?? null,
                'whatsapp'   => $data['whatsapp']   ?? null,
                'facebook'   => $data['facebook']   ?? null,
                'instagram'  => $data['instagram']  ?? null,
                'x'          => $data['x']          ?? null,
                'linkedin'   => $data['linkedin']   ?? null,
            ]);

            DB::commit();
            return response()->json(['status' => true, 'message' => 'contact updated successfully']);
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
