@extends('layouts.admin')
@section('admin-content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Letter</h1>
    <a href="{{ route('letter.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i>Kembali</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      @include('notif')
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">

          <h6 class="m-0 font-weight-bold text-primary">Data Letter</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('letter.update', $letter->id) }}" class="form" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="" class="label">Name Letter</label>
              <input type="text" name="name" class="form-control" placeholder="name letter"
                value="{{ $letter->name }}">
            </div>

            <div class="form-group ">
              <label for="" class="label">Type Letter</label> <br>
              <input type="radio" name="typeletter" value="formal" @php
                if ($letter->typeletter === 'formal') {
                    echo 'checked';
                }
              @endphp> Formal
              <input type="radio" name="typeletter" value="nonformal" @php
                if ($letter->typeletter === 'nonformal') {
                    echo 'checked';
                }
              @endphp> Non Formal
            </div>
            <div class="form-group">
              <label for="" class="label">File Letter</label>
              @if ($letter->file !== null)
                {{ $letter->file }}
              @endif
              <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
              <label for="" class="label">Cover Letter
                @if ($letter->cover !== null)
                  {{ $letter->cover }}
                @endif
              </label>
              <input type="file" name="cover" class="form-control">
            </div>

            <div class="form-group">
              <label for="" class="label">Category</label>
              <select name="category_id" id="" class="form-control">
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @php
                    if ($category->id === $letter->category_id) {
                        echo 'selected';
                    }
                  @endphp>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="" class="label">Description</label>
              <textarea rows="4" name="description" class="form-control">{{ $letter->description }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
