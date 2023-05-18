@inject('prodiService', 'App\Services\ProgramStudiService')
<ul class="sidebar-menu" data-widget="tree">
    <div class="text-center" style="margin-top: 15px; margin-bottom: 15px">
        <img src="{{ asset('assets/img/polnam.png') }}" width="60%" alt="">
    </div>
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="{{ route('admin.main') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.profile') }}">
            <i class="fa fa-info"></i> <span>Profile</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.prodi') }}">
            <i class="fa fa-list"></i> <span>Program Studi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.tahun-akademik') }}">
            <i class="fa fa-calendar"></i> <span>Tahun Akademik</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-check"></i> <span>Penilaian</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @foreach ($prodiService->getAll() as $item)
            <li><a href="{{ route('admin.penilaian', $item->id) }}"><i class="fa fa-circle-o"></i> {{ $item->program_studi }}</a></li>
            @endforeach
        </ul>
    </li>
    <li>
        <a href="{{ route('admin.dokumen') }}">
            <i class="fa fa-upload"></i> <span>Dokumen</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.user') }}">
            <i class="fa fa-user"></i> <span>User</span>
        </a>
    </li>
</ul>
{{-- {{ dump($prodiService->getAll()) }} --}}
