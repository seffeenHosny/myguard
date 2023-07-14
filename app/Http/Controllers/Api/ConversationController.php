<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateConversationRequest;
use App\Http\Requests\SendMessageRequest;
use App\Models\ConversationUser;
use App\Services\ConversationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConversationController extends Controller
{
    private $ConversationService;
    private $UserService;
    public function __construct(ConversationService $ConversationSer , UserService $UserSer){
        $this->ConversationService = $ConversationSer;
        $this->UserService = $UserSer;
    }


    public function companyConversations(){
        if(auth()->user()->type == 'company'){
            $data = $this->ConversationService->index();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.conversations'),'data'=>$data ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function guardConversations(){
        if(auth()->user()->type == 'guard'){
            $data = $this->ConversationService->index();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.conversations'),'data'=>$data ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function companyConversationMessages($id){
        if(auth()->user()->type == 'company'){
            $messages = $this->ConversationService->companyConversationMessages($id);
            if($messages == 'empty'){
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.messages'),'data'=>[] ], Response::HTTP_OK);
            }
            if($messages){
                $data = [];
                foreach($messages as $k=>$message){
                    $data[$k]['date'] = $k;
                    $data[$k]['messages'] = $message;
                }
                $data = array_values($data);
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.messages'),'data'=>$data ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function guardConversationMessages($id){
        if(auth()->user()->type == 'guard'){
            $messages = $this->ConversationService->guardConversationMessages($id);
            if($messages){
                $data = [];
                foreach($messages as $k=>$message){
                    $data[$k]['date'] = $k;
                    $data[$k]['messages'] = $message;
                }
                $data = array_values($data);
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.messages'),'data'=>$data ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function store(CreateConversationRequest $request){
        if(auth()->user()->type == 'company'){
            $data = $this->ConversationService->store($request);
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.conversations_add_message'),'data'=>$data ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function sendMessage(SendMessageRequest $request){
        if(auth()->user()->type == 'company'){
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
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.message_send'),'data'=>$data ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }
}
