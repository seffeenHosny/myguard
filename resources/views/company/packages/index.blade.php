@extends('company.layout.base')
@section('title', trans('admin.packages'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.packages')}}
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
                @if(session()->has('error'))
                    <div class="alert text-white bg-primary" role="alert">
                        <div class="iq-alert-text">{{session()->get('error')}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                @include('admin.include.messages_errors')
                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('admin.title')}}</th>
                        <th>{{trans('admin.description')}}</th>
                        <th>{{trans('admin.no_of_days_company')}}</th>
                        <th>{{trans('admin.no_of_cvs')}}</th>
                        <th>{{trans('admin.type')}}</th>
                        <th>{{trans('admin.price')}}</th>
                        <th>{{trans('admin.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $index=>$item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    @if($item->type == 'monthly')
                                    {{$item->no_of_days}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->type == 'monthly')
                                    {{$item->no_of_cvs}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->type == 'single')
                                        {{ __('admin.single') }}
                                    @else
                                        {{ __('admin.monthly') }}
                                    @endif
                                </td>
                                <td>{{$item->price}}</td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a class="iq-bg-primary" href="#" data-toggle="modal" data-target="#subscribemodel{{$item->id}}">
                                            <i class="fa fa-money" data-toggle="tooltip" data-placement="top" title="{{trans('admin.subscribe')}}"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="subscribemodel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="subscribemodellabel{{$item->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="subscribemodelLabel{{$item->id}}">{{__('admin.subscribe')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($item->type == 'single')
                                                        {!! Form::number('no_of_cvs' , old('no_of_cvs') ,['class'=>'form-control' , 'required'=>'required' , 'placeholder'=>__('admin.no_of_cvs') , 'form'=>'paymentForm'.$item->id]) !!}
                                                        @else
                                                        <p class="text-left">
                                                            {{__('admin.Are you sure you want to subscribe?')}}
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin.cancel')}}</button>
                                                        {!! Form::open(['method'=>'post' , 'route'=>'company.createPayForm', 'class'=>'d-inline' , 'id'=>'paymentForm'.$item->id]) !!}
                                                        {!! Form::hidden('type' , 'company') !!}
                                                        {!! Form::hidden('package_id' , $item->id) !!}
                                                        {!! Form::hidden('package_type' , $item->type) !!}
                                                        <button type="submit" class="btn btn-primary border-0" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="{{trans('admin.subscribe')}}">
                                                                {{trans('admin.subscribe')}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
