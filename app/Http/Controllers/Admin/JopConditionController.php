<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JopConditionRequest;
use App\Models\JopCondition;
use App\Models\JopType;
use App\Services\JopConditionService;
use Illuminate\Http\Request;

class JopConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $JopConditionService;
    public function __construct(JopConditionService $JopConditionSer)
    {
        $this->JopConditionService = $JopConditionSer;
    }

    public function index()
    {
        $data = $this->JopConditionService->index();
        return view('admin.jop_conditions.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job_types = JopType::all()->pluck('name' , 'id');
        return view('admin.jop_conditions.insert' , compact('job_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JopConditionRequest $request)
    {
        $this->JopConditionService->store($request);
        session()->flash('success' , trans('admin.jop_condition-add-message'));
        return redirect()->route('jop_conditions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JopCondition $jop_condition)
    {
        return view('admin.jop_conditions.show' , compact('jop_condition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JopCondition $jop_condition)
    {
        $job_types = JopType::all()->pluck('name' , 'id');
        return view('admin.jop_conditions.edit' , compact('jop_condition' , 'job_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JopConditionRequest $request, JopCondition $jop_condition)
    {
        $this->JopConditionService->update( $jop_condition->id , $request);
        session()->flash('success' , trans('admin.jop_condition-edit-message'));
        return redirect()->route('jop_conditions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JopCondition $jop_condition)
    {
        $this->JopConditionService->destroy( $jop_condition->id);
        session()->flash('success' , trans('admin.jop_condition-delete-message'));
        return redirect()->route('jop_conditions.index');
    }
}
