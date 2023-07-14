@extends('admin.layout.base')

@section('title', trans('admin.add-contact_reason'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.contact_reason-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'contact_reasons.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-contact_reason-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('reason_ar' , trans('admin.reason_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('reason_ar' , old('reason_ar') ,['class'=>'form-control' , 'id'=>'reason_ar' , 'placeholder'=>trans('admin.reason_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('reason_en' , trans('admin.reason_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('reason_en' , old('reason_en') ,['class'=>'form-control' , 'id'=>'reason_en' , 'placeholder'=>trans('admin.reason_en')]) !!}
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
