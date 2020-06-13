@extends('layouts.admin')
@section('title')
{{App\Setting::first()->name.App\Setting::first()->subname}} | Reply Comment
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>Reply Comment</span>
          </h1>
          <div class="page-header-subtitle">Reply Comment
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.comment.index')}}">Comment</a></li>
            <li class="breadcrumb-item active">Reply Comment</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card card-header-actions mb-4">
        <div class="card-header">
          <a href="{{route('admin.comment.index')}}" class="btn btn-primary btn-icon"><i class="fa fa-arrow-left"></i></a> Reply Comment
        </div>
        <div class="card-body">
            <div class="sbp-preview">
              <div class="sbp-preview-content">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                  <div class="media-body">
                    <h5 class="mt-0">{{$comment->name}} <small style="font-size:12px;">{{$comment->created_at->diffForHumans()}}</small></h5>
                    <p>{{$comment->comment}}</p>
                    <hr>
                    @forelse ($comment->replies as $item)
                    <div class="media mt-3">
                      <a class="pr-3" href="#!">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                      </a>
                      <div class="media-body">
                        <h5 class="mt-0">{{$item->users->name}} as {{$item->users->roles->name}} <small style="font-size:12px;">{{$item->created_at->diffForHumans()}}</small> </h5>
                        <p>{{$item->reply}}</p>
                      </div>
                      <form action="{{route('admin.reply.destroy',$item->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="ml-3 btn btn-datatable btn-icon btn-transparent-dark delete" onclick="return confirm('Yakin ingin hapus balasan ini?')"><i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </div>
                    @empty
                      Belum ada balasan
                    @endforelse
                  </div>
                </div>
                <form action="{{route('admin.comment.reply', $comment->id)}}" method="POST">
                    @csrf
                  <div class="form-group ">
                    <textarea name="reply" rows="1" placeholder="Enter your reply.." class="form-control" required></textarea>
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-sm shadow-lg">Reply</button>
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
