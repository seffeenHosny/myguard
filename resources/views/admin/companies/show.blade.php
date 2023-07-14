@extends('admin.layout.base')

@section('title', $data->name)

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    @if(!empty($data->image))
                        <img class="profile-pic img-fluid" src="{{ asset('storage/'.$data->image) }}" alt="profile-pic">
                    @else
                        <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                    @endif
                </div>
            </div>

            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="about-info m-0 p-0">
                        <div class="row">
                            @if(!empty($data->name))
                            <div class="col-4">{{trans('admin.name')}}:</div>
                            <div class="col-8">{{$data->name}}</div>
                            @endif
                            @if(!empty($data->phone))
                            <div class="col-5">{{trans('admin.phone')}}:</div>
                            <div class="col-7">{{$data->phone}}</div>
                            @endif
                            @if(!empty($data->company_type_id))
                            <div class="col-6">{{trans('admin.company_type')}}:</div>
                            <div class="col-6">{{$data->company_type->name}}</div>
                            @endif
                            @if(!empty($data->city_id))
                            <div class="col-6">{{trans('admin.city')}}:</div>
                            <div class="col-6">{{$data->city->name}}</div>
                            @endif
                            @if(!empty($data->gender))
                            <div class="col-4">{{trans('admin.gender')}}:</div>
                            <div class="col-8">
                                @if($data->gender == 'male')
                                    {{ __('admin.male') }}
                                @else
                                    {{ __('admin.female') }}
                                @endif
                            </div>
                            @endif
                            @if(!empty($data->email))
                            <div class="col-12">{{trans('admin.email')}}:</div>
                            <div class="col-12">{{$data->email}}</div>
                            @endif
                            @if(!empty($data->commercial_registration_no))
                            <div class="col-8">{{trans('admin.commercial_registration_no')}}:</div>
                            <div class="col-4">{{$data->commercial_registration_no}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($data->commercial_registration_image))
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{trans('admin.commercial_registration_image')}}
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <a href="{{ asset('storage/'.$data->commercial_registration_image) }}" >
                        <img class="img-fluid" src="{{ asset('storage/'.$data->commercial_registration_image) }}" alt="profile-pic">
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-9">
            <div class="iq-card">
                <div class="iq-card-body">
                    <ul class="nav nav-pills d-flex align-items-end profile-feed-items p-0 m-0">
                        <li>
                            <a class="nav-link active" data-toggle="pill" href="#company_packages">{{ __('admin.company_packages') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="pill" href="#job_offers">{{ __('admin.job_offers') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="pill" href="#guards">{{ __('admin.guards') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="company_packages">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.title')}}</th>
                                        <th>{{trans('admin.description')}}</th>
                                        <th>{{trans('admin.price')}}</th>
                                        <th>{{trans('admin.tax')}}</th>
                                        <th>{{trans('admin.total_price')}}</th>
                                        <th>{{trans('admin.type')}}</th>
                                        <th>{{trans('admin.no_of_cvs')}}</th>
                                        <th>{{trans('admin.package_duration')}}</th>
                                        <th>{{trans('admin.start_date')}}</th>
                                        <th>{{trans('admin.rest_of_points')}}</th>
                                        <th>{{trans('admin.status')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->subscribe_company_packages as $index=>$item)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$item->company_package->title}}</td>
                                                <td>{{$item->company_package->description}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->tax}}</td>
                                                <td>{{$item->total_price}}</td>
                                                <td>
                                                    @if($item->company_package->type == 'single')
                                                        {{__('admin.single')}}
                                                    @else
                                                        {{__('admin.monthly')}}
                                                    @endif

                                                </td>
                                                <td>{{$item->company_package->no_of_cvs}}</td>
                                                <td>{{$item->company_package->no_of_days}}</td>
                                                <td>{{date('d-m-Y' , strToTime($item->created_at))}}</td>
                                                <td>
                                                    @if($item->company_package->type == 'single')
                                                    @else
                                                    {{$item->rest_of_points}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 'active')
                                                        {{ __('admin.active') }}
                                                    @else
                                                    {{ __('admin.inactive') }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="job_offers">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.jop_type')}}</th>
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
                                        @foreach($data->company_jobs as $index=>$item)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$item->jop_type->name}}</td>
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
                        <div class="tab-pane fade" id="guards">
                            <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.phone')}}</th>
                                    <th>{{trans('admin.image')}}</th>
                                    <th>{{trans('admin.the_number_of_days_left')}}</th>
                                    <th>{{trans('admin.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->company_guards as $index=>$item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$item->company_guard->name}}</td>
                                            <td>{{$item->company_guard->phone}}</td>
                                            <td>
                                                @if($item->company_guard->image != null)
                                                    <img src="{{asset('storage/' . $item->company_guard->image)}}" style="width:40px;height:40px;" />
                                                @else
                                                    <img src="{{asset('assets/imgs/avatar.png')}}" style="width:40px;height:40px;" />
                                                @endif
                                            </td>
                                            <td>{{$item->the_number_of_days_left}}</td>
                                            <td class="text-center">
                                                <div class="flex align-items-center list-user-action">
                                                    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('guards.show' , $item->guard_id)}}">
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
    </div>

@endsection
