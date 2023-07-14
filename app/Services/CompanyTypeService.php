<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\CompanyType;
use App\Repositories\CompanyTypeRepository;
use Auth;

class CompanyTypeService
{

    protected $CompanyType;
    public function __construct(CompanyType $CompanyType)
    {
        $this->CompanyType = new CompanyTypeRepository($CompanyType);
    }

    public function index()
    {
        return $this->CompanyType->index();
    }

    public function store($request)
    {
        return $this->CompanyType->store($request);
    }

    public function show($id)
    {
        return $this->CompanyType->show($id);
    }

    public function update($id, $request)
    {
        return $this->CompanyType->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->CompanyType->destroy($id);
    }

}
