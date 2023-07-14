@extends('company.layout.base')
@section('title' , __('admin.job_offers'))
@section('content')
<div class="row">
    @foreach ($data as $job_offer)
    <div class="col-lg-4 col-md-6">
        <div class="p-2 mb-3" style="background:#BED8E0">
            <a href="{{ url('company/job_offers/guards?offer_id='.$job_offer->id ) }}">

                <div class="media">
                    @if(!empty($job_offer->company->image))
                    <img class="mr-3" style="width: 40px;height: 40px;border-radius: 50%" src="{{ asset('storage/'.$job_offer->company->image) }}" >
                    @else
                    <img class="mr-3" style="width: 40px;height: 40px;border-radius: 50%" src="{{ asset('assets/imgs/avatar.png') }}" >
                    @endif
                    <div class="media-body">
                        <h5 class="mt-0" style="color:#13718D">{{ $job_offer->company->name }}</h5>
                        <p class="text-danger">{{ date('d-m-Y' , strToTime($job_offer->created_at)) }}</p>
                    </div>
                </div>
                <hr class="mt-0" style="border-top: 1px solid #13718D">
                <h5>@lang('admin.job'):{{ $job_offer->jop_type->name }}</h5>
                <h5>@lang('admin.city'):{{ $job_offer->city->name }}</h5>
                <h5>@lang('admin.district'):{{ $job_offer->district->name }}</h5>
                <h5>@lang('admin.last_date_to_accept'):{{ $job_offer->last_date_to_accept }}</h5>
                <h5>@lang('admin.job_users_count'):{{ $job_offer->job_users_count }}</h5>
                @if($job_offer->work_nature_id != null)
                <h5>@lang('admin.work_nature') :
                    @if($job_offer->work_nature_id == 1)
                        {{ $job_offer->work_nature_text }}
                    @else
                    {{ $job_offer->work_nature->nature}}
                    @endif
                </h5>
                @endif
                <h5>@lang('admin.holidays'):{{ __('admin.'.$job_offer->holiday) }}</h5>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
