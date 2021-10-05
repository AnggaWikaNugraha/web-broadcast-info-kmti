@extends('layouts.app')

@section('body')
    <div id="app">

        @include('layouts.components.navbar-welcome')

        <main style="margin-top: 50px" class="py-4">
            {{-- content --}}

            <div id="header" class="container mt-5">
                <a class="navbar-brand" href="https://ti.umy.ac.id">
                    <img src="https://ti.umy.ac.id/wp-content/uploads/2019/10/logo-umy-samping.png" alt="Home" widht="180"
                        height="50">
                    <span>Teknologi Informasi</span>
                </a>

            </div>

            <div style="background-color: rgba(0, 45, 28, .4)" class="mt-5 jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 style="color: white; font-weight: 700" class="display-4">Progam Studi Teknologi <br>Informasi
                        (S1)</h1>
                    <p style="color: white" class="lead">Keluarga Mahasiswa Teknologi Informasi</p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-5">

                        <div class="row">
                            <div class="col-7">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-gelar-list"
                                        data-toggle="list" href="#list-gelar" role="tab" aria-controls="gelar">gelar</a>
                                    <a class="list-group-item list-group-item-action" id="list-Akreditasi-list"
                                        data-toggle="list" href="#list-Akreditasi" role="tab"
                                        aria-controls="profile">Akreditasi</a>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-gelar" role="tabpanel"
                                        aria-labelledby="list-gelar-list">
                                        <h6 style="color: #932520; font-weight: bold">S.Kom. - Sarjana (S1)</h5>
                                    </div>
                                    <div class="tab-pane fade" id="list-Akreditasi" role="tabpanel"
                                        aria-labelledby="list-Akreditasi-list">
                                        <h6 style="color: #932520; font-weight: bold">Akreditasi B (BAN-PT)</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-7">
                        <p>KMTI adalah rumah bagi mahasiswa TI UMY, wadah dan penyalur hasrat, minat, dan bakat baik
                            akademik maupun non-akademik, baik fisik maupun mental.</p>
                    </div>
                </div>

                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <h1 style="color: #932520; font-weight: bold" class="title text-right">Event dan acara KMTI </h1>
                    </div>
                </div>
            </div>

            <div class="container text-center my-3">

                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">

                            @foreach ($eventsActive as $item)
                                <div class="carousel-item active mb-4">
                                    <div class="col-md-4">
                                        <div style="border-radius: 5px" class="card card-body">
                                            <div style="width: 300px">
                                                <img class="img-fluid"
                                                    src="https://ti.umy.ac.id/wp-content/uploads/2020/02/Untitled-111.jpg">
                                            </div>
                                            <h6 style="font-weight: bold; text-align: left; margin-top: 5px">Event:
                                                {{ $item->nama }}</h6>
                                            <div style="font-size: 12px" class="mt-2 text-left" class="text-left">
                                                Lokasi : {{ $item->lokasi }}</div>
                                            <div style="font-size: 12px" class="text-left">Tanggal : <span
                                                    class="badge badge-warning">{{ $item->tanggal }}</span> mulai :
                                                {{ $item->jam_mulai }} - {{ $item->jam_berakhir }} WIB</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <h1 class="title text-center cl-primary font-weight-bold mb-30 animated hiding"
                            data-animation="fadeIn">Ayo bergabung di KMTI </h1>
                        <div class="content text-center">
                            <p>Mari bergabung dan cari tau lebih dalam diri anda </p>
                        </div>
                    </div>
                </div>

                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <h1 style="color: #932520; font-weight: bold" class="title text-right">Divisi KMTI </h1>
                    </div>
                </div>

                <div class="row" style="display: flex; justify-content: center">
                   
                    @foreach ($divisi as $item)
                        <div class="col-4 mb-4">
                            <div class="card">
                                <div style="height: 250px" class="view overlay">
                                    <img style="height: 100%; width: auto" class="card-img-top" src="{{ $item->foto !== null ? asset('storage/' . $item->foto) : '' }}" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $item->nama_divisi}}</h4>
                                    <hr>
                                    <p style="overflow-y: auto; height: 70px;" class="card-text">{{ $item->fungsi}}</p>
                                    <button class="btn btn-indigo btn-rounded btn-md">Read more</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <h1 class="title text-center cl-primary font-weight-bold mb-50 animated hiding"
                            data-animation="fadeIn">Sosial media </h1>
                        <div class="content mt-5">
                            <ul class="list-social list-inline text-center">
                                <li class="list-inline-item">
                                    <a href="https://twitter.com" class="cl-tertiary"><i
                                            class="fab fa-twitter-square"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/kmti_umy/" class="cl-tertiary"><i
                                            class="fab fa-instagram"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="https://www.youtube.com/channel/UCC1InZrEwsx4ArQdWw1mgBw"
                                        class="cl-tertiary"><i class="fab fa-youtube"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="https://facebook.com" class="cl-tertiary"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-5" style="margin-bottom: -40px">
                    <div class="col-12">
                        <div class="footer-bottom">
                            <p class="copyright text-center">© 2021 Universitas Muhammadiyah Yogyakarta • Dikembangkan oleh
                                KMTI</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- akhir conten --}}
        </main>
    </div>
@endsection

@push('script')

    <script type="text/javascript">
        $('#recipeCarousel').carousel({
            interval: 10000
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>

@endpush
