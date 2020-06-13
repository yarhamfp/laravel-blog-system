@extends('layouts.admin')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Edit User
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Create User</span>
          </h1>
          <div class="page-header-subtitle">Create new user
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">User</a></li>
            <li class="breadcrumb-item active">Create User</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  {{-- card --}}
  <div class="col-md-10">
    <div class="card card-icon mb-4">
      <div class="row no-gutters">
          <div class="col-auto card-icon-aside bg-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-white-50"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></div>
          <div class="col">
              <div class="card-body py-5">
                  <h5 class="card-title">Informasi</h5>
                  <p class="card-text">
                    Jika user id tidak sama dengan user yang sedang login. dengan alasan keamanan privasi pengguna, Admin hanya dapat mengedit ROLES pada user
                  </p>
              </div>
          </div>
      </div>
    </div>
  </div>
  {{-- end card --}}
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card">
        <img class="card-img-top"  src="{{Storage::disk('public')->url('profile/'.$user->image)}}" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$user->name}} <br><span class="text-muted" style="font-size:12px;">{{$user->email}}</span></h5>
            <p class="card-text"><strong>{{$user->roles->name}}</strong></p><hr>
            <p class="card-text text-muted">{!!$user->about!!}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-8 mx-auto">
      <div class="card card-header-actions mb-4">
        <div class="card-header"><a href="{{route('admin.user.index')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Settings Profile
        </div>
        <div class="card-body">
          <div class="sbp-preview">
            <div class="sbp-preview-content">
              @if ($user->id != Auth::id())
              <form action="{{route('admin.role',$user->id)}}" method="POST">
                @csrf
                <div class="form-group ">
                  <label for="role_id">Role User *</label>
                  <select class="form-control" name="role_id" id="role_id">
                    <option value="">- select role -</option>
                    <option value="1" {{$user->role_id == 1 ? "selected" : ""}}>Admin</option>
                    <option value="2" {{$user->role_id == 2 ? "selected" : ""}}>Author</option>
                  </select>
                  @if ($errors->has('role_id'))
                    <span class="text-danger">{{$errors->first('role_id')}}</span>
                  @endif
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary btn-sm shadow-lg">Update</button>
                </div>
              </form>
              @else 
              <form action="{{route('admin.user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group ">
                  <label for="name">Name User *</label>
                  <input class="form-control shadow-right {{$errors->has('name') ? ' border-danger' : ''}}" id="name" name="name" type="text" value="{{$user->name}}" placeholder="Enter User...">
                  @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group ">
                  <label for="email">Email *</label>
                  <input class="form-control shadow-right {{$errors->has('email') ? ' border-danger' : ''}}" id="email" name="email" type="email" value="{{$user->email}}" placeholder="Enter Email...">
                  @if ($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                  @endif
                </div>
                <div class="form-group ">
                  <label for="username">Username *</label>
                  <input class="form-control shadow-right {{$errors->has('username') ? ' border-danger' : ''}}" id="username" name="username" type="text" value="{{$user->username}}" placeholder="Enter Username...">
                  @if ($errors->has('username'))
                    <span class="text-danger">{{$errors->first('username')}}</span>
                  @endif
                </div>
                <div class="form-group ">
                  <label for="role_id">Role User *</label>
                  <select class="form-control" name="role_id" id="role_id">
                    <option value="">- select role -</option>
                    <option value="1" {{$user->role_id == 1 ? "selected" : ""}}>Admin</option>
                    <option value="2" {{$user->role_id == 2 ? "selected" : ""}}>Author</option>
                  </select>
                  @if ($errors->has('role_id'))
                    <span class="text-danger">{{$errors->first('role_id')}}</span>
                  @endif
                </div>
                <div class="form-group ">
                  <label for="image">Image User</label>
                  <input class="form-control shadow-right {{$errors->has('image') ? ' border-danger' : ''}}" id="image" name="image" type="file">
                  <span class="text-muted" style="font-size:10px;">Jika form image dikosongkan sistem akan mengisi otomatis dengan Default Image</span><br>
                  @if ($errors->has('image'))
                    <span class="text-danger">{{$errors->first('image')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="about">About</label>
                  <textarea class="form-control shadow-right {{$errors->has('about') ? ' border-danger' : ''}}" name="about" id="about" cols="30" rows="10">{!!$user->about!!}</textarea>
                  @if ($errors->has('about'))
                    <span class="text-danger">{{$errors->first('about')}}</span>
                  @endif
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary btn-sm shadow-lg">Update</button>
                </div>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- <div class="container-fluid mt-n10">
  
</div> --}}
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
<script type="text/javascript">
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
    toastr.error("Error! {{$error}}")  
  @endforeach
@endif
</script>
@endpush
