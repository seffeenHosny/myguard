@extends('admin.layout.base')
@section('title', trans('admin.job_offers'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.job_offers')}}
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.company')}}</th>
                            <th>{{trans('admin.jop_type')}}</th>
                            <th>{{trans('admin.work_nature')}}</th>
                            <th>{{trans('admin.city')}}</th>
                            <th>{{trans('admin.district')}}</th>
                            <th>{{trans('admin.salary')}}</th>
                            <th>{{trans('admin.date')}}</th>
                            <th>{{trans('admin.no_of_days')}}</th>
                            <th>{{trans('admin.no_of_hours')}}</th>
                            <th>{{trans('admin.last_date_to_accept')}}</th>
                            <th>{{trans('admin.holidays')}}</th>
                            <th>{{trans('admin.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index=>$item)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$item->company->name}}</td>
                                    <td>{{$item->jop_type->name}}</td>
                                    <td>
                                        @if($item->work_nature_id == 1 || $item->work_nature_id == null)
                                        {{$item->work_nature_text}}
                                        @else
                                        {{$item->work_nature->name}}
                                        @endif
                                    </td>
                                    <td>{{$item->city->name}}</td>
                                    <td>{{$item->district->name}}</td>
                                    <td>{{$item->salary}}</td>
                                    <td>{{ date('d-m-Y' , strToTime($item->created_at)) }}</td>
                                    <td>{{$item->no_of_days}}</td>
                                    <td>{{$item->no_of_hours}}</td>
                                    <td>{{$item->last_date_to_accept}}</td>
                                    <td>
                                        {{ __('admin.'.$item->holiday) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="flex align-items-center list-user-action">
                                            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('jobs.show' , $item->id)}}">
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
</div>
@endsection
