<?php

use App\Models\UserNotification;

if(!function_exists('active_link')){
    function active_link($param1 , $param2 = null){
        if($param2 == null){
            if(preg_match('/'.$param1.'/i' , Illuminate\Support\Facades\Request::segment(1))){
                return 'active';
            }else{
                return '';
            }
        }else{
            if(
                preg_match('/'.$param1.'/i' , Illuminate\Support\Facades\Request::segment(1))
                &&
                preg_match('/'.$param2.'/i' , Illuminate\Support\Facades\Request::segment(2))
            ){
                return 'active';
            }else{
                return '';
            }
        }
    }
}

if(!function_exists('getDistanceBetweenTwoLocations')){
    function getDistanceBetweenTwoLocations($lat1, $lon1, $lat2, $lon2, $unit){
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

if(!function_exists('upToDigits')){
    function upToDigits($number){
        return (string)round($number, 2);
    }
}
if(!function_exists('getUserNotifications')){
    function getUserNotifications(){
        return UserNotification::with('notification')
                                ->where('user_id', auth()->user()->id)
                                ->where('is_read' , 0)
                                ->orderBy('id' , 'DESC')->get();
    }
}

