@extends('admin.layout.base')

@section('title', trans('admin.add-user'))

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.add-user')}} </h4>
                    </div>
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-body">
                    <form>
                        <div class="form-group text-center">
                            <div class="add-img-user profile-img-edit">
                                <img class="profile-pic img-fluid"
                                    src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                                <div class="p-image">
                                    <a href="#" class="upload-button btn iq-bg-primary">{{trans('admin.image')}}</a>
                                    <input name="image" class="file-upload"  form="add-user-form" type="file" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.user-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'users.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
                        <div class="row">
                            @method('POST')
                            <div class="form-group col-md-6">
                                {!! Form::label('name' , trans('admin.name')) !!}
                                <span class="asters">*</span>
                                {!! Form::hidden('type' , 'admin') !!}
                                {!! Form::text('name' , old('name') ,['class'=>'form-control' ,'required'=>'required', 'id'=>'name' , 'placeholder'=>trans('admin.name')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('phone' , trans('admin.phone')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('phone' , old('phone') ,['class'=>'form-control' ,'required'=>'required', 'id'=>'phone' , 'placeholder'=>trans('admin.phone')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('email' , trans('admin.email')) !!}
                                <span class="asters">*</span>
                                {!! Form::email('email' , old('email') ,['class'=>'form-control' , 'id'=>'email' , 'placeholder'=>trans('admin.email')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {{--  {!! Form::label('gender' , trans('admin.gender')) !!}
                                {!! Form::select('gender' ,['male'=>trans('admin.male') , 'female'=>trans('admin.female')], old('gender') ,['class'=>'form-control' ,'required'=>'required', 'id'=>'gender' , 'placeholder'=>trans('admin.gender')]) !!}  --}}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('password' , trans('admin.password')) !!}
                                <span class="asters">*</span>
                                {!! Form::password('password' ,['class'=>'form-control' ,'required'=>'required', 'id'=>'password' , 'autocomplete'=>'new-password' ,  'placeholder'=>trans('admin.password')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('con-password' , trans('admin.con-password')) !!}
                                <span class="asters">*</span>
                                {!! Form::password('password_confirmation' ,['class'=>'form-control' , 'id'=>'con-password' ,'autocomplete'=>'new-password', 'placeholder'=>trans('admin.con-password')]) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::submit(trans('admin.save') , ['class'=>'btn btn-primary ml-2 pull-left']) !!}
                                {!! Form::reset(trans('admin.cancel') , ['class'=>'btn btn-secondary pull-left']) !!}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
