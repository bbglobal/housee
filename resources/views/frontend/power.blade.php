@extends('layouts.main')

@push('title')
    <title>
        Powers | Magical Housee
    </title>
@endpush

@section('main-section')
    @php
        $lolipop = 0;
        $choclate = 0;
        $icecream = 0;
        $pizza = 0;
        $cycle = 0;
        $bike = 0;
        $bomb = 0;
        $car = 0;
        $plane = 0;

        foreach ($powers as $row) {
            if ($row->power == 'lolipop') {
                $lolipop += 1;
            } elseif ($row->power == 'choclate') {
                $choclate += 1;
            } elseif ($row->power == 'icecream') {
                $icecream += 1;
            } elseif ($row->power == 'pizza') {
                $pizza += 1;
            } elseif ($row->power == 'cycle') {
                $cycle += 1;
            } elseif ($row->power == 'bike') {
                $bike += 1;
            } elseif ($row->power == 'bomb') {
                $bomb += 1;
            } elseif ($row->power == 'car') {
                $car += 1;
            } elseif ($row->power == 'plane') {
                $plane += 1;
            }
        }
    @endphp
    <section id="powers">
        <div class="container-fluid py-5">
            <h1 class="text-center py-5">CHOOSE A POWER UPP</h1>
            <div class="row slider-nav">
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/lolipop.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="lolipop" class="power">
                    <div class="available mt-3">Available: {{ $lolipop }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/choclate.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="choclate" class="power">
                    <div class="available mt-3">Available: {{ $choclate }}</div>
                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/icecream.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="icecream" class="power">
                    <div class="available mt-3">Available: {{ $icecream }}</div>
                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/pizza.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="pizza" class="power">
                    <div class="available mt-3">Available: {{ $pizza }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/cycle.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="cycle" class="power">
                    <div class="available mt-3">Available: {{ $cycle }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/bike.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="bike" class="power">
                    <div class="available mt-3">Available: {{ $bike }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/bomb.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="bomb" class="power">
                    <div class="available mt-3">Available: {{ $bomb }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/car.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="car" class="power">
                    <div class="available mt-3">Available: {{ $car }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
                <div class="col-12 uup">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/plane.svg') }}" alt="image" width="70%">
                        </figure>
                    </a>
                    <input type="hidden" value="plane" class="power">
                    <div class="available mt-3">Available: {{ $plane }}</div>

                    <button class="btn-buyNow btnPower">Buy Now</button>
                </div>
            </div>
        </div>
    </section>
@endsection
