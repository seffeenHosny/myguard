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
                    {!! Form::open(['method'=>'post' , 'route'=>'company.send_job_offer' ,'enctype'=>'multipart/form-data'  , 'id'=>'add-user-form']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('city_id' , trans('admin.city_id')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('city_id' , $cities , old('city_id') ,['class'=>'form-control' , 'id'=>'city_id' , 'placeholder'=>trans('admin.city_id')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('district_id' , trans('admin.district')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('district_id' , [] , old('district_id') ,['class'=>'form-control' , 'id'=>'district_id' , 'placeholder'=>trans('admin.district')]) !!}
                            {!! Form::hidden('jop_type_id' , $jop_type_id) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('salary' , trans('admin.salary')) !!}
                            <span class="asters">*</span>
                            {!! Form::text('salary' , old('salary') ,['class'=>'form-control' , 'id'=>'salary' , 'placeholder'=>trans('admin.salary')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('holiday' , trans('admin.holidays')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('holiday' , ['one_day'=>trans('admin.one_day') , 'two_day'=>trans('admin.two_day')] , old('holiday') ,['class'=>'form-control' , 'id'=>'holiday' ]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('no_of_days' , trans('admin.no_of_days')) !!}
                            <span class="asters">*</span>
                            {!! Form::number('no_of_days' , old('no_of_days') ,['class'=>'form-control' , 'id'=>'no_of_days' , 'placeholder'=>trans('admin.no_of_days')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('no_of_hours' , trans('admin.no_of_hours')) !!}
                            <span class="asters">*</span>
                            {!! Form::number('no_of_hours' , old('no_of_hours') ,['class'=>'form-control' , 'id'=>'no_of_hours' , 'placeholder'=>trans('admin.no_of_hours')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('last_date_to_accept' , trans('admin.last_date_to_accept')) !!}
                            {!! Form::text('last_date_to_accept' , old('last_date_to_accept') ,['class'=>'form-control' , 'id'=>'last_date_to_accept' , 'placeholder'=>trans('admin.last_date_to_accept')]) !!}
                            <select name="users[]" multiple class="d-none">
                                @foreach($users as $user_id)
                                    <option selected="selected" value="{{ $user_id }}">{{ $user_id }}</option>
                                @endforeach
                            </select>
                            <span class="asters">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('work_nature_id' , trans('admin.work_nature_id')) !!}
                            {!! Form::select('work_nature_id' , $work_natures , old('work_nature_id') ,['class'=>'form-control' , 'id'=>'work_nature_id' , 'placeholder'=>trans('admin.work_nature_id')]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('work_nature_text' , trans('admin.work_nature_text_placeholder')) !!}
                            {!! Form::textarea('work_nature_text' , old('work_nature_text') ,['class'=>'form-control' , 'id'=>'work_nature_text' , 'placeholder'=>trans('admin.work_nature_text_placeholder') , 'rows'=>3]) !!}
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

    </div>
</div>

@endsection
@section('script')
<script>
    @if(old('city_id'))
        getCities("{{ old('city_id') }}" , "{{ old('district_id') }}");
    @endif

    $('#city_id').on('change' , function(){
        var id = $(this).val();
        getCities(id);
    });

    function getCities(id , district_id = null){
        var route = "{{ route('city.districts' , 'cityId') }}";
        var url = route.replace('cityId' , id);
        $.ajax({
            type: 'POST',
            global: false,
            url: url,
            dataType: "JSON",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                $('#district_id').empty();
                var districts = data.data;
                for(var i in districts){
                    if(city_id == null){
                        $('#district_id').append(`
                            <option value="`+districts[i].id+`">`+districts[i].name+`</option>
                        `);
                    }else{
                        if(city_id == districts[i].id){
                            $('#district_id').append(`
                                <option selected value="`+districts[i].id+`">`+districts[i].name+`</option>
                            `);
                        }else{
                            $('#district_id').append(`
                                <option value="`+districts[i].id+`">`+districts[i].name+`</option>
                            `);
                        }
                    }
                }
            },
        });
    }
</script>
@endsection
