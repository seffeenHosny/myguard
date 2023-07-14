<?php

namespace App\Repositories;

use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Helpers\FileHelper;

class NewsRepository
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

    public function indexWithRelation($relation , $select=null)
    {
        return $this->indexWithRelationTrait($this->model , $relation , $select);
    }

    public function show($id)
    {
        return $this->showTrait($this->model, $id);
    }

    public function store($request){
        $data = $request->except('_method' , '_token');
        $news = $this->storeTrait($this->model ,$data);
        if($request->has('main_image')){
            $image_path = FileHelper::upload_file('news/'.$news->id, $request->main_image);
            $news->main_image = $image_path;
            $news->save();
        }
        if($request->has('images')){
            foreach ($request->images as $image) {
                $image_path = FileHelper::upload_file('news/'.$news->id , $image);
                $newsImage = new Image();
                $newsImage->path = $image_path;
                $news->images()->save($newsImage);
            }
        }
        return $news;

    }

    public function update($id, $request){
        $data = $request->except('_method' , '_token' , 'delete_images' , 'images' , 'main_image');

        $news = $this->updateTrait($this->model, $id, $data);
        if($request->has('main_image')){
            $image_path = FileHelper::update_file('news/'.$news->id, $request->main_image , $news->main_image);
            $news->main_image = $image_path;
            $news->save();
        }
        if($request->has('delete_images')){
            if($request->delete_images != null){
                $ids = explode(',' ,$request->delete_images);
                foreach($ids as $id){
                    $image = Image::where('id' , $id)->first();
                    FileHelper::delete_picture($image->path);
                    $image->delete();
                }
            }
        }
        if($request->has('images')){
            foreach ($request->images as $image) {
                $image_path = FileHelper::upload_file('news/'.$news->id , $image);
                $newsImage = new Image();
                $newsImage->path = $image_path;
                $news->images()->save($newsImage);
            }
        }
        return $news;
    }

    public function destroy($id)
    {
        $news = $this->model->where('id' , $id)->first();
        $news->images()->delete();
        FileHelper::deleteDirectory('news/'.$id);
        return $this->destroyTrait($this->model, $id);
    }

}
