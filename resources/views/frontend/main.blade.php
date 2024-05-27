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

@section('main-section')
    <section id="main">
        <div class="container-fluid py-5">
            <div class="numbers">
            </div>
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
