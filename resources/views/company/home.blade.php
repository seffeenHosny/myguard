
@extends('company.layout.base')
@section('title' , 'dashboard')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.aboutUs')}}
                    </h4>
                </div>
            </div>
            <div class="iq-card-body">
                <p class="mb-0 blue-color">{{ $aboutUs }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="iq-card">
            <div class="iq-card-body">
                <div id="images_Sliders" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($images as $k=>$image )
                            <li data-target="#images_Sliders" data-slide-to="{{ $k }}" class=""></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($images as $k=>$image )
                            <div class="carousel-item">
                                @if($image->type == 'video')
                                <video class="pr-1 pl-1 w-100" height="240" controls>
                                    <source src="{{asset('storage/'.$image->path)}}">
                                    Your browser does not support the video tag.
                                </video>
                                @else
                                <img src="{{ asset('storage/'.$image->path) }}" class="d-block w-100" alt="#">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.latest news')}}
                    </h4>
                </div>
            </div>
            <div class="iq-card-body">
                @foreach ($news as $news_item)
                    <a class="news pb-3 pt-3 d-block" href="{{ route('company.show.news' ,$news_item->id ) }}">
                        @if($news_item->main_image != null)
                        <img class="float-left ml-3 mr-3" style="width: 150px;height: 150px;border-radius: 8px" src="{{ asset('storage/'.$news_item->main_image) }}"/>
                        @endif
                        <span>@lang('admin.Posted on') {{ date('d-m-Y' , strToTime($news_item->created_at)) }}</span>
                        <h5 class="blue-color mb-0">{{ $news_item->description }}</h5>
                        <div class="clearfix"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#images_Sliders .carousel-indicators li:first-of-type').addClass('active');
        $('#images_Sliders .carousel-inner .carousel-item:first-of-type').addClass('active');
    });
</script>
@endsection
