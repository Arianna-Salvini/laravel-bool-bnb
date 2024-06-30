@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h2>Sponsor your apartment: {{ $apartment->title }}</h2>
            </div>
        </div>

        <div class="row justify-content-center gy-3">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-sm-12 col-lg-3">
                    <div class="card sponsor-card rounded-5">
                        <div class="card-header rounded-top-5">
                            <div class="card-title">
                                <h3 class="text-center">
                                    {{ $sponsorship->name }}
                                </h3>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="card-text text-center fs-2 fw-bold">
                                <span>{{ $sponsorship->price }}</span>
                                <i class="fa-solid fa-euro-sign"></i>
                            </div>
                            <div class="duration card-text pb-3 border-bottom text-center fs-5 text-secondary">
                                <i class="fa-solid fa-stopwatch"></i>
                                {{ $sponsorship->duration }}
                                <span>hours</span>
                            </div>
                            <div class="card-text pt-3">
                                <button type="button" class="btn btn-lg btn-primary select-sponsorship border-0"
                                    data-sponsorship-id="{{ $sponsorship->id }}"
                                    data-sponsorship-name="{{ $sponsorship->name }}"
                                    data-sponsorship-price="{{ $sponsorship->price }}" style="background-color: #45C2B1;">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Button trigger modal -->
        <div class="button-container text-center">
            <button type="button" class="btn btn-lg w-75 m-auto text-white border-0" data-bs-toggle="modal"
                data-bs-target="#payment-modal" style="background-color: #45C2B1;" id="proceed-button" disabled>
                Proceed
            </button>

        </div>

        <!-- Modal -->
        <div class="modal modal-lg fade" id="payment-modal" tabindex="-1" aria-labelledby="payment-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="payment-modalLabel">{{ $apartment->title }} - </h1>

                        <h1 class="modal-title fs-5 ps-1" id="modal-sponsorship-name">{{-- {{ $sponsorship->name }} -
                            {{ $sponsorship->price }}€ --}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <form action="{{ route('admin.sponsorship.store', $apartment) }}" method="post"
                            class="form-control p-4" id="pay-sponsorship-form">
                            @csrf

                            <input type="hidden" name="sponsorship" id="sponsorship-id" value="">

                            <div id="dropin-container"></div>

                            <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">

                            <div id="loading" style="display: none;">
                                <div class="text-center py-2">
                                    <span>Processing payment </span>
                                    <i class="fa-solid fa-circle-notch"></i>
                                </div>
                            </div>

                            {{-- <button type="submit" class="btn btn-primary" id="submit-button" value="">Purchase</button> --}}

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close-modal-btn"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-button" value="">Purchase</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- @dd($clientToken) --}}

        {{-- <form action="{{ route('admin.sponsorship.store', $apartment) }}" method="post" class="form-control p-4 mb-3"
            id="pay-sponsorship-form">
            @csrf


            <label for="sponsorship" class="form-label">
                <strong>Select a sponsorship</strong>
                <span class="text-danger">*</span>
            </label>

            <select name="sponsorship" id="sponsorship">
                @foreach ($sponsorships as $sponsorship)
                    <option value="{{ $sponsorship->id }}"> {{ $sponsorship->name }} {{ $sponsorship->price }}</option>
                @endforeach
            </select>


            <div id="dropin-container"></div>


            <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">

            <button type="submit" class="btn btn-primary" id="submit-button" value="">Purchase</button>

        </form> --}}

    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let sponsorshipInput = document.querySelector('#sponsorship-id');
            let sponsorshipCorrectName = document.querySelector('#modal-sponsorship-name');
            let selectedButtons = document.querySelectorAll('.select-sponsorship');
            let proceedBtn = document.querySelector('#proceed-button');
            let loading = document.querySelector('#loading');
            let closeModalBtn = document.querySelector('#close-modal-btn');

            selectedButtons.forEach(button => {
                button.addEventListener('click', function() {
                    sponsorshipInput.value = this.getAttribute('data-sponsorship-id');
                    let sponsorName = this.getAttribute('data-sponsorship-name');
                    let sponsorPrice = this.getAttribute('data-sponsorship-price');
                    sponsorshipCorrectName.innerText = `${sponsorName} - ${sponsorPrice}€`;

                    /* remove disabled when an option is selected */
                    proceedBtn.removeAttribute('disabled');
                })
            });

            let button = document.querySelector('#submit-button');
            let nonce = document.querySelector('#payment_method_nonce');
            let form = document.querySelector('#pay-sponsorship-form');

            braintree.dropin.create({
                authorization: '{{ $clientToken }}',
                selector: '#dropin-container'
            }, function(err, instance) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    /* processing div displaying */
                    loading.style.display = 'block';
                    button.setAttribute('disabled', true);
                    closeModalBtn.setAttribute('disabled', true);
                    instance.requestPaymentMethod(function(err, payload) {

                        if (err) {
                            loading.style.display = 'none';
                            button.removeAttribute('disabled');
                            closeModalBtn.removeAttribute('disabled');
                            console.log(err);
                            return;
                        }

                        if (sponsorshipInput.value === '') {
                            loading.style.display = 'none';
                            button.removeAttribute('disabled');
                            closeModalBtn.removeAttribute('disabled');
                            alert('Select a sponsorship');
                            return;
                        }

                        nonce.value = payload.nonce
                        // metto il valore del nome dell appartamento
                        /* let apartmentName = '{{ $apartment->title }}';
                        form.appendChild(createHiddenInput('apartment_name',
                            apartmentName)); */
                        form.submit();
                    });
                })
            });

        })
    </script>
@endsection
