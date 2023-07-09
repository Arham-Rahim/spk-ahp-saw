@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembobotan Subkriteria</h1>
    </div>

    @if (count($subkriterias) == 0)
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

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ($kriterias as $id => $kriteria)
                <li class="nav-item">
                    <a class="nav-link {{ $id == 0 ? 'active' : '' }}" href="#tab_{{ $id }}" data-toggle="tab" role="tab" aria-controls="tab_{{ $id }}"><b>{{ $kriteria->nama_kriteria }}</b></a>
                </li>
            @endforeach
        </ul>
        <div class="card-body">
        <!-- isi card -->
        
        <div class="tab-content">
            @foreach ($kriterias as $i => $kriteria)
            @php
                $dataSubkriteria = $subkriterias->where('kriteria_id', $kriteria->id);
                $countSubkriteria = count($dataSubkriteria);
                if (Session::has($kriteria->nama_kriteria)) {
                    $matrixSubKriteria = json_decode(session($kriteria->nama_kriteria));
                };

                if (Session::has('jumlahSubKriteria_'.$kriteria->nama_kriteria)) {
                    $jumlahMatrixSubKriteria = session('jumlahSubKriteria_'.$kriteria->nama_kriteria);
                };

            @endphp
            <div class="tab-pane {{ $i == 0 ? 'active' : '' }}" id="tab_{{ $i }}">
                <div class="box-header">
                    <h5 class="font-weight-bold">Menetukan Perbandingan Berpasangan antara Subkriteria <b>({{ $kriteria->nama_kriteria }})</b></h5>
                    <div class="mt-3 mb-4">
                      <button value="{{ $kriteria->id }}" data-countSubKriteria="{{ $countSubkriteria }}" data-namakriteria="{{ $kriteria->nama_kriteria }}" class="btn btn-sm btn-success btn-flat pull-right ceksubkriteria"><i class="fa fa-balance-scale"> </i> Periksa</button>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Subkriteria</th>
                            @foreach ($dataSubkriteria as $item)
                                <th class="text-center">{{ $item->nama_sub_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php $id_y = 0; @endphp
                        @foreach ($dataSubkriteria as $subkriteria)    
                        <tr>
                            <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                            @php $id_x = 0; @endphp
                                @foreach ($dataSubkriteria as $item)
                                @if ($id_y == $id_x)
                                    <td>
                                        {{-- <input type="text" class="form-control" name="coba" id="coba" value="[1] Sama penting dengan" readonly> --}}
                                        <select class="form-control skala" name="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}" disabled>
                                                <option value="1">[1] Sama penting dengan</option>
                                        </select>
                                    </td>
                                    @php $xy = $id_x; @endphp
                                @else
                                    @if ($id_y > $xy)
                                        <td>
                                            <select class="form-control skala" name="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}" disabled>
                                                @foreach(SiteHelpers::PlusSkalaPerbandingan() as $skala)
                                                    <option data-kriteriaid="{{ $item->kriteria_id }}" data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(Session::has($kriteria->nama_kriteria)) {{ $matrixSubKriteria[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                                @foreach(SiteHelpers::MinSkalaPerbandingan() as $skala)
                                                    <option data-kriteriaid="{{ $item->kriteria_id }}" data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(Session::has($kriteria->nama_kriteria)) {{ $matrixSubKriteria[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @else
                                        <td>
                                            <select class="form-control skala" name="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}" id="skala-{{ $item->kriteria_id }}-{{ $id_y }}-{{ $id_x }}">
                                                @foreach(SiteHelpers::PlusSkalaPerbandingan() as $skala)
                                                    <option data-kriteriaid="{{ $item->kriteria_id }}" data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(Session::has($kriteria->nama_kriteria)) {{ $matrixSubKriteria[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                                @foreach(SiteHelpers::MinSkalaPerbandingan() as $skala)
                                                    <option data-kriteriaid="{{ $item->kriteria_id }}" data-y="{{ $id_y }}" data-x="{{ $id_x }}" data-id="{{ $skala['id'] }}" value="{{ $skala['skala'] }}" @if(Session::has($kriteria->nama_kriteria)) {{ $matrixSubKriteria[$id_y][$id_x] == $skala['skala'] ? 'selected' : '' }}@endif>{{ $skala['keterangan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                @endif    
                            @endif
                            @php $id_x++ @endphp
                            @endforeach
                        </tr> 
                        @php $id_y++ @endphp                       
                        @endforeach
                    </tbody>
                </table>

                <div id="MatriksKriteria" @if(session($kriteria->nama_kriteria)) style="display:block" @else style="display:none" @endif>
                @if (session($kriteria->nama_kriteria))
                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Matriks Perbandingan Subkriteria</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>Subkriteria</th>
                              @foreach($dataSubkriteria as $subkriteria)
                                <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                              @endforeach
                            </tr>
                        </thead>
                        <tbody>
                                @php $niliaId_y = 0; @endphp
                                @foreach($dataSubkriteria as $subkriteria)
                                    <tr>
                                        <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                        @php $niliaId_x = 0; @endphp
                                        @foreach($dataSubkriteria as $subkriteria)
                                        <td>{{ $matrixSubKriteria[$niliaId_y][$niliaId_x] }}</td>
                                        @php $niliaId_x++; @endphp   
                                        @endforeach
                                    </tr>
                                    @php $niliaId_y++; @endphp  
                                @endforeach
                                <tr>
                                    <th>Jumlah</th>
                                    @foreach($jumlahMatrixSubKriteria as $data)
                                        <th>{{ $data }}</th>
                                    @endforeach    
                                </tr>                          
                        </tbody>
                    </table>

                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Normalisasi Matriks Perbandingan Subkriteria</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subkriteria</th>
                                @foreach($dataSubkriteria as $subkriteria)
                                <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                @endforeach
                            <th>Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $dataNormalisasiSubKriteria = SiteHelpers::NormalisasiMatrix($matrixSubKriteria, $jumlahMatrixSubKriteria);
                                    $labelKriteria = [];
                                    foreach ($dataSubkriteria as $value) {
                                        array_push($labelKriteria, $value->nama_sub_kriteria);
                                    }
                                    $dataPrioritas = SiteHelpers::CreatePrioritas($dataNormalisasiSubKriteria, $kriteria->nama_kriteria, $labelKriteria);
                                @endphp
                                @php $norId_y = 0; @endphp
                                @foreach($dataSubkriteria as $subkriteria)
                                    <tr>
                                        <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                        @php $norId_x = 0; @endphp
                                        @foreach($dataSubkriteria as $subkriteria)
                                        <td>{{ $dataNormalisasiSubKriteria[$norId_y][$norId_x] }}</td>   
                                        @php $norId_x++; @endphp
                                        @endforeach
                                        <th>{{ $dataPrioritas[$norId_y] }}</th>
                                    </tr>
                                    @php $norId_y++; @endphp
                                @endforeach
                        </tbody>
                    </table>


                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Matriks Penjumlahan Setiap Baris</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subkriteria</th>
                                @foreach($dataSubkriteria as $subkriteria)
                                    <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                @endforeach
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php 
                                    $perkalianMatrix = SiteHelpers::CreatePerkalianMatrix($matrixSubKriteria, $dataPrioritas);
                                    $jumlahPerBaris = SiteHelpers::CreateJumlahPerbaris($perkalianMatrix);
                                @endphp
                                @php $jmlId_y = 0; @endphp
                                @foreach($dataSubkriteria as $subkriteria)
                                    <tr>
                                        <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                        @php $jmlId_x = 0; @endphp
                                        @foreach($dataSubkriteria as $subkriteria)
                                        <td>{{ $perkalianMatrix[$jmlId_y][$jmlId_x] }}</td> 
                                        @php $jmlId_x++; @endphp  
                                        @endforeach
                                        <th>{{ $jumlahPerBaris[$jmlId_y] }}</th>
                                    </tr>
                                    @php $jmlId_y++; @endphp
                                @endforeach
                        </tbody>
                    </table>


                    <hr class="mt-5">
                    <h5 class="font-weight-bold">Perhitungan Rasio Konsistensi</h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Subriteria</th>
                            <th>Jumlah Perbaris</th>
                            <th>Prioritas</th>
                            <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $dataHasilPenjumlahan = SiteHelpers::CreateHasilPenjumlahan($dataPrioritas, $jumlahPerBaris); 
                                    // dd($jumlahPerBaris);
                                    $rkId = 0;
                                @endphp
                                
                                @foreach($dataSubkriteria as $subkriteria)
                                    <tr>
                                        <th>{{ $subkriteria->nama_sub_kriteria }}</th>
                                        <td>{{ $jumlahPerBaris[$rkId] }}</td>
                                        <td>{{ $dataPrioritas[$rkId] }}</td>
                                        <td>{{ $dataHasilPenjumlahan['Jumlah'][$rkId] }}</td>
                                    </tr>
                                    @php $rkId++; @endphp
                                @endforeach
                                <tr>
                                    <th colspan="3" class="text-center">Jumlah</th>
                                    <th>{{ $dataHasilPenjumlahan['hasil'] }}</th>
                                </tr>
                        </tbody>
                    </table>

                    @php
                        $hasil = SiteHelpers::CreateCR($dataSubkriteria, $dataHasilPenjumlahan['hasil']);
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
                @endif
                </div>
            </div>
            @endforeach
          <!-- /.tab-pane -->
        </div>
        <!-- /isi card -->
        </div>
    </div>
    <!-- /Content Body -->




    <!-- Content Body -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                




                
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
    </section>
@endif       
</div>
@endsection

@section('js_script')
  <script type="text/javascript">
    $(function () {
        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        $('a[href="#' + activeTab + '"]').tab('show');

console.log(activeTab);

        $(".skala").change(function (e) {
            const x = e.target.value;
            const krt_y = $(this).find(':selected').data("y");
            const krt_x = $(this).find(':selected').data("x");
            const krt_id = $(this).find(':selected').data("kriteriaid");
            const data_id = $(this).find(':selected').data("id");
            // console.log(data_id);
            if(x >= 1){
                if(x == 1){
                    $("#skala-"+krt_id+"-"+krt_x+"-"+krt_y).children("option[value='1']").prop('selected',true);
                }else{
                    const idMinSkala = cekMinSkala(data_id);
                    $("#skala-"+krt_id+"-"+krt_x+"-"+krt_y).children("option[value='"+idMinSkala[0].skala+"']").prop('selected',true);
                };
            }else{
                const idPlusSkala = cekPlusSkala(data_id);
                $("#skala-"+krt_id+"-"+krt_x+"-"+krt_y).children("option[value='"+idPlusSkala[0].skala+"']").prop('selected',true);
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


        $('.ceksubkriteria').on('click', function(e){
            const krt_id = e.target.value;
            const countSubkriteria = e.target.dataset.countsubkriteria;
            const namaKriteria = e.target.dataset.namakriteria;
            var dataArray = [];
            for(y=0; y<countSubkriteria; ++y){
                data_y = [];
                for(x=0; x<countSubkriteria; ++x){
                    const data_x = $("#skala-"+krt_id+"-"+y+"-"+x).val();
                    data_y.push(data_x);
                };
                dataArray.push(data_y);
            };            
            
            var jsonPost = JSON.stringify(dataArray);
            if(dataArray != ""){
                $.ajax({
                    url: '/pembobotan/ceksubkriteria',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'namakriteria': namaKriteria,
                        'data': jsonPost
                    },
                    success: function(response){
                        // console.log(response);
                    },
                    error: function(xhr){
                        // console.log(xhr.responseText);                        
                    }
                });
            }else{
                console.log('gagal');
            };
            const linkTab = $('a.active').attr('href');
            window.location.href = '/pembobotan/subkriteria'+linkTab;
            location.reload();
            $("#MatriksKriteria").css("display", "block");
        });
    });
  </script>
@endsection