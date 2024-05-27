@extends('layouts.main')

@push('title')
    <title>
        Printing | Magical Housee
    </title>
@endpush

@section('main-section')
    <section id="start">
        <div class="container py-5">
            <div class="text-center" style="position: relative;">
                <div class="circleProgress_wrapper">
                    <div class="wrapper right">
                        <div class="circleProgress rightcircle right_cartoon"></div>
                    </div>
                    <div class="wrapper left">
                        <div class="circleProgress leftcircle left_cartoon"></div>
                    </div>
                    <span id="timer">60</span>
                </div>
            </div>
            <table class="table-responsive">
                <tr>
                    <td style="width: 5rem; text-align:center;">
                        <div class="menus">
                            <img src="{{ url('assets/img/users.svg') }}" alt="icon"
                                style="width:2.5rem;">
                        </div>
                    </td>
                    <td style="width: 70%;">
                        Total Players
                    </td>
                    <td style="width: 5rem; text-align:center;" id="player-count">

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <div class="menus">
                            <img src="{{ url('assets/img/ticket.svg') }}" alt="icon"
                                style="width:2rem;">
                        </div>
                    </td>
                    <td>
                        Ticket Cost
                    </td>
                    <td style="text-align:center;" id="">
                        {{ $id }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 5rem; text-align:center;">
                        <div class="menus">
                            <img src="{{ url('assets/img/tickets.svg') }}" alt="icon"
                                style="width:2rem;">
                        </div>
                    </td>
                    <td style="width: 70%;">
                        Total Tickets
                    </td>
                    <td style="width: 5rem; text-align:center;" id="total-tickets">

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <div class="menus">
                            <img src="{{ url('assets/img/sack.svg') }}" alt="icon"
                                style="width:2rem;">
                        </div>
                    </td>
                    <td>
                        Final Price
                    </td>
                    <td style="text-align:center;" id="final-price">

                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" value="{{ $ticket }}" id="ticket">
    </section>

    <script>
        $(document).ready(function() {

            var currentPath = window.location.pathname;
            var pathSegments = currentPath.split('/');
            var desiredSegment = pathSegments[pathSegments.length - 1];

            function updateGameData() {

                // AJAX request
                $.ajax({
                    type: 'GET',
                    url: '/start/game-data/' + desiredSegment,
                    success: function(data) {
                        $('#player-count').text(data.onlineCount);

                        var ticketCost = 5;
                        var totalTickets = data.onlineCount;

                        $('#total-tickets').text(totalTickets);
                        $('#ticket-cost').text(ticketCost);
                        $('#final-price').text(totalTickets * ticketCost);
                    },
                    error: function() {
                        console.error('Error fetching data');
                    }
                });
            }

            updateGameData();


            const ticket = $("#ticket").val();
            setInterval(updateGameData, 5000);

            setTimeout(() => {
                window.location.href = `/room/${ticket}`;
            }, 600);

        });
        var timer = document.getElementById('timer');
        var time = 60;
        setInterval(function() {
            timer.innerHTML = time;
            time--;
            if (time <= 0) time = 60;
        }, 1000)
    </script>
@endsection
