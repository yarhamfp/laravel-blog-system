@extends('layouts.app')
@section('title')
    Hasil Tag
@endsection
@section('content')
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">
        <small>Posts dengan tag</small> {{$tag->name}}
      </h1>
  
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">tags-{{$tag->slug}}</li>
      </ol>
  
      <div class="row">
        @foreach ($postByTag as $item)
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="{{route('blogpost', $item->slug)}}"><img class="card-img-top" src="{{Storage::disk('public')->url('post/thumb/'.$item->image)}}" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="{{route('blogpost', $item->slug)}}">{{$item->title}}</a>
              </h4>
              <p class="card-text">{!!Str::limit($item->body)!!}</p>
            </div>
            <div class="card-footer">
              @foreach ($item->tags as $tag)
              <a href="{{route('post.tag',$tag->slug)}}" class="badge badge-secondary">#{{$tag->name}}</a>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>
  
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          {{$postByTag->links()}}
        </li>
      </ul>
  
    </div>
    <!-- /.container -->
@endsection