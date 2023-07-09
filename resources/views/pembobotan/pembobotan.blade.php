@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Pembobotan</h1>
    </div>

    @if (count($kriterias) == 0)
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-warning"></i> Tentukan Kriteria terlebih dahulu!
                </div>
                </div>
            </div>
        </section>
    @else
        <!-- Content Body -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Menetukan Perbandingan Berpasangan antara kriteria</h6>
                <div class="dropdown no-arrow">
                    <button id="cekkriteria" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-balance-scale"> </i> Periksa Kriteria</button>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- isi card -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Kriteria</th>
                    @foreach($kriterias as $id_x => $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @php $xy = 0; @endphp
                        @foreach($kriterias as $id_y => $kriteria)
                            <tr>
                                <th>{{ $kriteria->nama_kriteria }}</th>
                                @foreach($kriterias as $id_x => $kriteria)
                                @if ($id_y == $id_x)
                                    <td>
                                        {{-- <input type="text" class="form-control" name="coba" id="coba" value="[1] Sama penting dengan" readonly> --}}
                                        <select class="form-control skala" name="skala-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $id_y }}-{{ $id_x }}" disabled>
                                                <option value="1">[1] Sama penting dengan</option>
                                        </select>
                                    </td>
                                    @php $xy = $id_x; @endphp
                                @else
                                    @if ($id_y > $xy)
                                        <td>
                                            <select class="form-control skala" name="skala-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $id_y }}-{{ $id_x }}" disabled>
                                                @foreach(SiteHelpers::PlusSkalaPerbandingan() as $skala)
                                                    <option data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(session('dataKriteria')) {{ json_decode(session('dataKriteria'))[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                                @foreach(SiteHelpers::MinSkalaPerbandingan() as $skala)
                                                    <option data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(session('dataKriteria')) {{ json_decode(session('dataKriteria'))[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @else
                                        <td>
                                            <select class="form-control skala" name="skala-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $id_y }}-{{ $id_x }}">
                                                @foreach(SiteHelpers::PlusSkalaPerbandingan() as $skala)
                                                    <option data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(session('dataKriteria')) {{ json_decode(session('dataKriteria'))[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                                @foreach(SiteHelpers::MinSkalaPerbandingan() as $skala)
                                                    <option data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(session('dataKriteria')) {{ json_decode(session('dataKriteria'))[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endif    
                                @endif    
                                @endforeach
                            </tr>
                        @endforeach                          
                    </tbody>
                </table>


                <div id="MatriksKriteria" @if(session('dataKriteria')) style="display:block" @else style="display:none" @endif>
                    @if(session('dataKriteria'))
                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Matriks Perbandingan Kriteria</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kriteria</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                if (Session::has('dataKriteria')) {
                                    $dataKriteria = json_decode(session('dataKriteria'));
                                };

                                if (Session::has('jumlahKriteria')) {
                                    $jumlahMatrixKriteria = session('jumlahKriteria');
                                };
                            @endphp
                            @foreach($kriterias as $id_y => $kriteria)
                            <tr>
                                <th>{{ $kriteria->nama_kriteria }}</th>
                                @foreach($kriterias as $id_x => $kriteria)
                                    <td>{{ $dataKriteria[$id_y][$id_x] }}</td>   
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <th>Jumlah</th>
                                    @foreach(session('jumlahKriteria') as $data)
                                    <th>{{ $data }}</th>
                                    @endforeach    
                            </tr>                          
                        </tbody>
                    </table>
             

                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Normalisasi Matriks Perbandingan Kriteria</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kriteria</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                            <th>Prioritas</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dataNormalisasiKriteria = SiteHelpers::NormalisasiMatrix($dataKriteria, $jumlahMatrixKriteria);
                                    $namaSession = 'Kriteria';
                                    $labelKriteria = [];
                                    foreach ($kriterias as $value) {
                                        array_push($labelKriteria, $value->nama_kriteria);
                                    }
                                    $dataPrioritas = SiteHelpers::CreatePrioritas($dataNormalisasiKriteria, $namaSession, $labelKriteria);
                                @endphp
                                @foreach($kriterias as $id_y => $kriteria)
                                <tr>
                                    <th>{{ $kriteria->nama_kriteria }}</th>
                                        @foreach($kriterias as $id_x => $kriteria)
                                        <td>{{ $dataNormalisasiKriteria[$id_y][$id_x] }}</td>   
                                        @endforeach
                                    <th>{{ $dataPrioritas[$id_y] }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Matriks Penjumlahan Setiap Baris</h5>
                    <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Kriteria</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                            <th>Jumlah</th>
                            </tr>
                            </thead>
                        <tbody>
                            @php 
                                $perkalianMatrix = SiteHelpers::CreatePerkalianMatrix($dataKriteria, $dataPrioritas);
                                $jumlahPerBaris = SiteHelpers::CreateJumlahPerbaris($perkalianMatrix);
                            @endphp
                            @foreach($kriterias as $id_y => $kriteria)
                                <tr>
                                    <th>{{ $kriteria->nama_kriteria }}</th>
                                        @foreach($kriterias as $id_x => $kriteria)
                                        <td>{{ $perkalianMatrix[$id_y][$id_x] }}</td>   
                                        @endforeach
                                    <th>{{ $jumlahPerBaris[$id_y] }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Perhitungan Rasio Konsistensi</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kriteria</th>
                            <th>Jumlah Perbaris</th>
                            <th>Prioritas</th>
                            <th>Hasil</th>
                            </tr>
                            </thead>
                        <tbody>
                        @php
                            $dataHasilPenjumlahan = SiteHelpers::CreateHasilPenjumlahan($dataPrioritas, $jumlahPerBaris) 
                        @endphp
                        @foreach($kriterias as $id_y => $kriteria)
                            <tr>
                                <th>{{ $kriteria->nama_kriteria }}</th>
                                <td>{{ $jumlahPerBaris[$id_y] }}</td>
                                <td>{{ $dataPrioritas[$id_y] }}</td>
                                <td>{{ $dataHasilPenjumlahan['Jumlah'][$id_y] }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th colspan="3" class="text-center">Jumlah</th>
                                <th>{{ $dataHasilPenjumlahan['hasil'] }}</th>
                            </tr>
                        </tbody>
                    </table>
                    
                    @php
                        $hasil = SiteHelpers::CreateCR($kriterias, $dataHasilPenjumlahan['hasil']);
                    @endphp
                    
                    <table>
                        <tr>
                            <td>n</td>
                            <td>:</td>
                            <td>{{ $hasil['n'] }}</td>
                        </tr>
                        <tr>
                            <td>IR</td>
                            <td>:</td>
                            <td>{{ $hasil['ir'] }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>{{ $hasil['jumlah'] }}</td>
                        </tr>
                        <tr>
                            <td>Maks (Jumlah / n)</td>
                            <td>:</td>
                            <td>{{ $hasil['maks'] }}</td>
                        </tr>
                        <tr>
                            <td>CI ((Maks - n) / (n - 1))</td>
                            <td>:</td>
                            <td>{{ $hasil['ci'] }}</td>
                        </tr>
                        <tr>
                            <td>CR (CI / IR)</td>
                            <td>:</td>
                            <td>{{ $hasil['cr'] }}</td>
                        </tr>
                        <tr>
                            <td>Konsistensi (CR < 0,1)</td>
                            <td>:</td>
                            @if ($hasil['status'] === 'Konsisten')  
                                <td><b style="color: green">{{ $hasil['status'] }} !</b></td>
                            @else
                                <td><b style="color: red">{{ $hasil['status'] }} !</b></td>
                            @endif
                        </tr>
                    </table>
                </div>
                @endif
            </div>
                <!-- /isi card -->
        </div>

    <!-- /Content Body -->
  @endif   
</div>
@endsection

@section('js_script')
  <!-- jQuery 2.2.3 -->
  <script src="vendor/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- DataTables -->
  <script src="vendor/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">

    $(function () {
        $(".skala").change(function (e) {
            const x = e.target.value;
            const krt_y = $(this).find(':selected').data("y");
            const krt_x = $(this).find(':selected').data("x");
            const data_id = $(this).find(':selected').data("id");
            if(x >= 1){
                if(x == 1){
                    $("#skala-"+krt_x+"-"+krt_y).children("option[value='1']").prop('selected',true);
                }else{
                    const idMinSkala = cekMinSkala(data_id);
                    $("#skala-"+krt_x+"-"+krt_y).children("option[value='"+idMinSkala[0].skala+"']").prop('selected',true);
                };
            }else{
                const idPlusSkala = cekPlusSkala(data_id);
                $("#skala-"+krt_x+"-"+krt_y).children("option[value='"+idPlusSkala[0].skala+"']").prop('selected',true);
            };
        });

        function cekMinSkala(id){
            const MinSkalaPerbandingan = {{ Js::from(SiteHelpers::MinSkalaPerbandingan()) }};
            var filter =  MinSkalaPerbandingan.filter(function(creature) {
                return creature.id == id;
            });
            return filter;
        };

        function cekPlusSkala(id){
            const PlusSkalaPerbandingan = {{ Js::from(SiteHelpers::PlusSkalaPerbandingan()) }};
            var filter =  PlusSkalaPerbandingan.filter(function(creature) {
                return creature.id == id;
            });
            return filter;
        };

        $('#cekkriteria').on('click', function(){
            const kriterias = {{ Js::from($kriterias) }};
            var dataArray = [];
            for(y=0; y<kriterias.length; ++y){
                data_y = [];
                for(x=0; x<kriterias.length; ++x){
                    const data_x = $("#skala-"+y+"-"+x).val();
                    data_y.push(data_x);
                };
                dataArray.push(data_y);
            };
            
            var jsonPost = JSON.stringify(dataArray);
            if(dataArray != ""){
                $.ajax({
                    url: '/pembobotan/cekkriteria',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'data': jsonPost
                    },
                    success: function(response){
                        if (response.success) {
                            // console.log('berhasil');
                        }else{
                            // console.log('gagal');
                        }
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);                        
                    }
                });
            }else{
                console.log('gagal');
            };
            location.reload();
            $("#MatriksKriteria").css("display", "block");
        });
    });
  </script>
@endsection