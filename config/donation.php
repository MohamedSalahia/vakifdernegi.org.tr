<?php

return [
    // Turn on only after a card gateway (bank Sanal POS, iyzico, PayTR ...) is approved and integrated.
    'card_payment_enabled' => env('DONATION_CARD_PAYMENT_ENABLED', false),

    // Show bank accounts (IBANs) to donors. Page 5 holds the association's real,
    // verified Ziraat Bankası accounts (migration 2026_11_25_000002).
    'bank_transfer_enabled' => env('DONATION_BANK_TRANSFER_ENABLED', true),

    'currency' => 'TRY',
];
