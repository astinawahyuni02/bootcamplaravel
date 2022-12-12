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
      <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/category/store" method="POST">
        @csrf 
        {{-- fungsi @csrf supaya token tidak expired --}}
      <div class="card-body">
        <div class="form-group">
          <label>Name</label>
          <input type="name" class="form-control" id="name" name="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control"rows="3" id="description" name="description" placeholder="Enter Description"></textarea>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection