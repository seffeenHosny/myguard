<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Repositories\ConversationRepository;
use Auth;
use DateTime;

class ConversationService
{

    protected $Conversation;
    public function __construct(Conversation $Conversation)
    {
        $this->Conversation = new ConversationRepository($Conversation);
    }

    public function index()
    {
        return $this->Conversation->index();

    }

    public function store($request)
    {
        return $this->Conversation->store($request);
    }

    public function sendMessage($request)
    {
        return $this->Conversation->sendMessage($request);
    }

    public function companyConversationMessages($id)
    {
        return $this->Conversation->companyConversationMessages($id);
    }

    public function guardConversationMessages($id)
    {
        return $this->Conversation->guardConversationMessages($id);
    }

    public function show($id)
    {
        return $this->Conversation->show($id);
    }
}
