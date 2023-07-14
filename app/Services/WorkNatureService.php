<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\WorkNature;
use App\Repositories\WorkNatureRepository;
use Auth;

class WorkNatureService
{

    protected $WorkNature;
    public function __construct(WorkNature $WorkNature)
    {
        $this->WorkNature = new WorkNatureRepository($WorkNature);
    }

    public function index()
    {
        return $this->WorkNature->index();
    }

    public function store($request)
    {
        return $this->WorkNature->store($request);
    }

    public function show($id)
    {
        return $this->WorkNature->show($id);
    }

    public function update($id, $request)
    {
        return $this->WorkNature->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->WorkNature->destroy($id);
    }

}
