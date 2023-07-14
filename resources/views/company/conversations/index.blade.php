@extends('company.layout.base')
@section('title' , __('admin.conversations'))
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-body chat-page p-0">
                <div class="chat-data-block">
                    <div class="row">
                        <div class="col-lg-3 chat-data-left scroller">
                            <div class="chat-sidebar-channel scroller mt-4 pl-3">
                                <ul class="iq-chat-ui nav flex-column nav-pills">
                                    @foreach($conversations as $conversation)
                                    <li>
                                        <a href="{{route('conversations.messages' ,$conversation->conversation_id)  }}">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar mr-3">
                                                    <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="chatuserimage" class="avatar-50 ">
                                                </div>
                                                <div class="chat-sidebar-name">
                                                    <h6 class="mb-0">{{ $conversation->conversation->title }}</h6>
                                                    @if($conversation->type == 'text')
                                                    <span>{{ $conversation->message }}</span>
                                                    <p class="mb-0 text-right">{{ date('h:i d-m-Y' , strToTime($conversation->created_at)) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-9 chat-data p-0 chat-data-right" style="background-image: url({{ asset('assets/plugins/vito/images/page-img/100.jpg') }})">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="default-block" role="tabpanel">
                                    <div class="chat-start">
                                        <span class="iq-start-icon text-primary"><i class="ri-message-3-line"></i></span>
                                        <button id="chat-start" class="btn bg-white mt-3">@lang('admin.Start Conversation') !</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
