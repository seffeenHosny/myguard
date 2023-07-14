@extends('admin.layout.base')
@section('title', trans('admin.transactions'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="iq-card">
            <div class="iq-card-body">
                <ul class="nav nav-pills d-flex align-items-end profile-feed-items p-0 m-0">
                    <li>
                        <a class="nav-link active" data-toggle="pill" href="#all">{{ __('admin.all') }}</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="pill" href="#succeeded">{{ __('admin.succeeded') }}</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="pill" href="#failed">{{ __('admin.failed') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="all">
                        <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.client')}}</th>
                                <th>{{trans('admin.type')}}</th>
                                <th>{{trans('admin.price')}}</th>
                                <th>{{trans('admin.tax')}}</th>
                                <th>{{trans('admin.total_price')}}</th>
                                <th>{{trans('admin.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index=>$item)
                                    @include('admin.transactions.table_body')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="succeeded">
                        <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.client')}}</th>
                                <th>{{trans('admin.type')}}</th>
                                <th>{{trans('admin.price')}}</th>
                                <th>{{trans('admin.tax')}}</th>
                                <th>{{trans('admin.total_price')}}</th>
                                <th>{{trans('admin.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index=>$item)
                                    @if($item->status == 'approved')
                                        @include('admin.transactions.table_body')
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="failed">
                        <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.client')}}</th>
                                <th>{{trans('admin.type')}}</th>
                                <th>{{trans('admin.price')}}</th>
                                <th>{{trans('admin.tax')}}</th>
                                <th>{{trans('admin.total_price')}}</th>
                                <th>{{trans('admin.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index=>$item)
                                    @if($item->status == 'failed')
                                        @include('admin.transactions.table_body')
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
