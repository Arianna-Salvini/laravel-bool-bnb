<?php

/* braintree credentials to call them in the controller */
return [
    'environment' => env('BRAINTREE_ENV', 'sandbox'),
    'merchantId' => env('BRAINTREE_MERCHANT_ID'),
    'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
    'privateKey' => env('BRAINTREE_PRIVATE_KEY')
];
