@extends('layouts.app')

@section('body')
    <div id="app">
        <main class="page__Dashboard">
            <div class="container-fluid">

                {{-- content --}}
                <div class="row">

                    <div class="col-2">

                        <nav id="sidebar" class="sidebar-wrapper">
                            <div class="sidebar-content">
                              <div class="sidebar-menu">
                                <ul>

                                  <li class="header-menu">
                                    <span>Extra</span>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="fa fa-book"></i>
                                      <span>Documentation</span>
                                      <span class="badge badge-pill badge-primary">Beta</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="fa fa-calendar"></i>
                                      <span>Calendar</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="fa fa-folder"></i>
                                      <span>Examples</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <!-- sidebar-menu  -->
                            </div>
                          </nav>

                    </div>

                    <div class="col-10">
                        <div><h4 class="mt-4 mb-4 font-weight-bold title__admin"">WEB BROADCAST KMTI</h4></div>
                        @section('navbartitle', 'Dashboard')
                        @include('layouts.components.navbar')
                    </div>

                </div>
                {{-- akhir conten --}}
            </div>
        </main>
    </div>
@endsection
