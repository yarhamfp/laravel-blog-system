@extends('layouts.author')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Edit Post
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Edit Post</span>
          </h1>
          <div class="page-header-subtitle">Edit post
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('author.post.index')}}">Post</a></li>
            <li class="breadcrumb-item active">Edit Post</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <form action="{{route('author.post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header"><a href="{{route('author.post.index')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> <p class="mx-auto">Title Post</p>
          </div>
          <div class="card-body">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <label for="title">Title Post *</label>
                      <input class="form-control shadow-right {{$errors->has('title') ? ' border-danger' : ''}}" id="title" name="title" type="text" value="{{$post->title}}" placeholder="Enter Title Post...">
                      @if ($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="">Gambar sebelumnya</label> <span class="text-muted" style="font-size:12px;">(ukuran gambar 1600 x 1066)</span> <br>
                      <img src="{{ Storage::disk('public')->url('post/'.$post->image)}}" style="width:250px" class="img-thumbnail">
                    </div>
                    <div class="form-group ">
                      <label for="image">Image Post *</label> <span class="text-muted" style="font-size:12px;">(kosongkan jika tidak ingin ganti)</span>
                      <input class="form-control shadow-right {{$errors->has('image') ? ' border-danger' : ''}}" id="image" name="image" type="file">
                      @if ($errors->has('image'))
                        <span class="text-danger">{{$errors->first('image')}}</span>
                      @endif
                    </div>
                    <div class="form-group custom-control custom-checkbox">
                      <input class="custom-control-input" name="status" id="customCheck1" value="1" type="checkbox" {{$post->status == true ? 'checked' : ''}}>
                      <label class="custom-control-label" for="customCheck1">Publish</label>
                    </div>
                    {{-- <div class="text-right">
                      <button type="submit" class="btn btn-primary btn-sm shadow-lg">Simpan</button>
                    </div> --}}
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
          <div class="card-body" style="height: 270px;">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group">
                      <label for="category">Category Post *</label>
                      <select class="form-control selectpicker {{$errors->has('categories') ? ' is-invalid' : ''}}" name="categories[]" id="category" data-size="3" data-live-search="true" multiple>
                        @foreach($categories as $category)
                            <option
                                @foreach($post->categories as $postCategory)
                                    {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                @endforeach
                                value="{{ $category->id }}">{{ $category->name }}</option>
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
          <div class="card-body">
              <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="form-group ">
                      <label for="Tags">Tags:</label>
                      <select class="form-control" name="tags[]" id="tags" multiple="multiple">
                        @foreach ($post->tags as $tag)
                        <option selected="selected">{{$tag->name}}</option>
                        @endforeach
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
                      <textarea name="body" class="form-control {{$errors->has('body') ? ' is-invalid' : ''}}" id="body" cols="30">{{$post->body}}</textarea>
                      @if ($errors->has('body'))
                        <span class="text-danger">{{$errors->first('body')}}</span>
                      @endif
                    </div>
                    <div class="text-right">
                      <a href="{{route('author.post.index')}}" class="btn btn-outline-light btn-sm shadow-lg">Back</a>
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
<link href="{{ url('toastr/build/toastr.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{url('bootstrap-select/dist/css/bootstrap-select.min.css')}}">
<script src="{{ url('ckeditor/ckeditor.js')}}"></script>
<link href="{{url('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endpush

@push('prepend-script')
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('backend/assets/demo/datatables-demo.js') }}"></script>
<script src="{{ url('toastr/toastr.js')}}"></script>
<script src="{{url('bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{url('select2/dist/js/select2.min.js')}}"></script>
<script>
  @if(Session::has('sukses'))
  toastr.success("Sukses! {{Session::get('sukses')}}");  
  @endif
  @if(Session::has('error'))
  toastr.error("Jangan Nakal! {{Session::get('error')}}")  
  @endif
  @if(Session::has('warning'))
  toastr.warning("Warning! {{Session::get('warning')}}")  
  @endif
</script>
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

