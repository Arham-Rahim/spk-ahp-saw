@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Kriteria</h1>
  </div>

  <!-- Content Body -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Form Edit Kriteria</h6>
      <div class="dropdown no-arrow">
        {{-- <a href="/kriteria/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- isi card -->
      <form action="/kriteria/{{ $kriteria->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="box-body">
            <div class="form-group @error('nama_kriteria') has-error @enderror">
                <label for="nama_kriteria">Nama Krite</label>
                <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}">
                @error('nama_kriteria')<span class="help-block">{{ $message }}</span> @enderror
            </div>
            <div class="form-group @error('bobot_kriteria') has-error @enderror">
              <label for="bobot_kriteria">Bobot Kriteria</label>
              <input type="number" step="0.01" class="form-control" name="bobot_kriteria" id="bobot_kriteria" placeholder="Bobot Kriteria" value="{{ old('bobot_kriteria', $kriteria->bobot_kriteria) }}">
              @error('bobot_kriteria')<span class="help-block">{{ $message }}</span> @enderror
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

@section('js_script')
  <!-- jQuery 2.2.3 -->
  <script src="vendor/plugins/jQuery/jquery-2.2.3.min.js"></script>

  {{-- <!-- DataTables -->
  <script src="vendor/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script> --}}

@endsection