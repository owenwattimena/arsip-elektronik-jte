@extends('dashboard.admin.templates.index')

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
                <img class="profile-user-img img-responsive img-circle" src="{{ asset(Storage::url($user->dosenPlp->foto)) }}" alt="User profile picture">
                <form role="form" action="#">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group @error('nama_lengkap') has-error @enderror">
                            <label for="nama_lengkap">NAMA LENGKAP</label>
                            <input disabled type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $user->dosenPlp->nama_lengkap) }}" placeholder="Masukan nama lengkap" required>
                            @error('nama_lengkap') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('nip') has-error @enderror">
                            <label for="nip">NIP</label>
                            <input disabled type="text" class="form-control" name="nip" id="nip" value="{{ old('nip', $user->dosenPlp->nip) }}" placeholder="Masukan NIP">
                            @error('nip') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('pangkat_golongan') has-error @enderror">
                            <label for="pangkat_golongan">PANGKAT/GOLONGAN</label>
                            <input disabled type="text" class="form-control" name="pangkat_golongan" id="pangkat_golongan" value="{{ old('pangkat_golongan', $user->dosenPlp->pangkat_golongan) }}" placeholder="Masukan pangkat/golongan">
                            @error('pangkat_golongan') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('jenis_kelamin') has-error @enderror">
                            <label for="jenis_kelamin">JENIS KELAMIN</label>
                            <select disabled class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Masukan pangkat/golongan" required>
                                <option value="l" {{ $user->dosenPlp->jenis_kelamin == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="p" {{ $user->dosenPlp->jenis_kelamin == 'p' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-7 form-group @error('tempat_lahir') has-error @enderror">
                                <label for="tempat_lahir">TEMPAT LAHIR</label>
                                <input disabled type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $user->dosenPlp->tempat_lahir) }}" placeholder="Masukan tempat lahir" required>
                                @error('tempat_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                            <div class="col-md-5 form-group @error('tanggal_lahir') has-error @enderror">
                                <label for="tanggal_lahir">TANGGAL LAHIR</label>
                                <input disabled type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $user->dosenPlp->tanggal_lahir) }}" placeholder="Masukan tanggal lahir" required>
                                @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                            </div>
                        </div>
                        <div class="form-group @error('agama') has-error @enderror">
                            <label for="agama">AGAMA</label>
                            <select disabled class="form-control" name="agama" id="agama" required>
                                <option value="Kristen" {{ $user->dosenPlp->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ $user->dosenPlp->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Budah" {{ $user->dosenPlp->agama == 'Budah' ? 'selected' : '' }}>Budah</option>
                                <option value="Hindu" {{ $user->dosenPlp->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghucu" {{ $user->dosenPlp->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                <option value="Islam" {{ $user->dosenPlp->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            </select>
                            @error('agama') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('alamat') has-error @enderror">
                            <label for="alamat">ALAMAT</label>
                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat" required>{{ old('alamat', $user->dosenPlp->alamat) }}</textarea>
                            @error('alamat') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('telepon') has-error @enderror">
                            <label for="telepon">TELEPON</label>
                            <input disabled type="tel" class="form-control" name="telepon" id="telepon" value="{{ old('telepon', $user->dosenPlp->telepon) }}" placeholder="Masukan nomor telepon" required>
                            @error('telepon') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">EMAIL</label>
                            <input disabled type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->dosenPlp->email) }}" placeholder="Masukan alamat email" required>
                            @error('email') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                    </div>
                    {{-- <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-block">UBAH PROFIL</button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Sandi</h3>
            </div>
            <form action="{{ route('admin.user.change-password', $user->id) }}" method="post">
                <div class="box-body">
                    @csrf
                    @method('put')
                    {{-- <div class="form-group @error('password_lama') has-error @enderror">
                        <label for="password_lama">SANDI LAMA</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan sandi lama">
                        @error('password_lama') <span class="help-block">{{ $message }}</span> <br> @enderror
                    </div> --}}
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
