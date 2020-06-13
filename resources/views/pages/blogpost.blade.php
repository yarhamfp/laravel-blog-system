@extends('layouts.app')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Posts
@endsection
@section('content')
  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">{{$post->title}}
      <small>by
        <a href="#!">{{$post->users->name}}</a>
      </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('home')}}">Home</a>
      </li>
      <li class="breadcrumb-item active">{{$post->slug}}</li>
    </ol>

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-md-8">
        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="{{$post->slug}}">
        <hr>
        <!-- Date/Time -->
        <p>Posted on {{Carbon\Carbon::create($post->created_at->todateTimeString())->timezone('Asia/Jakarta')->format('d F, Y')}} at {{Carbon\Carbon::create($post->created_at->todateTimeString())->timezone('Asia/Jakarta')->format('h:i A')}}</p>

        <hr>

        <!-- Post Content -->
        <p class="lead">
          {!!$post->body!!}
        </p>
        <p> Tags: 
          @foreach ($post->tags as $tag)
          <a href="{{route('post.tag',$tag->slug)}}" class="badge badge-secondary">#{{$tag->name}}</a>
          @endforeach
        </p>

        <hr>

        <!-- Comments Form -->
        <div class="site-section bg-light my-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-title mb-5">
                  <h2>Leave a comment</h2>
                </div>
                <form action="{{route('comment.store', $post->id)}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="text" id="fname" name="name" placeholder="Enter your name.." class="form-control {{$errors->has('name') ? "border-danger" : ''}}">
                    </div>
                    <div class="col-md-6 form-group">
                      <input type="email" id="lname" name="email" placeholder="Enter your email.." class="form-control {{$errors->has('email') ? "border-danger" : ''}}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <textarea name="comment" cols="30" rows="5" placeholder="Enter your comment" class="form-control {{$errors->has('comment') ? "border-danger" : ''}}"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-secondary py-2">Send Comment</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Single Comment -->
        {{-- <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            <br>
            <a href="#!">Reply</a>
          </div>
          
        </div> --}}

        <!-- Comment with nested comments -->
        @forelse ($post->comments as $comment)
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{$comment->name}} <small class="text-muted" style="font-size:12px;">{{$comment->created_at->diffForHumans()}}</small></h5> 
            <p>{{$comment->comment}}</p>
            @auth
            <form action="{{route('comment.reply', $comment->id)}}" method="POST" class="mt-2">
              @csrf
              <div class="form-group">
                <textarea class="form-control mb-2" name="reply" id="" rows="1"></textarea>
                <button type="submit" class="btn btn-secondary btn-sm">Reply</button>
              </div>
            </form>
            @endauth

            @foreach ($comment->replies as $reply)
            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">{{$reply->users->name}} as {{$reply->users->roles->name}} <small class="text-muted" style="font-size:12px;">{{$reply->created_at->diffForHumans()}}</small></h5>
                <p>{{$reply->reply}}</p>
              </div>
            </div>
            @endforeach

          </div>
        </div>
        <hr>
        @empty
          <p>Belum ada komentar</p>
        @endforelse
        

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card mb-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                  @foreach ($categories as $item)
                    <a href="{{route('post.category',$item->slug)}}" class="badge badge-primary">{{$item->name}}</a>
                  @endforeach
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
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
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      toastr.error("Warning! {{$error}}")  
    @endforeach
  @endif
</script>
@endpush