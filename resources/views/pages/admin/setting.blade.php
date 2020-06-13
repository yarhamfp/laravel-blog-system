@extends('layouts.admin')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Settings
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-icon: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Setting</span>
          </h1>
          <div class="page-header-subtitle">Settings Web
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card card-header-actions mb-4">
        <div class="card-header"><a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Settings
        </div>
        <div class="card-body">
            <div class="sbp-preview">
              <div class="sbp-preview-content">
                <form action="{{route('admin.setting.update',$setting->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group ">
                    <label for="name">Name Web *</label>
                    <input class="form-control shadow-right {{$errors->has('name') ? ' border-danger' : ''}}" id="name" name="name" type="text" value="{{$setting->name}}">
                    @if ($errors->has('name'))
                      <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                  <div class="form-group ">
                    <label for="subname">Subname Web *</label>
                    <input class="form-control shadow-right {{$errors->has('subname') ? ' border-danger' : ''}}" id="subname" name="subname" type="text" value="{{$setting->subname}}">
                    @if ($errors->has('subname'))
                      <span class="text-danger">{{$errors->first('subname')}}</span>
                    @endif
                  </div>
                  <div class="form-group ">
                    <label>Icon Sekarang</label> <br>
                    @if ($setting->icon == 'icon.png')
                    <img src="{{Storage::disk('public')->url('settings/icon.png')}}" alt="" width="50px"class="img-thumbnail">
                    @else 
                    <img src="{{Storage::disk('public')->url('settings/'.$setting->first()->icon)}}" alt="" width="50px"class="img-thumbnail">
                    @endif
                  </div>
                  <div class="form-group ">
                    <label for="icon">Icon Web *</label>
                    <input class="form-control shadow-right {{$errors->has('icon') ? ' border-danger' : ''}}" id="icon" name="icon" type="file">
                    @if ($errors->has('icon'))
                      <span class="text-danger">{{$errors->first('icon')}}</span>
                    @endif
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-sm shadow-lg">Update</button>
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
