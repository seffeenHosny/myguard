<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\TechnicalSupport;
use App\Repositories\TechnicalSupportRepository;
use Auth;

class TechnicalSupportService
{

    protected $TechnicalSupport;
    public function __construct(TechnicalSupport $TechnicalSupport)
    {
        $this->TechnicalSupport = new TechnicalSupportRepository($TechnicalSupport);
    }

    public function index()
    {
        return $this->TechnicalSupport->index();
    }

    public function store($request)
    {
        return $this->TechnicalSupport->store($request);
    }

    public function show($id)
    {
        return $this->TechnicalSupport->show($id);
    }

    public function update($id, $request)
    {
        return $this->TechnicalSupport->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->TechnicalSupport->destroy($id);
    }

}
