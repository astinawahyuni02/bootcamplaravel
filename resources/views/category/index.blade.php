@extends('layouts.main')

@section('title', 'Category')

@section('page_title', 'Category')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active"><a>Category</a></li>

@endsection

@section('content')
<div class="row">
    <div class="col-md-5">

      {{-- session ini untuk mengetahui agar data nya tidak ada duplikat agar tidak bingung. --}}
      @if (Session::get('message'))
            <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fas fa-exclamation-triangle"></i> {{ Session::get('message') }}!</h6>
          </div>
      @endif
        
    </div>
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <a href="/category/create" class="btn btn-block btn-success">
            Create
        </a>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
      <h3 class="card-title">List Data</h3>

      {{-- pencarian --}}
      <div class="card-tools">
         {{-- pemanggilan route('searchnya dibagian web.php') --}}
         <form action="{{ route('search') }}" method="GET">
          @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
          
            {{-- pemanggilan name nya ke bagian controller --}}
            <input type="text" name="search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
            </div>
         </form>

      </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>  
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status Active</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
        <form action="/category/destroy/{{$d->id}}" method="POST">
          @csrf
          <tr>
            <td>{{ $d->no }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->description }}</td>
            <td>{{ $d->status_active }}</td>
            <td>{{ $d->created_at }}</td>

             <!-- Split button -->
             <td>
               <div class="btn-group">
                <button type="button" class="btn btn-default">Action</button>
                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item" href="/category/edit/{{$d->id}}">Edit</a>
                  <input type="submit" class="dropdown-item" value="Delete" onclick="return confirm('Are you sure to delete data?')" href="#">

                </div>
               </div>
              </td> 
          </tr>
        </form>
        @endforeach

        </tbody>
      </table>

      <div class="float-right mr-3 mt-3">
        {{ $data->links('pagination::bootstrap-4') }}
      </div>

    </div>
</div>


    

  </div>
    <!-- /.card-body -->
  </div>

@endsection

@push('custom-script')

<script>
  $(function(){

  })
</script>
  
@endpush