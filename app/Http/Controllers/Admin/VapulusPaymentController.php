<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyPayWithVapulusRequest;
use App\Http\Requests\GuardPayWithVapulusRequest;
use App\Models\CompanyPackage;
use App\Models\GuardPackage;
use App\Models\SubscribeCompanyPackage;
use App\Models\SubscribeGuardPackage;
use App\Models\Transaction;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class VapulusPaymentController extends Controller
{
    private $secureHash;
    private $appID;
    private $password;

    public function __construct()
    {
        $this->secureHash = '6fd7d27e34353562626362632d343131';
        $this->appID = '738bdc3e-167e-4afb-aeb9-a3a535c8ac53';
        $this->password = '12345678A';
    }


    public function guardPayForm($packageId , $userId)
    {
        $package = $this->getGuardPackage($packageId);
        if(setting('tax') != null){
            $amount = $package->price + ($package->price*setting('tax') / 100) ;
        }else{
            $amount = $package->price;
        }
        return view('payment.guard.card', compact('packageId','amount' , 'userId'));
    }

    public function companyPayForm($packageId , $userId ,$package_type ,$no_of_cvs)
    {
        $package = $this->getCompanyPackage($packageId);
        if($package_type == 'single'){
            $price = $package->price * $no_of_cvs;
        }else{
            $price = $package->price;
        }

        if(setting('tax') != null){
            $amount = $price + ($price *setting('tax') / 100) ;
        }else{
            $amount = $price;
        }
        return view('payment.company.card', compact('packageId','amount' , 'userId' , 'package_type' , 'no_of_cvs'));
    }

    //https://repl.it/@islamvapulus/php-http-request-with-hashing
    function generateHash($hashSecret, $postData)
    {
        ksort($postData);
        $message = "";
        $appendAmp = 0;
        foreach ($postData as $key => $value) {
            if (strlen($value) > 0) {
                if ($appendAmp == 0) {
                    $message .= $key . '=' . $value;
                    $appendAmp = 1;
                } else {
                    $message .= '&' . $key . "=" . $value;
                }
            }
        }

        $secret = pack('H*', $hashSecret);
        return hash_hmac('sha256', $message, $secret);
    }

    function HTTPPost($url, array $params)
    {
        $query = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function guardPay(GuardPayWithVapulusRequest $request)
    {
        try{
            $package = $this->getGuardPackage($request->package_id);
            $user = $this->getUser($request->user_id);
            if(setting('tax') != null){
                $price = $package->price + ($package->price*setting('tax') / 100) ;
            }else{
                $price = $package->price;
            }
            $postData = array(
                'sessionId' => $request->sessionId,
                'mobileNumber' => $user->phone,
                'email' => $user->email ?? '',
                'amount' => $price,
                'firstName' => $user->name,
                'lastName' => $user->name,
                'onAccept' => url(route('vapulusPayment.guard.successCallback', ['package_id' => $request->package_id  , 'user_id'=>$request->user_id])),
                'onFail' => url(route('vapulusPayment.guard.failCallback', ['package_id' => $request->package_id , 'user_id'=>$request->user_id]))
            );

            $secureHash = $this->secureHash;
            $postData['hashSecret'] = $this->generateHash($secureHash, $postData);
            $postData['appId'] = $this->appID;
            $postData['password'] = $this->password;
            $url = 'https://api.vapulus.com:1338/app/session/pay';
            $response = $this->HTTPPost($url, $postData);
            $decodedResponse = json_decode($response);
            if ($decodedResponse->statusCode == 200) {
                $htmlBodyContent = $decodedResponse->data->htmlBodyContent;
                return view('payment.guard.payment', compact('htmlBodyContent'));
            } else {
                $decodedResponse = json_decode($response);
                return view('payment.guard.fail', compact('decodedResponse'));
            }
        } catch(\Exception $e){
            return back()->with('flash_error', 'Something went wrong');
        }

    }

    public function companyPay(CompanyPayWithVapulusRequest $request)
    {
        try{
            $package = $this->getCompanyPackage($request->package_id);
            $user = $this->getUser($request->user_id);
            if($request->package_type == 'single'){
                $price = $package->price *$request->no_of_cvs ;
            }else{
                $price = $package->price;
            }
            if(setting('tax') != null){
                $total_price = $price + ($price * setting('tax') / 100) ;
            }else{
                $total_price = $$price;
            }
            $postData = array(
                'sessionId' => $request->sessionId,
                'mobileNumber' => $user->phone,
                'email' => $user->email ?? '',
                'amount' => $total_price ,
                'firstName' => $user->name,
                'lastName' => $user->name,
                'onAccept' => url(route('vapulusPayment.company.successCallback', ['package_id' => $request->package_id  , 'user_id'=>$request->user_id , 'package_type'=> $request->package_type , 'no_of_cvs'=>$request->no_of_cvs])),
                'onFail' => url(route('vapulusPayment.company.failCallback', ['package_id' => $request->package_id , 'user_id'=>$request->user_id , 'package_type'=> $request->package_type , 'no_of_cvs'=>$request->no_of_cvs]))
            );

            $secureHash = $this->secureHash;
            $postData['hashSecret'] = $this->generateHash($secureHash, $postData);
            $postData['appId'] = $this->appID;
            $postData['password'] = $this->password;
            $url = 'https://api.vapulus.com:1338/app/session/pay';
            $response = $this->HTTPPost($url, $postData);
            $decodedResponse = json_decode($response);
            if ($decodedResponse->statusCode == 200) {
                $htmlBodyContent = $decodedResponse->data->htmlBodyContent;
                return view('payment.company.payment', compact('htmlBodyContent'));
            } else {
                $decodedResponse = json_decode($response);
                return view('payment.company.fail', compact('decodedResponse'));
            }
        } catch(\Exception $e){
            return back()->with('flash_error', 'Something went wrong');
        }

    }

    public function guardSuccessCallback($package_id, $user_id , Request $request)
    {
        if ($this->checkTranscationID($request->transactionId)) {
            $transaction = new Transaction();
            $package = $this->getGuardPackage($package_id);
            if(setting('tax') != null){
                $tax = $package->price * setting('tax') / 100 ;
            }else{
                $tax = 0;
            }
            $total_price = $tax + $package->price;
            $transaction->user_id = $user_id;
            $transaction->guard_package_id = $package_id;
            $transaction->transaction_id = $request->transactionId;
            $transaction->amount = $package->price;
            $transaction->price = $package->price;
            $transaction->tax = $tax;
            $transaction->total_price = $total_price;
            $transaction->status = $request->status;
            $transaction->type = 'guard';
            $transaction->save();
            $message = trans('admin.success_payment');
            SubscribeGuardPackage::create(['user_id'=>$user_id, 'guard_package_id'=>$package_id , 'status'=>'active' , 'price'=>$package->price , 'tax'=>$tax , 'total_price'=>$total_price]);
            return view('payment.guard.success_payment', compact('message'));
        }
        $message = trans('admin.failed_payment');
        return view('payment.guard.fail_payment', compact('message'));
    }

    public function companySuccessCallback($package_id, $user_id ,$package_type ,$no_of_cvs, Request $request)
    {
        if ($this->checkTranscationID($request->transactionId)) {
            $transaction = new Transaction();
            $package = $this->getCompanyPackage($package_id);
            $transaction->user_id = $user_id;
            $transaction->company_package_id = $package_id;
            $transaction->transaction_id = $request->transactionId;
            if($package_type == 'single'){
                $price = $package->price *$no_of_cvs ;
            }else{
                $price = $package->price;
            }
            if(setting('tax') != null){
                $tax = $price * setting('tax') / 100;
            }else{
                $tax=0;
            }
            $total_price = $price + $tax;
            $transaction->amount = $price;
            $transaction->price = $price;
            $transaction->tax = $tax;
            $transaction->total_price = $total_price;
            $transaction->status = $request->status;
            $transaction->type = 'company';
            $transaction->save();
            $message = trans('admin.success_payment');
            if($package_type == 'single'){
                SubscribeCompanyPackage::create(['user_id'=>$user_id, 'company_package_id'=>$package_id , 'status'=>'active' , 'rest_of_points'=>$no_of_cvs , 'price'=>$price , 'tax'=>$tax , 'total_price'=>$total_price]);
            }else{
                SubscribeCompanyPackage::create(['user_id'=>$user_id, 'company_package_id'=>$package_id , 'status'=>'active' , 'rest_of_points'=>$package->no_of_cvs, 'price'=>$price , 'tax'=>$tax , 'total_price'=>$total_price]);
            }
            return view('payment.company.success_payment', compact('message'));
        }
        $message = trans('admin.failed_payment');
        return view('payment.company.fail_payment', compact('message'));
    }

    public function guardFailCallback($package_id, $user_id , Request $request)
    {
        if ($this->checkTranscationID($request->transactionId)) {
            $transaction = new Transaction();
            $package = $this->getGuardPackage($package_id);
            if(setting('tax') != null){
                $tax = $package->price * setting('tax') / 100 ;
            }else{
                $tax = 0;
            }
            $total_price = $tax + $package->price;
            $transaction->user_id = $user_id;
            $transaction->guard_package_id = $package_id;
            $transaction->transaction_id = $request->transactionId;
            $transaction->amount = $package->price;
            $transaction->price = $package->price;
            $transaction->tax = $tax;
            $transaction->total_price = $total_price;
            $transaction->status = $request->status;
            $transaction->type = 'guard';
            $transaction->save();
        }
        $message = trans('admin.failed_payment');
        return view('payment.guard.fail_payment', compact('message'));
    }

    public function companyFailCallback($package_id, $user_id ,$package_type ,$no_of_cvs ,Request $request)
    {
        if ($this->checkTranscationID($request->transactionId)) {
            $transaction = new Transaction();
            $package = $this->getCompanyPackage($package_id);
            $transaction->user_id = $user_id;
            $transaction->company_package_id = $package_id;
            $transaction->transaction_id = $request->transactionId;
            if($package_type == 'single'){
                $price = $package->price *$no_of_cvs ;
            }else{
                $price = $package->price;
            }
            if(setting('tax') != null){
                $tax = $price * setting('tax') / 100;
            }else{
                $tax=0;
            }
            $total_price = $price + $tax;
            $transaction->amount = $price;
            $transaction->price = $price;
            $transaction->tax = $tax;
            $transaction->total_price = $total_price;
            $transaction->status = $request->status;
            $transaction->type = 'company';
            $transaction->save();
        }
        $message = trans('admin.failed_payment');
        return view('payment.company.fail_payment', compact('message'));
    }

    public function checkTranscationID($transcationID)
    {
        $postData = array(
            'transactionId' => $transcationID
        );
        $postData['hashSecret'] = $this->generateHash($this->secureHash, $postData);
        $postData['appId'] = $this->appID;
        $postData['password'] = $this->password;
        $url = 'https://api.vapulus.com:1338/app/transactionInfo';
        $response = $this->HTTPPost($url, $postData);
        $decodedResponse = json_decode($response);
        if ($decodedResponse->statusCode == 200) {
            return true;
        } else {
            return false;
        }
    }

    public function getGuardPackage($packageId){
        return GuardPackage::findOrFail($packageId);
    }

    public function getCompanyPackage($packageId){
        return CompanyPackage::findOrFail($packageId);
    }

    public function getUser($userId){
        return User::findOrFail($userId);
    }
}
