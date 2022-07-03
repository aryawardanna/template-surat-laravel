@extends('layouts.admin')
@section('admin-content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category</h1>
    <a href="{{ route('category.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Tambah</a>
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
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th width="200">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($categories as $index => $category)
                  <tr>
                    <th>{{ $index + $categories->firstItem() }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td class="d-flex">
                      <a href="{{ route('category.edit', $category->id) }}">
                        <button class="btn btn-warning btn-sm  mr-1"><i class="fa fa-edit"></i>Edit</button>
                      </a>
                      <form action="{{ route('category.destroy', $category->id) }}" method="post" class="form">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Ingin di hapus?')"
                          class="btn btn-danger btn-sm "><i class="fa fa-trash"></i>Hapus</button>
                      </form>

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $categories->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
@endsection
