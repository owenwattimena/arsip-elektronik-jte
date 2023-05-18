@include('dashboard.templates.head')
<!-- Site wrapper -->
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin: 0">
        <!-- Content Header (Page header) -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <section class="content-header text-center">
                    <h1>
                        DAFTAR <br>
                        <small>Dosen/PLP</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar</h3>
                        </div>
                        <div class="box-body">
                            @if(session('alert'))
                            <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('alert')['message'] }}
                            </div>
                            @endif

                            <form role="form" action="{{ route('auth.register.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
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
                                    <div class="form-group @error('jenis_kelamin') has-error @enderror">
                                        <label for="jenis_kelamin">JENIS KELAMIN</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Masukan pangkat/golongan" required>
                                            <option value="l">Laki-laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 form-group @error('tempat_lahir') has-error @enderror">
                                            <label for="tempat_lahir">TEMPAT LAHIR</label>
                                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukan tempat lahir">
                                            @error('tempat_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                                        </div>
                                        <div class="col-md-5 form-group @error('tanggal_lahir') has-error @enderror">
                                            <label for="tanggal_lahir">TANGGAL LAHIR</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Masukan tanggal lahir">
                                            @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> <br> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group @error('agama') has-error @enderror">
                                        <label for="agama">AGAMA</label>
                                        <select class="form-control" name="agama" id="agama" required>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Budah">Budah</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Islam">Islam</option>
                                        </select>
                                        @error('agama') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('alamat') has-error @enderror">
                                        <label for="alamat">ALAMAT</label>
                                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('telepon') has-error @enderror">
                                        <label for="telepon">TELEPON</label>
                                        <input type="tel" class="form-control" name="telepon" id="telepon" value="{{ old('telepon') }}" placeholder="Masukan nomor telepon">
                                        @error('telepon') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label for="email">EMAIL</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Masukan alamat email">
                                        @error('email') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('foto') has-error @enderror">
                                        <label for="foto">FOTO</label>
                                        <input type="file" class="form-control" name="foto" id="foto" placeholder="Pilih foto">
                                        @error('foto') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('password') has-error @enderror">
                                        <label for="password">SANDI</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukan sandi">
                                        @error('password') <span class="help-block">{{ $message }}</span> <br> @enderror
                                    </div>
                                    <div class="form-group @error('password_confirmation') has-error @enderror">
                                        <label for="password_confirmation">KONFIRMASI SANDI</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Masukan sandi">
                                        @error('password_confirmation') <span class="help-block">{{ $message }}</span> <br> @enderror
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
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success btn-block">DAFTAR</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <span>Sudah punya akun? </span>
                            <a href="{{ route('auth.login') }}" class="text-center">Masuk</a>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->

                </section>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- @include('dashboard.templates.footer') --}}

</div>
<!-- ./wrapper -->
@include('dashboard.templates.script')
