@extends('layouts.main')

@push('title')
    <title>
        Play With Powers | Magical Housee
    </title>
@endpush

@push('script')
    <script src="{{ url('assets/js/powers.js') }}" defer></script>
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

@push('styles')
    <style>
        body {
            height: 100%;
            overflow: auto !important;
        }
    </style>
@endpush

@section('main-section')
    <section id="main">
        <div class="container-fluid py-5">
            <div class="container">
                <div class="numbers">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-evenly">
                <div id="tables">
                    <div class="my-5">
                        <div class="d-flex table-responsive">
                            <table class="ticket_table" id="check-numb"></table>
                            <div class="ticket-container">
                                <div class="ticket_no">
                                    <h2>Ticket 1</h2>
                                    <figure style="cursor: pointer;">
                                        <img src="{{ url('assets/img/button.svg') }}" alt="button" width="100px">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
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
