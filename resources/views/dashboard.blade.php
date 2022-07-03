@extends('layouts.admin')
@section('admin-content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Letter</h1>
    <a href="{{ route('letter.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Tambah</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      @include('notif')
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">

          <h6 class="m-0 font-weight-bold text-primary">Data Letters</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  {{-- <th>Category</th> --}}
                  <th>Description</th>
                  <th>Typeletter</th>
                  <th>Cover</th>
                  <th>File</th>
                  <th width="200">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($data as $index => $datas)
                  <tr>
                    <th>{{ $index + $data->firstItem() }}</th>
                    <td>{{ $datas->name }}</td>
                    <td>{{ $datas->description }}</td>
                    <td>{{ $datas->typeletter }}</td>
                    {{-- <td>{{ $datas->category->name }}</td> --}}
                    <td>{{ $datas->cover }}</td>
                    <td>
                      @if ($datas->file !== null)
                        <a href="{{ Url('upload/letter/file/' . $datas->file) }}" target="_blank">Donwload</a>
                      @endif
                    </td>
                    <td class="d-flex">
                      <a href="{{ route('letter.edit', $datas->id) }}">
                        <button class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i>Edit</button>
                      </a>
                      <form action="{{ route('letter.destroy', $datas->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm" type="submit">
                          <i class="fa fa-trash"></i>Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $data->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
@endsection
