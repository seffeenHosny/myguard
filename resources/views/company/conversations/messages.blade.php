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
                                    @if($messages == 'empty')
                                        <li>
                                            <a class="active">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar mr-3">
                                                        <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="chatuserimage" class="avatar-50 ">
                                                    </div>
                                                    <div class="chat-sidebar-name">
                                                        <h6 class="mb-0">@lang('admin.Start Conversation')</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                    @foreach($conversations as $conversation)
                                        <li>
                                            <a class="{{ $conversation->conversation_id == $id ? 'active' : 0  }}" href="{{route('conversations.messages' ,$conversation->conversation_id)  }}">
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
                                <div class="tab-pane fade active show" id="chatbox{{ $id }}" role="tabpanel">
                                    <div class="chat-content scroller">
                                        @if($messages != 'empty')
                                            @foreach (array_reverse($messages->toArray()) as $i=>$message_group )
                                                <span class="mb-4" style="background: #13718D;color: #FFF;display: inline-block;padding: 1px 10px;border-radius: 5px;">{{ $i }}</span>
                                                @foreach (array_reverse($message_group) as $message)
                                                <div class="chat">
                                                    <div class="chat-user">
                                                        <a class="avatar m-0">
                                                            <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="avatar" class="avatar-35 ">
                                                        </a>
                                                        <span class="chat-time mt-1"></span>
                                                    </div>
                                                    <div class="chat-detail">
                                                        <div class="chat-message">
                                                            @if($message['type'] == 'text')
                                                            <p>{{ $message['message'] }}</p>
                                                            @elseif($message['type'] == 'video')
                                                            <video controls="controls" style="max-width:100%">
                                                                <source src="{{ asset('storage/'.$message['message'] )}}" />
                                                            </video>
                                                            @elseif($message['type'] == 'file')
                                                            <a style="color: #FFF" href="{{url(asset('storage/'.$message['message'] ))}}"> @lang('admin.file')</a>
                                                            @elseif($message['type'] == 'image')
                                                            <img src="{{ asset('storage/'.$message['message'] )}}" style="max-width:100%" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="chat-footer p-3 bg-white">
                                        <div class="alert alert-danger d-none" id="form_errors" role="alert"></div>
                                        {!! Form::open(['method'=>'post' , 'id'=>'send-message' , 'class'=>'d-flex align-items-center']) !!}
                                            <div class="chat-attagement d-flex">
                                                <a href="#" id="chossefile">
                                                    <i class="fa fa-paperclip pr-3" aria-hidden="true"></i>
                                                </a>
                                                <input type="file" class="d-none" id="inpit_file" />
                                                <img src="{{asset('assets/images/loader.gif')}}" class="mr-3 d-none" id="loader-image" style="width: 30px" />
                                            </div>
                                            <input type="text" required name="message" id="message" class="form-control mr-3" placeholder="{{ __('admin.message') }}">
                                            <button type="submit" class="btn btn-primary d-flex align-items-center p-2">
                                                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                <span class="d-none d-lg-block ml-1">@lang('admin.send')</span>
                                            </button>
                                        {!! Form::close() !!}
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
@section('script')
<script>
    $('#send-message').on('submit' , function(e){
        e.preventDefault();
        var message = $('#message').val(),
            type = 'text' ,
            conversation_id = "{{ $id }}" ,
            url = "{{ route('conversations.messages.send') }}";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "type": type ,
                    'message': message ,
                    'conversation_id':conversation_id ,
                    },
                beforeSend:function (oEvent) {
                    $('#loader-image').removeClass('d-none');
                },
                success: function (data) {
                    if(data.status == 1){
                        $('#form_errors').addClass('d-none');
                        $('#form_success').removeClass('d-none');
                        $('#message').val('');
                        $('#chatbox{{$id}} .chat-content').append(
                            `
                            <div class="chat-user">
                                <a class="avatar m-0">
                                    <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="avatar" class="avatar-35 ">
                                </a>
                                <span class="chat-time mt-1"></span>
                            </div>
                            <div class="chat-detail">
                                <div class="chat-message">
                                    <p>`+message+`</p>
                                </div>
                            </div>
                            `
                        );
                    }
                },
                error: function (reject , ajaxOptions, thrownError) {
                    if( reject.status === 422 ) {
                        var errorString = '<ul>';
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors.message);
                        errorString += '<li>' + errors.message + '</li>';
                        errorString += '</ul>';
                        $("#form_errors").removeClass('d-none');
                        $('#form_success').addClass('d-none');
                        $("#form_errors").html(errorString);
                    }
                },
                complete: function() {
                    $('#loader-image').addClass('d-none');
                },
            });
    });

    $('#chossefile').on('click' , function(){
        $('#inpit_file').click();
    });

    $('#inpit_file').on('change' , function(){
        var file = $(this);
        var message = document.getElementById('inpit_file').files[0];
        var type = 'text' ,
            conversation_id = "{{ $id }}" ,
            url = "{{ route('conversations.messages.send') }}";
        
        if (isImage(file.val())) {
            type = 'image';
        } else if (isVideo(file.val())) {
            type = 'video' ;
        }else{
            type = 'file' ;
        }

        var formData = new FormData();
        formData.append('message', $('input[type=file]')[0].files[0]);
        formData.append( "_token", "{{ csrf_token() }}" );
        formData.append('conversation_id' , conversation_id);
        formData.append('type' , type);

        $.ajax({
            type: 'POST',
            url: url,
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function (oEvent) {
                $('#loader-image').removeClass('d-none');
            },
            success: function (data) {
                if(data.status == 1){
                    $('#form_errors').addClass('d-none');
                    $('#form_success').removeClass('d-none');
                    $('#message').val('');
                    if(data.data.type == 'video'){
                        $('#chatbox{{$id}} .chat-content').append(
                            `
                                <div class="chat-user">
                                    <a class="avatar m-0">
                                        <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="avatar" class="avatar-35 ">
                                    </a>
                                    <span class="chat-time mt-1"></span>
                                </div>
                                <div class="chat-detail">
                                    <div class="chat-message">
                                        <p>
                                            <video controls="controls" style="max-width:100%">
                                                <source src="{{ asset('storage/`+data.data.message+`')}}" />
                                            </video>
                                        </p>
                                    </div>
                                </div>
                            `
                        );
                    }else if(data.data.type == 'image'){
                        $('#chatbox{{$id}} .chat-content').append(
                            `
                                <div class="chat-user">
                                    <a class="avatar m-0">
                                        <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="avatar" class="avatar-35 ">
                                    </a>
                                    <span class="chat-time mt-1"></span>
                                </div>
                                <div class="chat-detail">
                                    <div class="chat-message">
                                        <img src="{{ asset('storage/`+data.data.message+`')}}" style="max-width:100%" />
                                    </div>
                                </div>
                            `
                        );

                    }else if(data.data.type == 'file'){
                        $('#chatbox{{$id}} .chat-content').append(
                            `
                                <div class="chat-user">
                                    <a class="avatar m-0">
                                        <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/imgs/avatar.png') }}" alt="avatar" class="avatar-35 ">
                                    </a>
                                    <span class="chat-time mt-1"></span>
                                </div>
                                <div class="chat-detail">
                                    <div class="chat-message">
                                        <a style="color: #FFF" href="{{url(asset('storage/`+data.data.message+`'))}}"> @lang('admin.file')</a>
                                    </div>
                                </div>
                            `
                        );

                    }
                    
                }
            },
            error: function (reject , ajaxOptions, thrownError) {
                if( reject.status === 422 ) {
                    var errorString = '<ul>';
                    var errors = $.parseJSON(reject.responseText);
                    console.log(errors.message);
                    errorString += '<li>' + errors.message + '</li>';
                    errorString += '</ul>';
                    $("#form_errors").removeClass('d-none');
                    $('#form_success').addClass('d-none');
                    $("#form_errors").html(errorString);
                }
            },
            complete: function() {
                $('#loader-image').addClass('d-none');
            },
        });
    });

    function getExtension(filename) {
        var parts = filename.split('.');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'jpg':
            case 'gif':
            case 'jpeg':
            case 'png':
            case 'svg':
            //etc
            return true;
        }
        return false;
    }

    function isVideo(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'qt':
            case 'ogg':
            case 'mov':
            case 'mp4':
            // etc
            return true;mp4,mov,ogg,qt
        }
        return false;
    }
</script>
@endsection
