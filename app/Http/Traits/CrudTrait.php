<?php
namespace App\Http\Traits;

trait CrudTrait
{

    public function indexTrait($model)
    {
        return $model->orderBy('id', 'desc')->get();
    }

    public function indexWhereTrait($model , $where)
    {
        return $model->where($where)->orderBy('id', 'desc')->get();
    }

    public function indexWithRelationTrait($model, $relation , $select=null)
    {
        if($select != null){
            return $model->orderBy('id', 'desc')
                        ->with([$relation=>function($q) use ($select){return $q->select($select);}])
                        ->get();
        }
        return $model->orderBy('id', 'desc')->with($relation)->get();
    }

    public function indexWhitConditionTrait($model, $condition)
    {
        return $model->orderBy('id', 'desc')->where($condition)->get();
    }

    public function indexWithStatusTrait($model, $condition)
    {
        return $model->orderBy('id', 'desc')->where('status',$condition)->get();
    }

    public function indexWithConditionAndRelationTrait($model, $condition, $relation)
    {
        return $model->with($relation)->where($condition)->orderBy('id', 'desc')->get();
    }

    public function storeTrait($model, $data)
    {
        return $model::create($data);
    }
    public function showTrait($model, $id)
    {
        return $model->find($id);
    }
    public function showWithRelationTrait($model, $id, $relation)
    {
        return $model->where('id', $id)->with($relation)->first();
    }

    public function updateTrait($model, $id, $data)
    {
        $model::where('id', $id)->update($data);
        return $model::findOrFail($id);
    }

    public function destroyTrait($model, $id)
    {
        return $model->where('id', $id)->delete();
    }
    public function restoreTrait($model, $id)
    {
        return $model->where('id', $id)->restore();
    }

}
