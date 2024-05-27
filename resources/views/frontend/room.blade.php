@extends('layouts.main')

@push('title')
    <title>
        Home | Magical Housee
    </title>
@endpush

@push('script')
    <script src="{{ url('assets/js/game.js') }}" defer></script>
@endpush

@push('styles')
    <style>
        body {
            height: 100%;
            overflow: auto !important;
        }
    </style>
@endpush

{{-- @push('loader')
    <div id="main-loader">
        <figure class="curtains" id="curtain_1">
            <img src="{{ url('assets/img/curtain_1.svg') }}" alt="curtain">
        </figure>
        <div class="text-center printing">
            <div class="circleProgress_wrapper">
                <div class="wrapper right">
                    <div class="circleProgress rightcircle right_cartoon"></div>
                </div>
                <div class="wrapper left">
                    <div class="circleProgress leftcircle left_cartoon"></div>
                </div>
                <span id="timer" style="display: none;">60</span>
            </div>
            <h1>YOUR TICKETS ARE PRINTING</h1>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="btn-invite" id="invite">Invite</div>
                <div class="btn-invite" id="leave">Leave</div>
            </div>
        </div>
        <figure class="curtains" id="curtain_2">
            <img src="{{ url('assets/img/curtain_2.svg') }}" alt="curtain">
        </figure>
    </div>
@endpush --}}


@section('main-section')
    <section id="main">
        <div class="container-fluid py-5">
            <div class="numbers">
            </div>
            {{-- <div style="float: right;" class="menu-item">
                Winning Price: &#8377; <span id="winAmount">{{ session('onlineCount', 0) * 5 }}</span>
            </div> --}}
            <br>
            <div class="d-flex align-items-center justify-content-evenly">

                <div id="tables">
                    @for ($i = 1; $i <= $ticket; $i++)
                        <div class="my-5">
                            <h2 class="Illuminated">Illuminated</h2>
                            <div class="d-flex terminate">
                                <table class="ticket_table" id="check-numb"></table>

                                <div class="ticket-container">
                                    <div class="ticket_no">
                                        <h2>Ticket {{ $i }}</h2>
                                        <figure style="cursor: pointer;" class="housee">
                                            <img src="{{ url('assets/img/button.svg') }}" alt="button">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div id="number-table">
                    <table id="numberTable">
                        @for ($i = 1; $i <= 90; $i++)
                            @if (($i - 1) % 5 == 0)
                                <tr>
                            @endif

                            <td>{{ $i }}</td>

                            @if ($i % 5 == 0)
                                </tr>
                            @endif
                        @endfor
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
