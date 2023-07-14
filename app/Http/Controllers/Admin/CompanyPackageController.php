<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyPackageRequest;
use App\Models\CompanyPackage;
use App\Services\CompanyPackageService;
use Illuminate\Http\Request;

class CompanyPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $CompanyPackageService;
    public function __construct(CompanyPackageService $CompanyPackageSer)
    {
        $this->CompanyPackageService = $CompanyPackageSer;
    }

    public function index()
    {
        $data = $this->CompanyPackageService->index();
        return view('admin.company_packages.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company_packages.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyPackageRequest $request)
    {
        $this->CompanyPackageService->store($request);
        session()->flash('success' , trans('admin.company_package-add-message'));
        return redirect()->route('company_packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyPackage $company_package)
    {
        return view('admin.company_packages.show' , compact('company_package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyPackage $company_package)
    {
        return view('admin.company_packages.edit' , compact('company_package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyPackageRequest $request, CompanyPackage $company_package)
    {
        $this->CompanyPackageService->update( $company_package->id , $request);
        session()->flash('success' , trans('admin.company_package-edit-message'));
        return redirect()->route('company_packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPackage $company_package)
    {
        $this->CompanyPackageService->destroy( $company_package->id);
        session()->flash('success' , trans('admin.company_package-delete-message'));
        return redirect()->route('company_packages.index');
    }
}
