<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\HomeImage;
use Illuminate\Http\Request;
use App\Models\User;
use Setting;
use App\Services\SettingService;
class SettingController extends Controller
{
    protected $SettingService;
    public function __construct(SettingService $SettingSer)
    {
        $this->SettingService = $SettingSer;
    }
    public function settings(){
        $images = HomeImage::where('type' , 'image')->get();
        $videos = HomeImage::where('type' , 'video')->get();
        return view('admin.settings.settings' , compact('images' , 'videos'));
    }

    public function update(SettingRequest $request){
        // dd($request->all());
        if($request->has('delete_images')){
            $deleteImage = explode(',',$request->delete_images);
            foreach($deleteImage as $image_id){
                $image = HomeImage::where('id' , $image_id)->first();
                if($image != null){
                    FileHelper::delete_picture($image->path);
                    $image->delete();
                }
            }
        }
        if($request->has('delete_videos')){
            $deleteVideo = explode(',',$request->delete_videos);
            foreach($deleteVideo as $video_id){
                $video = HomeImage::where('id' , $video_id)->first();
                if($video != null){
                    FileHelper::delete_picture($video->path);
                    $video->delete();
                }
            }
        }
        if($request->has('images')){
            foreach($request->images as $image){
                $image_path = FileHelper::upload_file('home' , $image);
                HomeImage::create(['path'=>$image_path]);
            }
        }
        if($request->has('videos')){
            foreach($request->videos as $video){
                $video_path = FileHelper::upload_file('home' , $video);
                HomeImage::create(['path'=>$video_path , 'type'=>'video']);
            }
        }
        $data = $request->except('_token');
        foreach($data as $i=>$item){
            Setting::set($i , $item);
        }
        Setting::save();
        session()->flash('success' , trans('admin.setting-edit-message'));
        return redirect()->back();
    }

    public function getPrivacy(){
        $data = $this->SettingService->getSettingData('policy' ,app()->getLocale() );
        return view('admin.settings.privacy', compact('data'));
    }

    public function getTerms(){
        $data = $this->SettingService->getSettingData('terms' ,app()->getLocale() );
        return view('admin.settings.terms', compact('data'));
    }

    public function changeLang($lang){
        $user = User::where('id' , auth()->user()->id)->first();
        $user->update(['lang'=>$lang]);
        return redirect()->back();
    }

}
