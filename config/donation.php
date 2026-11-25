<?php

return [
    // Turn on only after a card gateway (bank Sanal POS, iyzico, PayTR ...) is approved and integrated.
    'card_payment_enabled' => env('DONATION_CARD_PAYMENT_ENABLED', false),

    'currency' => 'TRY',
];
