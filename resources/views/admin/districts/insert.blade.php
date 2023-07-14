@extends('admin.layout.base')

@section('title', trans('admin.add-district'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.district-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'districts.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-district-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('city_id' , trans('admin.city')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('city_id' , $cities ,old('city_id') ,['class'=>'form-control' , 'id'=>'city_id' , 'placeholder'=>trans('admin.city')]) !!}
                            </div>

                            <div class="col-md-6"></div>

                            <div class="form-group col-md-6">
                                {!! Form::label('name_ar' , trans('admin.name_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('name_ar' , old('name_ar') ,['class'=>'form-control' , 'id'=>'name_ar' , 'placeholder'=>trans('admin.name_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('name_en' , trans('admin.name_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('name_en' , old('name_en') ,['class'=>'form-control' , 'id'=>'name_en' , 'placeholder'=>trans('admin.name_en')]) !!}
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
