
@extends('admin.layout.base')
@section('title' , 'dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="text-center">
                        <h5>{{ __('admin.companies') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="value-box">
                            <h4 class="mb-0">
                                <span >{{ $companiesCount }}</span>
                            </h4>
                        </div>
                        <div class="iq-iconbox">
                            <img src="{{ asset('assets/images/icons/number_of_companies.svg') }}" style="width:40px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="text-center">
                        <h5>{{ __('admin.guards') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="value-box">
                            <h4 class="mb-0">
                                <span >{{ $guardsCount }}</span>
                            </h4>
                        </div>
                        <div class="iq-iconbox">
                            <img src="{{ asset('assets/images/icons/number_of_guards.svg') }}" style="width:40px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="text-center">
                        <h5>{{ __('admin.jobsInMonth') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="value-box">
                            <h4 class="mb-0">
                                <span >{{ $jobsInMonth  }}</span>
                            </h4>
                        </div>
                        <div class="iq-iconbox">
                            <img src="{{ asset('assets/images/icons/job_offers_in_month.svg') }}" style="width:40px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="text-center">
                        <h5>{{ __('admin.total_jobs') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="value-box">
                            <h4 class="mb-0">
                                <span >{{ $jobsCount }}</span>
                            </h4>
                        </div>
                        <div class="iq-iconbox">
                            <img src="{{ asset('assets/images/icons/total_job_offers.svg') }}" style="width:40px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            {{trans('admin.job_offers')}}
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">{{trans('admin.company')}}</th>
                                <th scope="col">{{trans('admin.jop_type')}}</th>
                                <th scope="col">{{trans('admin.city')}}</th>
                                <th scope="col">{{trans('admin.district')}}</th>
                                <th scope="col">{{trans('admin.salary')}}</th>
                                <th scope="col">{{trans('admin.date')}}</th>
                                <th scope="col">{{trans('admin.no_of_days')}}</th>
                                <th scope="col">{{trans('admin.no_of_hours')}}</th>
                                <th scope="col">{{trans('admin.last_date_to_accept')}}</th>
                                <th scope="col">{{trans('admin.holidays')}}</th>
                                <th scope="col">{{trans('admin.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($lats5Jobs as $index=>$item)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$item->company->name}}</td>
                                        <td>{{$item->jop_type->name}}</td>
                                        <td>{{$item->city->name}}</td>
                                        <td>{{$item->district->name}}</td>
                                        <td>{{$item->salary}}</td>
                                        <td>{{ date('d-m-Y' , strToTime($item->created_at)) }}</td>
                                        <td>{{$item->no_of_days}}</td>
                                        <td>{{$item->no_of_hours}}</td>
                                        <td>{{$item->last_date_to_accept}}</td>
                                        <td>
                                            {{ __('admin.'.$item->holiday) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="flex align-items-center list-user-action">
                                                <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('admin.show')}}" data-original-title="Edit" href="{{route('jobs.show' , $item->id)}}">
                                                    <i class="ri-slideshow-3-line"></i>
                                                </a>
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
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">{{ __('admin.job_offers_in_year') }}</h4>
                </div>
                </div>
                <div class="iq-card-body">
                    <div id="chartdiv0" style="height: 500px"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ __('admin.job_offer_status') }}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div id="pie_chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var options = {
            series: [{{ $jobOffersNew }} , {{ $jobOffersAccept }} , {{ $jobOffersReject }}],
            chart: {
            width: 430,
            type: 'pie',
            },
            labels: ["{{ __('admin.new') }}", '{{ __('admin.accept') }}', '{{ __('admin.reject') }}'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                    width: 300
                    },
                    legend: {
                    position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#pie_chart"), options);
        chart.render();
    </script>
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {
            var root = am5.Root.new("chartdiv0");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX"
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "month",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, {})
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "month",
                tooltip: am5.Tooltip.new(root, {
                    labelText:"{valueY}"
                })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
            series.columns.template.adapters.add("fill", (fill, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", (stroke, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });
            @php
            $jobs = json_decode($jobs);
            @endphp
            var data = [{
            month: "{{ __('admin.January') }}",
            value: Number("{{ $jobs[0] }}")
            }, {
            month: "{{ __('admin.February') }}",
            value: Number( "{{ $jobs[1] }}")
            }, {
            month: "{{ __('admin.March') }}",
            value: Number( "{{ $jobs[2] }}")
            }, {
            month: "{{ __('admin.April') }}",
            value: Number( "{{ $jobs[3] }}")
            }, {
            month: "{{ __('admin.May') }}",
            value: Number( "{{ $jobs[4] }}")
            }, {
            month: "{{ __('admin.June') }}",
            value: Number( "{{ $jobs[5] }}")
            }, {
            month: "{{ __('admin.July') }}",
            value: Number( "{{ $jobs[6] }}")
            }, {
            month: "{{ __('admin.August') }}",
            value: Number( "{{ $jobs[7] }}")
            }, {
            month: "{{ __('admin.September') }}",
            value: Number( "{{ $jobs[8] }}")
            }, {
            month: "{{ __('admin.October') }}",
            value: Number( "{{ $jobs[9] }}")
            }, {
            month: "{{ __('admin.November') }}",
            value: Number( "{{ $jobs[10] }}")
            }, {
            month: "{{ __('admin.December') }}",
            value: Number( "{{ $jobs[11] }}")
            }];

            xAxis.data.setAll(data);
            series.data.setAll(data);
            series.appear(10);
            chart.appear(10, 100);

        });
    </script>
    <!-- HTML -->
@endsection
