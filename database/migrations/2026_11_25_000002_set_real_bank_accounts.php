<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Publishes the association's real bank accounts (T.C. Ziraat Bankası) on page 5.
 * IBANs verified (ISO 7064 mod-97 checksum, bank code 00010 = Ziraat Bankası).
 */
return new class extends Migration
{
    private const ACCOUNTS = [
        ['currency' => 'TL',  'iban' => 'TR59 0001 0004 4981 0845 8500 01'],
        ['currency' => 'USD', 'iban' => 'TR32 0001 0004 4981 0845 8500 02'],
    ];

    private function table(array $h): string
    {
        $rows = '';
        foreach (self::ACCOUNTS as $a) {
            $rows .= '<tr><td><strong>' . $a['currency'] . '</strong></td>'
                . '<td dir="ltr" style="font-family:monospace;font-size:16px;white-space:nowrap">' . $a['iban'] . '</td>'
                . '<td>VAKIF YARDIMLAŞMA DERNEĞİ</td></tr>';
        }

        return '<h3 style="margin:10px 0 15px">T.C. ZİRAAT BANKASI</h3>'
            . '<div style="overflow-x:auto"><table class="table table-bordered" style="width:100%">'
            . '<thead><tr><th>' . $h['currency'] . '</th><th>IBAN</th><th>' . $h['holder'] . '</th></tr></thead>'
            . '<tbody>' . $rows . '</tbody></table></div>';
    }

    public function up()
    {
        $tr = $this->table(['currency' => 'Para Birimi', 'holder' => 'Alıcı Adı'])
            . '<p>Lütfen havale/EFT yaparken <strong>alıcı adının VAKIF YARDIMLAŞMA DERNEĞİ</strong> olduğunu kontrol ediniz ve açıklama kısmına bağış türünü (ör. Zekât, Sadaka) veya bağış sayfasında verilen referans numarasını yazınız.</p>'
            . '<p>Banka dekontu, Dernekler Yönetmeliği uyarınca bağışınız için alındı belgesi yerine geçer.</p>';

        $ar = $this->table(['currency' => 'العملة', 'holder' => 'اسم المستفيد'])
            . '<p>عند التحويل يرجى التأكد من أن <strong>اسم المستفيد هو VAKIF YARDIMLAŞMA DERNEĞİ</strong>، وكتابة نوع التبرع (مثل: زكاة، صدقة) أو رقم المرجع الظاهر في صفحة التبرع في خانة الوصف (Açıklama).</p>'
            . '<p>إيصال التحويل البنكي يقوم مقام سند القبض لتبرعك وفق لائحة الجمعيات التركية.</p>';

        foreach (['tr' => [$tr, 'Banka Hesaplarımız'], 'en' => [$tr, 'Banka Hesaplarımız'], 'ar' => [$ar, 'حساباتنا البنكية']] as $locale => [$html, $name]) {
            DB::table('page_translations')->updateOrInsert(
                ['page_id' => 5, 'locale' => $locale],
                ['name' => $name, 'description' => $html]
            );
        }
    }

    public function down()
    {
        $placeholder = [
            'tr' => '<p>Banka hesap bilgilerimiz yakında bu sayfada yayınlanacaktır.</p>',
            'en' => '<p>Banka hesap bilgilerimiz yakında bu sayfada yayınlanacaktır.</p>',
            'ar' => '<p>ستُنشر بيانات حساباتنا البنكية في هذه الصفحة قريباً.</p>',
        ];
        foreach ($placeholder as $locale => $html) {
            DB::table('page_translations')->where(['page_id' => 5, 'locale' => $locale])->update(['description' => $html]);
        }
    }
};
