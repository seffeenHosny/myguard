
@extends('company.layout.base')
@section('title' , __('admin.news'))
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="iq-card">
            <div class="iq-card-body">
                <span>@lang('admin.Posted on') {{ date('d-m-Y' , strToTime($news->created_at)) }}</span>
                <p class="mb-0 blue-color">{{ $news->description }}</p>
            </div>
        </div>
    </div>
    @if(count($news->images) > 0)
    <div class="col-md-4">
        <div class="iq-card">
            <div class="iq-card-body">
                <div id="images_Sliders" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($news->images as $k=>$image )
                            <li data-target="#images_Sliders" data-slide-to="{{ $k }}" class=""></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($news->images as $k=>$image )
                            <div class="carousel-item">
                                <img src="{{ asset('storage/'.$image->path) }}" class="d-block w-100" alt="#">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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
