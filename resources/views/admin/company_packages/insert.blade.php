@extends('admin.layout.base')

@section('title', trans('admin.add-company_package'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.company_package-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'company_packages.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-company_package-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('title_ar' , trans('admin.title_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('title_ar' , old('title_ar') ,['class'=>'form-control' , 'id'=>'title_ar' , 'placeholder'=>trans('admin.title_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('title_en' , trans('admin.title_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('title_en' , old('title_en') ,['class'=>'form-control' , 'id'=>'title_en' , 'placeholder'=>trans('admin.title_en')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('description_ar' , trans('admin.description_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('description_ar' , old('description_ar') ,['class'=>'form-control' , 'id'=>'description_ar' , 'placeholder'=>trans('admin.description_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('description_en' , trans('admin.description_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('description_en' , old('description_en') ,['class'=>'form-control' , 'id'=>'description_en' , 'placeholder'=>trans('admin.description_en')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('type' , trans('admin.type')) !!}
                                <span class="asters">*</span>
                                {!! Form::select('type' ,['single'=>__('admin.single') , 'monthly'=>__('admin.monthly')] ,old('type') ,['class'=>'form-control' , 'id'=>'type']) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('price' , trans('admin.price')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('price' , old('price') ,['class'=>'form-control' , 'id'=>'price' , 'placeholder'=>trans('admin.price')]) !!}
                            </div>

                            <div class="form-group col-md-6 no_of_cvs">
                            </div>

                            <div class="form-group col-md-6 no_of_days">
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#type').on('change' , function(){
                var value = $(this).val();
                checkType(value);
            });

            @if(old('type'))
                checkType("{{ old('type') }}");
            @endif

            function checkType(value){
                if(value == 'single'){
                    $('.no_of_cvs').empty();
                    $('.no_of_days').empty();
                }else{
                    $('.no_of_cvs').append(`
                                            {!! Form::label('no_of_cvs' , trans('admin.no_of_cvs')) !!}
                                            <span class="asters">*</span>
                                            {!! Form::text('no_of_cvs' , old('no_of_cvs') ,['class'=>'form-control' , 'id'=>'no_of_cvs' , 'placeholder'=>trans('admin.no_of_cvs')]) !!}
                                        `);

                    $('.no_of_days').append(`
                                                {!! Form::label('no_of_days' , trans('admin.no_of_days_company')) !!}
                                                <span class="asters">*</span>
                                                {!! Form::text('no_of_days' , old('no_of_days') ,['class'=>'form-control' , 'id'=>'no_of_days' , 'placeholder'=>trans('admin.no_of_days_company')]) !!}
                                            `);
                }
            }
        });
    </script>
@endsection

