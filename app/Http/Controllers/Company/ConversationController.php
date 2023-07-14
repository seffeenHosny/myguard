<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateConversationRequest;
use App\Http\Requests\SendMessageRequest;
use App\Models\ConversationUser;
use App\Services\ConversationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    private $ConversationService;
    private $UserService;
    public function __construct(ConversationService $ConversationSer , UserService $UserSer){
        $this->ConversationService = $ConversationSer;
        $this->UserService = $UserSer;
    }


    public function index(){
        $conversations = $this->ConversationService->index();
        return view('company.conversations.index' , compact('conversations'));

    }

    public function companyConversationMessages($id){
        $conversations = $this->ConversationService->index();
        $messages = $this->ConversationService->companyConversationMessages($id);
        // if($messages == 'empty'){
        //     dd($messages);
        //     return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.messages'),'data'=>[] ]);
        // }
        if($messages){
            return view('company.conversations.messages' , compact('conversations' , 'messages' , 'id'));
        }else{
            return abort(404);
        }
    }

    public function store(CreateConversationRequest $request){
        $conversation = $this->ConversationService->store($request);
        return redirect()->route('conversations.messages' ,$conversation->id );
    }

    public function sendMessage(SendMessageRequest $request){
        $data = $this->ConversationService->sendMessage($request);
        if($data){
            $users = ConversationUser::where('conversation_id' , $request->conversation_id)->get();
            if($request->type == 'text'){
                $message = $request->message;
            }else{
                $message = trans('admin.new_message_body');
            }
            foreach($users as $user){
                $this->UserService->sendNotification($user->user_id, trans('admin.new_message_title'), $message , null ,'new_message');
            }
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.message_send'),'data'=>$data ]);
        }
    }
}
