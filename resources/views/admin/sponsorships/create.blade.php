@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h2>Sponsor your apartment: {{ $apartment->title }}</h2>
            </div>
        </div>

        {{-- @dd($clientToken) --}}

        <form action="{{ route('admin.sponsorship.store', $apartment) }}" method="post" class="form-control p-4 mb-3"
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

            {{-- for braintree --}}
            <div id="dropin-container"></div>

            {{-- nonce? --}}
            <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">

            <button type="submit" class="btn btn-primary" id="submit-button" value="">Purchase</button>

        </form>

    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.js"></script>
    <script>
        let button = document.querySelector('#submit-button');
        let nonce = document.querySelector('#payment_method_nonce');
        let form = document.querySelector('#pay-sponsorship-form');

        braintree.dropin.create({
            authorization: '{{ $clientToken }}',
            selector: '#dropin-container'
        }, function(err, instance) {
            button.addEventListener('click', function(e) {
                e.preventDefault()
                instance.requestPaymentMethod(function(err, payload) {
                    //console.log(nonce.value);
                    //console.log(payload.nonce);
                    if (err) {
                        console.log(err);
                        return
                    }
                    // Submit payload.nonce to your server
                    nonce.value = payload.nonce
                    //console.log(nonce.value);
                    form.submit();
                });
            })
        });
    </script>
@endsection
