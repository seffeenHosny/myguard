@extends('company.layout.base')
@section('title' , __('admin.bill'))
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{trans('admin.bill')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <h5>{{$data['package']->title }}</h5>
                @if($data['package']->type == 'single')
                <h5>@lang('admin.single_price') : {{ $data['price']['price_for_cv'] }}</h5>
                <h5>@lang('admin.number_of_guards') : {{ $data['price']['count'] }}</h5>
                <h5>@lang('admin.total_price') : {{ $data['price']['price_without_tax'] }}</h5>
                @else
                <h5>@lang('admin.price') : {{ $data['price']['price_without_tax'] }}</h5>
                @endif
                <h5>@lang('admin.tax')({{ $data['price']['tax_rate'] }}%) : {{ $data['price']['tax_value'] }}</h5>
                <h5>@lang('admin.total_price') : {{ $data['price']['price_with_tax'] }}</h5>
                <a class="btn btn-primary float-right" href="{{ $data['url'] }}">@lang('admin.pay')</a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection
