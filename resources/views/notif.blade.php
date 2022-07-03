@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('info'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
  </div>
@endif

{{-- cek error validasi form --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <button class="close" data-dismiss="alert">x</button>
    Please check the form below for errors
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </div>
@endif
