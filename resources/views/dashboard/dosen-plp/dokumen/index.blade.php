@extends('dashboard.dosen-plp.templates.index')

@section('title')
Dokumen {{ $jenisDokumen }}
@endsection
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Dokumen</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>NO</th> --}}
                        <th>DOKUMEN</th>
                        <th>DILIHAT OLEH</th>
                        <th>DIBUAT TANGGAL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokumen as $key => $item)
                        @if ($item->dilihat_oleh == "all")
                        <tr>
                            {{-- <td>{{ ++$key }}</td> --}}
                            <td> <a href="{{ asset(Storage::url($item->dokumen)) }}" target="_blank">{{ getFileName($item->dokumen) }}</a> </td>
                            <td>{{ config('app.'.$item->dilihat_oleh) }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                        @else
                            @if ($item->dilihat_oleh == auth()->user()->role . "_all")
                            <tr>
                                {{-- <td>{{ ++$key }}</td> --}}
                                <td> <a href="{{ asset(Storage::url($item->dokumen)) }}" target="_blank">{{ getFileName($item->dokumen) }}</a> </td>
                                <td>{{ config('app.'.$item->dilihat_oleh) }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            @endif


                            @if ($item->akses)
                                @foreach ($item->akses as $akses)
                                    @if($akses->dosen_plp_id == auth()->user()->dosenPlp->id)
                                    <tr>
                                        {{-- <td>{{ ++$key }}</td> --}}
                                        <td> <a href="{{ asset(Storage::url($item->dokumen)) }}" target="_blank">{{ getFileName($item->dokumen) }}</a> </td>
                                        <td>{{ config('app.'.$item->dilihat_oleh) }}</td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif
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


