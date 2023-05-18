@extends('dashboard.admin.templates.index')

@section('title', 'MAIN')
@section('sub-title', 'Selamat datang!!!')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Dosen</span>
                <span class="info-box-number">{{ $totalDosen }} <small>Orang</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah PLP</span>
                <span class="info-box-number">{{ $totalPlp }} <small>Orang</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
@endsection
