@extends('layouts.admin')
@section('title')
  Tag | BakeBlog
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>All Tags</span>
          </h1>
          <div class="page-header-subtitle">Keseluruhan data tag
          </div>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <div class="row">
    <div class="col-lg-5">
      <div class="card mb-4">
        <div class="card-header">Tambah Tag</div>
        <div class="card-body">
            <div class="sbp-preview">
              <div class="sbp-preview-content">
                <form action="{{route('tag.store')}}" method="POST">
                  @csrf
                  <div class="form-group ">
                    <label for="name">Name Tag *</label>
                    <input class="form-control shadow-right {{$errors->has('name') ? ' border-danger' : ''}}" id="name" name="name" type="text" value="{{old('name')}}" placeholder="Enter Tag...">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                          <span class="text-danger">{{$error}}</span> 
                        @endforeach
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
    <div class="col-lg-7">
      <div class="card mb-4">
        <div class="card-header">Data Tag</div>
        <div class="card-body">
            <div class="datatable table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tag</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tag</th>
                            <th>Posts Count</th>
                            <th>Create At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($item as $key=>$item)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->posts->count()}}</td>
                          <td>{{ \carbon\carbon::create($item->created_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' H:i')}}</td>
                          <td>
                            <form action="{{route('tag.destroy',$item->id)}}" method="POST" class="d-inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="return confirm('Yakin ingin hapus data ini?')"><i data-feather="trash-2"></i>
                              </button>
                              </form>
                          </td>
                        </tr>
                        @empty
                          <tr>
                            <td colspan="4" class="text-center">Data Tag Kosong</td>
                          </tr>
                        @endforelse
                    </tbody>
                </table>
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
