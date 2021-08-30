@extends('layouts.app')

@section('body')
    <div id="app">
        <main class="page__Dashboard">
            <div class="container-fluid h-100">

                <div class="row h-100">

                    <div class="col-2 h-100 w-100 pr-0">

                        @include('layouts.components.sidebar')

                    </div>

                    <div class="col-10 pr-4">
                        <div><h4 class="mt-4 mb-4 font-weight-bold title__admin"">WEB BROADCAST KMTI</h4></div>
                        @section('navbartitle', 'Dashboard')
                        @include('layouts.components.navbar')

                        {{-- content --}}
                        <div class="card wrapper__card">
                            tes
                        </div>
                        {{-- akhir conten --}}
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection
