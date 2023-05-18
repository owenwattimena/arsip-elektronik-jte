@extends('dashboard.admin.templates.index')

@section('title', 'Dokumen')
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Dokumen</h3>
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
                        <h4 class="modal-title"> Unggah Dokumen</h4>
                    </div>
                    <form action="{{ route('admin.dokumen.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group @error('dokumen') has-error @enderror">
                                <label for="dokumen">DOKUMEN</label>
                                <input type="file" class="form-control" name="dokumen" id="dokumen" value="{{ old('dokumen') }}" placeholder="Masukan program studi" required>
                                @error('dokumen') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('dilihat_oleh') has-error @enderror">
                                <label for="dilihat_oleh">DILIHAT OLEH</label>
                                <select class="form-control" name="dilihat_oleh" id="dilihat_oleh" required>
                                    <option value="all">Semua</option>
                                    <option value="dosen">Dosen</option>
                                    <option value="plp">PLP</option>
                                </select>
                                @error('dilihat_oleh') <span class="help-block">{{ $message }}</span> <br> @enderror
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
                        <td> <a href="{{ asset(Storage::url($item->dokumen)) }}" target="_blank">{{ $item->dokumen }}</a> </td>
                        <td>{{ config('app.'.$item->dilihat_oleh) }}</td>
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
