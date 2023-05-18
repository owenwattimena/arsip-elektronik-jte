@extends('dashboard.admin.templates.index')

@section('title', 'User')
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User</h3>
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
                        <h4 class="modal-title"> Tambah User</h4>
                    </div>
                    <form action="{{ route('admin.user.create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group @error('nama_lengkap') has-error @enderror">
                                <label for="nama_lengkap">NAMA LENGKAP</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukan nama lengkap" required>
                                @error('nama_lengkap') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('nip') has-error @enderror">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip') }}" placeholder="Masukan NIP">
                                @error('nip') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('pangkat_golongan') has-error @enderror">
                                <label for="pangkat_golongan">PANGKAT/GOLONGAN</label>
                                <input type="text" class="form-control" name="pangkat_golongan" id="pangkat_golongan" value="{{ old('pangkat_golongan') }}" placeholder="Masukan pangkat/golongan">
                                @error('pangkat_golongan') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('program_studi') has-error @enderror">
                                <label for="username">USERNAME</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="Masukan username" required>
                                @error('username') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('program_studi') has-error @enderror">
                                <label for="password">PASSWORD</label>
                                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Masukan password" required>
                                @error('password') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('status') has-error @enderror">
                                <label for="status">STATUS</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="dosen">Dosen</option>
                                    <option value="plp">PLP</option>
                                </select>
                                @error('status') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('program_studi_id') has-error @enderror">
                                <label for="status">PROGRAM STUDI</label>
                                @foreach ($prodi as $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="program_studi_id[]" value="{{ $item->id }}">
                                        {{ $item->program_studi }}
                                    </label>
                                </div>
                                @endforeach
                                @error('program_studi_id') <span class="help-block">{{ $message }}</span> <br> @enderror
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
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>NIP</th>
                        <th>JENIS KELAMIN</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->dosenPlp->nama_lengkap }}</td>
                        <td>{{ $item->dosenPlp->nip }}</td>
                        <td>{{ config('app.jenis_kelamin.'.$item->dosenPlp->jenis_kelamin) }}</td>
                        <td>{{ config('app.'.$item->role) }}</td>
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
