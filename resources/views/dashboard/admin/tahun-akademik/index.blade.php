@extends('dashboard.admin.templates.index')

@section('title', 'Tahun Akademik')
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tahun Akademik</h3>
    </div>
    <div class="box-body">
        <div class="text-right">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah"> <i class="fa fa-plus"></i> Tambah</button>
        </div>
        <div class="modal fade" id="modal-tambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Tambah Tahun Akademik</h4>
                    </div>
                    <form action="{{ route('admin.tahun-akademik.create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group @error('tahun_akademik') has-error @enderror">
                                <label for="tahun_akademik">TAHUN AKADEMIK</label>
                                <input type="text" class="form-control" name="tahun_akademik" id="tahun_akademik" value="{{ old('tahun_akademik') }}" placeholder="Masukan program studi" required>
                                @error('tahun_akademik') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>TAHUN AKADEMIK</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tahunAkademik as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->tahun_akademik }}</td>
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
