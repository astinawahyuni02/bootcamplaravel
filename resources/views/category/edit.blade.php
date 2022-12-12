@extends('layouts.main')

@section('title','Category')

@section('page_title', 'Create Category')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item"><a href="/category">Category</a></li>
<li class="breadcrumb-item active">Category</a></li>

@endsection

@section('content')
<div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Form Edit</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/category/update/{{$data->id}}" method="post">
        @csrf 
        {{-- dungsi @csrf supaya token tidak expired --}}
      <div class="card-body">
        <div class="form-group">
          <label>Name</label>
          <input type="name" value="{{ $data->name }}" class="form-control" id="name" name="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control"rows="3" id="description" name="description" placeholder="Enter Description">{{ $data->description }}</textarea>
        </div>
        <div class="form-group">
          <label>Status Active</label>
          <select class="form-control" name="status_active">
              <option value="ACTIVE" {{$data->status_active == 'ACTIVE' ? 'selected' :'' }}>ACTIVE</option>
              <option value="NONACTIVE" {{$data->status_active == 'NONACTIVE' ? 'selected' :''}}>NON ACTIVE</option>
          </select>
        </div>
        
       </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection