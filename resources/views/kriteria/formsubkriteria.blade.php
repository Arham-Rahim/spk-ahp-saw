@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Sub Kriteria</h1>
      </div>
  
      <!-- Content Body -->
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Form Tambah Sub Kriteria <b>({{ $kriteria->nama_kriteria }})</b></h6>
          <div class="dropdown no-arrow">
            {{-- <a href="/kriteria/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- isi card -->
          <form action="/subkriteria" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kriteria_id" id="kriteria_id" value="{{ $kriteria->id }}">
            <div class="box-body">
                <div class="form-group @error('nama_sub_kriteria') has-error @enderror">
                    <label for="nama_sub_kriteria">Nama Sub Kriteria</label>
                    <input autofocus type="text" class="form-control" name="nama_sub_kriteria" id="nama_sub_kriteria" placeholder="Nama Kriteria" value="{{ old('nama_sub_kriteria') }}">
                    @error('nama_sub_kriteria')<span class="help-block">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/kriteria" class="btn btn-default">Cancel</a>
              </div>
            </form>
          <!-- /isi card -->
        </div>
      </div>
      <!-- /Content Body -->
</div>
@endsection