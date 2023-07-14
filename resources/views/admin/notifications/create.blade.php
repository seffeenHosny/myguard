@extends('admin.layout.base')

@section('title', trans('admin.add-notification'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.notifications')}}</h4>
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
                        {!! Form::open(['method'=>'post' , 'route'=>['notifications.store' , app()->getLocale()] ,'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            @method('POST')
                            <div class="form-group col-md-6">
                                {!! Form::label('title' , trans('admin.title_notification')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('title' , old('title') ,['class'=>'form-control' ,'required'=>'required', 'id'=>'title' , 'placeholder'=>trans('admin.title_notification')]) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('message' , trans('admin.message_notification')) !!}
                                <span class="asters">*</span>
                                {!! Form::textarea('message' , old('name_en') ,['class'=>'form-control' ,'required'=>'required',"rows"=>3, 'id'=>'message' , 'placeholder'=>trans('admin.message_notification')]) !!}

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
