<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Services\ContactUsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ContactUsController extends Controller
{
    protected $ContactUsService;
    public function __construct(ContactUsService $ContactUsSer)
    {
        $this->ContactUsService = $ContactUsSer;
    }


    public function store(ContactUsRequest $request)
    {
        $this->ContactUsService->store($request);
        session()->flash('success' , trans('admin.contact_us-add-message'));
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.contact_us-add-message'),'data'=>null ], Response::HTTP_OK);
    }
}
