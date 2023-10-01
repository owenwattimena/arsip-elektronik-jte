<div>
    <div class="text-right">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah"> <i class="fa fa-plus"></i> Tambah</button>
    </div>
    <div class="modal fade" id="modal-tambah" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Unggah Dokumen</h4>
                </div>
                <form action="{{ route('admin.dokumen.create') }}" method="POST" enctype="multipart/form-data">
                    {{-- <form action="{{ route('admin.dokumen.create') }}" method="POST" enctype="multipart/form-data"> --}}
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="jenis" value="{{ $jenis }}">
                        <div class="form-group @error('dokumen') has-error @enderror">
                            <label for="dokumen">DOKUMEN</label>
                            <input type="file" class="form-control" name="dokumen" id="dokumen" value="{{ old('dokumen') }}" placeholder="Masukan program studi" required>
                            @error('dokumen') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <div class="form-group @error('dilihat_oleh') has-error @enderror">
                            <label for="dilihat_oleh">DILIHAT OLEH</label>
                            <select class="form-control" name="dilihat_oleh" wire:model="dilihatOleh" id="dilihat_oleh" required wire:ignore>
                                <option value="">---Pilih Akses---</option>
                                <option value="all">Semua</option>
                                <option value="dosen">Dosen</option>
                                <option value="plp">PLP</option>
                            </select>
                            @error('dilihat_oleh') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        @if ($users)
                        <div class="form-group @error('dosen_plp_id') has-error @enderror">
                            <label for="dosen_plp_id">{{ strtoupper($dilihatOleh) }}</label>
                            <select wire:ignore class="form-control select2" style="width: 100%;" multiple="multiple" name="dosen_plp_id[]" wire:model="dosenPlpId" id="dosen_plp_id">
                                <option value="">---Pilih {{ $dilihatOleh }}---</option>
                                @foreach ($users as $item)
                                <option value="{{ $item->dosenPlp->id }}">{{ $item->dosenPlp->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @error('dosen_plp_id') <span class="help-block">{{ $message }}</span> <br> @enderror
                        </div>
                        <script>
                             $('.select2').select2();
                        </script>
                        @endif

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
</div>
@section('script')
<!-- Select2 -->
<script src="{{ asset('assets/dashboard/bower_components/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>

$(document).ready(function(){
    $('.select2').select2();
});
</script>
@endsection
