@extends('dashboard.admin.templates.index')
@section('style')
<!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('title')
Dokumen {{$jenisDokumen}}
@endsection
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Dokumen</h3>
    </div>
    <div class="box-body">
        <livewire:admin.dokumen.tambah :jenis="$jenis">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>DOKUMEN</th>
                        <th>DILIHAT OLEH</th>
                        <th>DIBUAT TANGGAL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokumen as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td> <a href="{{ asset(Storage::url($item->dokumen)) }}" target="_blank">{{ getFileName($item->dokumen) }}</a> </td>
                        <td>{{ config('app.'.$item->dilihat_oleh) }} -
                        @if(count($item->akses) <= 0)
                            <span class="badge bg-green">Semua</span>
                        @else
                        @foreach ($item->akses as $akses)
                        <span class="badge bg-yellow">{{ $akses->dosenPlp->nama_lengkap }}</span>
                        @endforeach
                        @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

