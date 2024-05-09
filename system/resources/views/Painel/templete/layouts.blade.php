@extends('app')

@section('main')

<div class="layout-top-nav" cz-shortcut-listen="true" style="height: auto;">

    <div class="wrapper">

        @include('Painel.templete.Partials.navigation')


        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('Painel.templete.Partials.footer')
    </div>

</div>

@endsection
