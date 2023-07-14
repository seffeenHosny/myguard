<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeImage;
use App\Services\CityService;
use App\Services\DistrictService;
use App\Services\JopConditionService;
use App\Services\NewsService;
use App\Services\SettingService;
use App\Services\TechnicalSupportService;
use App\Services\WorkNatureService;
use App\Services\ContactReasonService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    protected $CityService;
    protected $DistrictService;
    protected $TechnicalSupportService;
    protected $SettingService;
    protected $NewsService;
    protected $JopConditionService;
    protected $WorkNatureService;
    protected $ContactReasonService;
    public function __construct(CityService $CitySer ,
                                DistrictService $DistrictSer ,
                                TechnicalSupportService $TechnicalSupportSer ,
                                SettingService $SettingSer ,
                                NewsService $NewsSer ,
                                JopConditionService $JopConditionSer ,
                                ContactReasonService $ContactReasonSer,
                                WorkNatureService $WorkNatureSer
                                )
    {
        $this->CityService = $CitySer;
        $this->DistrictService = $DistrictSer;
        $this->TechnicalSupportService = $TechnicalSupportSer;
        $this->SettingService = $SettingSer;
        $this->NewsService = $NewsSer;
        $this->JopConditionService = $JopConditionSer;
        $this->ContactReasonService = $ContactReasonSer;
        $this->WorkNatureService = $WorkNatureSer;
    }

    public function home(){
        $aboutUs = $this->SettingService->getSettingData('aboutUs' ,app()->getLocale() );
        $images = HomeImage::select('path' , 'type')->get();
        $news = $this->NewsService->indexWithRelation('images' , ['id' ,'imageable_id', 'path']);
        $data['about_us']=$aboutUs;
        $data['home_images']=$images;
        $data['news']=$news;
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.home'),'data'=>$data ], Response::HTTP_OK);
    }

    public function social(){
        $domain = $this->SettingService->getSettingData('domain' );
        $facebook = $this->SettingService->getSettingData('facebook');
        $twitter = $this->SettingService->getSettingData('twitter');
        $snapchat = $this->SettingService->getSettingData('snapchat');
        $instagram = $this->SettingService->getSettingData('instagram');
        $data['domain']=$domain;
        $data['facebook']=$facebook;
        $data['twitter']=$twitter;
        $data['snapchat']=$snapchat;
        $data['instagram']=$instagram;
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.social_media'),'data'=>$data ], Response::HTTP_OK);
    }

    public function technicalSupport(){
        $technicalSupport = $this->TechnicalSupportService->index()->pluck('phone');
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.technical_supports'),'data' => $technicalSupport], Response::HTTP_OK);
    }

    public function cities(){
        $cities = $this->CityService->index();
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.cities'),'data' => $cities], Response::HTTP_OK);
    }

    public function districts($id){
        $districts = $this->DistrictService->indexWhere(['city_id'=>$id]);
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.districts'),'data' => $districts], Response::HTTP_OK);
    }

    public function jobConditions($id){
        $job_conditions = $this->JopConditionService->indexWhere(['jop_type_id'=>$id]);
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.jop_conditions'),'data' => $job_conditions], Response::HTTP_OK);
    }

    public function contactReasons(){
        $data = $this->ContactReasonService->index();
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.contact_reasons'),'data' => $data], Response::HTTP_OK);
    }

    public function workNatures(){
        $data = $this->WorkNatureService->index();
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.work_natures'),'data' => $data], Response::HTTP_OK);
    }
}
