<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\JopCondition;
use App\Repositories\JopConditionRepository;
use Auth;

class JopConditionService
{

    protected $JopCondition;
    public function __construct(JopCondition $JopCondition)
    {
        $this->JopCondition = new JopConditionRepository($JopCondition);
    }

    public function index()
    {
        return $this->JopCondition->index();
    }

    public function indexWhere($where)
    {
        return $this->JopCondition->indexWhere( $where);
    }

    public function store($request)
    {
        return $this->JopCondition->store($request);
    }

    public function show($id)
    {
        return $this->JopCondition->show($id);
    }

    public function update($id, $request)
    {
        return $this->JopCondition->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->JopCondition->destroy($id);
    }

}
