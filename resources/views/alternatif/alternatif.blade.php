@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Alternatif</h1>
  </div>

  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-warning"></i> {{ session('success') }}
    </div>
  @endif

  <!-- Content Body -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
      <div class="dropdown no-arrow">
        <a href="/alternatif/create" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- isi card -->
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach ($alternatifs as $alternatif)
          <tr>
              <td class="p-1">{{ $no++ }}</td>
              <td class="p-1">{{ $alternatif->nik }}</td>
              <td class="p-1">{{ $alternatif->nama }}</td>
              <td class="p-1">{{ $alternatif->alamat }}</td>
              <td class="p-1">
                  <a href="/alternatif/{{ $alternatif->id }}/edit" class="btn btn-success btn-sm" data-widget="Edit" data-toggle="tooltip" title="Ubah Password"><i class="fa fa-pen"></i></a>
  
                  <form style="display: contents" action="/alternatif/{{ $alternatif->id }}" method="post" class="inline">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-danger btn-sm" data-widget="Delete" data-toggle="tooltip" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                  <i class="fa fa-trash"></i></button>
                  </form>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- /isi card -->
    </div>
  </div>
  <!-- /Content Body -->
</div>
@endsection

@section('js_script')
  <script src="{{ URL::asset('vendor/sb_admin/jquery/jquery.min.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ URL::asset('vendor/sb_admin/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('vendor/sb_admin/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(function () {
      $("#example1").DataTable();
    });
  </script>

@endsection