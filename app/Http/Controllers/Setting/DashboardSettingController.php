<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Setting\SettingRepository;
use App\Http\Requests\Settings\UpdateSettingsRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Resources\Setting\DashboardSettingResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardSettingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * SettingController constructor.
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the specified resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        return new DashboardSettingResource(Setting::first());
    }

    /**
     * Show the specified resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateSettingsRequest $request)
    {
        return $this->repository->update('no id', $request->all());
    }
}
