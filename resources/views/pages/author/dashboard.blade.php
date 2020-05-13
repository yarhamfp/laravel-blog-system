@extends('layouts.author')
@section('title')
    BakeBlog | Dashboard
@endsection
@section('content')
<div class="container-fluid mt-5">
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="mr-4 mb-3 mb-sm-0">
            <h1 class="mb-0">Dashboard</h1>
            @php
                date_default_timezone_set('Asia/Jakarta');
                $waktuSekarang = date('d-m-Y H:i:s');
            @endphp
            <div class="small"><span class="font-weight-500 text-primary">{{ Carbon\Carbon::create($waktuSekarang)->format('l')}}</span> &#xB7; {{ Carbon\Carbon::create($waktuSekarang)->format('d F, Y'.' .'.' h:i A')}}</div>
        </div>
        <div class="dropdown">
            <a class="btn btn-white btn-sm font-weight-500 line-height-normal p-3 dropdown-toggle" id="dropdownMenuLink" href="#" role="button" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"><i class="text-primary mr-2" data-feather="calendar"></i>Jan - Feb 2020</a>
            <div class="dropdown-menu dropdown-menu-sm-right animated--fade-in" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#!">Last 30 days</a><a class="dropdown-item" href="#!">Last week</a><a class="dropdown-item" href="#!">This year</a><a class="dropdown-item" href="#!">Yesterday</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#!">Custom</a>
            </div>
        </div>
    </div>
    <div class="alert alert-primary border-0 mb-4 mt-5 px-md-5">
        <div class="position-relative">
            <div class="row align-items-center justify-content-between">
                <div class="col position-relative">
                    <h2 class="text-primary">Welcome back Author, your dashboard is ready!</h2>
                    <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view sales, generate links, prepare coupons, and download affiliate reports using this dashboard.</p>
                    <a class="btn btn-teal" href="#!">Get started<i class="ml-1" data-feather="arrow-right"></i></a>
                </div>
                <div class="col d-none d-md-block text-right pt-3"><img class="img-fluid mt-n5" src="{{ url('backend/assets/img/drawkit/color/drawkit-content-man-alt.svg') }}" style="max-width: 25rem;" /></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-blue h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-blue mb-1">Earnings (monthly)</div>
                            <div class="h5">$4,390</div>
                            <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-purple h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-purple mb-1">Average sale price</div>
                            <div class="h5">$27.00</div>
                            <div class="text-xs font-weight-bold text-danger d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-down"></i>3%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-green h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-green mb-1">Jurusan</div>
                            <div class="h5">13</div>
                            <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-yellow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-yellow mb-1">Exstrakulikuler</div>
                            <div class="h5">12</div>
                            <div class="text-xs font-weight-bold text-danger d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-down"></i>1%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-percentage fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-3 mb-4">
            <div class="card bg-secondary o-visible mb-4">
                <div class="card-body">
                    <h4 class="text-white">Report generation</h4>
                    <p class="text-white-50">Ready to get started? Let us know now! It&apos;s time to start building that dashboard you&apos;ve been waiting to create!</p>
                    <img class="float-left" src="{{ url('backend/assets/img/drawkit/color/drawkit-developer-woman-flush.svg') }}" style="width: 8rem; margin-left: -2.5rem; margin-bottom: -5.5rem;" />
                </div>
                <div class="card-footer bg-transparent pt-0 border-0 text-right"><a class="btn btn-primary" href="#!">Continue</a></div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Affiliate Reports</div>
                <div class="list-group list-group-flush small">
                    <a class="list-group-item list-group-item-action border-top" href="#!"><i class="fas fa-dollar-sign fa-fw text-blue mr-2"></i>Earnings Reports</a><a class="list-group-item list-group-item-action" href="#!"><i class="fas fa-tag fa-fw text-purple mr-2"></i>Average Sale Price</a><a class="list-group-item list-group-item-action" href="#!"><i class="fas fa-mouse-pointer fa-fw text-green mr-2"></i>Engagement (Clicks &amp; Impressions)</a><a class="list-group-item list-group-item-action" href="#!"><i class="fas fa-percentage fa-fw text-yellow mr-2"></i>Conversion Rate</a><a class="list-group-item list-group-item-action" href="#!"><i class="fas fa-chart-pie fa-fw text-pink mr-2"></i>Segments</a>
                </div>
                <div class="card-footer">
                    <a class="text-xs d-flex align-items-center justify-content-between" href="#!">View More Reports<i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="card bg-secondary border-0">
                <div class="card-body">
                    <h5 class="text-white-50">Budget reporting</h5>
                    <div class="mb-4"><span class="display-4 text-white">$48k</span><span class="text-white-50"> per year</span></div>
                    <div class="progress bg-white-25 rounded-pill" style="height: 0.5rem;"><div class="progress-bar bg-white w-75 rounded-pill" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-9 mb-4">
            <div class="card mb-4">
                <div class="card-header">Sales reporting</div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Sales reporting</div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('prepend-script')
<script src="{{ url('backend/cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('backend/assets/demo/chart-bar-demo.js') }}"></script>
@endpush