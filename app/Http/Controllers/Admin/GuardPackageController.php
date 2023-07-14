<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardPackageRequest;
use App\Models\GuardPackage;
use App\Services\GuardPackageService;
use Illuminate\Http\Request;

class GuardPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $GuardPackageService;
    public function __construct(GuardPackageService $GuardPackageSer)
    {
        $this->GuardPackageService = $GuardPackageSer;
    }

    public function index()
    {
        $data = $this->GuardPackageService->index();
        return view('admin.guard_packages.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guard_packages.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardPackageRequest $request)
    {
        $this->GuardPackageService->store($request);
        session()->flash('success' , trans('admin.guard_package-add-message'));
        return redirect()->route('guard_packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GuardPackage $guard_package)
    {
        return view('admin.guard_packages.show' , compact('guard_package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GuardPackage $guard_package)
    {
        return view('admin.guard_packages.edit' , compact('guard_package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuardPackageRequest $request, GuardPackage $guard_package)
    {
        $this->GuardPackageService->update( $guard_package->id , $request);
        session()->flash('success' , trans('admin.guard_package-edit-message'));
        return redirect()->route('guard_packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuardPackage $guard_package)
    {
        $this->GuardPackageService->destroy( $guard_package->id);
        session()->flash('success' , trans('admin.guard_package-delete-message'));
        return redirect()->route('guard_packages.index');
    }
}
