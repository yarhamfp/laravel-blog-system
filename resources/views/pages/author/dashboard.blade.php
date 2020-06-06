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
                    <h2 class="text-primary">Selamat datang kembali, Dasbor anda sudah siap!</h2>
                    <p class="text-gray-700">Kerja bagus, dasbor anda siap digunakan! Anda dapat melihat total post, total tag, total kategori, total komentar, total pemirsa, dan total user</p>
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
                            <div class="small font-weight-bold text-blue mb-1">Total Posts</div>
                            <div class="h5">{{$posts->count()}}</div>
                            <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-folder-open fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-purple h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-purple mb-1">All Views</div>
                            <div class="h5">{{$all_views}}</div>
                            <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>3%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-eye fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-green h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-green mb-1">All Kategori</div>
                            <div class="h5">{{$category}}</div>
                            <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-list fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-yellow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small font-weight-bold text-yellow mb-1">Pending Posts</div>
                            <div class="h5">{{$total_pending_posts}}</div>
                            <div class="text-xs font-weight-bold text-danger d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-down"></i>1%</div>
                        </div>
                        <div class="ml-2"><i class="fas fa-spinner fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-3 mb-4">
            <div class="card bg-secondary o-visible mb-4">
                <div class="card-body">
                    <h4 class="text-white">Ayo buat post</h4>
                    <p class="text-white-50">Jangan biarkan pemikiran atau ide anda terbuang sia - sia. Ayo abadikan dan bagikan itu semua disini!</p>
                    <img class="float-left" src="{{ url('backend/assets/img/drawkit/color/drawkit-developer-woman-flush.svg') }}" style="width: 8rem; margin-left: -2.5rem; margin-bottom: -5.5rem;" />
                </div>
                <div class="card-footer bg-transparent pt-0 border-0 text-right"><a class="btn btn-primary" href="{{route('author.post.create')}}">Buat Post</a></div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-9 mb-4">
            <div class="card mb-4">
                <div class="card-header">Popular Posts ( view lebih dari 10)</div>
                <div class="card-body">
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Views</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($popular_posts as $key=>$post)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{Str::limit($post->title, '20')}}</td>
                                    <td class="text-center">{{$post->view_count}}</td>
                                    <td class="text-center">{{$post->comments->count()}}</td>
                                    <td>
                                        @if ($post->status == true)
                                            <span class="badge badge-primary">Published</span>
                                        @else
                                            <span class="badge badge-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.post.show',$post->id)}}" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Popular Post Kosong
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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