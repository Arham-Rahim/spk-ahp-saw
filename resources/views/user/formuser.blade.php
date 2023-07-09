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
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <!-- isi card -->
        <form action="/user" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group @error('name') has-error @enderror">
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama User" value="{{ old('name') }}">
                    @error('name')<span class="help-block">{{ $message }}</span> @enderror
                </div>
                <div class="form-group @error('email') has-error @enderror">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')<span class="help-block">{{ $message }}</span> @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" value="{{ old('password') }}">
                    @error('password')<span class="help-block">{{ $message }}</span> @enderror
                </div>
                <div class="form-group @error('password_confirmation') has-error @enderror">
                    <label for="password_confirmation">Konfirmasi Password</label>
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
