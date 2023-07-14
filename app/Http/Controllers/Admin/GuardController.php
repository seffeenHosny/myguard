<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;

class GuardController extends Controller
{
    protected $UserService;
    public function __construct(UserService $UserSer)
    {
        $this->UserService = $UserSer;
    }
    public function index()
    {
        $data = $this->UserService->getUsersWhereType('guard');
        return view('admin.guards.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guards.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->UserService->storeUser($request);
        session()->flash('success' , trans('admin.guard-add-message'));
        return redirect()->route('guards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $guard)
    {
        $data = $this->UserService->showUser($guard->id);
        $guardPackages = $data->subscribe_guard_packages->where('status' , 'active');
        if(count($guardPackages) > 0){
            foreach($guardPackages as $package){
                $packageDays = $package->guard_package->no_of_days;
                $fDate = new DateTime($package->created_at);
                $tDate = new DateTime();
                $interval = $fDate->diff($tDate);
                $days = $interval->format('%a');
                $reminder[] = $packageDays - $days;
            }
            $data->subscribe_package_days = max($reminder);
        }else{
            $data->subscribe_package_days = 0;
        }
        return view('admin.guards.show' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $guard)
    {
        $data = $this->UserService->showUser($guard->id);
        return view('admin.guards.edit' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $guard)
    {
        $this->UserService->updateUser($guard->id , $request);
        session()->flash('success' , trans('admin.guard-edit-message'));
        return redirect()->route('guards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $guard)
    {
        $this->UserService->destroyUser($guard->id);
        session()->flash('success' , trans('admin.guard-delete-message'));
        return redirect()->route('guards.index');
    }
}
