@extends('dashboard.templates.index')

@section('style')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('assets/dashboard') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endsection

@section('aside-menu')
@if (auth()->user()->role == 'admin')
@include('dashboard.admin.templates.menu')
@else
@include('dashboard.dosen-plp.templates.menu')
@endif
@endsection

@section('title', 'Profile')
{{-- @section('sub-title', 'Daftar') --}}

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Profile</h3>
    </div>
    <div class="box-body">
        @if (auth()->user()->role != 'admin')
        {!! $pengaturan->profile ?? '' !!}
        @else
        <form action="" method="POST">
            @csrf
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <textarea name="profile" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $pengaturan->profile??'' }}</textarea>
        </form>
        @endif

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

@section('script')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/dashboard') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function() {
        $('.textarea').wysihtml5()
    })

</script>
@endsection
