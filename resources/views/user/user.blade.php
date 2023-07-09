@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
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
      <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
      <div class="dropdown no-arrow">
        <a href="/user/create" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- isi card -->
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach ($users as $user)
        <tr>
            <td class="p-1">{{ $no++ }}</td>
            <td class="p-1">{{ $user->name }}</td>
            <td class="p-1">{{ $user->email }}</td>
            <td class="p-1">
                <a href="/user/{{ $user->id }}/edit" class="btn btn-success btn-sm" data-widget="Edit" data-toggle="tooltip" title="Ubah Password"><i class="fa fa-key"></i></a>

                <form style="display: contents" action="/user/{{ $user->id }}" method="post" class="inline">
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
  </script>

@endsection