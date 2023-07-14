@extends('company.layout.base')
@section('title', trans('admin.contact_us'))
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('admin.contact_us')}}
                    </h4>
                </div>
            </div>

            <div class="iq-card-body">
                @include('admin.include.messages_errors')
                @if(session()->has('success'))
                    <div class="alert text-white bg-primary" role="alert">
                        <div class="iq-alert-text">{{session()->get('success')}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                {!! Form::open(['method'=>'post' , 'route'=>'company.technical_supports.store' ,'enctype'=>'multipart/form-data'  , 'id'=>'contact-us-form']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('contact_reason_id' , trans('admin.contact_reason_id')) !!}
                            <span class="asters">*</span>
                            {!! Form::select('contact_reason_id' , $contact_reasons , old('contact_reason_id') ,['class'=>'form-control' , 'id'=>'contact_reason_id' , 'placeholder'=>trans('admin.contact_reason_id')]) !!}
                        </div>

                        <div class="col-md-6 form-group">
                            {!! Form::label('file' , trans('admin.file')) !!}
                            {!! Form::hidden('type', null , ['id'=>'type']) !!}
                            {!! Form::file('file' , ['class'=>'form-control-file' , 'id'=>'file']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('message' , trans('admin.message')) !!}
                            <span class="asters">*</span>
                            {!! Form::textarea('message' , old('message') ,['class'=>'form-control' , 'id'=>'message' , 'placeholder'=>trans('admin.message') , 'rows'=>3]) !!}
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
@endsection
@section('script')
<script>
    function getExtension(filename) {
        var parts = filename.split('.');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'jpg':
            case 'gif':
            case 'jpeg':
            case 'png':
            case 'svg':
            //etc
            return true;
        }
        return false;
    }

    function isVideo(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'qt':
            case 'ogg':
            case 'mov':
            case 'mp4':
            // etc
            return true;mp4,mov,ogg,qt
        }
        return false;
    }

    $(function() {
        $('#file').on('change',function() {
            function failValidation(msg) {
                alert(msg); // just an alert for now but you can spice this up later
                return false;
            }
            var file = $('#file');
            if (isImage(file.val())) {
                $('#type').val('image');
            } else if (isVideo(file.val())) {
                $('#type').val('video');
            }else{
                $('#type').val('');
                alert('Please select a valid file');
            }

            return false;
        });
    });
</script>
@endsection
