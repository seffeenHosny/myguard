@extends('company.layout.base')

@section('title', trans('admin.profile'))

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.profile')}} </h4>
                    </div>
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-body">
                    <form>
                        <div class="form-group text-center">
                            <div class="add-img-user profile-img-edit">
                                @if(!empty(auth()->user()->image))
                                    <img class="profile-pic img-fluid" src="{{ asset('storage/'.auth()->user()->image) }}" alt="profile-pic">
                                @else
                                    <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                                @endif
                                <div class="p-image">
                                    <a href="#" class="upload-button btn iq-bg-primary">{{trans('admin.image')}}</a>
                                    <input name="image" class="file-upload" form="edit-user-form" type="file" accept="image/*">
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
                        <h4 class="card-title"> {{trans('admin.profile-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if(session()->has('success'))
                        <div class="alert text-white bg-primary" role="alert">
                            <div class="iq-alert-text">{{session()->get('success')}}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endif
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'put' , 'route'=>'company.profile.update' ,'enctype'=>'multipart/form-data'  , 'id'=>'edit-user-form']) !!}
                        <div class="row">
                            @method('PUT')
                            <div class="form-group col-md-6">
                                {!! Form::label('name' , trans('admin.company_name')) !!}
                                <span class="asters">*</span>
                                {{--  {!! Form::hidden('type' , auth()->user()->type) !!}  --}}
                                {!! Form::hidden('id' , auth()->user()->id) !!}
                                {!! Form::text('name' , old('name') ?? auth()->user()->name ,['class'=>'form-control' ,'required'=>'required', 'id'=>'name' , 'placeholder'=>trans('admin.company_name')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('commercial_registration_no' , trans('admin.commercial_registration_no')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('commercial_registration_no' , old('commercial_registration_no') ?? auth()->user()->commercial_registration_no ,['class'=>'form-control' , 'id'=>'phone' , 'placeholder'=>trans('admin.commercial_registration_no')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('city_id' , trans('admin.city_id')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('city_id' ,$cities, old('city_id') ?? auth()->user()->city_id ,['class'=>'form-control' , 'id'=>'city_id' , 'placeholder'=>trans('admin.city_id')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('email' , trans('admin.email')) !!}
                                <span class="asters">*</span>
                                {!! Form::email('email' , old('email') ?? auth()->user()->email ,['class'=>'form-control' , 'id'=>'email' , 'placeholder'=>trans('admin.email')]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('company_type' , trans('admin.company_type')) !!}
                                <span class="asters">*</span>
                                {!! Form::hidden('type' , 'company') !!}
                                {!! Form::select('company_type_id' ,$company_types, old('company_type_id') ?? auth()->user()->company_type_id ,['class'=>'form-control' , 'id'=>'company_type' , 'placeholder'=>trans('admin.company_type')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('commercial_registration_image' , trans('admin.commercial_registration_image')) !!}
                                <span class="asters">*</span>
                                {!! Form::file('commercial_registration_image' , ['class'=>'form-control-file' , 'id'=>'exampleFormControlFile1']) !!}
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
