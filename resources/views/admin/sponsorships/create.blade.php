@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h2>Sponsor your apartment: {{ $apartment->title }}</h2>
            </div>
        </div>

        {{-- @dd($clientToken) --}}
        
        <form action="{{-- {{ route('admin.sponsorship.store', $apartment->id) }} --}}" method="post" class="form-control p-4 mb-3" id="pay-sponsorship-form">
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

            <button type="submit" class="btn btn-primary" id="submit-button">Purchase</button>

        </form>

    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.js"></script>
    <script>
        let button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
            selector: '#dropin-container'
        }, function(err, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    // Submit payload.nonce to your server
                });
            })
        });
    </script>
@endsection
