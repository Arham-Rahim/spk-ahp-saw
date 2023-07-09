@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
      </div>
  
      <!-- Content Body -->
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Form Penilaian <b>( {{ $alternatif->nama }} )</b></h6>
          <div class="dropdown no-arrow">
            {{-- <a href="/kriteria/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i>  Data Baru</a> --}}
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- isi card -->
          <form action="/penilaian" method="post" enctype="multipart/form-data">
            @csrf
            @php $countData = count($kriterias) @endphp
            <input type="hidden" class="form-control" name="alternatif_id" id="alternatif_id" value="{{ $alternatif->id }}">
            <input type="hidden" class="form-control" name="countdata" id="countdata" value="{{ $countData }}">
            @foreach($kriterias as $key => $kriteria)
            <div class="box-body">
                <input type="hidden" class="form-control" name="kriteria{{ $key }}" id="kriteria{{ $key }}" value="{{ $kriteria->id }}">
                <div class="form-group @error('{{ $kriteria->nama_kriteria }}') has-error @enderror">
                    <label for="{{ $kriteria->nama_kriteria }}">{{ $kriteria->nama_kriteria }}</label>
                    @foreach($kriteria->subkriteria as $qq)
                    <div class="radio">
                        <label>
                            <input type="radio" name="subkriteria{{ $key }}" id="{{ $qq->id }}" value="{{ $qq->id }}" required>
                            {{ $qq->nama_sub_kriteria }}
                        </label>
                    </div>
                    @endforeach                                
                    {{-- <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="{{ old('nama_kriteria') }}"> --}}
                    @error('nama_kriteria')<span class="help-block">{{ $message }}</span> @enderror
                </div>
            </div>
            @endforeach
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/penilaian" class="btn btn-default">Cancel</a>
              </div>
            </form>
          <!-- /isi card -->
        </div>
      </div>
      <!-- /Content Body -->
</div>
@endsection