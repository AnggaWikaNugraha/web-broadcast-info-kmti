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

                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <h1 style="color: #932520; font-weight: bold" class="title text-right">Detail Event KMTI </h1>
                    </div>
                </div>

                <div class="row mb-4 mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="display: flex">
                                <div class="col-6" style="display: flex; flex-direction: column; justify-content: center">
                                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px">Nama event : {{ $event->nama}}</div>
                                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px">Tanggal event : <div style="color: white; font-size: 16px" class="badge badge-warning">{{ $event->tanggal}}</div> , {{ $event->jam_mulai}}-{{ $event->jam_berakhir}} WIB</div>
                                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px">Lokasi event : {{ $event->lokasi}}</div>
                                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px">Status event : {{ $event->status}}</div>
                                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px">Keterangan : {{ $event->keterangan}}</div>
                                </div>
                                <div class="col-6">
                                    <div style="height: 350px" class="view overlay">
                                        <img style="height: 100%; width: auto" class="card-img-top" src="{{ $event->foto !== null ? asset('storage/' . $event->foto) : '' }}" alt="Card image cap">
                                    </div>
                                </div>
                            </div>
                            <a href="/" class="ml-4 mb-4 col-2 btn btn-info">kembali</a>
                        </div>
                    </div>
                </div>
          
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
