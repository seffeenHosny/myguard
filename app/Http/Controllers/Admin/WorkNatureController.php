<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkNatureRequest;
use App\Models\WorkNature;
use App\Services\WorkNatureService;
use Illuminate\Http\Request;

class WorkNatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $WorkNatureService;
    public function __construct(WorkNatureService $WorkNatureSer)
    {
        $this->WorkNatureService = $WorkNatureSer;
    }

    public function index()
    {
        $data = $this->WorkNatureService->index();
        return view('admin.work_natures.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.work_natures.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkNatureRequest $request)
    {
        $this->WorkNatureService->store($request);
        session()->flash('success' , trans('admin.work_nature-add-message'));
        return redirect()->route('work_natures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WorkNature $work_nature)
    {
        return view('admin.work_natures.show' , compact('work_nature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkNature $work_nature)
    {
        return view('admin.work_natures.edit' , compact('work_nature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkNatureRequest $request, WorkNature $work_nature)
    {
        $this->WorkNatureService->update( $work_nature->id , $request);
        session()->flash('success' , trans('admin.work_nature-edit-message'));
        return redirect()->route('work_natures.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkNature $work_nature)
    {
        $this->WorkNatureService->destroy( $work_nature->id);
        session()->flash('success' , trans('admin.work_nature-delete-message'));
        return redirect()->route('work_natures.index');
    }
}
