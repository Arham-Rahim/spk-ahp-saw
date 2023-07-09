@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Page Heading -->              
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home</h1>
    </div>
    <!-- Content Body -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <img class="mt-5 mb-5" src="{{ URL::asset('dist/img/Logo.png') }}" alt="Logo" height="120px">
                <h1><b>SELAMAT DATANG</b></h1>
                <h2>SISTEM PENDUKUNG KEPUTUSAN <br> PENERIMA BANTUAN SOSIAL BEDA RUMAH <br>LEMBANG PARINDING</h2>
                <br>
                <div class="btn-group">
                    <a href="/alternatif" type="button" class="btn btn-block btn-primary btn-lg">MULAI KEPUTUSAN</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection