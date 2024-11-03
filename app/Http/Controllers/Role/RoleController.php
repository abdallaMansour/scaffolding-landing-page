<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json(RoleResource::collection($roles));
    }

    public function show ($roleId) {
        try {
            return  response()->json(new RoleResource(Role::findOrFail($roleId)));
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->all());

            $role->translateOrNew('ar')->display_name = $request->display_name_ar;
            $role->translateOrNew('en')->display_name = $request->display_name_en;

            $role->save();

            $unique_permission = array_unique($request->permissions);

            for ($i = 0; $i < count($unique_permission); $i++) {
                DB::table('permission_role')->insert([
                    'permission_id' => $unique_permission[$i],
                    'role_id' => $role->id
                ]);
            }

            DB::commit();
            return response()->json(new RoleResource($role), 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return  response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(UpdateRoleRequest $request, $roleId)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($roleId);

            if (!$role) {
                return response()->json(['message' => 'Role not found'], 404);
            }

            $role->translateOrNew('ar')->display_name = $request->display_name_ar;
            $role->translateOrNew('en')->display_name = $request->display_name_en;
            $role->save();

            $unique_permission = array_unique($request->permissions);

            DB::table('permission_role')->where('role_id' , $roleId)->delete();

            for ($i = 0; $i < count($unique_permission); $i++) {
                DB::table('permission_role')->insert([
                    'permission_id' => $unique_permission[$i],
                    'role_id' => $role->id
                ]);
            }

            DB::commit();
            return response()->json(new RoleResource($role));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => 'you have error on update role',
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function destroy($roleId)
    {
        try {
            $role = Role::find($roleId);

            if (!$role) {
                return  response()->json(['message' => 'Role not found'], 404);
            }

            $role->deleteTranslations();
            $role->delete();

            return response()->json(['message' => 'Role deleted successfully']);
        } catch (\Throwable $th) {

            return  response()->json([
                'error' => 'you have error on delete role',
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
