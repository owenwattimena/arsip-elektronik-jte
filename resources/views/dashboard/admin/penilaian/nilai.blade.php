@extends('dashboard.admin.templates.index')

@section('title', 'Penilaian')
@section('sub-title')
{{ $prodi->program_studi }} - {{ $dosenPlp->nama_lengkap }}
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Penilaian</h3>
    </div>
    <div class="box-body">

        <form action="" method="GET">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Tahun Akademik</label>
                    <select class="form-control" name="tahun_akademik_id">
                        <option>---Pilih Tahun Akademik---</option>
                        @foreach ($tahunAkademik as $item)
                        <option {{ $item->id == $tahunAkademikId ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->tahun_akademik }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Semester</label>
                    <select class="form-control" name="semester" required>
                        <option>---Pilih Semester---</option>
                        <option {{ 'ganjil' == $semester ? 'selected' : '' }} value="ganjil">Ganjil</option>
                        <option {{ 'genap' == $semester ? 'selected' : '' }} value="genap">Genap</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class="text-white">_</label>
                    <button class="btn btn-success form-control">Filter</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->

@if ($tahunAkademikId != null && $semester != null)
<!-- /.box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Berkas</h3>
    </div>
    <div class="box-body">


        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">BKD</a></li>
                <li><a href="#tab_2" data-toggle="tab">LKD</a></li>
                <li><a href="#tab_3" data-toggle="tab">SKP</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @if ($bkd)
                    @if (!$bkd->penilaian)
                    <div class="alert alert-warning">
                        <h4><i class="icon fa fa-warning"></i> Dokumen belum dinilai!</h4>
                    </div>
                    @endif
                    @if ($bkd->penilaian)
                    <div class="alert alert-{{ $bkd->penilaian->terpenuhi? 'success':'danger' }}">
                        <h4><i class="icon fa fa-warning"></i> {!! $bkd->penilaian->terpenuhi? 'Dokemen telah di nilai <b>TERPENUHI</b>':'Dokemen telah di nilai <b>TIDAK TERPENUHI</b>' !!}</h4>
                    </div>
                    @endif

                    <embed src="{{ asset(Storage::url($bkd->berkas)) }}" width="100%" style="height: 600px;" />
                    @if (!$bkd->penilaian)
                    <h4>Penilaian</h4>
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="berkas_id" value="{{ $bkd->id }}" required>
                        <div class="form-group">
                            <label>Nilai</label>
                            <select class="form-control" name="terpenuhi" required>
                                <option value="">---Pilih Nilai---</option>
                                <option value="true">Terpenuhi</option>
                                <option value="false">Tidak Terpenuhi</option>
                            </select>
                        </div>
                        <button class="btn btn-success btn-block">Nilai</button>
                    </form>
                    @endif
                    @else
                    <p>Belum melakukan unggah berkas.</p>
                    @if (auth()->user()->role != 'admin')

                    <form action="{{ route('dosen.penilaian.create', $prodi->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dosen_plp_prodi_id" value="{{ $dosenPlpProdiId }}">
                        <input type="hidden" name="tahun_akademik_id" value="{{ $tahunAkademikId }}">
                        <input type="hidden" name="jenis_berkas" value="bkd">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <div class="form-group">
                            <label for="file_bkd">Unggah File BKD</label>
                            <input type="file" id="file_bkd" name="berkas" required>
                            @error('berkas') <span class="help-block text-red">{{ $message }}</span> <br> @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Unggah File</button>
                    </form>
                    @endif

                    @endif
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @if ($lkd)
                    @if (!$lkd->penilaian)
                    <div class="alert alert-warning">
                        <h4><i class="icon fa fa-warning"></i> Dokumen belum dinilai!</h4>
                    </div>
                    @endif
                    @if ($lkd->penilaian)
                    <div class="alert alert-{{ $lkd->penilaian->terpenuhi? 'success':'danger' }}">
                        <h4><i class="icon fa fa-warning"></i> {!! $lkd->penilaian->terpenuhi? 'Dokemen telah di nilai <b>TERPENUHI</b>':'Dokemen telah di nilai <b>TIDAK TERPENUHI</b>' !!}</h4>
                    </div>
                    @endif
                    <embed src="{{ asset(Storage::url($lkd->berkas)) }}" width="100%" style="height: 600px;" />
                    @if (!$lkd->penilaian)
                    <h4>Penilaian</h4>
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="berkas_id" value="{{ $lkd->id }}" required>
                        <div class="form-group">
                            <label>Nilai</label>
                            <select class="form-control" name="terpenuhi" required>
                                <option value="">---Pilih Nilai---</option>
                                <option value="true">Terpenuhi</option>
                                <option value="false">Tidak Terpenuhi</option>
                            </select>
                        </div>
                        <button class="btn btn-success btn-block">Nilai</button>
                    </form>
                    @endif
                    @else
                    <p>Belum melakukan unggah berkas.</p>
                    @if (auth()->user()->role != 'admin')
                    <form action="{{ route('dosen.penilaian.create', $prodi->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dosen_plp_prodi_id" value="{{ $dosenPlpProdiId }}">
                        <input type="hidden" name="tahun_akademik_id" value="{{ $tahunAkademikId }}">
                        <input type="hidden" name="jenis_berkas" value="lkd">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <div class="form-group">
                            <label for="berkas-lkd">Unggah File LKD</label>
                            <input type="file" id="berkas-lkd" name="berkas" required>
                            @error('berkas') <span class="help-block text-red">{{ $message }}</span> <br> @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Unggah File</button>
                    </form>
                    @endif
                    @endif
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @if ($skp)
                    @if (!$skp->penilaian)
                    <div class="alert alert-warning">
                        <h4><i class="icon fa fa-warning"></i> Dokumen belum dinilai!</h4>
                    </div>
                    @endif
                    @if ($skp->penilaian)
                    <div class="alert alert-{{ $skp->penilaian->terpenuhi? 'success':'danger' }}">
                        <h4><i class="icon fa fa-warning"></i> {!! $skp->penilaian->terpenuhi? 'Dokemen telah di nilai <b>TERPENUHI</b>':'Dokemen telah di nilai <b>TIDAK TERPENUHI</b>' !!}</h4>
                    </div>
                    @endif
                    <embed src="{{ asset(Storage::url($skp->berkas)) }}" width="100%" style="height: 600px;" />
                    @if (!$skp->penilaian)
                    <h4>Penilaian</h4>
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="berkas_id" value="{{ $skp->id }}" required>
                        <div class="form-group">
                            <label>Nilai</label>
                            <select class="form-control" name="terpenuhi" required>
                                <option value="">---Pilih Nilai---</option>
                                <option value="true">Terpenuhi</option>
                                <option value="false">Tidak Terpenuhi</option>
                            </select>
                        </div>
                        <button class="btn btn-success btn-block">Nilai</button>
                    </form>
                    @endif
                    @else
                    <p>Belum melakukan unggah berkas.</p>
                    @if (auth()->user()->role != 'admin')
                    <form action="{{ route('dosen.penilaian.create', $prodi->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dosen_plp_prodi_id" value="{{ $dosenPlpProdiId }}">
                        <input type="hidden" name="tahun_akademik_id" value="{{ $tahunAkademikId }}">
                        <input type="hidden" name="jenis_berkas" value="skp">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <div class="form-group">
                            <label for="berkas-skp">Unggah File SKP</label>
                            <input type="file" id="berkas-skp" name="berkas" required>
                            @error('berkas') <span class="help-block text-red">{{ $message }}</span> <br> @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Unggah File</button>
                    </form>
                    @endif
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->


    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endif
@endsection
