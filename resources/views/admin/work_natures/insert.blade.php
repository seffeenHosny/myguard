@extends('admin.layout.base')

@section('title', trans('admin.add-work_nature'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.work_nature-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'work_natures.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-work_nature-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('nature_ar' , trans('admin.nature_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('nature_ar' , old('nature_ar') ,['class'=>'form-control' , 'id'=>'nature_ar' , 'placeholder'=>trans('admin.nature_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('nature_en' , trans('admin.nature_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('nature_en' , old('nature_en') ,['class'=>'form-control' , 'id'=>'nature_en' , 'placeholder'=>trans('admin.nature_en')]) !!}
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
