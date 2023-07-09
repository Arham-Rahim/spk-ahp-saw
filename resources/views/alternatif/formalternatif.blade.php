@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Alternatif</h1>
      </div>
  
      <!-- Content Body -->
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Form Tambah Alternatif</h6>
          <div class="dropdown no-arrow">
            {{-- <a href="/kriteria/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- isi card -->
          <form action="/alternatif" method="post" enctype="multipart/form-data" autocomplete="on">
            @csrf
            <div class="box-body">
                <div class="form-group @error('nik') has-error @enderror">
                    <label for="nik">NIK</label>
                    <input autofocus type="number" class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}">
                    @error('nik')<span class="help-block">{{ $message }}</span> @enderror
                </div>
                <div class="form-group @error('nama') has-error @enderror">
                    <label for="nama">Nama Alternatif</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Alternatif" value="{{ old('nama') }}">
                    @error('nama')<span class="help-block">{{ $message }}</span> @enderror
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea autocomplete="on" type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">@if(old('alamat')){{ old('alamat') }}@endif</textarea>
                    @error('alamat')<span class="help-block">{{ $message }}</span> @enderror
                </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/alternatif" class="btn btn-default">Cancel</a>
              </div>
            </form>
          <!-- /isi card -->
        </div>
      </div>
      <!-- /Content Body -->
</div>
@endsection