@extends('admin.layout.base')

@section('title', trans('admin.add-phone'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                {{-- <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.company_type-info')}}</h4>
                    </div>
                </div> --}}
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'technical_supports.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-phone-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('phone' , trans('admin.phone')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('phone' , old('phone') ,['class'=>'form-control' , 'id'=>'phone' , 'placeholder'=>trans('admin.phone')]) !!}
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
