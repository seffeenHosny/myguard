<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyTypeRequest;
use App\Models\CompanyType;
use App\Services\CompanyTypeService;
use Illuminate\Http\Request;

class CompanyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $CompanyTypeService;
    public function __construct(CompanyTypeService $CompanyTypeSer)
    {
        $this->CompanyTypeService = $CompanyTypeSer;
    }

    public function index()
    {
        $data = $this->CompanyTypeService->index();
        return view('admin.company_types.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company_types.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyTypeRequest $request)
    {
        $this->CompanyTypeService->store($request);
        session()->flash('success' , trans('admin.company_type-add-message'));
        return redirect()->route('company_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyType $company_type)
    {
        return view('admin.company_types.show' , compact('company_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyType $company_type)
    {
        return view('admin.company_types.edit' , compact('company_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyTypeRequest $request, CompanyType $company_type)
    {
        $this->CompanyTypeService->update( $company_type->id , $request);
        session()->flash('success' , trans('admin.company_type-edit-message'));
        return redirect()->route('company_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyType $company_type)
    {
        $this->CompanyTypeService->destroy( $company_type->id);
        session()->flash('success' , trans('admin.company_type-delete-message'));
        return redirect()->route('company_types.index');
    }
}
