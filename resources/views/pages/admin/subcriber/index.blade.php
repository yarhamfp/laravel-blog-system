@extends('layouts.admin')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Subcribers
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>All Subcribers</span>
          </h1>
          <div class="page-header-subtitle">Keseluruhan data subcriber
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Subcriber</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10 ">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-header-actions mb-4">
        <div class="card-header">Data Subcriber
          {{-- <a href="{{route('admin.subcriber.create')}}" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i></a> --}}
          {{-- <span>
            <a href="{{route('subcriber.create')}}" class="btn btn-primary ml-4"><i class="fa fa-plus"></i> Tambah</a>
          </span>  --}}
        </div>
        
        <div class="card-body">
            <div class="datatable table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subcriber</th>
                            <th>Created At</th>
                            <th>Updated At</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Subcriber</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                          <td>{{$item->id}}</td>
                          <td>{{$item->email}}</td>
                          <td>{{ \carbon\carbon::create($item->created_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' H:i')}}</td>
                          <td>{{\carbon\carbon::create($item->updated_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' H:i')}}</td>
                          <td>
                            <form action="{{route('admin.subcriber.destroy',$item->id)}}" method="POST" class="d-inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="return confirm('Yakin ingin hapus data ini?')"><i data-feather="trash-2"></i>
                              </button>
                              </form>
                          </td>
                        </tr>
                        @empty
                          <tr>
                            <td colspan="5" class="text-center">Data Subcriber Kosong</td>
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
