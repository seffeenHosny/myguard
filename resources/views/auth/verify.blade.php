@extends('auth.auth_layout')
@section('title' , 'تفعيل الحساب')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0"> تفيعل الحساب </h1>
    @if(session()->has('status'))
        <div class="alert text-white bg-primary" role="alert">
            <div class="iq-alert-text">
                {{session()->get('status')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-text">
                {{session()->get('error')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    <div class="alert alert-danger d-none" id="form_errors" role="alert">
    </div>
    <div class="alert alert-success d-none" id="form_success" role="alert">
        تم ارسال الكود الي رقم الجوال بنجاح
    </div>
    @include('admin.include.messages_errors')
    {!! Form::open(['method'=>'post' , 'route'=>'company.post.verify' ,'enctype'=>'multipart/form-data'  , 'id'=>'register' , 'class'=>'mt-4']) !!}
        <div class="form-group">
            {!! Form::label('phone','رقم الجوال' ) !!}
            {!! Form::text('phone',$user->phone ?? old('phone')  , ['class'=>'form-control mb-0' , 'id'=>'phone' , 'placeholder'=>'رقم الجوال'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('code','الكود' ) !!}
            {!! Form::text('code', old('code') ,['class'=>'form-control mb-0' , 'id'=>'code' , 'placeholder'=>'الكود'] ) !!}
        </div>

        <div class="d-inline-block w-100">
            <button type="submit" class="btn btn-primary float-right">تفعيل الحساب</button>
        </div>
        <div class="text-center">
            <a id="send-code" href="#">اعادة أرسال الكود </a>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script>
        $('#send-code').click(function(e) {
            e.preventDefault();
            var phone = $('#phone').val();
            $.ajax({
                url: "{{ route('company.resend.code') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'phone':phone
                },
                success: function (data) {
                    $('#form_errors').addClass('d-none');
                    $('#form_success').removeClass('d-none');
                },
                error: function (reject , ajaxOptions, thrownError) {
                    if( reject.status === 422 ) {
                        var errorString = '<ul>';
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors);
                        {{--  $.each(errors.errors, function (key, value) {
                        });  --}}
                        errorString += '<li>' + errors.message + '</li>';
                        errorString += '</ul>';
                        $("#form_errors").removeClass('d-none');
                        $('#form_success').addClass('d-none');
                        $("#form_errors").html(errorString);
                        $('html,body').animate({
                            scrollTop:0
                        },500);
                    }
                },
            });
            return false;
        });

    </script>
@endsection
