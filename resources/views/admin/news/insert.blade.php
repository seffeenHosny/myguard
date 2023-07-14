@extends('admin.layout.base')

@section('title', trans('admin.add-news'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.news-info')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @include('admin.include.messages_errors')
                    <div class="new-user-info">
                        {!! Form::open(['method'=>'post' , 'route'=>'news.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-news-form']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {!! Form::label('description_ar' , trans('admin.description_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::textarea('description_ar' , old('description_ar') ,['class'=>'form-control' , 'id'=>'description_ar' , 'rows'=>3 , 'placeholder'=>trans('admin.description_ar')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('description_en' , trans('admin.description_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::textarea('description_en' , old('description_en') ,['class'=>'form-control' , 'id'=>'description_en' , 'rows'=>3 , 'placeholder'=>trans('admin.description_en')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('main_image' , trans('admin.main_image')) !!}
                                <span class="asters">*</span>
                                {!! Form::file('main_image' , ['class'=>'form-control-file' , 'id'=>'main_image']) !!}
                            </div>

                            <div class="col-md-12">
                            {!! Form::label('images' , trans('admin.images')) !!}
                                <div id="demo"></div>
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
        $("#demo").spartanMultiImagePicker({
            fieldName: 'images[]',
            rowHeight :'200px',
            groupClassName :'multiuploadImage',
            allowedExt:'png|jpg|jpeg|gif',
            dropFileLabel:   'Drop file here',
        });

        var imagesId =[];
        $('.delete-image-id').on('click' , function(){
            var id = $(this).data('id')
            imagesId.push(id);
            $('#delete_images').val(imagesId);
            console.log(imagesId);
            $(this).parent('.image').fadeOut();
        });
    </script>
@endsection
