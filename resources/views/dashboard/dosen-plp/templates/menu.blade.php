@inject('prodiService', 'App\Services\ProgramStudiService')
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="{{ route('dosen.main') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
    </li>
    <li>
        <a href="{{ route('dosen.profile') }}">
            <i class="fa fa-info"></i> <span>Profile</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-check"></i> <span>Penilaian</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        {{-- {{ dd($prodiService->getDosenProdi(auth()->user()->dosenPlp->id)) }} --}}
        <ul class="treeview-menu">
            @foreach ($prodiService->getDosenProdi(auth()->user()->dosenPlp->id) as $item)
            <li><a href="{{ route('dosen.penilaian', $item->prodi->id) }}"><i class="fa fa-circle-o"></i> {{ $item->prodi->program_studi }}</a></li>
            @endforeach
        </ul>
    </li>
    <li>
        <a href="{{ route('dosen.dokumen') }}">
            <i class="fa fa-book"></i> <span>Dokumen</span>
        </a>
    </li>
</ul>
