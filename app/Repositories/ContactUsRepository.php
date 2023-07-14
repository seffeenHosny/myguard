<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Model;
class ContactUsRepository
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
        $data = $request->except('_method' , '_token' , 'file' , 'type');
        if($request->hasFile('file')){
            $filePath = FileHelper::upload_file('contact_us/' , $request->file);
            $data['file'] = $filePath;
            $data['type'] = $request->type;
        }
        $data['user_id'] = auth()->user()->id;
        return $this->storeTrait($this->model ,$data);
    }

    public function destroy($id)
    {
        return $this->destroyTrait($this->model, $id);
    }

}
