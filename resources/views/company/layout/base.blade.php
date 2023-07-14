
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta char set="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{trans('admin.app-name')}} | @yield('title')</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo.svg') }}" />

        <!-- ====================================== start css vito files ========================== -->
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/bootstrap.min.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/typography.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/style.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/responsive.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/'.trans('admin.lang').'/css/custom-lang.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div id="token"></div>
            @include('company.include.header')
            @include('company.include.sidebar')
            <div id="content-page" class="content-page">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('admin.include.footer')
        <script src="{{asset('assets/js/map-input.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('google_key') }}&libraries=places&callback=initialize" async defer></script>
        <!-- ===============================  start vito js files =============================== -->
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/jquery.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/jquery-3.3.1.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/popper.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/bootstrap.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/jquery.appear.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/countdown.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/waypoints.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/jquery.counterup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/wow.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/apexcharts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/slick.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/select2.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/owl.carousel.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/jquery.magnific-popup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/smooth-scrollbar.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/lottie.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/bodymovin.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/core.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/charts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/animated.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/highcharts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/highcharts-3d.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/highcharts-more.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/kelly.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/maps.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/morris.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/morris.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/raphael-min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/worldLow.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/en/js/chart-custom.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/'.trans('admin.lang').'/js/custom.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('assets/plugins/Multiple-Image/dist/js/spartan-multi-image-picker-min.js')}}"></script>
        <!-- ===============================  start datatable js files =============================== -->
        <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
        {{-- <script src="{{asset('service-worker.js')}}"></script>
        <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script> --}}
        <!-- ===============================  end datatable js files =============================== -->
        <script>
            $(document).ready(function() {
                $('.datatable-example').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> Copy',
                        titleAttr: 'copy',
                        title: 'Insurance Companies',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        titleAttr: 'Export to Excel',
                        title: 'Insurance Companies',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i> CSV',
                        titleAttr: 'CSV',
                        title: 'Insurance Companies',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i> PDF',
                        titleAttr: 'PDF',
                        title: 'Insurance Companies',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'print',
                        exportOptions: {
                        columns: ':visible'
                        },
                        customize: function(win) {
                            $(win.document.body).find( 'table' ).find('td:last-child, th:last-child').remove();
                        }
                    },
                    ]
                } );

                $('.datatable-example2').DataTable( {
                    "paging":   false,
                    "ordering": true,
                    "info":     false
                } );

                $('.iq-menu-bt-sidebar').on('click' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').removeClass('delete-logo-text');
                    }else{
                        $('.logo-text').addClass('delete-logo-text');
                    }
                });

                $('.iq-sidebar').on('mouseleave' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').fadeOut(300);
                    }
                });

                $('.iq-sidebar').on('mouseenter' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').fadeIn(300);
                    }
                });

                $('.notification_item').on('click' , function(){
                    let id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('notifications.read') }}",
                        dataType: "JSON",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id':id,
                            },
                        success: function (data) {
                            window.location.href = "{{ route('company.jobOffers') }}";
                        }
                    });
                });

                $('.read_all_notifications').on('click' , function(){
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('notifications.read.all') }}",
                        dataType: "JSON",
                        data: {
                            "_token": "{{ csrf_token() }}"
                            },
                        success: function (data) {
                            $('.iq-sub-card.notification_item').remove();
                            $('.count-of-notification').text('0');
                            $('.read_all_notifications').remove();
                        }
                    });
                });


            } );
        </script>

        @yield('script')
        <!-- ===============================  end vito js files ================================= -->
    </body>
</html>
