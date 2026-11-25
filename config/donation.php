<?php

return [
    // Turn on only after a card gateway (bank Sanal POS, iyzico, PayTR ...) is approved and integrated.
    'card_payment_enabled' => env('DONATION_CARD_PAYMENT_ENABLED', false),

    // Show bank accounts (IBANs) to donors only after the "Bank accounts" page (id 5)
    // has been filled with the association's real, verified accounts.
    'bank_transfer_enabled' => env('DONATION_BANK_TRANSFER_ENABLED', false),

    'currency' => 'TRY',
];
