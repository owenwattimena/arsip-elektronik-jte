@extends('dashboard.admin.templates.index')

@section('title', 'Program Studi')
@section('sub-title', 'Daftar')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Program Studi</h3>
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
                        <h4 class="modal-title"> Tambah Program Studi</h4>
                    </div>
                    <form action="{{ route('admin.prodi.create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group @error('program_studi') has-error @enderror">
                                <label for="program_studi">PROGRAM STUDI</label>
                                <input type="text" class="form-control" name="program_studi" id="program_studi" value="{{ old('program_studi') }}" placeholder="Masukan program studi" required>
                                @error('program_studi') <span class="help-block">{{ $message }}</span> <br> @enderror
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
                        <th>PROGRAM STUDI</th>
                        <th>DOSEN</th>
                        {{-- <th>PLP</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodi as $key => $item)
                    @php
                        $totalDosen=0;
                        // $totalPlp=0;
                        foreach ($item->dosen as $value) {
                            if($value->user->role == 'dosen'){
                                ++$totalDosen;
                            }
                            // else if($value->user->role == 'plp'){
                            //     ++$totalPlp;
                            // }
                        }
                    @endphp
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->program_studi }}</td>
                        <td>{{ $totalDosen }}</td>
                        {{-- <td>{{ $totalPlp }}</td> --}}
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
