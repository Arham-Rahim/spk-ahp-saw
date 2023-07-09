@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
        <div class="dropdown no-arrow">
          <a href="/kriteria/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a>
        </div>
      </div>
    <!-- Card Body -->
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Boto Kriteria</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($kriterias as $kriteria)
              <tr>
                <td class="p-1">{{ $no++ }}</td>
                <td class="p-1">{{ $kriteria->nama_kriteria }}</td>
                <td class="p-1">{{ $kriteria->bobot_kriteria }}</td>
                <td class="p-1">
                  <a href="/kriteria/{{ $kriteria->id }}/edit" class="btn btn-success btn-sm" data-widget="Edit" data-toggle="tooltip" title="Ubah Password"><i class="fa fa-pen"></i></a>
                  <form style="display: contents" action="/kriteria/{{ $kriteria->id }}" method="post" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" data-widget="Delete" data-toggle="tooltip" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
                  @endforeach 
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @foreach ($kriterias as $kriteria)

    @if(session()->has('success'.$kriteria->id))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close id{{ $kriteria->id }}" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa fa-warning"></i> {{ session('success'.$kriteria->id) }}
      </div>
    @endif

    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Sub Kriteria <b>({{ $kriteria->nama_kriteria }})</b></h6>
      <div class="dropdown no-arrow">
        <a href="/subkriteria/{{ $kriteria->id }}/add_subkriteria" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Subkriteria Baru</a>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="dataTable{{$kriteria->id}}" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Kriteria</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($subkriterias->where('kriteria_id', $kriteria->id) as $sub)
              <tr>
                  <td class="p-1">{{ $no++ }}</td>
                  <td class="p-1">{{ $sub->nama_sub_kriteria }}</td>
                  <td class="p-1">
                      <a href="/subkriteria/{{ $sub->id }}/edit" class="btn btn-success btn-sm" data-widget="Edit" data-toggle="tooltip" title="Ubah Sub Kategori"><i class="fa fa-pen"></i></a>
      
                      <form style="display: contents" action="/subkriteria/{{ $sub->id }}" method="post" class="inline">
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
      </div>
    </div>
    </div>
    @endforeach
    
</div>
@endsection

@section('js_script')
  <!-- jQuery 2.2.3 -->
  <script src="{{ URL::asset('vendor/sb_admin/jquery/jquery.min.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ URL::asset('vendor/sb_admin/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('vendor/sb_admin/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(function () {
      var kriterias = {{ Js::from($kriterias) }}
      
      $("#dataTable").DataTable();
      kriterias.forEach((kriteria) => {
        $("#dataTable"+kriteria.id).DataTable();
        var target = $('.id'+kriteria.id);
        if (target.length) {
          $('html, body').stop().animate({
            scrollTop: target.offset().top - 50
          }, 10);
        }
      });
    });
    
  </script>

@endsection