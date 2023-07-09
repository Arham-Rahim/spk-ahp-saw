@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
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
      <h6 class="m-0 font-weight-bold text-primary">Data Yang Belum Dinilai</h6>
      <div class="dropdown no-arrow">
        {{-- <a href="/alternatif/create" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- isi card -->
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          @foreach($kriteria as $kr)
            <th>{{ $kr->nama_kriteria }}</th>
          @endforeach
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($alternatifs as $alternatif)
            @php $cekAlternatif = $penilaians->where('alternatif_id', $alternatif->id);@endphp
            @if(count($cekAlternatif) == 0)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $alternatif->nama }}</td>
                @php $count = count($kriteria) @endphp
                @for($i = 0; $i < $count; $i++)
                    <td>-</td>
                @endfor
                <td>
                    <a href="/penilaian/{{ $alternatif->id }}/nilai" class="btn btn-primary btn-sm" data-widget="Nilai" data-toggle="tooltip" title="Nilai"><i class="fa fa-check-square-o"></i> Nilai</a>
                </td>
            </tr>
            @endif
            @endforeach
          
        </tbody>
      </table>

      
      <!-- /isi card -->
    </div>
  </div>
  <!-- /Content Body -->

  @if(session()->has('success1'))
    <div class="alert alert-success alert-dismissible ">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-warning"></i> {{ session('success1') }}
    </div>
  @endif
  <!-- Content Body -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Hasil Penilaian</h6>
      <div class="dropdown no-arrow">
        {{-- <a href="/alternatif/create" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- isi card -->
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          @foreach($kriteria as $kr)
            <th>{{ $kr->nama_kriteria }}</th>
          @endforeach
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @php $no = 1; $allg = $penilaians->groupBy('alternatif_id'); @endphp
          @foreach($allg as $key_y => $b)
              <tr>
                <td class="p-1">{{ $no++ }}</td>
                <td class="p-1">{{ $b[0]->alternatif->nama }}</td>
                @foreach($kriteria as $i => $kr)
                  <td class="p-1">{{ $b[$i]->subkriteria->nama_sub_kriteria }}</td>
                @endforeach
                <td class="p-1">
                  <a href="/penilaian/{{ $b[0]->alternatif_id }}/edit" class="btn btn-success btn-sm" data-widget="Edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pen"></i></a>
  
                  <form style="display: contents" action="/penilaian/{{ $b[0]->alternatif_id }}" method="post" class="inline">
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


      @php

        $namaKriteria = ['Prio_Kriteria'];
        foreach ($kriteria as $key => $value) {
          array_push($namaKriteria, 'Prio_'.$value->nama_kriteria);
        };

        $sessionNames = $namaKriteria;

        $foundSessions = [];
        foreach ($sessionNames as $sessionName) {
            if (session()->has($sessionName)) {
                $foundSessions[] = $sessionName;
            };
        };

      @endphp
    @if (count($foundSessions) === count($sessionNames))
      @php
        $hasilPenilaian = SiteHelpers::hasilAHP();
        $hasilAkhir = SiteHelpers::hasilAkhirAHP();
      @endphp
      <!-- Content Body -->
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Hasil Analisis AHP</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- isi card -->
          <table id="exampleAHP" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Alternatif</th>
                @foreach($kriteria as $kr)
                  <th>{{ $kr->nama_kriteria }}</th>
                @endforeach
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
                  $y = 0;
              @endphp
              @foreach ($allg as $item)    
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item[0]->alternatif->nama }}</td>
                @for ($i = 0; $i < count($kriteria); $i++)
                  <td>{{ $hasilPenilaian[$y][$i] }}</td>
                @endfor
                <td>{{ $hasilAkhir[$y] }}</td>
              </tr>
              @php
                  $y++
              @endphp
              @endforeach
            
            </tbody>
          </table>
          <!-- /isi card -->
        </div>
      </div>
      <!-- /Content Body -->

      @php
        $hasilSAW = SiteHelpers::hasilSAW();
        // dd($hasilSAW);
        $hasilAkhirSAW = SiteHelpers::hasilAkhirSAW();
      @endphp
      <!-- Content Body -->
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Hasil Analisis SAW</h6>
          <div class="dropdown no-arrow">
            {{-- <a href="/alternatif/create" class="btn btn-block btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- isi card -->
          <table id="exampleSAW" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              @foreach($kriteria as $kr)
                <th>{{ $kr->nama_kriteria }}</th>
              @endforeach
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
                  $y = 0;
              @endphp
              @foreach ($allg as $item)    
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item[0]->alternatif->nama }}</td>
                @for ($i = 0; $i < count($kriteria); $i++)
                  <td>{{ $hasilSAW[$y][$i] }}</td>
                @endfor
                <td>{{ $hasilAkhirSAW[$y] }}</td>
              </tr>
              @php
                  $y++
              @endphp
              @endforeach
             
            </tbody>
          </table>
          <!-- /isi card -->
        </div>
      </div>
      <!-- /Content Body -->
    @else
      <section class="content" id="contentHasilAnalisis">
        <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-danger alert-dismissible ">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> Tentukan terlebih dahulu bobo Kriteria dan Subkriteria!
              </div>
            </div>
        </div>
      </section>
    @endif
</div>
@endsection

@section('js_script')
  <!-- jQuery 2.2.3 -->
  <script src="vendor/plugins/jQuery/jquery-2.2.3.min.js"></script>

  <!-- DataTables -->
  <script src="vendor/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable();

      $("#exampleSAW").DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        
      });

      $('#exampleSAW').DataTable().columns(-1).order('desc').draw();

      $("#exampleAHP").DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
      // $("#example2").DataTable();

      $('#analisis').on('click', function(){
            location.reload();
            $("#contentHasilAnalisis").css("display", "block");
        });
    });
    
  </script>
@endsection