@extends('layouts.author')
@section('title')
  Category | BakeBlog
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Create Category</span>
          </h1>
          <div class="page-header-subtitle">Create new category
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('author.category.index')}}">Category</a></li>
            <li class="breadcrumb-item active">Create Category</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card card-header-actions mb-4">
        <div class="card-header"><a href="{{route('author.category.index')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Tambah Category
        </div>
        <div class="card-body">
            <div class="sbp-preview">
              <div class="sbp-preview-content">
                <form action="{{route('author.category.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group ">
                    <label for="name">Name Category *</label>
                    <input class="form-control shadow-right {{$errors->has('name') ? ' border-danger' : ''}}" id="name" name="name" type="text" value="{{old('name')}}" placeholder="Enter Category...">
                    @if ($errors->has('name'))
                      <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                  <div class="form-group ">
                    <label for="image">Image Category *</label>
                    <input class="form-control shadow-right {{$errors->has('image') ? ' border-danger' : ''}}" id="image" name="image" type="file">
                    <span class="text-muted" style="font-size:10px;">Jika form image dikosongkan sistem akan mengisi otomatis dengan Default Image</span><br>
                    @if ($errors->has('image'))
                      <span class="text-danger">{{$errors->first('image')}}</span>
                    @endif
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-sm shadow-lg">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('prepend-style')
<link href="{{ url('backend/cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ url('toastr/build/toastr.css')}}" rel="stylesheet"/>
@endpush
@push('prepend-script')
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/assets/demo/datatables-demo.js') }}"></script>
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
