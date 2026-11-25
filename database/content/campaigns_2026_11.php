<?php

/*
| Campaign texts (Turkish + Arabic) for the association's real campaigns.
| Locations given by the association: Türkiye (Nizip/Gaziantep) and Syria (Aleppo countryside).
| Deliberately no invented figures (unit prices, family counts): those can be added
| from the admin panel once known. Goals are editable in the admin panel.
|
| Campaign ids reuse the existing rows: 1 Zekât, 2 Et Dağıtımı, 4 İftar.
| Campaign 3 (legal support for detainees) stays hidden until the payment provider
| approves the account (outside Tüzük art. 2 purposes; high-risk for providers).
*/

$where_tr = 'Türkiye (Nizip / Gaziantep) ve Suriye (Halep kırsalı)';
$where_ar = 'تركيا (نزيب / غازي عنتاب) وسوريا (ريف حلب)';

$abroad_tr = '<p><small>Yurt dışına yapılan yardımlar, Dernekler Kanunu ve ilgili mevzuat kapsamındaki bildirim yükümlülüklerine uygun olarak gerçekleştirilir.</small></p>';
$abroad_ar = '<p><small>تُنفَّذ المساعدات خارج تركيا وفق التزامات الإبلاغ المنصوص عليها في قانون الجمعيات التركي والأنظمة ذات الصلة.</small></p>';

return [
    1 => [
        'category' => 1, // Sadakalar
        'image' => 'campaign-zekat.jpg',
        'tr' => [
            'name' => 'Zekât',
            'name_slug' => 'zekat',
            'meta_description' => 'Zekâtınızı Türkiye ve Suriye\'deki ihtiyaç sahiplerine ulaştırıyoruz.',
            'description' => <<<HTML
<h3>Zekâtınızı İhtiyaç Sahiplerine Ulaştırıyoruz</h3>
<p>Zekât bağışlarınızı yalnızca zekât verilebilecek kişilere (fakir, miskin, borçlu vb.) ulaştırıyoruz. Zekât bağışları başka hiçbir amaçla kullanılmaz ve diğer bağışlarla karıştırılmaz.</p>
<ul>
<li><strong>Nerede:</strong> {$where_tr}</li>
<li><strong>Kimlere:</strong> İhtiyaç durumu tespit edilen aileler; öncelikle yetimler, dul kadınlar, yaşlılar ve geliri olmayan aileler.</li>
<li><strong>Nasıl:</strong> İhtiyaca göre nakdi destek veya temel ihtiyaç (gıda, giyim, barınma) yardımı olarak.</li>
</ul>
<p><strong>Şeffaflık:</strong> Dağıtımlar tamamlandığında bu sayfada bilgilendirme paylaşılır. Yardım alan kişilerin kimlikleri gizli tutulur.</p>
{$abroad_tr}
HTML,
        ],
        'ar' => [
            'name' => 'الزكاة',
            'name_slug' => 'zakat',
            'meta_description' => 'نوصل زكاتكم إلى مستحقيها في تركيا وسوريا.',
            'description' => <<<HTML
<h3>نوصل زكاتكم إلى مستحقيها</h3>
<p>نوصل زكاتكم حصراً إلى مصارفها الشرعية (الفقراء، والمساكين، والغارمين…). ولا تُصرف الزكاة في أي غرض آخر، ولا تُخلط بباقي التبرعات.</p>
<ul>
<li><strong>المكان:</strong> {$where_ar}</li>
<li><strong>المستفيدون:</strong> الأسر التي يثبت احتياجها، وفي مقدمتها الأيتام والأرامل وكبار السن والأسر التي لا دخل لها.</li>
<li><strong>طريقة الصرف:</strong> دعم نقدي أو مساعدات أساسية (غذاء، كسوة، سكن) حسب الحاجة.</li>
</ul>
<p><strong>الشفافية:</strong> ننشر في هذه الصفحة معلومات عن التوزيع بعد إتمامه، مع الحفاظ على خصوصية المستفيدين.</p>
{$abroad_ar}
HTML,
        ],
    ],

    2 => [
        'category' => 1, // Sadakalar
        'image' => 'campaign-et-dagitimi.jpg',
        'tr' => [
            'name' => 'Et Dağıtımı',
            'name_slug' => 'et-dagitimi',
            'meta_description' => 'Kurban ve et bağışlarınızı Türkiye ve Suriye\'deki ihtiyaç sahibi ailelere ulaştırıyoruz.',
            'description' => <<<HTML
<h3>Kurban ve Et Dağıtımı</h3>
<p>Bağışlarınızla kurban kesimi yapıyor veya taze et temin ederek ihtiyaç sahibi ailelere ulaştırıyoruz.</p>
<ul>
<li><strong>Nerede:</strong> {$where_tr}</li>
<li><strong>Kimlere:</strong> İhtiyaç durumu tespit edilen aileler.</li>
<li><strong>Ne zaman:</strong> Kurban Bayramı'nda ve yıl içinde ihtiyaç oldukça.</li>
</ul>
<p><strong>Şeffaflık:</strong> Kesim ve dağıtım tamamlandığında bu sayfada bilgilendirme paylaşılır.</p>
{$abroad_tr}
HTML,
        ],
        'ar' => [
            'name' => 'توزيع اللحوم',
            'name_slug' => 'tawzi-al-luhum',
            'meta_description' => 'نوصل أضاحيكم وتبرعات اللحوم إلى الأسر المحتاجة في تركيا وسوريا.',
            'description' => <<<HTML
<h3>الأضاحي وتوزيع اللحوم</h3>
<p>بتبرعاتكم نذبح الأضاحي أو نشتري اللحم الطازج ونوزعه على الأسر المحتاجة.</p>
<ul>
<li><strong>المكان:</strong> {$where_ar}</li>
<li><strong>المستفيدون:</strong> الأسر التي يثبت احتياجها.</li>
<li><strong>الموعد:</strong> في عيد الأضحى، وعلى مدار العام حسب الحاجة.</li>
</ul>
<p><strong>الشفافية:</strong> ننشر في هذه الصفحة معلومات عن الذبح والتوزيع بعد إتمامهما.</p>
{$abroad_ar}
HTML,
        ],
    ],

    4 => [
        'category' => 3, // Oruçluya İftar
        'image' => 'campaign-iftar.jpg',
        'tr' => [
            'name' => 'İftar Sofrası',
            'name_slug' => 'iftar-sofrasi',
            'meta_description' => 'Ramazan ayında Türkiye ve Suriye\'deki ihtiyaç sahibi ailelere iftar yardımı.',
            'description' => <<<HTML
<h3>İftar Sofrası</h3>
<p>Ramazan ayı boyunca ihtiyaç sahibi ailelere iftar yemeği veya iftar kolisi ulaştırıyoruz.</p>
<ul>
<li><strong>Nerede:</strong> {$where_tr}</li>
<li><strong>Kimlere:</strong> İhtiyaç durumu tespit edilen aileler ve oruçlular.</li>
<li><strong>Ne zaman:</strong> Ramazan ayı boyunca.</li>
</ul>
<p><strong>Şeffaflık:</strong> Dağıtımlar tamamlandığında bu sayfada bilgilendirme paylaşılır.</p>
{$abroad_tr}
HTML,
        ],
        'ar' => [
            'name' => 'مائدة الإفطار',
            'name_slug' => 'maidat-al-iftar',
            'meta_description' => 'إفطار الصائمين من الأسر المحتاجة في تركيا وسوريا خلال شهر رمضان.',
            'description' => <<<HTML
<h3>مائدة الإفطار</h3>
<p>نوصل خلال شهر رمضان وجبات الإفطار أو سلال الإفطار إلى الأسر المحتاجة.</p>
<ul>
<li><strong>المكان:</strong> {$where_ar}</li>
<li><strong>المستفيدون:</strong> الأسر المحتاجة والصائمون.</li>
<li><strong>الموعد:</strong> طوال شهر رمضان.</li>
</ul>
<p><strong>الشفافية:</strong> ننشر في هذه الصفحة معلومات عن التوزيع بعد إتمامه.</p>
{$abroad_ar}
HTML,
        ],
    ],
];
