<?php

namespace App\Http\Controllers\Seo;

use App\Models\Seo;
use App\Traits\ApiTrait;
use App\Helpers\PageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seo\SeoRequest;
use App\Repositories\Seo\SeoRepository;
use App\Http\Resources\Seo\DashboardSeoResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardSeoController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait, PageHelper;

    // private $pages = [
    //     'home',
    //     'about_us',
    //     'services',
    //     'shutter',
    //     'windows',
    //     'curtains',
    //     'images',
    //     'articles',
    //     'contact_us',
    // ];

    /**
     * @var SeoRepository
     */
    private $repository;

    /**
     * DashboardSeoController constructor.
     * @param SeoRepository $repository
     */
    public function __construct(SeoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seo = Seo::all();

        $seo = DashboardSeoResource::collection($seo);

        return $this->sendResponse($seo, 'success');
    }

    /**
     * Show the specified resource.
     * 
     * @param Seo $seo
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(string $page)
    {
        $seo = $this->getSeoPageDashboard($page);

        return $seo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $page, SeoRequest $request)
    {
        $data = $this->repository->update($page, $request->all());

        return $this->sendResponse($data, trans('seo::seo.messages.updated')) ;
    }
}
