@extends('layouts.admin')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Pending Post
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
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Post</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10 ">
  {{-- card --}}
  <div class="col-md-10">
    <div class="card card-icon mb-4">
      <div class="row no-gutters">
          <div class="col-auto card-icon-aside bg-info"><i class="text-white-50" data-feather="alert-triangle"></i></div>
          <div class="col">
              <div class="card-body py-5">
                  <h5 class="card-title">Informasi</h5>
                  <p class="card-text">
                    Klik button <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark" style="font-size: 9px;"><i data-feather="check"></i></button> pada field Actions untuk mengapprove post.
                  </p>
                  <p class="card-text">
                    Saat anda mengapprove post maka sistem otomatis akan mengirimkan email notifikasi kepada subscribers dan Author yang memiliki post tersebut. Jadi harap dimaklum jika loading agak lama :) dan harap jangan melakukan aksi apapun sampai notif sukses approve muncul dipojok kanan atas.
                  </p>
              </div>
          </div>
      </div>
    </div>
  </div>
  {{-- end card --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-header-actions mb-4">
        <div class="card-header">Data Post
          <a href="{{route('admin.post.create')}}" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i></a>
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
                            <th>Is Approved</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($post as $key=>$item)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{Str::limit($item->title,'10')}}</td>
                          <td>{{Str::limit($item->users->name,'15')}}</td>
                          <td>{{$item->users->roles->name}}</td>
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
                            @if($item->is_approved == false)
                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark" style="font-size: 9px;" onclick="approvePost({{ $item->id }})">
                                    <i data-feather="check"></i>
                                </button>
                                <form method="post" class="d-inline" action="{{ route('admin.post.approve',$item->id) }}" id="approval-form-{{ $item->id }}" style="display: none">
                                    @csrf
                                    @method('PUT')
                                </form>
                            @endif
                            <a href="{{route('admin.post.show',$item->id)}}" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></a>
                            {{-- <a href="{{route('post.edit',$item->id)}}" class="btn btn-primary btn-icon"><i class="fa fa-pencil-alt"></i></a> --}}
                            <form id="delete-post" action="{{route('admin.post.destroy',$item->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="return confirm('Yakin ingin hapus data ini?')"><i data-feather="trash-2"></i>
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
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
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
<script type="text/javascript">
  function approvePost(id) {
            swal({
                title: 'Kamu yakin?',
                text: "Kamu ingin mengapprove post ini? ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form-'+ id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Post tetap terpending :)',
                        'info'
                    )
                }
            })
        }
</script>
@endpush
