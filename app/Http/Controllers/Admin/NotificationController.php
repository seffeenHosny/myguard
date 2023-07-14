<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use dev\Application\Utility\PushNotificationScreen;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $notifications = Notification::get();
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request){
        $tokens = User::where('fcm_token' , '!=' ,null)->pluck('fcm_token')->toArray();
        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
        ]);
        $this->push->sendPushNotification('multi', $tokens, $request->message,
            $request->title, null, $notification->id, '/');
        session()->flash('success', trans('admin.notification_add_message'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        session()->flash('success', trans('admin.notification_delete_message'));
        return redirect()->back();
    }
}


