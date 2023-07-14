@extends('company.layout.base')
@section('title' , __('admin.Request for new guards'))
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{trans('admin.search for new guards')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                @include('admin.include.messages_errors')
                <div class="new-user-info">
                    {!! Form::open(['method'=>'get' , 'route'=>'company.filter.post' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('jop_type_id' , trans('admin.jop_type_id')) !!}
                            {!! Form::select('jop_type_id' , $job_types , $request->jop_type_id ?? old('jop_type_id') ,['class'=>'form-control' , 'id'=>'jop_type_id' , 'placeholder'=>trans('admin.jop_type_id')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('number_of_guards' , trans('admin.number_of_guards')) !!}
                            <span class="asters">*</span>
                            {!! Form::number('number_of_guards' , $request->number_of_guards ?? old('number_of_guards') ,['class'=>'form-control' , 'id'=>'number_of_guards' , 'placeholder'=>trans('admin.number_of_guards')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('qualification' , trans('admin.qualification')) !!}
                            {!! Form::select('qualification' , ['primary'=>trans('admin.primary') , 'middle'=>trans('admin.middle') , 'secondary'=>trans('admin.secondary') , 'other'=>trans('admin.other')] , $request->qualification ?? old('qualification') ,['class'=>'form-control' , 'id'=>'qualification' , 'placeholder'=>trans('admin.qualification')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('experience' , trans('admin.experience')) !!}
                            {!! Form::select('experience' , ['from_1_year_to_5_years'=>trans('admin.from_1_year_to_5_years') , 'from_6_year_to_10_years'=>trans('admin.from_6_year_to_10_years')] , $request->experience ?? old('experience') ,['class'=>'form-control' , 'id'=>'experience' , 'placeholder'=>trans('admin.experience')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('english' , trans('admin.english')) !!}
                            {!! Form::select('english' , ['poor'=>trans('admin.poor') , 'good'=>trans('admin.good') , 'very_good'=>trans('admin.very_good') , 'excellent'=>trans('admin.excellent')] , $request->english ?? old('english') ,['class'=>'form-control' , 'id'=>'english' , 'placeholder'=>trans('admin.english')]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            <h5>
                                @lang('admin.age range')
                            </h5>
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('age_from' , trans('admin.age_from')) !!}
                            {!! Form::number('age_from' , $request->age_from ?? old('age_from') ,['class'=>'form-control' , 'id'=>'age_from' , 'placeholder'=>trans('admin.age_from')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('age_to' , trans('admin.age_to')) !!}
                            {!! Form::number('age_to' ,$request->age_to ?? old('age_to') ,['class'=>'form-control' , 'id'=>'age_to' , 'placeholder'=>trans('admin.age_to')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('city_id' , trans('admin.city_id')) !!}
                            {!! Form::select('city_id' , $cities ,$request->city_id ?? old('city_id') ,['class'=>'form-control' , 'id'=>'city_id' , 'placeholder'=>trans('admin.city_id')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('gender' , trans('admin.gender')) !!}
                            {!! Form::select('gender' , ['male'=>__('admin.male') , 'female'=>__('admin.female')] , $request->gender ?? old('gender') ,['class'=>'form-control' , 'id'=>'gender' , 'placeholder'=>trans('admin.gender')]) !!}
                        </div>

                        <div class="col-md-12">
                            {!! Form::submit(trans('admin.save') , ['class'=>'btn btn-primary ml-2 pull-left']) !!}
                            {!! Form::reset(trans('admin.cancel') , ['class'=>'btn btn-secondary pull-left']) !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @if(isset($data))
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title" id="#result"> {{trans('admin.search result')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                {!! Form::open(['method'=>'post' , 'route'=>'company.buyCvs']) !!}
                <div>
                    <h5 id="total_count">@lang('admin.total_count') : <span>{{ $data['count'] }}</span></h5>
                    <h5 id="selected_count" class="mb-3">@lang('admin.selected_count') : <span>0</span></h5>
                </div>
                <div class="float-left">
                    {!! Form::submit(__('admin.purchase request') , ['class'=>'btn btn-primary']) !!}
                </div>
                <div class="float-right">
                    <span class="btn btn-primary" id="select_all"> @lang('admin.select all') </span>
                </div>
                <div class="clearfix mb-3"></div>
                <table class="table table-striped table-bordered mt-4 table-hover text-center datatable-example2" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('admin.name')}}</th>
                        <th>{{trans('admin.last update')}}</th>
                        <th>{{trans('admin.image')}}</th>
                        <th>{{trans('admin.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['guards'] as $index=>$item)
                            <tr>
                                <td>
                                    <input type="checkbox" name='users[{{ $item->id }}]' value="{{ $item->id }}" />
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{date('d-m-Y' , strToTime($item->updated_at))}}</td>
                                <td>
                                    @if($item->image != null)
                                        <img src="{{asset('storage/' . $item->image)}}" style="width:40px;height:40px;" />
                                    @else
                                        <img src="{{asset('assets/imgs/avatar.png')}}" style="width:40px;height:40px;" />
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        <a target="_blank" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('guard.profile' , $item->id)}}">
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
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    @if(isset($data))
    $('html,body').animate({
        scrollTop:"500px"
    },500);
    @endif
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
