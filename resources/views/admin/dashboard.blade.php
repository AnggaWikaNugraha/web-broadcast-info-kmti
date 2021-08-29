@extends('layouts.app')

@section('body')
    <div id="app">
        <main class="page__Dashboard">
            <div class="container-fluid h-100">

                {{-- content --}}
                <div class="row h-100">

                    <div class="col-2 h-100 w-100 pr-0">

                        <nav id="sidebar" class="sidebar-wrapper">
                            <div class="sidebar-content">
                              <div class="sidebar__menu">

                                <div class="sidebar__header">
                                    <img style="width: 70%" src="{{ asset('img/KMTI.png') }}" alt="">
                                </div>

                                <ul>

                                    <li>
                                        <a href="#">
                                            <i class="icons__ fas fa-tachometer-alt"></i>
                                          <span>Dashboard</span>
                                        </a>
                                    </li>
                                  <li>
                                    <a href="#">
                                      <i class="icons__ fa fa-book"></i>
                                      <span>Manage User</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="icons__ fa fa-calendar"></i>
                                      <span>Divisi</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="icons__ fa fa-folder"></i>
                                      <span>Broadcast</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#">
                                      <i class="icons__ fa fa-folder"></i>
                                      <span>Event</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
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
