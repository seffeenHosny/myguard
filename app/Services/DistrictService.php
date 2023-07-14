<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\District;
use App\Repositories\DistrictRepository;
use Auth;

class DistrictService
{

    protected $District;
    public function __construct(District $District)
    {
        $this->District = new DistrictRepository($District);
    }

    public function index()
    {
        return $this->District->index();
    }

    public function indexWhere($where)
    {
        return $this->District->indexWhere( $where);
    }

    public function store($request)
    {
        return $this->District->store($request);
    }

    public function show($id)
    {
        return $this->District->show($id);
    }

    public function update($id, $request)
    {
        return $this->District->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->District->destroy($id);
    }

}
