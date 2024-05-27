@extends('layouts.main')

@push('title')
    <title>
        Tickets | Magical Housee
    </title>
@endpush

@section('main-section')
    @php
        $valueFive = 0;
        $valueTen = 0;
        $valueTwenty = 0;
        $valueFifty = 0;

        foreach ($tickets as $row) {
            if ($row->ticketValue == 5) {
                $valueFive += 1;
            } elseif ($row->ticketValue == 10) {
                $valueTen += 1;
            } elseif ($row->ticketValue == 20) {
                $valueTwenty += 1;
            } elseif ($row->ticketValue == 50) {
                $valueFifty += 1;
            }
        }
    @endphp
    <section id="tickets">
        <div class="container py-5">
            <div class="row">
                <h1 class="text-center h1">BUY TICKETS FOR</h1>
                <div class="col-12 col-md-6 col-lg-3 room">
                    <a href="javascript:void(0)">
                        <figure>
                            <img src="{{ url('assets/img/ticket-1.svg') }}" alt="image" width="100%">
                        </figure>
                    </a>
                    @if ($valueFive == 0)
                        <button class="btn-buyNow roomTickets">Buy Now</button>
                    @endif
                    <input type="hidden" value="5" class="ticket">
                    <div class="available text-center mt-3">Available: {{ $valueFive }}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 room">
                    <a href="javascript:void(0)">
                        <figure>
                            <img src="{{ url('assets/img/ticket-2.svg') }}" alt="image" width="100%">
                        </figure>
                    </a>
                    @if ($valueTen == 0)
                        <button class="btn-buyNow roomTickets">Buy Now</button>
                    @endif
                    <input type="hidden" value="10" class="ticket">
                    <div class="available text-center mt-3">Available: {{ $valueTen }}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 room">
                    <a href="javascript:void(0)">
                        <figure>
                            <img src="{{ url('assets/img/ticket-3.svg') }}" alt="image" width="100%">
                        </figure>
                    </a>
                    @if ($valueTwenty == 0)
                        <button class="btn-buyNow roomTickets">Buy Now</button>
                    @endif
                    <input type="hidden" value="20" class="ticket">
                    <div class="available text-center mt-3">Available: {{ $valueTwenty }}</div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 room">
                    <a href="javascript:void(0)">
                        <figure>
                            <img src="{{ url('assets/img/ticket-4.svg') }}" alt="image" width="100%">
                        </figure>
                    </a>
                    @if ($valueFifty == 0)
                        <button class="btn-buyNow roomTickets">Buy Now</button>
                    @endif
                    <input type="hidden" value="50" class="ticket">
                    <div class="available text-center mt-3">Available: {{ $valueFifty }}</div>
                </div>
            </div>
        </div>

    </section>
@endsection
