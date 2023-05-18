@extends('dashboard.admin.templates.index')

@section('title', 'Penilaian')
@section('sub-title')
{{ $prodi->program_studi }}
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Penilaian</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>PANGKAT/GOLONGAN</th>
                        <th>JENIS KELAMIN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodi->dosen as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->pangkat_golongan }}</td>
                        <td>{{ config('app.jenis_kelamin.'.$item->jenis_kelamin)  }}</td>
                        <td>
                            <a href="{{ route('admin.penilaian.nilai', [$prodi->id, $item->id]) }}" class="btn btn-success btn-sm">Nilai</a>
                        </td>
                    </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <form action="" method="GET">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Tahun Akademik</label>
                    <select class="form-control">
                        <option>---Pilih Tahun Akademik---</option>
                        @foreach ($tahunAkademik as $item)
                        <option value="{{ $item->id }}">{{ $item->tahun_akademik }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Semester</label>
                    <select class="form-control">
                        <option>---Pilih Semester---</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class="text-white">_</label>
                    <button class="btn btn-success form-control">Filter</button>
                </div>
            </div>
        </form> --}}

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection
