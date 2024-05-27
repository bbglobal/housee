@extends('layouts.main')

@push('title')
    <title>
        Add/Withdraw Coins | Magical Housee
    </title>
@endpush

@section('main-section')
    <section id="rooms">
        <div class="container py-5 mt-5">
            <div class="row text-center py-5">
                <div class="col-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-12 col-lg-6 bg">
                    <a href="javascript:void(0)" id="addCoins">
                        <h2 class="p-5 m-5">Add Coins</h2>
                    </a>
                </div>
                <div class="col-12 col-md-12 col-lg-6 bg">
                    <a href="javascript:void(0)" id="withdraw">
                        <h2 class="p-5 m-5">Withdraw</h2>
                    </a>
                </div>
            </div>
        </div>


        <div class="modal fade" id="storePyaeeInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Withdrawl Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('request.withdraw') }}">
                            @csrf
                            <div class="mb-3 d-flex align-items-center justify-content-between">
                                <label for="upi" class="form-label">
                                    <h5>UPI</h5>
                                    <small class="text-muted">PhonePe, Gpay, Paytm, BHIM & more</small>
                                </label>
                                <input type="radio" class="form-radio" name="withdraw" id="upi" checked>
                            </div>
                            <div id="upi-section">
                                <ul class="d-flex align-items-center justify-content-around pay-options">
                                    <li>
                                        <figure>
                                            <img src="{{ url('assets/img/PHONEPE_WEB.png') }}" alt="phonePe"
                                                width="24px">
                                            <figcaption>
                                                <small class="text-muted">PhonePe</small>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ url('assets/img/GPAY_WEB.png') }}" alt="phonePe" width="24px">
                                            <figcaption>
                                                <small class="text-muted">GPay</small>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ url('assets/img/PYTM_WEB.png') }}" alt="phonePe" width="24px">
                                            <figcaption>
                                                <small class="text-muted">Paytm</small>
                                            </figcaption>
                                        </figure>
                                    </li>
                                </ul>
                                <div class="mb-3 input-group">
                                    <input type="text" name="upiId" class="form-control" id="upiId"
                                        placeholder="UPI ID">
                                    <select name="via" class="form-select">
                                        <option selected>ybl</option>
                                        <option>ibl</option>
                                        <option>axl</option>
                                    </select>
                                    <select name="via" class="form-select d-none">
                                        <option selected>okicici</option>
                                        <option>okhdfc</option>
                                        <option>okaxis</option>
                                        <option>oksbi</option>
                                    </select>
                                    <select name="via" class="form-select d-none">
                                        <option selected>paytm</option>
                                    </select>
                                </div>
                            </div>
                            <hr>

                            <div class="mb-3 d-flex align-items-center justify-content-between">
                                <label for="credit-card" class="col-form-label">
                                    <h5> <i class="fa fa-card"></i> Bank Transfer</h5>
                                </label>
                                <input type="radio" class="form-radio" name="withdraw" id="credit-card">
                            </div>
                            <div id="credit-card-section">
                                <div class="mb-3 input-group">
                                    <input type="text" class="form-control" name="accountNumber"
                                        placeholder="Enter your Account/IBAN number">
                                </div>
                                <div class="mb-3 input-group">
                                    <input type="text" class="form-control" name="accountTitle"
                                        placeholder="Enter your account title">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="coins">Coins</label>
                                <input type="number" class="form-control" name="coins" id="coins"
                                    placeholder="Enter the number of coins" required>
                                @error('coins')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-housee">Create Request</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
