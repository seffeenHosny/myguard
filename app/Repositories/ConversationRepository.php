<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\ConversationUser;
use App\Models\JopType;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class ConversationRepository
{
    use CrudTrait, ResponseTraits, MainTrait;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        if(auth()->user()->type == 'company'){
            $messages = Message::orderBy('created_at', 'DESC')
                                ->with('conversation')
                                ->whereHas('conversation' , function($q){return $q->where('user_id' , auth()->user()->id);})
                                ->get()
                                ->unique('conversation_id')
                                ->values()
                                ->all();
        }elseif(auth()->user()->type == 'guard'){
            $users = User::
                            select('id' , 'name' , 'image')
                            ->whereHas('conversations')
                            ->get();
                            $usersConversation = [];

            foreach($users as $user){
                $Conversation = $this->model->where('user_id' , $user->id)
                                    ->whereHas('users' , function($q){return $q->where('user_id' , auth()->user()->id);})
                                    ->get();
                if(count($Conversation) > 0){
                    $usersConversation[] = $user;
                }
            }

            $messages = [];
            foreach($usersConversation as $user){
                $user_id = $user->id;
                $userMessage = Message::
                                    whereHas('conversation' , function($q) use ($user_id){return $q->where('user_id' , $user_id);})
                                    ->orderBy('id' , 'DESC')
                                    ->first();
                $user->lastMessage =$userMessage;
                $messages[] = $user;
            }
        }
        return $messages;
    }

    public function show($id)
    {
        return $this->showTrait($this->model, $id);
    }

    public function store($request){
        $jop_type = JopType::where('id',$request->jop_type_id)->first();
        $data['title'] = $jop_type->name;
        $data['user_id'] = auth()->user()->id;
        $data['type'] = 'multi';
        $conversation =  $this->storeTrait($this->model ,$data);
        foreach($request->users as $user_id){
            ConversationUser::create(['conversation_id'=>$conversation->id , 'user_id'=>$user_id]);
        }
        return $conversation;
    }

    public function sendMessage($request){
        $data = $request->all();
        if($request->type != 'text'){
            if($request->hasFile('message')){
                $message_path = FileHelper::upload_file('conversations/'.$request->conversation_id , $request->message);
                $data['message'] = $message_path;
            }
        }
        $message = Message::create($data);
        return Message::where('id' , $message->id)->first();
    }

    public function companyConversationMessages($id)
    {
        $conversation = $this->model->where('user_id' , auth()->user()->id)->where('id' , $id)->first();
        if($conversation == null){
            return false;
        }
        if(count($conversation->messages) < 1){
            return 'empty' ;
        }
        return Message::where('conversation_id', $conversation->id)
                        ->orderBy('id' , 'DESC')
                        ->get()
                        ->groupBy(function($query){return $query->created_at->format('Y-m-d');});
    }

    public function guardConversationMessages($id)
    {
        return Message::whereHas('conversation' , function($q) use ($id){return $q->where('user_id' , $id);})
                        ->orderBy('id' , 'DESC')
                        ->get()
                        ->groupBy(function($query){return $query->created_at->format('Y-m-d');});
    }


}
