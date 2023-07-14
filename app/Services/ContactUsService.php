<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\ContactUs;
use App\Repositories\ContactUsRepository;
use Auth;

class ContactUsService
{

    protected $ContactUs;
    public function __construct(ContactUs $ContactUs)
    {
        $this->ContactUs = new ContactUsRepository($ContactUs);
    }

    public function index()
    {
        return $this->ContactUs->index();
    }

    public function store($request)
    {
        return $this->ContactUs->store($request);
    }

    public function show($id)
    {
        return $this->ContactUs->show($id);
    }

    
    public function destroy($id)
    {
        return $this->ContactUs->destroy($id);
    }

}
