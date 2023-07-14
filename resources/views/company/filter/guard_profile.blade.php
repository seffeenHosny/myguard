@extends('company.layout.base')

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
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($data->identification_id))
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h5 class="card-title">
                            {{trans('admin.identification_id')}}
                        </h5>
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
                    <div class="row">
                        @if(!empty($data->email))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.email')}}</h5>
                            <h6>{{$data->email}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->gender))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.gender')}}</h5>
                            <h6>
                                @if($data->gender == 'male')
                                    {{ __('admin.male') }}
                                @else
                                    {{ __('admin.female') }}
                                @endif
                            </h6>
                        </div>
                        @endif

                        @if(!empty($data->iban_no))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.iban_no')}}</h5>
                            <h6>{{$data->iban_no}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->qualification))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.qualification')}}</h5>
                            <h6>{{__('admin.'.$data->qualification)}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->english))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.english')}}</h5>
                            <h6>{{__('admin.'.$data->english)}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->other_cities))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.other_cities')}}</h5>
                            <h6>{{__('admin.other_cities_'.$data->other_cities)}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->age))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.age')}}</h5>
                            <h6>{{$data->age}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->experience))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.experience')}}</h5>
                            <h6>{{__('admin.'.$data->experience)}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->social_status))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.social_status')}}</h5>
                            <h6>
                                @if($data->social_status == 'married')
                                    {{ __('admin.married') }}
                                @else
                                    {{ __('admin.single_social_status') }}
                                @endif
                            </h6>
                        </div>
                        @endif

                        @if(!empty($data->jop_type))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.jop_type')}}</h5>
                            <h6>{{$data->jop_type->name}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->city))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.city')}}</h5>
                            <h6>{{$data->city->name}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->district))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.district')}}</h5>
                            <h6>{{$data->district->name}}</h6>
                        </div>
                        @endif

                        @if(!empty($data->offer_me))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.offer_me')}}</h5>
                            <h6>{{$data->offer_me}}</h6>
                        </div>
                        @else
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.offer_me')}}</h5>
                            <h6>0</h6>
                        </div>
                        @endif

                        @if(!empty($data->appear))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.appear')}}</h5>
                            <h6>{{$data->appear}}</h6>
                        </div>
                        @else
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.appear')}}</h5>
                            <h6>0</h6>
                        </div>
                        @endif

                        @if(!empty($data->communication))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.communication')}}</h5>
                            <h6>{{$data->communication}}</h6>
                        </div>
                        @else
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.communication')}}</h5>
                            <h6>0</h6>
                        </div>
                        @endif

                        @if(isset($data->subscribe_package_days))
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.subscription')}}</h5>
                            <h6>{{$data->subscribe_package_days}}</h6>
                        </div>
                        @else
                        <div class="col-md-4 mb-3">
                            <h5>{{trans('admin.subscription')}}</h5>
                            <h6>0</h6>
                        </div>
                        @endif

                        @if(!empty($data->no_experience))
                        <div class="col-md-4 mb-3">
                            @if($data->no_experience == 0)
                                <h5>{{trans('admin.no_experience')}}:</h5>
                            @endif
                        </div>
                        @endif

                        @if(!empty($data->military_experience))
                        <div class="col-md-4 mb-3">
                            @if($data->military_experience == 0)
                                <h5>{{trans('admin.military_experience')}}:</h5>
                            @endif
                        </div>
                        @endif

                        @if(!empty($data->experience_of_the_filed_of_security))
                        <div class="col-md-4 mb-3">
                            @if($data->experience_of_the_filed_of_security == 0)
                                <h5>{{trans('admin.experience_of_the_filed_of_security')}}:</h5>
                            @endif
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
