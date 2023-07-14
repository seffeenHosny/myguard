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
                            @if(!empty($data->email))
                            <div class="col-12">{{trans('admin.email')}}:</div>
                            <div class="col-12">{{$data->email}}</div>
                            @endif
                            @if(!empty($data->gender))
                            <div class="col-6">{{trans('admin.gender')}}:</div>
                            <div class="col-6">
                                @if($data->gender == 'male')
                                    {{ __('admin.male') }}
                                @else
                                    {{ __('admin.female') }}
                                @endif
                            </div>
                            @endif
                            @if(!empty($data->iban_no))
                            <div class="col-6">{{trans('admin.iban_no')}}:</div>
                            <div class="col-6">{{$data->iban_no}}</div>
                            @endif
                            @if(!empty($data->qualification))
                            <div class="col-8">{{trans('admin.qualification')}}:</div>
                            <div class="col-4">@lang('admin.'.$data->qualification)</div>
                            @endif
                            @if(!empty($data->english))
                            <div class="col-12">{{trans('admin.english')}}:</div>
                            <div class="col-12">@lang('admin.'.$data->english)</div>
                            @endif
                            @if(!empty($data->age))
                            <div class="col-6">{{trans('admin.age')}}:</div>
                            <div class="col-6">{{$data->age}}</div>
                            @endif
                            @if(!empty($data->experience))
                            <div class="col-4">{{trans('admin.experience')}}:</div>
                            <div class="col-8">@lang('admin.'.$data->experience)</div>
                            @endif
                            @if(!empty($data->social_status))
                            <div class="col-8">{{trans('admin.social_status')}}:</div>
                            <div class="col-4">
                                @if($data->social_status == 'married')
                                    {{ __('admin.married') }}
                                @else
                                    {{ __('admin.single_social_status') }}
                                @endif
                            </div>
                            @endif
                            @if(!empty($data->jop_type))
                            <div class="col-6">{{trans('admin.jop_type')}}:</div>
                            <div class="col-6">{{$data->jop_type->name}}</div>
                            @endif
                            @if(!empty($data->city))
                            <div class="col-6">{{trans('admin.city')}}:</div>
                            <div class="col-6">{{$data->city->name}}</div>
                            @endif
                            @if(!empty($data->district))
                            <div class="col-6">{{trans('admin.district')}}:</div>
                            <div class="col-6">{{$data->district->name}}</div>
                            @endif
                            @if(!empty($data->other_cities))
                            <div class="col-12">{{trans('admin.other_cities')}}:</div>
                            <div class="col-12">{{__('admin.other_cities_'.$data->other_cities)}}</div>
                            @endif
                            @if(!empty($data->offer_me))
                            <div class="col-6">{{trans('admin.offer_me')}}:</div>
                            <div class="col-6">{{$data->offer_me}}</div>
                            @endif
                            @if(!empty($data->appear))
                            <div class="col-6">{{trans('admin.appear')}}:</div>
                            <div class="col-6">{{$data->appear}}</div>
                            @endif
                            @if(!empty($data->communication))
                            <div class="col-6">{{trans('admin.communication')}}:</div>
                            <div class="col-6">{{$data->communication}}</div>
                            @endif
                            @if(isset($data->subscribe_package_days))
                            <div class="col-6">{{trans('admin.subscription')}} : </div>
                            <div class="col-6">{{$data->subscribe_package_days}}</div>
                            @else
                            <div class="col-md-4 mb-3">
                                <h5>{{trans('admin.subscription')}}</h5>
                                <h6>0</h6>
                            </div>
                            @endif
                            @if(!empty($data->no_experience))
                                @if($data->no_experience == 0)
                                    <div class="col-12">{{trans('admin.no_experience')}}:</div>
                                @endif
                            @endif

                            @if(!empty($data->military_experience))
                                @if($data->military_experience == 0)
                                    <div class="col-12">{{trans('admin.military_experience')}}:</div>
                                @endif
                            @endif

                            @if(!empty($data->experience_of_the_filed_of_security))
                                @if($data->experience_of_the_filed_of_security == 0)
                                    <div class="col-12">{{trans('admin.experience_of_the_filed_of_security')}}:</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($data->identification_id))
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{trans('admin.identification_id')}}
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <a href="{{ asset('storage/'.$data->identification_id) }}" >
                        <img class="img-fluid" src="{{ asset('storage/'.$data->identification_id) }}" alt="profile-pic">
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
                            <a class="nav-link active" data-toggle="pill" href="#guard_packages">{{ __('admin.guard_packages') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="pill" href="#job_offers">{{ __('admin.job_offers') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="guard_packages">
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
                                            <th>{{trans('admin.package_duration')}}</th>
                                            <th>{{trans('admin.start_date')}}</th>
                                            <th>{{trans('admin.status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->subscribe_guard_packages as $index=>$item)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$item->guard_package->title}}</td>
                                                <td>{{$item->guard_package->description}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->tax}}</td>
                                                <td>{{$item->total_price}}</td>
                                                <td>{{$item->guard_package->no_of_days}}</td>
                                                <td>{{date('d-m-Y' , strToTime($item->created_at))}}</td>
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
                                        <th>{{trans('admin.status')}}</th>
                                        <th>{{trans('admin.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->job_users as $index=>$item)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$item->job->jop_type->name}}</td>
                                                <td>{{$item->job->city->name}}</td>
                                                <td>{{$item->job->district->name}}</td>
                                                <td>{{$item->job->salary}}</td>
                                                <td>{{ date('d-m-Y' , strToTime($item->job->created_at)) }}</td>
                                                <td>{{$item->job->no_of_days}}</td>
                                                <td>{{$item->job->no_of_hours}}</td>
                                                <td>{{$item->job->last_date_to_accept}}</td>
                                                <td>
                                                    {{ __('admin.'.$item->holiday) }}
                                                </td>
                                                <td>
                                                    @if($item->status == 'new')
                                                        {{ __('admin.new') }}
                                                    @elseif($item->status == 'accept')
                                                        {{ __('admin.accept') }}
                                                    @elseif($item->status == 'reject')
                                                        {{ __('admin.reject') }}
                                                    @endif
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
        </div>
    </div>

@endsection
