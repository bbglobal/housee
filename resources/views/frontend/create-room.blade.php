@extends('layouts.main')

@push('title')
    <title>
        Create Room | Magical Housee
    </title>
@endpush

@section('main-section')
    <section id="rooms">
        <div class="container py-5">
            <div class="row text-center">
                <div class="col-12 col-md-12 col-lg-6">
                    <a href="javascript:void(0)" id="createLink">
                        <figure>
                            <img src="{{ url('assets/img/create-room.svg') }}" alt="box-image" width="50%">
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-md-12 col-lg-6" id="join-room">
                    <a href="javascript:void(0)" id="showAlert">
                        <figure>
                            <img src="{{ url('assets/img/join-room.svg') }}" alt="box-image" width="50%">
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-md-12 col-lg-6 d-none" id="room-id">
                    <ul>
                        @foreach ($roomIds as $row)
                            <li>
                                <a href="#">{{ $row->roomId }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <form id="randomIdForm" action="{{ route('add.roomId') }}" method="POST">
            @csrf
            <input type="hidden" name="room_id" id="randomIdInput">
            <button style="display: none;">submit</button>
        </form>

    </section>
@endsection
