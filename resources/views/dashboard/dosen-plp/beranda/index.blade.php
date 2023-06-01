@extends('dashboard.dosen-plp.templates.index')
@section('style')
<style>
    .product-info {
        margin-left: 0 !important;
    }

</style>
@endsection
@section('title', 'HOME')
@section('sub-title', 'Selamat datang!!!')
@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-info-circle"></i> Pemberitahuan dan Informasi</h3>
    </div>
    <div class="box-body">

        <ul class="products-list product-list-in-box">
            @forelse ($informasi as $item)
            <li class="item">
                <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{ $item->tipe }}
                        <span class="label label-warning pull-right">{{ $item->created_at }}</span></a>
                    <span class="product-description">
                    {{ $item->deskripsi }}
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
