<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Models\District;
use App\Services\CityService;
use App\Services\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $DistrictService;
    protected $CityService;
    public function __construct(DistrictService $DistrictSer , CityService $CitySer)
    {
        $this->DistrictService = $DistrictSer;
        $this->CityService = $CitySer;
    }

    public function index()
    {
        $data = $this->DistrictService->index();
        return view('admin.districts.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('admin.districts.insert' , compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $this->DistrictService->store($request);
        session()->flash('success' , trans('admin.district-add-message'));
        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        return view('admin.districts.show' , compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('admin.districts.edit' , compact('district' , 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        $this->DistrictService->update( $district->id , $request);
        session()->flash('success' , trans('admin.district-edit-message'));
        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $this->DistrictService->destroy( $district->id);
        session()->flash('success' , trans('admin.district-delete-message'));
        return redirect()->route('districts.index');
    }
}
