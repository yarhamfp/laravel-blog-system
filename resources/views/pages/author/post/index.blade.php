@extends('layouts.author')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Posts
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>All Posts</span>
          </h1>
          <div class="page-header-subtitle">Keseluruhan data post
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Post</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10 ">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-header-actions mb-4">
        <div class="card-header">Data Post
          <a href="{{route('author.post.create')}}" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i></a>
          {{-- <span>
            <a href="{{route('post.create')}}" class="btn btn-primary ml-4"><i class="fa fa-plus"></i> Tambah</a>
          </span>  --}}
        </div>
        <div class="card-body">
            <div class="datatable table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Role Author</th>
                            <th>Views</th>
                            <th>Is Approved</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Role Author</th>
                            <th>Views</th>
                            <th>Is Approved</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($item as $key=>$item)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{Str::limit($item->title,'10')}}</td>
                          <td>{{Str::limit($item->users->name,'15')}}</td>
                          <td>{{$item->users->roles->name}}</td>
                          <td>{{$item->view_count}}</td>
                          <td>
                            @if ($item->is_approved == true)
                              <span class="badge badge-primary">Approved</span>
                            @else
                              <span class="badge badge-danger">Pending</span>
                            @endif
                          </td>
                          <td>
                            @if ($item->status == true)
                            <span class="badge badge-primary">Published</span>
                          @else
                            <span class="badge badge-danger">Pending</span>
                          @endif
                          </td>
                          <td>{{ \carbon\carbon::create($item->created_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' H:i')}}</td>
                          <td>{{\carbon\carbon::create($item->updated_at->toDateTimeString())->timezone('Asia/Jakarta')->format('d F, Y'.' .'.' H:i')}}</td>
                          <td>
                            <a href="{{route('author.post.show',$item->id)}}" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></a>
                            <a href="{{route('author.post.edit',$item->id)}}" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="edit"></i></a>
                            {{-- <a href="{{route('post.edit',$item->id)}}" class="btn btn-primary btn-icon"><i class="fa fa-pencil-alt"></i></a> --}}
                            <form id="delete-post" action="{{route('author.post.destroy',$item->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark delete" onclick="return confirm('Yakin ingin hapus data ini?')"><i data-feather="trash-2"></i>
                            </button>
                            </form>
                          </td>
                        </tr>
                        @empty
                          <tr>
                            <td colspan="10" class="text-center">Data Post Kosong</td>
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
