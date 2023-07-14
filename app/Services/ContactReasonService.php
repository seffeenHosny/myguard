<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\ContactReason;
use App\Repositories\ContactReasonRepository;
use Auth;
class ContactReasonService
{

    protected $ContactReason;
    public function __construct(ContactReason $ContactReason)
    {
        $this->ContactReason = new ContactReasonRepository($ContactReason);
    }

    public function index()
    {
        return $this->ContactReason->index();
    }

    public function store($request)
    {
        return $this->ContactReason->store($request);
    }

    public function show($id)
    {
        return $this->ContactReason->show($id);
    }

    public function update($id, $request)
    {
        return $this->ContactReason->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->ContactReason->destroy($id);
    }

}
