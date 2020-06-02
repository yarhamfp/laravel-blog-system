@extends('layouts.author')
@section('title')
    BakeBlog | Dashboard
@endsection
@section('content')
<div class="page-header pb-8 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Preview Posts</span>
          </h1>
          <div class="page-header-subtitle">Detail tampilan post
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('author.post.index')}}">Post</a></li>
            <li class="breadcrumb-item active">Show Post</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-5">
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="mr-4 mb-3 mb-sm-0">
            <h1 class="mb-0">{{$post->title}}</h1>
            <div class="small">Ditulis oleh <span class="font-weight-500 text-primary"> {{$post->users->name}}</span> dipublikasi pada {{ Carbon\Carbon::create($post->created_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' h:i A')}}</div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-xl-3 mb-4">
          <div class="card bg-light o-visible mb-4">
                <div class="card-body">
                  <h4 class="text-dark">Categories</h4>
                  @foreach ($post->categories as $category)
                    <a href="#!"><span class="badge badge-dark">{{$category->name}}</span></a>
                  @endforeach
                  <br><br>
                  <h4 class="text-dark">Tags</h4>
                  @foreach ($post->tags as $tag)
                    <a href="#!"><span class="badge badge-primary">#{{$tag->name}}</span></a>
                  @endforeach
              </div>
          </div>
          <div class="card bg-dark border-0">
              <div class="card-body">
                  <h5 class="text-white-50">Status Post</h5>
                  <div class="mb-4">
                    @if ($post->status == true)
                      <span class="badge badge-primary"><i class="fa fa-check"></i> Published</span>
                    @else
                      <span class="badge badge-danger"><i data-feather="clock"></i> Pending</span>
                    @endif
                  </div>
                  <h5 class="text-white-50">Is Approved</h5>
                  <div class="mb-4">
                    @if ($post->is_approved == true)
                      <span class="badge badge-primary"><i class="fa fa-check"></i> Approved</span>
                    @else
                      <span class="badge badge-danger"><i data-feather="clock"></i> Pending</span>
                    @endif
                  </div>
                  <div class="card-footer bg-transparent pt-0 border-0 text-right"><a class="btn btn-light btn-sm" href="{{route('author.post.index')}}"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a></div>
              </div>
            </div>
      </div>
      <div class="col-lg-8 col-xl-9 mb-4">
          <div class="card mb-4">
              <div class="card-header">Title</div>
              <div class="card-body">
                <h1>{{$post->title}}</h1>
                <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" class="img-thumbnail" alt="{{$post->slug}}">
              </div>
          </div>
          <div class="card">
              <div class="card-header">Body</div>
              <div class="card-body">
                  <p class="card-text">{!!$post->body!!}</p>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('prepend-style')
<link href="{{ url('toastr/build/toastr.css')}}" rel="stylesheet"/>
@endpush

@push('prepend-script')
<script src="{{ url('toastr/toastr.js')}}"></script>
<script>
  @if(Session::has('sukses'))
  toastr.success("Sukses! {{Session::get('sukses')}}");  
  @endif
  @if(Session::has('error'))
  toastr.error("Error! {{Session::get('error')}}")  
  @endif
  @if(Session::has('warning'))
  toastr.warning("Warning! {{Session::get('warning')}}")  
  @endif
</script>
@endpush