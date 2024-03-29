@extends('dashboard.dosen-plp.templates.index')

@section('title', 'Profil')
@section('sub-title', '')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User</h3>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('dosen.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group @error('nama_lengkap') has-error @enderror">
                            <label for="nama_lengkap">NAMA LENGKAP <span class="text-danger ">*</span> </label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->dosenPlp->nama_lengkap) }}" placeholder="Masukan nama lengkap" required>
                            @error('nama_lengkap') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('nip') has-error @enderror">
                            <label for="nip">NIP <span class="text-danger ">*</span></label>
                            <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip', auth()->user()->dosenPlp->nip) }}" placeholder="Masukan NIP">
                            @error('nip') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('jabatan_fungsional') has-error @enderror">
                            <label for="nidn">JABATAN FUNGSIONAL <span class="text-danger ">*</span></label>
                            @php
                                $jabatan = old('jabatan_fungsional', auth()->user()->dosenPlp->jabatan_fungsional);
                            @endphp
                            <select class="form-control" name="jabatan_fungsional">
                                <option value="">---PILIH JABATAN FUNGSIONAL---</option>
                                <option {{ $jabatan == "Asisten Ahli" ? 'selected' : '' }} value="Asisten Ahli">Asisten Ahli</option>
                                <option {{ $jabatan == "Lektor" ? 'selected' : '' }} value="Lektor">Lektor</option>
                                <option {{ $jabatan == "Lektor Kepala" ? 'selected' : '' }} value="Lektor Kepala">Lektor Kepala</option>
                            </select>
                            @error('jabatan_fungsional') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('pangkat_golongan') has-error @enderror">
                            <label for="pangkat_golongan">PANGKAT/GOLONGAN <span class="text-danger ">*</span></label>
                            {{-- <input type="text" class="form-control" name="pangkat_golongan" id="pangkat_golongan" value="{{ old('pangkat_golongan', auth()->user()->dosenPlp->pangkat_golongan) }}" placeholder="Masukan pangkat/golongan"> --}}
                            @php
                                $pangkatGolongan = old('pangkat_golongan', auth()->user()->dosenPlp->pangkat_golongan);
                            @endphp
                            <select class="form-control" name="pangkat_golongan">
                                <option value="">---PILIH PANGKAT GOLONGAN---</option>
                                <option {{ $pangkatGolongan == "II/A" ? 'selected' : '' }} value="II/A">II/A</option>
                                <option {{ $pangkatGolongan == "II/B" ? 'selected' : '' }} value="II/B">II/B</option>
                                <option {{ $pangkatGolongan == "II/C" ? 'selected' : '' }} value="II/C">II/C</option>
                                <option {{ $pangkatGolongan == "II/D" ? 'selected' : '' }} value="II/D">II/D</option>
                                <option {{ $pangkatGolongan == "III/A" ? 'selected' : '' }} value="III/A">III/A</option>
                                <option {{ $pangkatGolongan == "III/B" ? 'selected' : '' }} value="III/B">III/B</option>
                                <option {{ $pangkatGolongan == "III/C" ? 'selected' : '' }} value="III/C">III/C</option>
                                <option {{ $pangkatGolongan == "III/D" ? 'selected' : '' }} value="III/D">III/D</option>
                                <option {{ $pangkatGolongan == "IV/A" ? 'selected' : '' }} value="IV/A">IV/A</option>
                                <option {{ $pangkatGolongan == "IVB" ? 'selected' : '' }} value="IV/B">IV/B</option>
                                <option {{ $pangkatGolongan == "IV/C" ? 'selected' : '' }} value="IV/C">IV/C</option>
                            </select>
                            @error('pangkat_golongan') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('jenis_kelamin') has-error @enderror">
                            <label for="jenis_kelamin">JENIS KELAMIN <span class="text-danger ">*</span></label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Masukan pangkat/golongan" required>
                                <option value="l" {{ auth()->user()->dosenPlp->jenis_kelamin == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="p" {{ auth()->user()->dosenPlp->jenis_kelamin == 'p' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-7 form-group @error('tempat_lahir') has-error @enderror">
                                <label for="tempat_lahir">TEMPAT LAHIR <span class="text-danger ">*</span></label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', auth()->user()->dosenPlp->tempat_lahir) }}" placeholder="Masukan tempat lahir" required>
                                @error('tempat_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="col-md-5 form-group @error('tanggal_lahir') has-error @enderror">
                                <label for="tanggal_lahir">TANGGAL LAHIR <span class="text-danger ">*</span></label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', auth()->user()->dosenPlp->tanggal_lahir) }}" placeholder="Masukan tanggal lahir" required>
                                @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                        </div>
                        <div class="form-group @error('agama') has-error @enderror">
                            <label for="agama">AGAMA <span class="text-danger ">*</span></label>
                            <select class="form-control" name="agama" id="agama" required>
                                <option value="Kristen" {{ auth()->user()->dosenPlp->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ auth()->user()->dosenPlp->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Budah" {{ auth()->user()->dosenPlp->agama == 'Budah' ? 'selected' : '' }}>Budah</option>
                                <option value="Hindu" {{ auth()->user()->dosenPlp->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghucu" {{ auth()->user()->dosenPlp->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                <option value="Islam" {{ auth()->user()->dosenPlp->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            </select>
                            @error('agama') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('alamat') has-error @enderror">
                            <label for="alamat">ALAMAT <span class="text-danger ">*</span></label>
                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat" required>{{ old('alamat', auth()->user()->dosenPlp->alamat) }}</textarea>
                            @error('alamat') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('telepon') has-error @enderror">
                            <label for="telepon">TELEPON <span class="text-danger ">*</span></label>
                            <input type="tel" class="form-control" name="telepon" id="telepon" value="{{ old('telepon', auth()->user()->dosenPlp->telepon) }}" placeholder="Masukan nomor telepon" required>
                            @error('telepon') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">EMAIL <span class="text-danger ">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', auth()->user()->dosenPlp->email) }}" placeholder="Masukan alamat email" required>
                            @error('email') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('foto') has-error @enderror">
                            <label for="foto">FOTO</label>
                            <input type="file" class="form-control" name="foto" id="foto" placeholder="Pilih foto">
                            @error('foto') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-block">UBAH PROFIL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Sandi</h3>
            </div>
            <form action="{{ route('dosen.profil.change-password') }}" method="post">
                <div class="box-body">
                    @csrf
                    @method('put')
                    <div class="form-group @error('password_lama') has-error @enderror">
                        <label for="password_lama">SANDI LAMA</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan sandi lama">
                        @error('password_lama') <span class="help-block">{{ $message }}</span> <br> @enderror
                    </div>
                    <div class="form-group @error('password') has-error @enderror">
                        <label for="password">SANDI</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukan sandi baru">
                        @error('password') <span class="help-block">{{ $message }}</span> <br> @enderror
                    </div>
                    <div class="form-group @error('password_confirmation') has-error @enderror">
                        <label for="password_confirmation">KONFIRMASI SANDI</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Masukan konfirmasi sandi baru">
                        @error('password_confirmation') <span class="help-block">{{ $message }}</span> <br> @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger btn-block"> <i class="fa fa-key"></i> UBAH SANDI</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
