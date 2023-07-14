<html>
    <head>
        <title>{{ __('admin.app-name') }}</title>
        <link rel="icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            h3{
                padding: 20px;
                background: #295F8B;
                color: #FFF;
                font-size: 30px;
                margin-top: 0;
                text-align: right;
            }
            h4{
                color: #295F8B;
                font-size: 30px;
                font-weight: bold;
                padding: 15px 0 ;
            }
            .p-0{
                padding: 0 !important;
            }
            body{
                padding: 0;
                margin: 0;
                overflow-x: hidden;
            }
            .logo{
                width: 150px;
                padding: 15px;
            }
            @if(auth()->user())
                @if(auth()->user()->lang == 'en')
                h3{
                    text-align: left;
                }
                @else
                @endif
            @endif
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" style="margin-top:30px">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="row" style="border:1px solid #EEE">
                        <div class="p-0">
                            <h3>{{ __('admin.app-name') }}</h3>
                        </div>
                        <div class="col-sm-4 col-12 p-0 text-ceter">
                            <img src="{{asset('assets/images/logo.svg')}}" class="logo">
                        </div>
                        <div class="col-sm-8 col-12 p-0">
                            <h4>{{ __('admin.Thank_You') }}</h4>
                            <p>{!! $message !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </body>
</html>

