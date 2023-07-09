@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form User</h1>
  </div>

<!-- Content Body -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
    <!-- isi card -->
    <form action="/user/{{ $user->id }}" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="box-body">
          <div class="form-group @error('old_password') has-error @enderror">
              <label for="old_password">Password Lama</label>
              <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Password Lama" value="{{ old('old_password') }}">
              @error('old_password')<span class="help-block">{{ $message }}</span> @enderror
          </div>

          <div class="form-group @error('password') has-error @enderror">
              <label for="password">Password Baru</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru" value="{{ old('password') }}">
              @error('password')<span class="help-block">{{ $message }}</span> @enderror
          </div>

          <div class="form-group @error('password_confirmation') has-error @enderror">
              <label for="password_confirmation">Konfirmasi Password Baru</label>
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password Baru" value="{{ old('password_confirmation') }}">
              @error('password_confirmation')<span class="help-block">{{ $message }}</span> @enderror
          </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="/user" class="btn btn-default">Cancel</a>
        </div>
      </form>
    <!-- /isi card -->
    </div>
</div>
<!-- /Content Body -->
</div>
@endsection