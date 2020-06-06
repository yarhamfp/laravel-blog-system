@extends('layouts.author')
@section('title')
  Comment | BakeBlog
@endsection
@section('content')
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary bg-img-repeat" style="background-image: url('{{ url('backend/assets/img/pattern-shapes.png')}}');">
  <div class="container-fluid">
      <div class="page-header-content">
          <h1 class="page-header-title">
              <div class="page-header-icon">
                <i data-feather="filter"></i>
              </div>
              <span>All Comments</span>
          </h1>
          <div class="page-header-subtitle">Keseluruhan data comment
          </div>
          <ol class="breadcrumb mt-4 mb-0">
            <li class="breadcrumb-item"><a href="{{route('author.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('author.post.index')}}">Blogs</a></li>
            <li class="breadcrumb-item active">Comment</li>
          </ol>
      </div>
  </div>
</div>
<div class="container-fluid mt-n10 ">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-header-actions mb-4">
        <div class="card-header">
          Data Comment 
        </div>
        <div class="card-body">
            <div class="datatable table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Comment Info</th>
                            <th>Replies</th>
                            <th>Post Info</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Comment Info</th>
                            <th>Replies</th>
                            <th>Post Info</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($posts as $key=>$post)
                        @foreach ($post->comments as $comment)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>
                            <div class="media">
                              <div class="media-left">
                                <a href="#!">
                                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4>{{$comment->name}} <small style="font-size:12px;">{{$comment->created_at->diffForHumans()}}</small> </h4>
                                <p>{{$comment->comment}}</p>
                                <a href="{{route('author.comment.show',$comment->id)}}">Reply</a>
                              </div>
                            </div>
                          </td>
                          <td>{{$comment->replies->count()}}</td>
                          <td>
                            <div class="media">
                              <div class="media-left">
                                <a href="#!">
                                  <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->posts->image) }}" width="64" height="64" alt="{{$comment->posts->slug}}">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4>
                                  <a class="text-dark" target="_blank" href="{{route('blogpost',$comment->posts->slug)}}">{{Str::limit($comment->posts->title, 40)}}</a>
                                </h4>
                                <p>by <strong>{{ $comment->posts->users->name }}</strong></p>
                              </div>
                            </div>
                          </td>
                          <td>
                            {{-- <a href="{{route('comment.edit',$item->id)}}" class="btn btn-primary btn-icon"><i class="fa fa-pencil-alt"></i></a> --}}
                            <form id="delete-comment" action="{{route('author.comment.destroy',$comment->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark delete" onclick="return confirm('Yakin ingin hapus komentar ini?')"><i data-feather="trash-2"></i>
                            </button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                        @empty
                          <tr>
                            <td colspan="10" class="text-center">Tidak ada komentar</td>
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
