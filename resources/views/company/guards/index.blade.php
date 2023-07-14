@extends('company.layout.base')
@section('title' , __('admin.guards'))
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{trans('admin.guards')}}</h4>
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
                @if(session()->has('error'))
                    <div class="alert text-white bg-primary" role="alert">
                        <div class="iq-alert-text">{{session()->get('error')}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                @include('admin.include.messages_errors')
                {!! Form::open(['method'=>'post' , 'route'=>'company.create_job_offer']) !!}
                <div>
                    <h5 id="total_count">@lang('admin.total_count') : <span>{{ $data['count'] }}</span></h5>
                    <h5 id="selected_count" class="mb-3">@lang('admin.selected_count') : <span>0</span></h5>
                </div>
                <div class="float-left">
                    {!! Form::submit(__('admin.Send Job Offer') , ['class'=>'btn btn-primary']) !!}
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('company.guards.filter') }}"> @lang('admin.filter') </a>
                    <span class="btn btn-primary" id="select_all"> @lang('admin.select all') </span>
                </div>
                <div class="clearfix mb-3"></div>
                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example2" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('admin.name')}}</th>
                        <th>{{trans('admin.last update')}}</th>
                        <th>{{ trans('admin.the_number_of_days_left') }}</th>
                        <th>{{trans('admin.image')}}</th>
                        <th>{{trans('admin.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['guards'] as $index=>$item)
                            <tr>
                                <td>
                                    <input type="checkbox" name='users[{{ $item->guard_id }}]' value="{{ $item->guard_id }}" />
                                </td>
                                <td>{{$item->company_guard->name}}</td>
                                <td>{{date('d-m-Y' , strToTime($item->company_guard->updated_at))}}</td>
                                <td>{{$item->the_number_of_days_left}}</td>
                                <td>
                                    @if($item->company_guard->image != null)
                                        <img src="{{asset('storage/' . $item->company_guard->image)}}" style="width:40px;height:40px;" />
                                    @else
                                        <img src="{{asset('assets/imgs/avatar.png')}}" style="width:40px;height:40px;" />
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a target="_blank" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('guard.profile' , $item->guard_id)}}">
                                            <i class="ri-slideshow-3-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#select_all').on('click' , function(){
        $('input[type="checkbox"]').prop('checked', true);
        var count = $('input:checkbox:checked').length;
        $('#selected_count span').text(count);
    });

    $('input[type="checkbox"]').on('change' , function(){
        var count = $('input:checkbox:checked').length;
        $('#selected_count span').text(count);
    });
</script>
@endsection
