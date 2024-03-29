@extends('layouts.app')
@section('title')
    Hasil Tag
@endsection
@section('content')
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">
        <small>Hasil dari pencarian</small> {{$search}} <span class="badge badge-secondary">{{$posts->count()}}</span>
      </h1>
  
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">pencarian-{{$search}}</li>
      </ol>

      {{-- <header class="mb-4">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url('http://placehold.it/750x300'); height:250px;">
              <h3 class="carousel-caption">Search</h3>
            </div>
          </div>
      </header> --}}

      <div class="row">
        @forelse ($posts as $item)
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="{{route('blogpost', $item->slug)}}"><img class="card-img-top" src="{{Storage::disk('public')->url('post/thumb/'.$item->image)}}" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="{{route('blogpost', $item->slug)}}">{{$item->title}}</a>
              </h4>
              <p class="card-text">{!!Str::limit($item->body)!!}</p>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$item->created_at->diffForHumans()}} by
              <a href="#!" class="text-dark"><strong>{{$item->users->name}}</strong></a>
            </div>
          </div>
        </div>
        @empty
          <div class="row mx-auto">
            <div class="col-md-12 mb-4">
              <h3>Tidak ada hasil untuk Pencarian <span class="badge badge-secondary">{{$search}}</span></h3>
            </div>
            <a href="{{route('home')}}" class="btn btn-primary">Back</a>
          </div>
        @endforelse
      </div>
  
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          {{$posts->links()}}
        </li>
      </ul>
  
    </div>
    <!-- /.container -->
@endsection