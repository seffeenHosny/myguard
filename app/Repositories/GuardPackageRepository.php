<?php

namespace App\Repositories;

use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\SubscribeGuardPackage;
use Illuminate\Database\Eloquent\Model;
class GuardPackageRepository
{
    use CrudTrait, ResponseTraits, MainTrait;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->indexTrait($this->model);
    }

    public function show($id)
    {
        return $this->showTrait($this->model, $id);
    }

    public function store($request){
        $data = $request->except('_method' , '_token');
        return $this->storeTrait($this->model ,$data);
    }

    public function update($id, $request){
        $data = $request->except('_method' , '_token');
        return $this->updateTrait($this->model, $id, $data);
    }

    public function destroy($id)
    {
        return $this->destroyTrait($this->model, $id);
    }

    public function subscribeGuardPackages(){
        return SubscribeGuardPackage::where('user_id' , auth()->user()->id)
                                    ->where('status' , 'active')
                                    ->with('guard_package')
                                    ->get();
    }

}
