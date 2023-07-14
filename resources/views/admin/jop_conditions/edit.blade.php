@extends('admin.layout.base')

@section('title', trans('admin.edit-company_type'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.company_type-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'put' , 'route'=>['jop_conditions.update' , $jop_condition->id] ,'enctype'=>'multipart/form-data'  , 'id'=>'add-jop_condition-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('jop_type_id' , trans('admin.jop_type')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('jop_type_id' , $job_types ,old('jop_type_id')?? $jop_condition->jop_type_id ,['class'=>'form-control' , 'id'=>'jop_type_id' , 'placeholder'=>trans('admin.jop_type')]) !!}
                            </div>

                            <div class="col-md-6"></div>
                            <div class="form-group col-md-6">
                                {!! Form::label('condition_ar' , trans('admin.condition_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('condition_ar' , old('condition_ar') ?? $jop_condition->condition_ar ,['class'=>'form-control' , 'id'=>'condition_ar' , 'placeholder'=>trans('admin.condition_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('condition_en' , trans('admin.condition_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('condition_en' , old('condition_en') ?? $jop_condition->condition_en ,['class'=>'form-control' , 'id'=>'condition_en' , 'placeholder'=>trans('admin.condition_en')]) !!}
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
