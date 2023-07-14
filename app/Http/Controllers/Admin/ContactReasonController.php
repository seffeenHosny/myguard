<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactReasonRequest;
use App\Models\ContactReason;
use App\Services\ContactReasonService;
use Illuminate\Http\Request;

class ContactReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ContactReasonService;
    public function __construct(ContactReasonService $ContactReasonSer)
    {
        $this->ContactReasonService = $ContactReasonSer;
    }

    public function index()
    {
        $data = $this->ContactReasonService->index();
        return view('admin.contact_reasons.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact_reasons.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactReasonRequest $request)
    {
        $this->ContactReasonService->store($request);
        session()->flash('success' , trans('admin.contact_reason-add-message'));
        return redirect()->route('contact_reasons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactReason $contact_reason)
    {
        return view('admin.contact_reasons.show' , compact('contact_reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactReason $contact_reason)
    {
        return view('admin.contact_reasons.edit' , compact('contact_reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactReasonRequest $request, ContactReason $contact_reason)
    {
        $this->ContactReasonService->update( $contact_reason->id , $request);
        session()->flash('success' , trans('admin.contact_reason-edit-message'));
        return redirect()->route('contact_reasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactReason $contact_reason)
    {
        $this->ContactReasonService->destroy( $contact_reason->id);
        session()->flash('success' , trans('admin.contact_reason-delete-message'));
        return redirect()->route('contact_reasons.index');
    }
}
