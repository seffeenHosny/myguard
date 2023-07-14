@extends('admin.layout.base')
@section('title', trans('admin.contact_us'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.contact_us')}}
                    </h4>
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
                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('admin.client')}}</th>
                        <th>{{trans('admin.contact_reason')}}</th>
                        <th>{{trans('admin.message')}}</th>
                        <th>{{trans('admin.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $index=>$item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->contact_reason->reason}}</td>
                                <td>{{$item->message}}</td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('contact_us.show' , $item->id)}}">
                                            <i class="ri-slideshow-3-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
