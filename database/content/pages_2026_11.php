<?php

/*
| Content of the site's fixed pages (Turkish + Arabic).
| Based only on the association's official documents (Faaliyet Belgesi, Tüzük).
| Legal texts are drafts prepared for the association and should be reviewed
| by its lawyer / accountant before card payments go live.
|
| Page ids: 1 Gizlilik & KVKK, 2 Kullanım Koşulları, 3 Hakkımızda,
|           5 Banka Hesapları, 6 Bağış Koşulları, 7 İptal ve İade Koşulları
*/

$name    = 'VAKIF YARDIMLAŞMA DERNEĞİ';
$address = 'Atatürk Mah. Vatan Cad. Dış Kapı No:60 İç Kapı No:Z01, Nizip / Gaziantep / Türkiye';
$email   = 'info@vakifdernegi.org.tr';
$phone   = '+90 534 633 05 21';
$ids     = 'Kütük No: 27-030-002 · Vergi No: 9221546963 · MERSİS No: 0922154696300001';
$updated = '25.11.2026';

return [

    /* ------------------------------------------------------------------ 3 */
    3 => [
        'tr' => [
            'name' => 'Hakkımızda',
            'description' => <<<HTML
<h2>Biz Kimiz?</h2>
<p><strong>{$name}</strong> (kısa adı: VAKIF), 17.06.2025 tarihinde Gaziantep'in Nizip ilçesinde kurulmuş, 5253 sayılı Dernekler Kanunu'na tabi bir dernektir. Derneğimiz Gaziantep İl Sivil Toplumla İlişkiler Müdürlüğü'ne kayıtlıdır ve faaliyet alanı <strong>İnsani Yardım – İhtiyaç Sahiplerine Yardım</strong> olarak tescil edilmiştir.</p>

<h2>Amacımız</h2>
<p>Tüzüğümüzün 2. maddesine göre derneğimiz;</p>
<ul>
<li>yardıma muhtaç insanlara yardım etmek,</li>
<li>eğitim çalışmalarına katkıda bulunmak ve öğrencilere burs vermek,</li>
<li>sanatsal ve kültürel faaliyetler gerçekleştirmek,</li>
<li>sosyal tesislerin yapılmasına, bakım ve onarımına katkıda bulunmak,</li>
<li>toplumda sosyal yardımlaşma ve dayanışmayı sağlamak</li>
</ul>
<p>amacıyla kurulmuştur. Derneğimiz sosyal alanda yurt içinde ve yurt dışında faaliyet gösterebilir; yardım toplama faaliyetlerini ilgili mevzuat kapsamında gerekli izinleri alarak yürütür.</p>

<h2>Yönetim ve Denetim</h2>
<p>Derneğimizin organları Genel Kurul, Yönetim Kurulu (5 asıl üye) ve Denetim Kurulu (3 asıl üye)'dur. Dernek Başkanı <strong>Usame Elşahhud</strong>'dur.</p>
<p>Derneğin gelir ve giderleri tüzük ve Dernekler Yönetmeliği'ne uygun olarak kayıt altına alınır. Denetim Kurulu derneği en az yılda bir kez denetler ve her yıl Dernek Beyannamesi mülki idare amirliğine verilir.</p>

<h2>Şeffaflık</h2>
<p>Derneğimiz <strong>kamu yararına çalışan dernek statüsünde değildir.</strong> Bağışlar, tüzüğümüzde belirtilen amaçlar doğrultusunda kullanılır. Bağışlarınızla ilgili her türlü soru için bizimle iletişime geçebilirsiniz.</p>

<h2>Resmî Bilgiler</h2>
<p>{$name}<br>{$ids}<br>Adres: {$address}<br>Telefon: {$phone} · E-posta: {$email}</p>
<p>Derneğimizin faaliyet belgesini <a href="https://derbis.dernekler.gov.tr/default/anonymous/faaliyet-belgesi-dogrulama-anonim" target="_blank" rel="noopener">DERBİS</a> üzerinden kütük numarası ile doğrulayabilirsiniz.</p>
HTML,
        ],
        'ar' => [
            'name' => 'من نحن',
            'description' => <<<HTML
<h2>من نحن؟</h2>
<p><strong>{$name}</strong> (جمعية وقف للتعاون، الاسم المختصر: VAKIF) جمعية تأسست بتاريخ 17.06.2025 في قضاء نزيب بولاية غازي عنتاب في تركيا، وتخضع لقانون الجمعيات التركي رقم 5253. الجمعية مسجلة لدى مديرية العلاقات مع المجتمع المدني في ولاية غازي عنتاب، ومجال نشاطها المسجّل هو <strong>المساعدات الإنسانية – مساعدة المحتاجين</strong>.</p>

<h2>أهدافنا</h2>
<p>وفق المادة الثانية من النظام الأساسي، تأسست الجمعية بهدف:</p>
<ul>
<li>مساعدة المحتاجين،</li>
<li>المساهمة في الأنشطة التعليمية وتقديم المنح الدراسية للطلاب،</li>
<li>تنظيم الأنشطة الفنية والثقافية،</li>
<li>المساهمة في إنشاء المرافق الاجتماعية وصيانتها،</li>
<li>تعزيز التكافل والتضامن الاجتماعي.</li>
</ul>
<p>يمكن للجمعية العمل في المجال الاجتماعي داخل تركيا وخارجها، وتمارس أنشطة جمع التبرعات بعد الحصول على الأذونات اللازمة وفق القوانين النافذة.</p>

<h2>الإدارة والرقابة</h2>
<p>هيئات الجمعية هي: الجمعية العمومية، ومجلس الإدارة (5 أعضاء أصليين)، ومجلس الرقابة (3 أعضاء أصليين). رئيس الجمعية هو <strong>Usame Elşahhud</strong>.</p>
<p>تُسجَّل إيرادات الجمعية ومصروفاتها وفق النظام الأساسي ولائحة الجمعيات، ويقوم مجلس الرقابة بتدقيق أعمال الجمعية مرة واحدة على الأقل سنوياً، ويُقدَّم بيان الجمعية السنوي إلى السلطات المختصة.</p>

<h2>الشفافية</h2>
<p>الجمعية <strong>ليست من الجمعيات ذات النفع العام</strong>. وتُستخدم التبرعات في الأهداف المحددة في النظام الأساسي. يمكنكم التواصل معنا لأي استفسار يخص تبرعاتكم.</p>

<h2>البيانات الرسمية</h2>
<p>{$name}<br>{$ids}<br>العنوان: {$address}<br>الهاتف: <span dir="ltr">{$phone}</span> · البريد: {$email}</p>
<p>يمكنكم التحقق من شهادة نشاط الجمعية عبر نظام <a href="https://derbis.dernekler.gov.tr/default/anonymous/faaliyet-belgesi-dogrulama-anonim" target="_blank" rel="noopener">DERBİS</a> باستخدام رقم القيد.</p>
HTML,
        ],
    ],

    /* ------------------------------------------------------------------ 1 */
    1 => [
        'tr' => [
            'name' => 'Gizlilik ve KVKK Aydınlatma Metni',
            'description' => <<<HTML
<p><em>Son güncelleme: {$updated}</em></p>
<p>Bu metin, 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") kapsamında, vakifdernegi.org.tr internet sitesini ziyaret eden, bize başvuran ve bağış yapan kişilerin kişisel verilerinin nasıl işlendiğini açıklamak amacıyla hazırlanmıştır.</p>

<h3>1. Veri Sorumlusu</h3>
<p>{$name}<br>{$ids}<br>Adres: {$address}<br>E-posta: {$email} · Telefon: {$phone}</p>

<h3>2. İşlenen Kişisel Veriler</h3>
<ul>
<li><strong>Kimlik ve iletişim bilgileri:</strong> ad soyad, e-posta adresi, telefon numarası (iletişim formu, üyelik ve bağış işlemleri).</li>
<li><strong>Bağış / işlem bilgileri:</strong> bağış tutarı, bağış türü, bağış yapılan kampanya, işlem tarihi ve referans numarası, banka dekontu bilgileri.</li>
<li><strong>Talep ve mesaj içeriği:</strong> iletişim formu ile gönderdiğiniz konu ve mesaj.</li>
<li><strong>Hesap bilgileri:</strong> üye olmanız halinde ad soyad, e-posta ve şifreleme ile korunan şifre.</li>
<li><strong>İşlem güvenliği verileri:</strong> IP adresi, tarayıcı bilgileri, ziyaret tarih ve saatleri, çerez kayıtları.</li>
</ul>
<p>Kartla ödeme hizmeti aktif olduğunda kart bilgileriniz <strong>derneğimiz tarafından alınmaz ve saklanmaz</strong>; ödeme işlemi doğrudan lisanslı ödeme kuruluşu / banka altyapısında gerçekleştirilir.</p>

<h3>3. İşleme Amaçları</h3>
<ul>
<li>Bağışların alınması, kayıt altına alınması ve tüzükte belirtilen amaçlarda kullanılması,</li>
<li>Bağışçılara bilgi ve makbuz/dekont gönderilmesi,</li>
<li>İletişim taleplerinin yanıtlanması,</li>
<li>Dernekler mevzuatı ve vergi mevzuatından doğan yükümlülüklerin yerine getirilmesi,</li>
<li>İnternet sitesinin güvenliğinin sağlanması ve hizmet kalitesinin iyileştirilmesi.</li>
</ul>

<h3>4. Hukuki Sebepler</h3>
<p>Kişisel verileriniz KVKK'nın 5. maddesinde yer alan; bir sözleşmenin kurulması veya ifasıyla doğrudan ilgili olması (bağış işlemi), veri sorumlusunun hukuki yükümlülüğünü yerine getirebilmesi (dernek kayıtları), ilgili kişinin temel hak ve özgürlüklerine zarar vermemek kaydıyla veri sorumlusunun meşru menfaati (site güvenliği) ve gerekli hallerde açık rızanız hukuki sebeplerine dayanılarak işlenir.</p>

<h3>5. Kişisel Verilerin Aktarılması</h3>
<p>Kişisel verileriniz; yalnızca yukarıdaki amaçlarla sınırlı olarak ve gerekli olduğu ölçüde, bağış işlemlerinin gerçekleştirildiği bankalar ve ödeme kuruluşlarına, internet sitesinin barındırma (hosting) hizmet sağlayıcısına ve kanunen yetkili kamu kurum ve kuruluşlarına aktarılabilir. Sitemiz güvenlik ve performans amacıyla bir içerik dağıtım ağı (CDN) hizmeti kullanmaktadır; bu kapsamda IP adresi gibi teknik veriler yurt dışında bulunan sunucularda işlenebilir. Yurt dışına aktarım KVKK'nın 9. maddesine uygun olarak gerçekleştirilir. Kişisel verileriniz hiçbir şekilde satılmaz veya reklam amacıyla üçüncü kişilerle paylaşılmaz.</p>

<h3>6. Saklama Süresi</h3>
<p>Kişisel verileriniz işleme amacının gerektirdiği süre boyunca ve ilgili mevzuatta öngörülen süreler (dernek defter ve belgeleri için en az 5 yıl) kadar saklanır; sürenin sonunda silinir, yok edilir veya anonim hale getirilir.</p>

<h3>7. Haklarınız (KVKK m. 11)</h3>
<p>Derneğimize başvurarak; kişisel verilerinizin işlenip işlenmediğini öğrenme, işlenmişse bilgi talep etme, işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, yurt içinde veya yurt dışında aktarıldığı üçüncü kişileri bilme, eksik veya yanlış işlenmişse düzeltilmesini, KVKK'nın 7. maddesi çerçevesinde silinmesini veya yok edilmesini isteme, bu işlemlerin aktarıldığı üçüncü kişilere bildirilmesini isteme, münhasıran otomatik sistemlerle analiz edilmesi sonucu aleyhinize bir sonuç çıkmasına itiraz etme ve kanuna aykırı işleme sebebiyle zarara uğramanız halinde zararın giderilmesini talep etme haklarına sahipsiniz.</p>
<p>Başvurularınızı kimliğinizi tespit edici bilgilerle birlikte yazılı olarak yukarıdaki adresimize veya {$email} adresine iletebilirsiniz. Başvurular en geç 30 gün içinde ücretsiz olarak sonuçlandırılır.</p>

<h3>8. Çerezler</h3>
<p>Sitemizde yalnızca sitenin çalışması için zorunlu olan çerezler kullanılır: oturum çerezi, güvenlik (CSRF) çerezi, dil tercihi ve bağış sepeti çerezi. Bu çerezler reklam veya profil oluşturma amacıyla kullanılmaz. Tarayıcınızın ayarlarından çerezleri silebilir veya engelleyebilirsiniz; ancak bu durumda sitenin bazı bölümleri çalışmayabilir.</p>
HTML,
        ],
        'ar' => [
            'name' => 'سياسة الخصوصية وحماية البيانات',
            'description' => <<<HTML
<p><em>آخر تحديث: {$updated}</em></p>
<p>يوضح هذا النص كيفية معالجة البيانات الشخصية لزوار موقع vakifdernegi.org.tr والمتواصلين معنا والمتبرعين، وفق قانون حماية البيانات الشخصية التركي رقم 6698 (KVKK).</p>

<h3>1. المسؤول عن البيانات</h3>
<p>{$name}<br>{$ids}<br>العنوان: {$address}<br>البريد: {$email} · الهاتف: <span dir="ltr">{$phone}</span></p>

<h3>2. البيانات التي نعالجها</h3>
<ul>
<li><strong>بيانات الهوية والتواصل:</strong> الاسم الكامل، البريد الإلكتروني، رقم الهاتف (نموذج التواصل، إنشاء الحساب، التبرع).</li>
<li><strong>بيانات التبرع:</strong> مبلغ التبرع ونوعه والحملة وتاريخ العملية ورقم المرجع وبيانات إيصال التحويل البنكي.</li>
<li><strong>محتوى الطلبات:</strong> الموضوع والرسالة المرسلة عبر نموذج التواصل.</li>
<li><strong>بيانات الحساب:</strong> عند إنشاء حساب: الاسم والبريد وكلمة المرور المشفّرة.</li>
<li><strong>بيانات أمان الموقع:</strong> عنوان IP، بيانات المتصفح، أوقات الزيارة، ملفات تعريف الارتباط.</li>
</ul>
<p>عند تفعيل الدفع بالبطاقة، <strong>لا تحصل الجمعية على بيانات بطاقتك ولا تخزنها</strong>، إذ تتم عملية الدفع مباشرة لدى مؤسسة الدفع أو البنك المرخّص.</p>

<h3>3. أغراض المعالجة</h3>
<ul>
<li>استلام التبرعات وتسجيلها واستخدامها في الأهداف المحددة في النظام الأساسي،</li>
<li>إرسال المعلومات والإيصالات للمتبرعين،</li>
<li>الرد على طلبات التواصل،</li>
<li>الوفاء بالالتزامات القانونية بموجب قوانين الجمعيات والضرائب،</li>
<li>حماية أمان الموقع وتحسين الخدمة.</li>
</ul>

<h3>4. الأساس القانوني</h3>
<p>تتم المعالجة استناداً إلى المادة 5 من القانون: ارتباطها المباشر بإتمام عملية التبرع، والالتزام القانوني للجمعية، والمصلحة المشروعة للجمعية (أمان الموقع) دون الإضرار بحقوقكم، وموافقتكم الصريحة عند الحاجة.</p>

<h3>5. نقل البيانات</h3>
<p>قد تُنقل بياناتكم بالقدر الضروري فقط إلى البنوك ومؤسسات الدفع التي تتم عبرها التبرعات، ومزوّد استضافة الموقع، والجهات الرسمية المخوّلة قانوناً. يستخدم موقعنا خدمة شبكة توزيع محتوى (CDN) لأغراض الأمان والأداء، وقد تُعالج بيانات تقنية مثل عنوان IP على خوادم خارج تركيا وفق المادة 9 من القانون. لا نبيع بياناتكم ولا نشاركها لأغراض إعلانية إطلاقاً.</p>

<h3>6. مدة الحفظ</h3>
<p>تُحفظ البيانات طوال المدة اللازمة للغرض، وللمدد التي تنص عليها القوانين (5 سنوات على الأقل لسجلات الجمعية)، ثم تُحذف أو تُتلف أو تُجعل مجهولة الهوية.</p>

<h3>7. حقوقكم (المادة 11)</h3>
<p>يحق لكم: معرفة ما إذا كانت بياناتكم تُعالج، وطلب معلومات عنها، ومعرفة الغرض من معالجتها، ومعرفة الجهات التي نُقلت إليها، وطلب تصحيحها أو حذفها أو إتلافها، وطلب إبلاغ الجهات التي نُقلت إليها بذلك، والاعتراض على أي نتيجة ضدكم ناتجة عن تحليل آلي، والمطالبة بالتعويض عن أي ضرر ناتج عن معالجة مخالفة للقانون.</p>
<p>يمكنكم تقديم طلباتكم كتابياً مع ما يثبت هويتكم إلى عنواننا أو إلى البريد {$email}، ويتم الرد مجاناً خلال 30 يوماً كحد أقصى.</p>

<h3>8. ملفات تعريف الارتباط (الكوكيز)</h3>
<p>نستخدم فقط ملفات الارتباط الضرورية لعمل الموقع: ملف الجلسة، وملف الحماية (CSRF)، وتفضيل اللغة، وسلة التبرعات. لا تُستخدم لأي أغراض إعلانية أو لبناء ملفات تعريفية. يمكنكم حذفها أو حظرها من إعدادات المتصفح، مع العلم أن بعض أجزاء الموقع قد لا تعمل حينها.</p>
HTML,
        ],
    ],

    /* ------------------------------------------------------------------ 2 */
    2 => [
        'tr' => [
            'name' => 'Kullanım Koşulları',
            'description' => <<<HTML
<p><em>Son güncelleme: {$updated}</em></p>
<p>vakifdernegi.org.tr internet sitesi ("Site") {$name} ("Dernek") tarafından işletilmektedir. Siteyi kullanan herkes aşağıdaki koşulları kabul etmiş sayılır.</p>
<h3>1. Sitenin Amacı</h3>
<p>Site; Derneğin tanıtılması, faaliyet ve kampanyaları hakkında bilgi verilmesi ve bağış kabul edilmesi amacıyla yayınlanmaktadır.</p>
<h3>2. Bilgilerin Doğruluğu</h3>
<p>Dernek, sitede yer alan bilgilerin doğru ve güncel olması için azami özeni gösterir. Kampanya hedefleri ve içerikleri ihtiyaçlara göre güncellenebilir. Kullanıcılar, form ve bağış işlemlerinde verdikleri bilgilerin doğru olmasından sorumludur.</p>
<h3>3. Kullanıcı Yükümlülükleri</h3>
<p>Kullanıcılar Siteyi hukuka uygun amaçlarla kullanmayı; sitenin işleyişini bozacak, güvenliğini tehdit edecek veya başkalarının haklarını ihlal edecek davranışlarda bulunmamayı kabul eder. Üyelik hesabının ve şifresinin güvenliğinden kullanıcı sorumludur.</p>
<h3>4. Fikrî Mülkiyet</h3>
<p>Sitedeki metin, logo, görsel ve diğer içerikler Derneğe aittir veya Dernek tarafından izinle kullanılmaktadır. Kaynak gösterilmeden ve izin alınmadan ticari amaçla kopyalanamaz.</p>
<h3>5. Bağışlar</h3>
<p>Site üzerinden yapılan bağışlar <a href="/donation-policy">Bağış Koşulları</a> ve <a href="/delivery-and-refund-policy">İptal ve İade Koşulları</a>'na tabidir.</p>
<h3>6. Kişisel Veriler</h3>
<p>Kişisel verileriniz <a href="/privacy">Gizlilik ve KVKK Aydınlatma Metni</a> kapsamında işlenir.</p>
<h3>7. Bağlantılar</h3>
<p>Sitede üçüncü kişilere ait sitelere bağlantılar bulunabilir. Dernek bu sitelerin içeriğinden sorumlu değildir.</p>
<h3>8. Sorumluluğun Sınırlandırılması</h3>
<p>Dernek, sitenin kesintisiz ve hatasız çalışması için gerekli önlemleri alır; ancak teknik arızalar veya üçüncü kişilerden kaynaklanan kesintilerden doğan dolaylı zararlardan sorumlu tutulamaz.</p>
<h3>9. Değişiklikler</h3>
<p>Dernek bu koşulları gerektiğinde güncelleyebilir. Güncel metin her zaman bu sayfada yayınlanır.</p>
<h3>10. Uygulanacak Hukuk</h3>
<p>Bu koşullar Türkiye Cumhuriyeti hukukuna tabidir. Uyuşmazlıklarda Gaziantep Mahkemeleri ve İcra Daireleri yetkilidir.</p>
<h3>11. İletişim</h3>
<p>{$name} · {$address} · {$email} · {$phone}</p>
HTML,
        ],
        'ar' => [
            'name' => 'شروط الاستخدام',
            'description' => <<<HTML
<p><em>آخر تحديث: {$updated}</em></p>
<p>يُدار موقع vakifdernegi.org.tr ("الموقع") من قِبل {$name} ("الجمعية"). ويُعدّ كل من يستخدم الموقع موافقاً على الشروط التالية.</p>
<h3>1. غرض الموقع</h3>
<p>يهدف الموقع إلى التعريف بالجمعية ونشاطاتها وحملاتها واستقبال التبرعات.</p>
<h3>2. دقة المعلومات</h3>
<p>تحرص الجمعية على أن تكون المعلومات المنشورة صحيحة ومحدّثة، وقد تُحدَّث أهداف الحملات ومحتواها حسب الاحتياجات. والمستخدم مسؤول عن صحة البيانات التي يُدخلها في النماذج وعمليات التبرع.</p>
<h3>3. التزامات المستخدم</h3>
<p>يلتزم المستخدم باستخدام الموقع لأغراض مشروعة، وعدم القيام بما يعطّل عمله أو يهدد أمانه أو ينتهك حقوق الآخرين. والمستخدم مسؤول عن أمان حسابه وكلمة مروره.</p>
<h3>4. الملكية الفكرية</h3>
<p>النصوص والشعارات والصور وسائر المحتوى مملوكة للجمعية أو مستخدمة بإذن، ولا يجوز نسخها لأغراض تجارية دون إذن.</p>
<h3>5. التبرعات</h3>
<p>تخضع التبرعات عبر الموقع لـ <a href="/ar/donation-policy">شروط التبرع</a> و<a href="/ar/delivery-and-refund-policy">شروط الإلغاء والاسترداد</a>.</p>
<h3>6. البيانات الشخصية</h3>
<p>تُعالج بياناتكم وفق <a href="/ar/privacy">سياسة الخصوصية وحماية البيانات</a>.</p>
<h3>7. الروابط الخارجية</h3>
<p>قد يحتوي الموقع على روابط لمواقع أخرى، والجمعية غير مسؤولة عن محتواها.</p>
<h3>8. حدود المسؤولية</h3>
<p>تتخذ الجمعية الإجراءات اللازمة لعمل الموقع دون انقطاع، لكنها لا تتحمل المسؤولية عن الأضرار غير المباشرة الناتجة عن أعطال تقنية أو أسباب خارجة عن إرادتها.</p>
<h3>9. التعديلات</h3>
<p>يحق للجمعية تحديث هذه الشروط عند الحاجة، ويُنشر النص المحدّث دائماً في هذه الصفحة.</p>
<h3>10. القانون المطبّق</h3>
<p>تخضع هذه الشروط لقوانين الجمهورية التركية، وتختص محاكم ودوائر التنفيذ في غازي عنتاب بالنظر في أي نزاع.</p>
<h3>11. التواصل</h3>
<p>{$name} · {$address} · {$email} · <span dir="ltr">{$phone}</span></p>
HTML,
        ],
    ],

    /* ------------------------------------------------------------------ 6 */
    6 => [
        'tr' => [
            'name' => 'Bağış Koşulları',
            'description' => <<<HTML
<p><em>Son güncelleme: {$updated}</em></p>
<h3>1. Bağışın Niteliği</h3>
<p>Bu sitede yapılan bağışlar, gönüllü olarak ve karşılıksız şekilde {$name}'ne ({$ids}) yapılır. Bağış bir mal veya hizmet satışı değildir.</p>
<h3>2. Bağışların Kullanımı</h3>
<ul>
<li>Bağışlar, Derneğin tüzüğünde belirtilen amaçlar doğrultusunda kullanılır.</li>
<li>Belirli bir kampanya için yapılan bağışlar o kampanya için kullanılır. Kampanyanın hedefine ulaşması, tamamlanması veya gerçekleştirilememesi halinde bağış, tüzük amaçlarına uygun ve kampanyaya en yakın faaliyette kullanılır.</li>
<li><strong>Zekât</strong> olarak yapılan bağışlar yalnızca zekât verilebilecek kişi ve alanlarda kullanılır; sadaka, kefaret ve adak bağışları da belirtilen amaca uygun olarak ayrı değerlendirilir.</li>
</ul>
<h3>3. Bağış Yöntemleri</h3>
<p>Bağışlar, Derneğin adına açılmış banka hesaplarına havale/EFT yoluyla veya (aktif olduğunda) lisanslı ödeme kuruluşu altyapısı üzerinden banka/kredi kartı ile yapılabilir. Banka hesaplarımızın alıcı adı her zaman <strong>{$name}</strong>'dir; farklı bir alıcı adı görmeniz halinde işlem yapmayınız ve bize bildiriniz.</p>
<p>Havale/EFT ile bağışlarda, bağış sayfasında verilen referans numarasının açıklama kısmına yazılması bağışınızın doğru kaydedilmesini sağlar. En düşük bağış tutarı 5 TL'dir.</p>
<h3>4. Makbuz ve Belge</h3>
<p>Dernekler Yönetmeliği uyarınca banka aracılığıyla yapılan bağışlarda banka dekontu alındı belgesi yerine geçer. Talep etmeniz halinde bağışınıza ilişkin bilgilendirme yazısı tarafınıza gönderilir.</p>
<h3>5. Vergi Durumu</h3>
<p>Derneğimiz kamu yararına çalışan dernek statüsünde olmadığından, yapılan bağışlar için gelir/kurumlar vergisi matrahından indirim imkânı bulunmamaktadır.</p>
<h3>6. Bağışçı Bilgileri</h3>
<p>Bağış sırasında verdiğiniz bilgiler <a href="/privacy">Gizlilik ve KVKK Aydınlatma Metni</a> kapsamında işlenir ve gizli tutulur. Bağışçı isimleri izniniz olmadan yayınlanmaz.</p>
<h3>7. İptal ve İade</h3>
<p>Bağışların iptal ve iadesi <a href="/delivery-and-refund-policy">İptal ve İade Koşulları</a>'na tabidir.</p>
<h3>8. İletişim</h3>
<p>{$email} · {$phone}</p>
HTML,
        ],
        'ar' => [
            'name' => 'شروط التبرع',
            'description' => <<<HTML
<p><em>آخر تحديث: {$updated}</em></p>
<h3>1. طبيعة التبرع</h3>
<p>التبرعات عبر هذا الموقع تُقدَّم طوعاً ودون مقابل إلى {$name} ({$ids}). والتبرع ليس عملية بيع لسلعة أو خدمة.</p>
<h3>2. استخدام التبرعات</h3>
<ul>
<li>تُستخدم التبرعات في الأهداف المحددة في النظام الأساسي للجمعية.</li>
<li>التبرعات المخصصة لحملة معينة تُصرف على تلك الحملة. وفي حال اكتمال الحملة أو بلوغ هدفها أو تعذّر تنفيذها، تُصرف في أقرب نشاط مماثل يتوافق مع أهداف الجمعية.</li>
<li>تبرعات <strong>الزكاة</strong> تُصرف حصراً في مصارف الزكاة الشرعية، وتُعامل الصدقات والكفارات والنذور كلٌّ حسب غرضه.</li>
</ul>
<h3>3. طرق التبرع</h3>
<p>يمكن التبرع بالتحويل البنكي (حوالة/EFT) إلى حسابات الجمعية، أو بالبطاقة البنكية عبر مؤسسة دفع مرخّصة (عند تفعيلها). اسم المستفيد في حساباتنا هو دائماً <strong>{$name}</strong>؛ إن ظهر لك اسم مختلف فلا تُكمل العملية وأبلغنا.</p>
<p>عند التحويل البنكي، كتابة رقم المرجع الظاهر في صفحة التبرع في خانة الوصف يضمن تسجيل تبرعك بشكل صحيح. الحد الأدنى للتبرع 5 ليرات تركية.</p>
<h3>4. الإيصال</h3>
<p>وفق لائحة الجمعيات، يقوم إيصال البنك مقام سند القبض في التبرعات المحوّلة عبر البنك. ويمكن عند الطلب إرسال إفادة بتبرعك.</p>
<h3>5. الوضع الضريبي</h3>
<p>الجمعية ليست من الجمعيات ذات النفع العام، لذلك لا يمكن خصم التبرعات من الوعاء الضريبي.</p>
<h3>6. بيانات المتبرع</h3>
<p>تُعالج بياناتك وفق <a href="/ar/privacy">سياسة الخصوصية وحماية البيانات</a> وتبقى سرّية، ولا تُنشر أسماء المتبرعين دون إذنهم.</p>
<h3>7. الإلغاء والاسترداد</h3>
<p>يخضع إلغاء التبرعات واستردادها لـ <a href="/ar/delivery-and-refund-policy">شروط الإلغاء والاسترداد</a>.</p>
<h3>8. التواصل</h3>
<p>{$email} · <span dir="ltr">{$phone}</span></p>
HTML,
        ],
    ],

    /* ------------------------------------------------------------------ 7 */
    7 => [
        'tr' => [
            'name' => 'İptal ve İade Koşulları',
            'description' => <<<HTML
<p><em>Son güncelleme: {$updated}</em></p>
<p>Bağış, karşılıksız bir kazandırma olup bir mal veya hizmet satışı değildir; bu nedenle mesafeli satışlardaki cayma hakkı bağışlar için uygulanmaz. Bununla birlikte Derneğimiz aşağıdaki durumlarda bağışınızı iade eder:</p>
<h3>1. İade Yapılan Durumlar</h3>
<ul>
<li>Hatalı tutarla yapılan bağışlar (ör. fazladan sıfır girilmesi),</li>
<li>Aynı bağışın teknik bir hata nedeniyle birden fazla kez tahsil edilmesi,</li>
<li>Kartın sahibinin bilgisi ve onayı dışında kullanılarak yapılan işlemler,</li>
<li>Derneğe yanlışlıkla gönderilen havale/EFT işlemleri.</li>
</ul>
<h3>2. Başvuru</h3>
<p>İade talebinizi, bağış tarihinden itibaren <strong>30 gün içinde</strong>; adınız soyadınız, bağış tarihi, tutarı, referans numarası ve (varsa) dekont bilgisi ile birlikte {$email} adresine veya {$phone} numarasına iletebilirsiniz.</p>
<h3>3. Değerlendirme ve İade Süresi</h3>
<p>Talebiniz en geç 7 iş günü içinde değerlendirilir ve sonucu size bildirilir. Onaylanan iadeler, ödemenin yapıldığı yönteme (aynı karta veya gönderen banka hesabına) en geç 14 gün içinde yapılır. Kart iadelerinin hesabınıza yansıma süresi bankanıza göre değişebilir. İade işleminde herhangi bir kesinti yapılmaz.</p>
<h3>4. İade Yapılamayan Durumlar</h3>
<p>Yukarıdaki durumlar dışında, bağışın amacına uygun olarak ihtiyaç sahiplerine ulaştırılmış veya harcanmış olması halinde iade yapılamaz. Bu durumda bağışınızın kullanımı hakkında talep üzerine bilgi verilir.</p>
<h3>5. Yetkisiz Kart Kullanımı</h3>
<p>Kartınızın izniniz dışında kullanıldığını düşünüyorsanız, Derneğimizle birlikte kartınızı veren bankaya da başvurmanızı öneririz.</p>
<h3>6. İletişim</h3>
<p>{$name} · {$address} · {$email} · {$phone}</p>
HTML,
        ],
        'ar' => [
            'name' => 'شروط الإلغاء والاسترداد',
            'description' => <<<HTML
<p><em>آخر تحديث: {$updated}</em></p>
<p>التبرع عطاء دون مقابل وليس بيعاً لسلعة أو خدمة، ولذلك لا ينطبق عليه حق العدول الخاص بالبيع عن بُعد. ومع ذلك تقوم الجمعية بإعادة التبرع في الحالات التالية:</p>
<h3>1. حالات الاسترداد</h3>
<ul>
<li>التبرع بمبلغ خاطئ (مثل إدخال صفر زائد)،</li>
<li>تحصيل التبرع نفسه أكثر من مرة بسبب خطأ تقني،</li>
<li>استخدام البطاقة دون علم صاحبها وموافقته،</li>
<li>التحويلات البنكية المرسلة إلى الجمعية عن طريق الخطأ.</li>
</ul>
<h3>2. تقديم الطلب</h3>
<p>يمكن تقديم طلب الاسترداد <strong>خلال 30 يوماً</strong> من تاريخ التبرع، مع ذكر الاسم وتاريخ التبرع ومبلغه ورقم المرجع وبيانات الإيصال إن وُجد، عبر البريد {$email} أو الهاتف <span dir="ltr">{$phone}</span>.</p>
<h3>3. مدة الدراسة والإعادة</h3>
<p>يُدرس الطلب خلال 7 أيام عمل كحد أقصى ويُبلَّغ المتبرع بالنتيجة. وتُعاد المبالغ الموافق عليها بنفس وسيلة الدفع (البطاقة نفسها أو الحساب البنكي المرسِل) خلال 14 يوماً كحد أقصى، وقد تختلف مدة ظهورها في حسابك حسب البنك. ولا يُقتطع أي مبلغ من قيمة الاسترداد.</p>
<h3>4. حالات لا يمكن فيها الاسترداد</h3>
<p>في غير الحالات المذكورة أعلاه، إذا كان التبرع قد وصل إلى المستحقين أو صُرف في غرضه، فلا يمكن استرداده، ويمكن عند الطلب تزويدك بمعلومات عن كيفية صرفه.</p>
<h3>5. الاستخدام غير المصرّح للبطاقة</h3>
<p>إذا كنت تعتقد أن بطاقتك استُخدمت دون إذنك، ننصحك بالتواصل مع البنك المُصدر لبطاقتك إضافة إلى التواصل معنا.</p>
<h3>6. التواصل</h3>
<p>{$name} · {$address} · {$email} · <span dir="ltr">{$phone}</span></p>
HTML,
        ],
    ],

    /* ------------------------------------------------------------------ 5 */
    5 => [
        'tr' => [
            'name' => 'Banka Hesaplarımız',
            'description' => <<<HTML
<p>Banka hesap bilgilerimiz yakında bu sayfada yayınlanacaktır. Hesaplarımızın alıcı adı her zaman <strong>{$name}</strong>'dir.</p>
HTML,
        ],
        'ar' => [
            'name' => 'حساباتنا البنكية',
            'description' => <<<HTML
<p>ستُنشر بيانات حساباتنا البنكية في هذه الصفحة قريباً. اسم المستفيد في حساباتنا هو دائماً <strong>{$name}</strong>.</p>
HTML,
        ],
    ],
];
