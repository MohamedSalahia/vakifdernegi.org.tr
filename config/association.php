<?php

/*
| Official identity of the association, as registered in DERBİS
| (Faaliyet Belgesi dated 15.01.2026, Tüzük approved 24.06.2025).
| Shown on the site exactly as registered: do not change without a new official document.
*/
return [
    'legal_name'   => 'VAKIF YARDIMLAŞMA DERNEĞİ',
    'short_name'   => 'VAKIF',
    'kutuk_no'     => '27-030-002',
    'vergi_no'     => '9221546963',
    'vergi_dairesi'=> env('ASSOCIATION_VERGI_DAIRESI'), // not on the documents yet
    'mersis_no'    => '0922154696300001',
    'founded'      => '17.06.2025',
    'address'      => [
        'tr' => 'Atatürk Mah. Vatan Cad. Dış Kapı No:60 İç Kapı No:Z01, Nizip / Gaziantep / Türkiye',
        'ar' => 'Atatürk Mah. Vatan Cad. No:60 Z01، نزيب / غازي عنتاب / تركيا',
    ],
    'phone'        => '+90 534 633 05 21',
    'email'        => 'info@vakifdernegi.org.tr',
    'derbis_verify_url' => 'https://derbis.dernekler.gov.tr/default/anonymous/faaliyet-belgesi-dogrulama-anonim',
];
