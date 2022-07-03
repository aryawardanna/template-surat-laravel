@extends('layouts.admin')
@section('admin-content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    <a href="{{ route('category.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i>Kembali</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      @include('notif')
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">

          <h6 class="m-0 font-weight-bold text-primary">Data Categories</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('category.update', $categories->id) }}" class="form" method="post">
            @method('put')
            @csrf
            <div class="form-group">
              <label for="" class="label">Name Category</label>
              <input type="text" name="name" class="form-control" value="{{ $categories->name }}">
            </div>
            <div class="form-group">
              <label for="" class="label">Description</label>
              <textarea rows="4" name="description" class="form-control">{{ $categories->description }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
