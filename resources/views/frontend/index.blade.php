@extends('layouts.main')

@push('title')
    <title>
        Home | Magical Housee
    </title>
@endpush

@push('loader')
    <div id="preloader" class="container-fluid">
        <figure class="loader">
            <img src="{{ url('assets/img/mhAnimate.gif') }}" alt="loader" width="100%">
        </figure>
    </div>
@endpush

@section('main-section')
    <section id="home">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mob">
                    <a href="{{ route('tickets') }}" id="onlinePlayButton">
                        <figure>
                            <img src="{{ url('assets/img/onlinePlay.svg') }}" alt="box-image" width="100%">
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mob">
                    <a href="{{ route('tickets.powers') }}">
                        <figure>
                            <img src="{{ url('assets/img/playWithPowers.svg') }}" alt="box-image" width="100%">
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 bg">
                    <a href="#">
                        <h2 class="play-admin">Event</h2>
                        <button class="btn-housee start-time">START TIME</button>
                        <button class="btn-housee end-time">END TIME</button>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mob">
                    <a href="{{ route('play.rooms') }}">
                        <figure>
                            <img src="{{ url('assets/img/playInRoom.svg') }}" alt="box-image" width="100%">
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            gsap.to("#curtain_1", {
                x: '-100%',
                duration: 3
            }).delay(1);
            gsap.to("#curtain_2", {
                x: '100%',
                duration: 3
            }).delay(1);

            var tl = gsap.timeline();

            tl.fromTo(".loader img", 
                {
                    opacity: 0,
                    scale: 0
                },
                {
                    scale: 1,
                    opacity: 1,
                    duration: 3
                }).delay(0.8)
                .eventCallback("onComplete", preLoader, [null, 3]);

            gsap.set('.loader img', {
                visibility: "visible"
            });

            var loader = document.getElementById("preloader");

            function preLoader() {
                loader.style.display = "none";
            }

            window.addEventListener("load", () => {
                // preLoader();
                setTimeout(() => {});
                preLoader()
            }, 10000);
        });
    </script>
@endsection
