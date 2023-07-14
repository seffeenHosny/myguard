<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\City;
use App\Repositories\CityRepository;
use Auth;

class CityService
{

    protected $City;
    public function __construct(City $City)
    {
        $this->City = new CityRepository($City);
    }

    public function index()
    {
        return $this->City->index();
    }

    public function store($request)
    {
        return $this->City->store($request);
    }

    public function show($id)
    {
        return $this->City->show($id);
    }

    public function update($id, $request)
    {
        return $this->City->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->City->destroy($id);
    }

}
