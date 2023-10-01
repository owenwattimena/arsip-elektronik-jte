@inject('prodiService', 'App\Services\ProgramStudiService')
<ul class="sidebar-menu" data-widget="tree">
    <div class="text-center" style="margin-top: 15px; margin-bottom: 15px">
        <img src="{{ asset('assets/img/polnam.png') }}" width="60%" alt="">
    </div>

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
    {{-- @if (auth()->user()->role == "plp")
    <li>
        <a href="{{ url('dosen_plp/penilaian/plp') }}">
            <i class="fa fa-check"></i> <span>Penilaian</span>
        </a>
    </li>
    @else --}}
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
    {{-- @endif --}}
    <li class="treeview">
        <a href="#">
            <i class="fa fa-upload"></i> <span>Dokumen</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('dosen.dokumen.sk') }}"><i class="fa fa-circle-o"></i> SK Direktur</a></li>
            <li><a href="{{ route('dosen.dokumen.surat-tugas') }}"><i class="fa fa-circle-o"></i> Surat Tugas</a></li>
        </ul>
    </li>
    {{-- <li>
        <a href="{{ route('dosen.dokumen') }}">
            <i class="fa fa-book"></i> <span>Dokumen</span>
        </a>
    </li> --}}
</ul>
