@extends('layouts.user')

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Analisis Dashboard Broadcast
                    <div class="page-title-subheading">
                        Rangkuman Broadcast KMTI
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Divisi</div>
                            <div class="widget-subheading">Divisi yang ada di KMTI</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success">{{ $divisi }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total info</div>
                            <div class="widget-subheading">Info KMTI</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">{{ $info }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Events</div>
                            <div class="widget-subheading">Event yang aktif</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">{{ $events }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Info terbaru</div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Subject</th>
                                <th>Terkirim</th>
                                <th>Terkirim ke</th>
                                {{-- <th style="text-align: center">Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infoMahasiswa as $item)

                                <tr>
                                    <td style="text-align: center">{{ $loop->index  + 1}}</td>
                                    <td>{{ $item->subject}}</td>
                                    <td>{{ $item->mahasiswa()->first()->pivot->tanggal_kirim}}</td>
                                    <td>{!! $item->divisi !== null?  $item->divisi->nama_divisi : '<div class="badge badge-info">Anggota KMTI</div>' !!}</td>
                                    {{-- <td style="text-align: center">{!! $item->mahasiswa()->first()->pivot->status == 'active' ? ' <div class="badge badge-warning">Belum terbaca</div>' : '  <div class="badge badge-success">Sudah terbaca</div>' !!}</td> --}}
                                </tr>

                           @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Event terdekat</div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Tanggal mulai</th>
                                <th>Tanggal berakhir</th>
                                <th>Jam</th>
                                <th>lokasi</th>
                                <th style="text-align: center">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventsActive as $item)

                                <tr>
                                    <td style="text-align: center">{{ $loop->index  + 1}}</td>
                                    <td>{{ $item->nama}}</td>
                                    <td>{{ $item->tanggal_mulai}}</td>
                                    <td>{{ $item->tanggal_berakhir}}</td>
                                    <td>{{ $item->jam_mulai}} - {{ $item->jam_berakhir}}</td>
                                    <td>{{ $item->lokasi}}</td>
                                    <td style="text-align: center">{!! $item->status == 'belum-mulai' ? '<div class="badge badge-warning">belum-mulai</div>' : $hasil = $item->status == 'sudah-selesai' ? ' <div class="badge badge-success">sudah-selesai</div>' : '<div class="badge badge-danger">Cancel</div>' !!}</td>
                                </tr>

                           @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
