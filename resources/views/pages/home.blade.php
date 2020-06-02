@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('{{Storage::disk('public')->url('category/slider/'.$categori1->image)}}')">
        <div class="carousel-caption d-none d-md-block">
          <h3>{{$categori1->name}}</h3>
          <p>This is a description for the first slide.</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      @foreach ($categories as $item)
      <div class="carousel-item" style="background-image: url('{{Storage::disk('public')->url('category/slider/'.$item->image)}}')">
        <div class="carousel-caption d-none d-md-block">
          <h3>{{$item->name}}</h3>
          <p>This is a description for the second slide.</p>
        </div>
      </div>
      @endforeach
      <!-- Slide Three - Set the background image for this slide in the line below -->
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>

<!-- Page Content -->
<div class="container">

  <h1 class="my-4">Popular Post</h1>

  <!-- Popular Section -->
  <div class="row">
    @forelse ($popularPost as $popular)
    <div class="col-lg-4 mb-4">
      <div class="card h-100 text-center">
        <img class="card-img-top" src="{{Storage::disk('public')->url('post/thumb/'.$popular->image)}}" alt="{{$popular->slug}}">
        <div class="card-body">
          <h4 class="card-title"><a href="{{route('blogpost',$popular->slug)}}">{{$popular->title}}</a></h4>
          {{-- @foreach ($popular->categories as $category) --}}
          <h6 class="card-subtitle mb-2 text-muted">in {{$popular->categories->first()->name}}</h6>
          {{-- @endforeach --}}
          <p class="card-text text-muted"><i class="fa fa-eye"></i> {{$popular->view_count}}</p>
        </div>
        <div class="card-footer text-muted">
          Posted on {{Carbon\Carbon::create($popular->created_at->todateTimeString())->timezone('Asia/Jakarta')->format('d F, Y')}} by
          <a href="#!" class="text-dark"><strong>{{$popular->users->name}}</strong></a>
        </div>
      </div>
    </div>
    @empty
    <p class="bg-secondary">Popular post Kosong, Silahkan admin/author membuat post untuk ditampilkan</p>
    @endforelse
  </div>
  <!-- /.row -->

  <!-- Portfolio Section -->
  <h2>Recent Post</h2>

  <div class="row">
    @foreach ($terbaru as $item)
    <div class="col-lg-4 mb-4">
      <div class="card h-100 ">
        <img class="card-img-top" src="{{Storage::disk('public')->url('post/thumb/'.$item->image)}}" alt="{{$item->slug}}">
        <div class="card-body">
          <h2 class="card-title">{{$item->title}}</h2>
          <p class="card-text">{!!Str::limit($item->body)!!}</p>
          <p class="card-text text-muted"><i class="fa fa-eye"></i> {{$item->view_count}} &nbsp; <i class="fa fa-comment"></i> {{$item->view_count}}</p>
          <a href="{{route('blogpost',$item->slug)}}" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
          Posted on {{$item->created_at->diffForHumans()}} by
          <a href="#!" class="text-dark"><strong>{{$item->users->name}}</strong></a>
        </div>
      </div>
    </div>
    @endforeach
    
  </div>
  <ul class="pagination justify-content-center">
    <li class="page-item">
      {{$terbaru->links()}}
    </li>
  </ul>
  <!-- /.row -->

  <!-- Features Section -->
  <div class="row">
    <div class="col-lg-6">
      <h2>Modern Business Features</h2>
      <p>The Modern Business template by Start Bootstrap includes:</p>
      <ul>
        <li>
          <strong>Bootstrap v4</strong>
        </li>
        <li>jQuery</li>
        <li>Font Awesome</li>
        <li>Working contact form with validation</li>
        <li>Unstyled page elements for easy customization</li>
      </ul>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id
        reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum
        ducimus unde.</p>
    </div>
    <div class="col-lg-6">
      <img class="img-fluid rounded" src="http://placehold.it/700x450" alt="">
    </div>
  </div>
  <!-- /.row -->

  <hr>

  <!-- Call to Action Section -->
  <div class="row mb-4">
    <div class="col-md-8">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti
        beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
    </div>
    <div class="col-md-4">
      <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
    </div>
  </div>

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
</script>
@endpush