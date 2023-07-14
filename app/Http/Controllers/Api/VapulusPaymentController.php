<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePayFomRequest;
use App\Http\Traits\ResponseTraits;
use App\Services\CompanyPackageService;
use App\Services\GuardPackageService;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class VapulusPaymentController extends Controller
{
    use ResponseTraits;

    private $GuardPackageService;
    private $CompanyPackageService;
    public function __construct(GuardPackageService $GuardPackageSer , CompanyPackageService $CompanyPackageSer ){
        $this->GuardPackageService = $GuardPackageSer;
        $this->CompanyPackageService = $CompanyPackageSer;
    }
    public function createPayForm(CreatePayFomRequest $request)
    {
        $priceData = [];
        if(setting('tax') != null){
            $priceData['tax_rate'] = setting('tax');
        }else{
            $priceData['tax_rate'] = "0" ;
        }
        $priceData['count'] = "0";
        $priceData['price_for_cv'] = "0";
        if($request->type == 'guard'){
            $package = $this->GuardPackageService->show($request->package_id);
            if($package->price > 0){
                $priceData['price_without_tax'] = $package->price;
                $priceData['tax_value'] = $priceData['price_without_tax'] * $priceData['tax_rate'] / 100;
                $priceData['price_with_tax'] = $priceData['price_without_tax'] + $priceData['tax_value'];
                $data = [
                    'data' => $package,
                    'data_price'=>$priceData,
                    "url" => url(route('vapulusPayment.guard.payForm', [$request->package_id , auth()->user()->id]))
                ];
            }else{
                $data = [
                    'data' => $package,
                    'data_price'=>null,
                    "url" => null
                ];
            }
        }elseif($request->type == 'company'){
            $package = $this->CompanyPackageService->show($request->package_id);
            if($package->price > 0){
                if($request->package_type == 'single'){
                    $priceData['count'] = $request->no_of_cvs;
                    $priceData['price_for_cv'] = $package->price;
                    $priceData['price_without_tax'] = $package->price * $request->no_of_cvs;
                    $priceData['tax_value'] = $priceData['price_without_tax'] * $priceData['tax_rate'] / 100;
                    $priceData['price_with_tax'] = $priceData['price_without_tax'] + $priceData['tax_value'];
                    $data = [
                        'data' => $package,
                        'data_price'=>$priceData,
                        "url" => url(route('vapulusPayment.company.payForm', [$request->package_id , auth()->user()->id , 'single' , $request->no_of_cvs]))
                    ];
                }else{
                    $priceData['price_without_tax'] = $package->price;
                    $priceData['tax_value'] = $priceData['price_without_tax'] * $priceData['tax_rate'] / 100;
                    $priceData['price_with_tax'] = $priceData['price_without_tax'] + $priceData['tax_value'];
                    $data = [
                        'data' => $package,
                        'data_price'=>$priceData,
                        "url" => url(route('vapulusPayment.company.payForm', [$request->package_id , auth()->user()->id , 'monthly' , 0]))
                    ];
                }
            }else{
                $data = [
                    'data' => $package,
                    'data_price'=>null,
                    "url" => null
                ];
            }
        }
        return response()->json(['status'=>1 , 'code'=>200 , 'message'=>trans('admin.pay'),'data'=>$data] ,Response::HTTP_OK);

    }
}
