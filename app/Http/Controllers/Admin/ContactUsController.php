<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use App\Services\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ContactUsService;
    public function __construct(ContactUsService $ContactUsSer)
    {
        $this->ContactUsService = $ContactUsSer;
    }

    public function index()
    {
        $data = $this->ContactUsService->index();
        return view('admin.contact_us.index' , compact('data'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact_us = ContactUs::findOrFail($id);
        return view('admin.contact_us.show' , compact('contact_us'));
    }

}
