@extends('admin.layout.base')

@section('title', __('admin.news'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body">
                    <p class="mb-4">
                        {{ $news->description }}
                    </p>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if($news->main_image != null)
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/'.$news->main_image) }}" class="d-block w-100" alt="...">
                            </div>
                            @endif
                            @foreach ($news->images as $image )
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/'.$image->path) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        @if($news->main_image == null)
        $(document).ready(function(){
            $('.carousel-item:first-of-type').addClass('active');
        });
        @endif
    </script>
@endsection
