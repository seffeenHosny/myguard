@extends('admin.layout.base')

@section('title', trans('admin.settings'))

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title"> {{trans('admin.settings')}}</h4>
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
                        {!! Form::open(['method'=>'post' , 'route'=>['settings.update'] ,'enctype'=>'multipart/form-data'  , 'id'=>'settings-form']) !!}
                        <div class="row">

                            <div class="form-group col-md-6">
                                {!! Form::label('domain' , trans('admin.domain')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('domain' , old('domain') ?? setting('domain')  ,['class'=>'form-control' , 'id'=>'domain' , 'placeholder'=>trans('admin.domain')]) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('tax' , trans('admin.tax')) !!}
                                <span class="asters">*</span>
                                {!! Form::text('tax' , old('tax') ?? setting('tax')  ,['class'=>'form-control' , 'id'=>'tax' , 'placeholder'=>trans('admin.tax')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('facebook' , trans('admin.facebook')) !!}
                                <span class="asters">*</span>
                                {!! Form::url('facebook' , old('facebook') ?? setting('facebook')  ,['class'=>'form-control' , 'id'=>'facebook' , 'placeholder'=>trans('admin.facebook')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('instagram' , trans('admin.instagram')) !!}
                                <span class="asters">*</span>
                                {!! Form::url('instagram' , old('instagram') ?? setting('instagram')  ,['class'=>'form-control' , 'id'=>'instagram' , 'placeholder'=>trans('admin.instagram')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('twitter' , trans('admin.twitter')) !!}
                                <span class="asters">*</span>
                                {!! Form::url('twitter' , old('twitter') ?? setting('twitter')  ,['class'=>'form-control' , 'id'=>'twitter' , 'placeholder'=>trans('admin.twitter')]) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('snapchat' , trans('admin.snapchat')) !!}
                                <span class="asters">*</span>
                                {!! Form::url('snapchat' , old('snapchat') ?? setting('snapchat')  ,['class'=>'form-control' , 'id'=>'snapchat' , 'placeholder'=>trans('admin.snapchat')]) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('aboutUs_ar' , trans('admin.aboutUs_ar')) !!}
                                <span class="asters">*</span>
                                {!! Form::textarea('aboutUs_ar' , old('aboutUs_ar') ?? setting('aboutUs_ar')  ,['class'=>'form-control' , 'id'=>'aboutUs_ar' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('aboutUs_en' , trans('admin.aboutUs_en')) !!}
                                <span class="asters">*</span>
                                {!! Form::textarea('aboutUs_en' , old('aboutUs_en') ?? setting('aboutUs_en')  ,['class'=>'form-control' , 'id'=>'aboutUs_en' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('terms_ar' , trans('admin.terms_ar')) !!}
                                {!! Form::textarea('terms_ar' , old('terms_ar') ?? setting('terms_ar')  ,['class'=>'form-control' , 'id'=>'terms_ar' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('terms_en' , trans('admin.terms_en')) !!}
                                {!! Form::textarea('terms_en' , old('terms_en') ?? setting('terms_en')  ,['class'=>'form-control' , 'id'=>'terms_en' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('policy_ar' , trans('admin.policy_ar')) !!}
                                {!! Form::textarea('policy_ar' , old('policy_ar') ?? setting('policy_ar')  ,['class'=>'form-control' , 'id'=>'policy_ar' ,'rows'=>'3']) !!}
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('policy_en' , trans('admin.policy_en')) !!}
                                {!! Form::textarea('policy_en' , old('policy_en') ?? setting('policy_en')  ,['class'=>'form-control' , 'id'=>'policy_en' ,'rows'=>'3']) !!}
                            </div>

                            {!! Form::label('images' , trans('admin.images')) !!}
                            <div class="col-md-12">
                                {!! Form::hidden('delete_images' , '' , ['id'=>'delete_images']) !!}
                                @foreach ($images as $image )
                                    <div class="image position-relative p-2 pull-right" style="width: 200px">
                                        <img style="width: 100%;height: 150px;" src="{{asset('storage/'.$image->path)}}" />
                                        <span class="delete-image-id" data-id="{{$image->id}}">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-12 mt-5">
                                <div id="demo"></div>
                            </div>

                            {!! Form::label('videos' , trans('admin.videos')) !!}
                            <div class="col-md-12">
                                {!! Form::hidden('delete_videos' , '' , ['id'=>'delete_videos']) !!}
                                @foreach ($videos as $video )
                                    <div class="video position-relative p-2 pull-right" style="width: 200px">
                                        <video width="200px" class="pr-1 pl-1" height="240" controls>
                                            <source src="{{asset('storage/'.$video->path)}}">
                                            Your browser does not support the video tag.
                                        </video>
                                        <span class="delete-video-id" data-id="{{$video->id}}">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-12 mt-5">
                                {!! Form::label('videos' , trans('admin.videos')) !!}
                                {!! Form::file('videos[]' , ['class'=>'form-control-file' , 'id'=>'videos' , 'multiple'=>'multiple' , 'accept'=>'video/*']) !!}
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
            $(this).parent('.image').fadeOut();
        });

        var videosId =[];
        $('.delete-video-id').on('click' , function(){
            var id = $(this).data('id')
            videosId.push(id);
            $('#delete_videos').val(videosId);
            $(this).parent('.video').fadeOut();
        });
    </script>
@endsection
