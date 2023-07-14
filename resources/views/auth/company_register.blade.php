@extends('auth.auth_layout')
@section('title' , 'تسجيل حساب جديد')
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">تسجيل حساب جديد</h1>
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
    @include('admin.include.messages_errors')
    {!! Form::open(['method'=>'post' , 'route'=>'company.post.register' ,'enctype'=>'multipart/form-data'  , 'id'=>'register' , 'class'=>'mt-4']) !!}
        <div class="form-group">
            {!! Form::label('commercial_registration_no','رقم السجل التجاري' ) !!}
            {!! Form::text('commercial_registration_no',old('commercial_registration_no') , ['class'=>'form-control mb-0' , 'id'=>'commercial_registration_no' , 'placeholder'=>'رقم السجل التجاري'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name','اسم الشركة' ) !!}
            {!! Form::hidden('type' , 'company') !!}
            {!! Form::text('name',old('name') , ['class'=>'form-control mb-0' , 'id'=>'name' , 'placeholder'=>'اسم الشركة'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email','البريد الالكتروني' ) !!}
            {!! Form::text('email',old('email') , ['class'=>'form-control mb-0' , 'id'=>'email' , 'placeholder'=>'البريد الالكتروني'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone','رقم الجوال' ) !!}
            {!! Form::text('phone',old('phone') , ['class'=>'form-control mb-0' , 'id'=>'phone' , 'placeholder'=>'رقم الجوال'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('company_type_id','نوع الشركة' ) !!}
            {!! Form::select('company_type_id', $company_types, old('company_type_id') , ['class'=>'form-control mb-0' , 'id'=>'company_type_id' , 'placeholder'=>'نوع الشركة'] ) !!}
        </div>

         <div class="form-group">
            {!! Form::label('city_id','مثر الشركة' ) !!}
            {!! Form::select('city_id', $cities, old('city_id') , ['class'=>'form-control mb-0' , 'id'=>'city_id' , 'placeholder'=>'مقر الشركة'] ) !!}
        </div>

        <div class="form-group">
            <label for="commercial_registration_image">صورة السجل التجاري</label>
            <input type="file" name="commercial_registration_image" class="form-control-file" id="commercial_registration_image">
        </div>

        <div class="form-group">
            {!! Form::label('password','كلمة المرور' ) !!}
            {!! Form::password('password', ['class'=>'form-control mb-0' , 'id'=>'password' , 'placeholder'=>'كلمة المرور'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation','تاكيد كلمة المرور' ) !!}
            {!! Form::password('password_confirmation', ['class'=>'form-control mb-0' , 'id'=>'password_confirmation' , 'placeholder'=>'تاكيد كلمة المرور'] ) !!}
        </div>



        <div class="d-inline-block w-100">
            <button type="submit" class="btn btn-primary float-right">تسجيل حساب جديد</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection
