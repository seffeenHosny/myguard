<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Services\TechnicalSupportService;
use App\Services\ContactReasonService;
use App\Services\ContactUsService;
use Illuminate\Http\Request;

class CompanyTechnicalSupportController extends Controller
{
    protected $TechnicalSupportService;
    protected $ContactReasonService;
    protected $ContactUsService;
    public function __construct(TechnicalSupportService $TechnicalSupportSer , ContactReasonService $ContactReasonSer , ContactUsService $ContactUsSer)
    {
        $this->TechnicalSupportService = $TechnicalSupportSer;
        $this->ContactReasonService = $ContactReasonSer;
        $this->ContactUsService = $ContactUsSer;
    }

    public function index()
    {
        $data = $this->TechnicalSupportService->index();
        $contact_reasons = $this->ContactReasonService->index()->pluck('reason' , 'id');
        return view('company.technical_supports.index' , compact('contact_reasons'));
    }

    public function store(ContactUsRequest $request)
    {
        $this->ContactUsService->store($request);
        session()->flash('success' , trans('admin.contact_us-add-message'));
        return redirect()->route('company.technical_supports');
    }
}
