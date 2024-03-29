@extends('layouts.author')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Profile
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="user"></i>
              </div>
              <span>Profile</span>
          </h1>
          <div class="page-header-subtitle">Profile User
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Account</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
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
      <div class="card mb-4">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills" id="cardPill" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="overview-pill" href="#overviewPill" data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true"><i data-feather="user"></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link" id="activities-pill" href="#activitiesPill" data-toggle="tab" role="tab" aria-controls="activities" aria-selected="false"><i data-feather="lock"></i> Password</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="cardPillContent">
                {{-- profile --}}
                <div class="tab-pane fade show active" id="overviewPill" role="tabpanel" aria-labelledby="overview-pill">
                  <div class="card card-header-actions mb-4">
                    <div class="card-header"><a href="{{route('author.dashboard')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Edit Profile
                    </div>
                    <div class="card-body">
                        <div class="sbp-preview">
                          <div class="sbp-preview-content">
                            <form action="{{route('author.profile.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                              {{-- @method('PUT') --}}
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
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                {{-- end profile --}}
                {{-- tab reset password --}}
                <div class="tab-pane fade" id="activitiesPill" role="tabpanel" aria-labelledby="activities-pill">
                  <div class="card card-header-actions mb-4">
                    <div class="card-header"><a href="{{route('author.dashboard')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Reset Password
                    </div>
                    <div class="card-body">
                        <div class="sbp-preview">
                          <div class="sbp-preview-content">
                            <form action="{{route('author.reset-password')}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="form-group ">
                                <label for="old_password">Old Password *</label>
                                <input class="form-control shadow-right {{$errors->has('old_password') ? ' border-danger' : ''}}" id="old_password" name="old_password" type="password" placeholder="Enter your old password...">
                                {{-- @if ($errors->has('old_password'))
                                  <span class="text-danger">{{$errors->first('old_password')}}</span>
                                @endif --}}
                              </div>
                              <br>
                              <hr>
                              <div class="form-group ">
                                <label for="password">New Password *</label>
                                <input class="form-control shadow-right {{$errors->has('password') ? ' border-danger' : ''}}" id="password" name="password" type="password" placeholder="Enter new password...">
                                {{-- @if ($errors->has('password'))
                                  <span class="text-danger">{{$errors->first('password')}}</span>
                                @endif --}}
                              </div>
                              <div class="form-group ">
                                <label for="password_confirm">Password Confirm *</label>
                                <input class="form-control shadow-right {{$errors->has('password_confirm') ? ' border-danger' : ''}}" id="password_confirm" name="password_confirmation" type="password" placeholder="Enter new password again...">
                                {{-- @if ($errors->has('password_confirm'))
                                  <span class="text-danger">{{$errors->first('password_confirm')}}</span>
                                @endif --}}
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
                {{-- end password --}}
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
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      toastr.error("Error! {{$error}}")  
    @endforeach
  @endif
</script>
@endpush
