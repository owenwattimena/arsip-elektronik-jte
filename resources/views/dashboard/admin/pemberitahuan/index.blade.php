@extends('dashboard.admin.templates.index')

@section('title', 'Pemberitahuan')
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Pemberitahuan</h3>
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
                        <h4 class="modal-title"> Tambah Pemberitahuan</h4>
                    </div>
                    <form action="{{ route('admin.informasi.create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group @error('deskripsi') has-error @enderror">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukan deskripsi" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi') <span class="help-block">{{ $message }}</span> <br> @enderror
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
                        <th>Deskripsi</th>
                        <th>Dibuat pada</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemberitahuan as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <form action="{{ route('admin.informasi.delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah ingin menghapus pemberitahuan?')">HAPUS</button>
                            </form>
                        </td>
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
