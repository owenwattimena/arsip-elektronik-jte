@include('dashboard.templates.head')
<!-- Site wrapper -->
<div class="wrapper">
    @include('dashboard.templates.header')

    <!-- =============================================== -->

    @include('dashboard.templates.aside')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"  style="background-image: url('{{ asset('assets/img/jte-building.jpeg') }}'); background-size: cover">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('sub-title')</small>
            </h1>
            {{-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol> --}}
        </section>

        <!-- Main content -->
        <section class="content">
            @if(session('status'))
            <div class="alert alert-{{ session('status')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('message') }}
            </div>
            @endif
            @yield('content')
            <!-- Default box -->
            {{-- <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Title</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    Start creating your amazing application!
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div> --}}
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('dashboard.templates.footer')

    @include('dashboard.templates.sidebar')
</div>
<!-- ./wrapper -->
@include('dashboard.templates.script')
