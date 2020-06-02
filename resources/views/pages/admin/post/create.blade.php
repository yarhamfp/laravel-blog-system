@extends('layouts.admin')
@section('title')
  Post | BakeBlog
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Create Post</span>
          </h1>
          <div class="page-header-subtitle">Membuat post baru</div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.post.index')}}">Post</a></li>
            <li class="breadcrumb-item active">Create Post</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-lg-12 mx-auto">
        <div class="card mb-4">
          <div class="card-header"><a href="{{route('admin.post.index')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> <p class="mx-auto">Title Post</p>
          </div>
          <div class="card-body">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <label for="title">Title Post *</label>
                      <input class="form-control shadow-right {{$errors->has('title') ? ' border-danger' : ''}}" id="title" name="title" type="text" value="{{old('title')}}" placeholder="Enter Title Post...">
                      @if ($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                      @endif
                    </div>
                    <div class="form-group ">
                      <label for="image">Image Post *</label> <span class="text-muted" style="font-size:12px;">(ukuran gambar akan auto crop jadi 1600 x 1066)</span>
                      <input class="form-control shadow-right {{$errors->has('image') ? ' border-danger' : ''}}" id="image" name="image" type="file">
                      @if ($errors->has('image'))
                        <span class="text-danger">{{$errors->first('image')}}</span>
                      @endif
                    </div>
                    <div class="form-group custom-control custom-checkbox">
                      <input class="custom-control-input" name="status" id="customCheck1" value="1" type="checkbox">
                      <label class="custom-control-label" for="customCheck1">Publish</label>
                    </div>
                    <div class="text-right">
                      {{-- <button type="submit" class="btn btn-primary btn-sm shadow-lg">Simpan</button> --}}
                      <a href="#body" class="btn btn-info">Gulir &nbsp;<i class="fa fa-arrow-down"></i></a>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-header-actions mb-4">
          <div class="card-header">Categories
          </div>
          <div class="card-body" style="height: 400px;">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <a href="{{route('admin.category.create')}}" class="btn btn-info">Create New Category</a>
                    </div>
                    <div class="form-group">
                      <label for="category">Pilih Category *</label>
                      <select class="form-control selectpicker {{$errors->has('categories') ? ' is-invalid' : ''}}" name="categories[]" id="category" data-size="5" data-live-search="true" multiple>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('categories'))
                      <span class="text-danger">{{$errors->first('categories')}}</span>
                      @endif
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card card-header-actions mb-4">
          <div class="card-header">Tags
          </div>
          <div class="card-body" style="height: 400px;">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <label for="tag">Pilih Tag *</label> <br>
                      <span class="text-muted">Ketik dan enter untuk membuat tag</span>
                      <select class="form-control" name="tags[]" id="tags" multiple="multiple">
                      </select>
                      @if ($errors->has('tags'))
                      <span class="text-danger">{{$errors->first('tags')}}</span>
                      @endif
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-header-actions mb-4">
          <div class="card-header">Body Post
          </div>
          <div class="card-body">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <label for="body">Body Post *</label>
                      <textarea name="body" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" id="body" cols="30" rows="10"></textarea>
                      @if ($errors->has('body'))
                        <span class="text-danger">{{$errors->first('body')}}</span>
                      @endif
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-primary btn-sm shadow-lg">Simpan</button>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@push('prepend-style')
<link href="{{ url('backend/cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link rel="stylesheet" href="{{url('bootstrap-select/dist/css/bootstrap-select.min.css')}}">
<script src="{{ url('ckeditor/ckeditor.js')}}"></script>
<link rel="stylesheet" href="{{url('tagsinput/tagsinput.css')}}">
<link href="{{url('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endpush

@push('prepend-script')
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/assets/demo/datatables-demo.js') }}"></script>
<script src="{{url('bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{url('tagsinput/tagsinput.js')}}"></script>
<script src="{{url('select2/dist/js/select2.min.js')}}"></script>
<script>
  $('.my-select').selectpicker();
  $("#tags").select2({
  tags: true
});
</script>
<script>
  CKEDITOR.replace( 'body' );
</script>
@endpush

