@extends('dashboard.admin.templates.index')

@section('title', 'MAIN')
@section('sub-title', 'Selamat datang!!!')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
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

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-info-circle"></i> Informasi</h3>
    </div>
    <div class="box-body">

        <ul class="products-list product-list-in-box">
            @forelse ($informasi as $item)
            <li class="item">
                <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{ $item->tipe }}
                        <span class="label label-warning pull-right">{{ $item->created_at }}</span></a>
                    <span class="product-description">
                    {{ str_replace("program studi PLP ", "", $item->deskripsi) }}
                    </span>
                </div>
            </li>
            @empty
            Tidak ada data.
            @endforelse
        </ul>
    </div>
</div>
@endsection
