@extends('admin.layout.base')
@section('title', __('admin.contact_us'))
@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-body">
                @if(!empty($contact_us->user->image))
                    <img class="profile-pic img-fluid" src="{{ asset('storage/'.$contact_us->user->image) }}" alt="profile-pic">
                @else
                    <img class="profile-pic img-fluid" src="{{ asset('assets/imgs/avatar.png') }}" alt="profile-pic">
                @endif
            </div>
        </div>

        <div class="iq-card">
            <div class="iq-card-body">
                <div class="about-info m-0 p-0">
                    <div class="row">
                        @if(!empty($contact_us->user->name))
                        <div class="col-4">{{trans('admin.name')}}:</div>
                        <div class="col-8">{{$contact_us->user->name}}</div>
                        @endif
                        @if(!empty($contact_us->user->phone))
                        <div class="col-5">{{trans('admin.phone')}}:</div>
                        <div class="col-7">{{$contact_us->user->phone}}</div>
                        @endif

                        @if(!empty($contact_us->user->email))
                        <div class="col-12">{{trans('admin.email')}}:</div>
                        <div class="col-12">{{$contact_us->user->email}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="iq-card">
            <div class="iq-card-body">
                <h4>@lang('admin.contact_reason')</h4>
                <p>{{ $contact_us->contact_reason->reason }}</p>
                <h4>@lang('admin.message')</h4>
                <p>{{ $contact_us->message }}</p>
                @if($contact_us->file != null)
                    @if($contact_us->type == 'video')
                    <video controls style="max-width: 100%">
                        <source src="{{asset('storage/'.$contact_us->file)}}">
                        Your browser does not support the video tag.
                    </video>
                    @else
                        <img src="{{ asset('storage/'.$contact_us->file)}}" class="img-fluid" />
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

