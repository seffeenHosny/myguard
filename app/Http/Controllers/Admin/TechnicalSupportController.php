<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicalSupportRequest;
use App\Models\TechnicalSupport;
use App\Services\TechnicalSupportService;
use Illuminate\Http\Request;

class TechnicalSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $TechnicalSupportService;
    public function __construct(TechnicalSupportService $TechnicalSupportSer)
    {
        $this->TechnicalSupportService = $TechnicalSupportSer;
    }

    public function index()
    {
        $data = $this->TechnicalSupportService->index();
        return view('admin.technical_supports.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technical_supports.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnicalSupportRequest $request)
    {
        $this->TechnicalSupportService->store($request);
        session()->flash('success' , trans('admin.phone-add-message'));
        return redirect()->route('technical_supports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TechnicalSupport $technical_support)
    {
        return view('admin.technical_supports.show' , compact('technical_support'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TechnicalSupport $technical_support)
    {
        return view('admin.technical_supports.edit' , compact('technical_support'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TechnicalSupportRequest $request, TechnicalSupport $technical_support)
    {
        $this->TechnicalSupportService->update( $technical_support->id , $request);
        session()->flash('success' , trans('admin.phone-edit-message'));
        return redirect()->route('technical_supports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnicalSupport $technical_support)
    {
        $this->TechnicalSupportService->destroy( $technical_support->id);
        session()->flash('success' , trans('admin.phone-delete-message'));
        return redirect()->route('technical_supports.index');
    }
}
