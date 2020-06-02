@extends('layouts.app')
@section('title')
  Categories 
@endsection
@section('content')
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">All
        <small>Categories</small>
      </h1>
  
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
  
      <div class="row">
        @foreach ($categories as $item)
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100" style="background-image: url('{{Storage::disk('public')->url('category/slider/'.$item->image)}}'); height: 250px !important;">
            <a href="#"><img class="card-img-top" src="" alt=""></span></a>
            <div class="mx-auto" style="margin-top: 92px">
              <h4 class="card-title p-1" style="background-color: darkslategrey; border-radius:5px;">
                <a href="{{route('post.category',$item->slug)}}" class="btn btn-primary text-white">{{$item->name}}</a>
              </h4>
            </div>
          </div>
        </div>
        @endforeach
      </div>
  
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          {{$categories->links()}}
        </li>
      </ul>
    </div>
    <!-- /.container -->
@endsection