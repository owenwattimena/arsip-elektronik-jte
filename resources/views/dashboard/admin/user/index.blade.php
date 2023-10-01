@extends('dashboard.admin.templates.index')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/dashboard') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
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
        <br>
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
                            <div class="form-group @error('nidn') has-error @enderror">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control" name="nidn" id="nidn" value="{{ old('nidn') }}" placeholder="Masukan NIDN">
                                @error('nidn') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('nip') has-error @enderror">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip') }}" placeholder="Masukan NIP">
                                @error('nip') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('jabatan_fungsional') has-error @enderror">
                                <label for="nidn">JABATAN FUNGSIONAL</label>
                                <select class="form-control" name="jabatan_fungsional">
                                    <option value="">---PILIH JABATAN FUNGSIONAL---</option>
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                </select>
                                @error('jabatan_fungsional') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="form-group @error('pangkat_golongan') has-error @enderror">
                                <label for="nidn">PANGKAT GOLONGAN</label>
                                <select class="form-control" name="pangkat_golongan">
                                    <option value="">---PILIH PANGKAT GOLONGAN---</option>
                                    <option value="II/A">II/A</option>
                                    <option value="II/B">II/B</option>
                                    <option value="II/C">II/C</option>
                                    <option value="II/D">II/D</option>
                                    <option value="III/A">III/A</option>
                                    <option value="III/B">III/B</option>
                                    <option value="III/C">III/C</option>
                                    <option value="III/D">III/D</option>
                                    <option value="IV/A">IV/A</option>
                                    <option value="IV/B">IV/B</option>
                                    <option value="IV/C">IV/C</option>
                                </select>
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
                            <div id="prodi" class="form-group @error('program_studi_id') has-error @enderror">
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
            <table id="table" class="table">
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
                        <td>
                            <a href="{{route('admin.user.biodata', $item->id)}}" class="btn btn-primary btn-xs">BIODATA</a>
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
@section('script')
<!-- DataTables -->
<script src="{{ asset('assets/dashboard') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        // $('#table').dataTable();

        $("#status").on("change", function(){
            if($(this).val() == 'plp'){
                showProdi(false);
            }else{
                showProdi(true);
            }
        });
    })

    function showProdi(val=true)
    {
        if(val)
        {
            $("#prodi").show();
        }else{
            $("#prodi").hide();
        }
    }

</script>
@endsection
