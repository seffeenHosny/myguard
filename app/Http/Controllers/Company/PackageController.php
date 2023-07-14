<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePayFomRequest;
use App\Services\CompanyPackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    private $CompanyPackageService;
    public function __construct(CompanyPackageService $CompanyPackageSer ){
        $this->CompanyPackageService = $CompanyPackageSer;
    }

    public function index(){
        $data = $this->CompanyPackageService->index();
        return view('company.packages.index' , compact('data'));

    }

    public function subscribe(){
        $data = $this->CompanyPackageService->subscribeCompanyPackages();
        return view('company.packages.subscriptions' , compact('data'));
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

        $package = $this->CompanyPackageService->show($request->package_id);
        if($package->price > 0){
            if($request->package_type == 'single'){
                $priceData['count'] = $request->no_of_cvs;
                $priceData['price_for_cv'] = $package->price;
                $priceData['price_without_tax'] = $package->price * $request->no_of_cvs;
                $priceData['tax_value'] = $priceData['price_without_tax'] * $priceData['tax_rate'] / 100;
                $priceData['price_with_tax'] = $priceData['price_without_tax'] + $priceData['tax_value'];
                $url = route('vapulusPayment.company.payForm', [$request->package_id , auth()->user()->id , 'single' , $request->no_of_cvs]);
            }else{
                $priceData['price_without_tax'] = $package->price;
                $priceData['tax_value'] = $priceData['price_without_tax'] * $priceData['tax_rate'] / 100;
                $priceData['price_with_tax'] = $priceData['price_without_tax'] + $priceData['tax_value'];
                $url = route('vapulusPayment.company.payForm', [$request->package_id , auth()->user()->id , 'monthly' , 0]);
            }
            $data['price'] = $priceData;
            $data['package'] = $package;
            $data['url'] = $url;
            return redirect()->route('company.view.bill')->with('paymentData' , $data);
        }else{
            session()->flash('error' , trans('admin.something_went_wrong'));
            return redirect()->back();
        }
    }

    public function bill(){
        $data = session()->get('paymentData');
        if($data != null){
            return view('company.bills.index' , compact('data'));
        }else{
            return redirect()->route('company.packages');
        }
    }
}
