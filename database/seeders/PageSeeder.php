<?php

namespace Database\Seeders;

use App\Models\PageCategory;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // policy & terms
        Page::create(['page_category_id'=>null,
            'header_show' => null,
            'special' => null,
            'locked' => 1,
            'ar' => ['name' => 'سياسة الخصوصية', 'description' => '<p style="text-align: justify;">يرحب بكم فريق عمل وقف الخيرية ويقدم لكم الشكر لإمضاء القليل من الوقت لقراءة سياسة الخصوصية الخاصة بالمنصة.</p>
<p style="text-align: justify;">نقدر مخاوفكم واهتمامكم بشأن خصوصية بياناتكم على شبكة الإنترنت، ولذلك تم إعداد هذه السياسة لمساعدتكم في تفهم طبيعة البيانات التي نقوم بتجميعها منكم عند زيارتكم لموقعنا على شبكة الإنترنت وكيفية تعاملنا مع هذه البيانات الشخصية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>أولاً، التصفح:</strong></span></h3>
<p style="text-align: justify;">لم نقم بتصميم هذا الموقع من أجل تجميع بياناتك الشخصية من جهاز الكمبيوتر الخاص بك أثناء تصفحك لهذا الموقع، وإنما سيتم فقط استخدام البيانات المقدمة من قبلك بمعرفتك ومحض إرادتك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثانياً، عنوان بروتوكول شبكة الإنترنت (IP):</strong></span></h3>
<p style="text-align: justify;">في أي وقت تزور فيه موقع إنترنت بما فيها هذا الموقع، سيقوم السيرفر المضيف بتسجيل عنوان بروتوكول شبكة الإنترنت (IP) الخاص بك، وتاريخ ووقت الزيارة، ونوع متصفح الإنترنت الذي تستخدمه، وعنوان&nbsp;URL الخاص بأي موقع من مواقع الإنترنت التي تقوم بإحالتك إلى الى هذا الموقع على الشبكة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثالثاً، عمليات المسح على الشبكة:</strong></span></h3>
<p style="text-align: justify;">إن عمليات المسح التي نقوم بها مباشرة على الشبكة تمكننا من تجميع بيانات محددة مثل البيانات المطلوبة منك بخصوص نظرتك وشعورك تجاه موقعنا، وتعتبر ردودك ذات أهمية كبيرة بالنسبة لنا، وهي ومحل تقديرنا حيث أنها تمكننا من تحسين مستوى موقعنا، ولك كامل الحرية والاختيار في تقديم البيانات المتعلقة باسمك والبيانات الأخرى.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>رابعاً، الروابط بالمواقع الأخرى على شبكة الإنترنت:</strong></span></h3>
<p style="text-align: justify;">قد يشتمل موقعنا على روابط بالمواقع الأخرى على شبكة الإنترنت، او علانات من مواقع أُخرى مثل&nbsp;<a href="https://www.google.com/adsense"><span style="color: hsl(210,75%,60%);"><u>Google AdSense</u></span> </a>ولا نعتبر مسئولين عن أساليب تجميع البيانات من قبل تلك المواقع، ويمكنك الاطلاع على سياسات السرية والمحتويات الخاصة بتلك المواقع التي يتم الدخول إليها من خلال موقعهم الرسمي.</p>
<p style="text-align: justify;">نحن قد نستعين بشركات إعلان لأطراف ثالثة لعرض الإعلانات عندما تزور موقعنا على الويب. يحق لهذه الشركات أن تستخدم معلومات حول زياراتك لهذا الموقع ولمواقع الويب الأخرى (باستثناء الاسم أو العنوان أو عنوان البريد الإلكتروني أو رقم الهاتف)، وذلك من أجل تقديم إعلانات حول البضائع والخدمات التي تهمك، وإذا كنت ترغب في مزيد من المعلومات حول هذا الأمر وكذلك إذا كنت تريد معرفة الاختيارات المتاحة لك لمنع استخدام هذه المعلومات من قِبل هذه الشركات،<a href="https://policies.google.com/technologies/ads"> <span style="color: hsl(210,75%,60%);"><u>فالرجاء النقر هنا</u></span></a>.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>خامساً، إفشاء المعلومات:</strong></span></h3>
<p style="text-align: justify;">سنحافظ في كافة الأوقات على خصوصية وسرية كافة البيانات الشخصية التي نتحصل عليها، ولن يتم إفشاء هذه المعلومات إلا إذا كان ذلك مطلوباً بموجب أي قانون أو عندما نعتقد بحسن نية أن مثل هذا الإجراء سيكون مطلوباً أو مرغوباً فيه للتمشي مع القانون، أو للدفاع عن أو حماية حقوق الملكية الخاصة بهذا الموقع أو الجهات المستفيدة منه.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>سادساً، البيانات اللازمة لتنفيذ المعاملات المطلوبة من قبلك:</strong></span></h3>
<p style="text-align: justify;">عندما نحتاج إلى أية بيانات خاصة بك، فإننا سنطلب منك تقديمها بمحض إرادتك. حيث ستساعدنا هذه المعلومات في الاتصال بك وتنفيذ طلباتك حيثما كان ذلك ممكنناً. لن يتم إطلاقاً بيع البيانات المقدمة من قبلك إلى أي طرف ثالث بغرض تسويقها لمصلحته الخاصة دون الحصول على موافقتك المسبقة والمكتوبة ما لم يتم ذلك على أساس أنها ضمن بيانات جماعية تستخدم للأغراض الإحصائية والأبحاث دون اشتمالها على أية بيانات من الممكن استخدامها للتعريف بك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>سابعاً، عند الاتصال بنا:</strong></span></h3>
<p style="text-align: justify;">سيتم التعامل مع كافة البيانات المقدمة من قبلك على أساس أنها سرية. تتطلب النماذج التي يتم تقديمها مباشرة على الشبكة تقديم البيانات التي ستساعدنا في تحسين موقعنا، وسيتم استخدام البيانات التي يتم تقديمها من قبلك في الرد على كافة استفساراتك، وملاحظاتك، أو طلباتك من قبل هذا الموقع أو أياً من المواقع التابعة له.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثامناً، إفشاء المعلومات لأي طرف ثالث:</strong></span></h3>
<p style="text-align: justify;">لن نقوم ببيع، أو المتاجرة، أو إفشاء أية معلومات لمصلحة أي طرف ثالث خارج هذا الموقع، أو المواقع التابعة له، ووسيتم الكشف عن المعلومات فقط في حالة صدور أمر بذلك من قبل أي سلطة قضائية أو تنظيمية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>تاسعاً، التعديلات على سياسة السرية وخصوصية المعلومات:</strong></span></h3>
<p style="text-align: justify;">نحتفظ بالحق في تعديل بنود وشروط سياسة السرية وخصوصية المعلومات إن لزم الأمر ومتى كان ذلك ملائماً، وسيتم تنفيذ التعديلات هنا او على صفحة سياسة الخصوصية الرئيسية وسيتم بصفة مستمرة إخطارك بالبيانات التي حصلنا عليها، وكيف سنستخدمها والجهة التي سنقوم بتزويدها بهذه البيانات.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>عاشراً، حذف الحساب:</strong></span></h3>
<section id="about-us-page">
<div>
<div>
<div>
<div>
<p style="text-align: right;">في حال قمت بتسجيل الدخول إلى الموقع باستخدام معلوماتك الشخصية، يمكنك حذف الحساب في أيّ وقت تشاء وذلك من خلال الضغط على أيقونة حذف الحساب في صفحة تعديل بياناتي الشخصية.</p>
</div>
</div>
</div>
</div>
</section>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>أخيراً</strong></span></h3>
<p style="text-align: justify;">يمكنكم الاتصال بنا عند الحاجة من خلال الضغط على رابط اتصل بنا المتوفر في روابط موقعنا او الإرسال الى بريدنا الإلكتروني info@ala3mal.org.</p>
<p style="text-align: justify;">إن مخاوفك واهتمامك بشأن سرية وخصوصية البيانات تعتبر مسألة في غاية الأهمية بالنسبة لنا. نحن نأمل أن يتم تحقيق ذلك من خلال هذه السياسة.</p>'],
            'en' => ['name' => 'سياسة الخصوصية', 'description' => '<p style="text-align: justify;">يرحب بكم فريق عمل وقف الخيرية ويقدم لكم الشكر لإمضاء القليل من الوقت لقراءة سياسة الخصوصية الخاصة بالمنصة.</p>
<p style="text-align: justify;">نقدر مخاوفكم واهتمامكم بشأن خصوصية بياناتكم على شبكة الإنترنت، ولذلك تم إعداد هذه السياسة لمساعدتكم في تفهم طبيعة البيانات التي نقوم بتجميعها منكم عند زيارتكم لموقعنا على شبكة الإنترنت وكيفية تعاملنا مع هذه البيانات الشخصية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>أولاً، التصفح:</strong></span></h3>
<p style="text-align: justify;">لم نقم بتصميم هذا الموقع من أجل تجميع بياناتك الشخصية من جهاز الكمبيوتر الخاص بك أثناء تصفحك لهذا الموقع، وإنما سيتم فقط استخدام البيانات المقدمة من قبلك بمعرفتك ومحض إرادتك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثانياً، عنوان بروتوكول شبكة الإنترنت (IP):</strong></span></h3>
<p style="text-align: justify;">في أي وقت تزور فيه موقع إنترنت بما فيها هذا الموقع، سيقوم السيرفر المضيف بتسجيل عنوان بروتوكول شبكة الإنترنت (IP) الخاص بك، وتاريخ ووقت الزيارة، ونوع متصفح الإنترنت الذي تستخدمه، وعنوان&nbsp;URL الخاص بأي موقع من مواقع الإنترنت التي تقوم بإحالتك إلى الى هذا الموقع على الشبكة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثالثاً، عمليات المسح على الشبكة:</strong></span></h3>
<p style="text-align: justify;">إن عمليات المسح التي نقوم بها مباشرة على الشبكة تمكننا من تجميع بيانات محددة مثل البيانات المطلوبة منك بخصوص نظرتك وشعورك تجاه موقعنا، وتعتبر ردودك ذات أهمية كبيرة بالنسبة لنا، وهي ومحل تقديرنا حيث أنها تمكننا من تحسين مستوى موقعنا، ولك كامل الحرية والاختيار في تقديم البيانات المتعلقة باسمك والبيانات الأخرى.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>رابعاً، الروابط بالمواقع الأخرى على شبكة الإنترنت:</strong></span></h3>
<p style="text-align: justify;">قد يشتمل موقعنا على روابط بالمواقع الأخرى على شبكة الإنترنت، او علانات من مواقع أُخرى مثل&nbsp;<a href="https://www.google.com/adsense"><span style="color: hsl(210,75%,60%);"><u>Google AdSense</u></span> </a>ولا نعتبر مسئولين عن أساليب تجميع البيانات من قبل تلك المواقع، ويمكنك الاطلاع على سياسات السرية والمحتويات الخاصة بتلك المواقع التي يتم الدخول إليها من خلال موقعهم الرسمي.</p>
<p style="text-align: justify;">نحن قد نستعين بشركات إعلان لأطراف ثالثة لعرض الإعلانات عندما تزور موقعنا على الويب. يحق لهذه الشركات أن تستخدم معلومات حول زياراتك لهذا الموقع ولمواقع الويب الأخرى (باستثناء الاسم أو العنوان أو عنوان البريد الإلكتروني أو رقم الهاتف)، وذلك من أجل تقديم إعلانات حول البضائع والخدمات التي تهمك، وإذا كنت ترغب في مزيد من المعلومات حول هذا الأمر وكذلك إذا كنت تريد معرفة الاختيارات المتاحة لك لمنع استخدام هذه المعلومات من قِبل هذه الشركات،<a href="https://policies.google.com/technologies/ads"> <span style="color: hsl(210,75%,60%);"><u>فالرجاء النقر هنا</u></span></a>.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>خامساً، إفشاء المعلومات:</strong></span></h3>
<p style="text-align: justify;">سنحافظ في كافة الأوقات على خصوصية وسرية كافة البيانات الشخصية التي نتحصل عليها، ولن يتم إفشاء هذه المعلومات إلا إذا كان ذلك مطلوباً بموجب أي قانون أو عندما نعتقد بحسن نية أن مثل هذا الإجراء سيكون مطلوباً أو مرغوباً فيه للتمشي مع القانون، أو للدفاع عن أو حماية حقوق الملكية الخاصة بهذا الموقع أو الجهات المستفيدة منه.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>سادساً، البيانات اللازمة لتنفيذ المعاملات المطلوبة من قبلك:</strong></span></h3>
<p style="text-align: justify;">عندما نحتاج إلى أية بيانات خاصة بك، فإننا سنطلب منك تقديمها بمحض إرادتك. حيث ستساعدنا هذه المعلومات في الاتصال بك وتنفيذ طلباتك حيثما كان ذلك ممكنناً. لن يتم إطلاقاً بيع البيانات المقدمة من قبلك إلى أي طرف ثالث بغرض تسويقها لمصلحته الخاصة دون الحصول على موافقتك المسبقة والمكتوبة ما لم يتم ذلك على أساس أنها ضمن بيانات جماعية تستخدم للأغراض الإحصائية والأبحاث دون اشتمالها على أية بيانات من الممكن استخدامها للتعريف بك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>سابعاً، عند الاتصال بنا:</strong></span></h3>
<p style="text-align: justify;">سيتم التعامل مع كافة البيانات المقدمة من قبلك على أساس أنها سرية. تتطلب النماذج التي يتم تقديمها مباشرة على الشبكة تقديم البيانات التي ستساعدنا في تحسين موقعنا، وسيتم استخدام البيانات التي يتم تقديمها من قبلك في الرد على كافة استفساراتك، وملاحظاتك، أو طلباتك من قبل هذا الموقع أو أياً من المواقع التابعة له.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>ثامناً، إفشاء المعلومات لأي طرف ثالث:</strong></span></h3>
<p style="text-align: justify;">لن نقوم ببيع، أو المتاجرة، أو إفشاء أية معلومات لمصلحة أي طرف ثالث خارج هذا الموقع، أو المواقع التابعة له، ووسيتم الكشف عن المعلومات فقط في حالة صدور أمر بذلك من قبل أي سلطة قضائية أو تنظيمية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>تاسعاً، التعديلات على سياسة السرية وخصوصية المعلومات:</strong></span></h3>
<p style="text-align: justify;">نحتفظ بالحق في تعديل بنود وشروط سياسة السرية وخصوصية المعلومات إن لزم الأمر ومتى كان ذلك ملائماً، وسيتم تنفيذ التعديلات هنا او على صفحة سياسة الخصوصية الرئيسية وسيتم بصفة مستمرة إخطارك بالبيانات التي حصلنا عليها، وكيف سنستخدمها والجهة التي سنقوم بتزويدها بهذه البيانات.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>عاشراً، حذف الحساب:</strong></span></h3>
<section id="about-us-page">
<div>
<div>
<div>
<div>
<p style="text-align: right;">في حال قمت بتسجيل الدخول إلى الموقع باستخدام معلوماتك الشخصية، يمكنك حذف الحساب في أيّ وقت تشاء وذلك من خلال الضغط على أيقونة حذف الحساب في صفحة تعديل بياناتي الشخصية.</p>
</div>
</div>
</div>
</div>
</section>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>أخيراً</strong></span></h3>
<p style="text-align: justify;">يمكنكم الاتصال بنا عند الحاجة من خلال الضغط على رابط اتصل بنا المتوفر في روابط موقعنا او الإرسال الى بريدنا الإلكتروني info@ala3mal.org.</p>
<p style="text-align: justify;">إن مخاوفك واهتمامك بشأن سرية وخصوصية البيانات تعتبر مسألة في غاية الأهمية بالنسبة لنا. نحن نأمل أن يتم تحقيق ذلك من خلال هذه السياسة.</p>'],
            'tr' => [
                'name' => 'Gizlilik Politikası',
                'description' => '<p style="text-align: justify;">Hayır Vakfı ekibi sizleri memnuniyetle karşılar ve platformun gizlilik politikasını okumak için ayırdığınız zaman için teşekkür eder.</p>
<p style="text-align: justify;">İnternet üzerindeki kişisel verilerinizin gizliliği konusundaki endişe ve ilginizi takdir ediyoruz. Bu nedenle, web sitemizi ziyaret ettiğinizde sizden topladığımız verilerin niteliğini ve bu kişisel verilerle nasıl işlem yaptığımızı açıklamak amacıyla bu politika hazırlanmıştır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Birincisi: Gezinme</strong></span></h3>
<p style="text-align: justify;">Bu site, gezinme sırasında bilgisayarınızdan kişisel verilerinizi toplamak amacıyla tasarlanmamıştır. Yalnızca bilginiz ve tamamen kendi isteğinizle sağladığınız veriler kullanılmaktadır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>İkincisi: İnternet Protokolü (IP) Adresi</strong></span></h3>
<p style="text-align: justify;">Bu site dâhil herhangi bir internet sitesini ziyaret ettiğinizde, barındırma sunucusu IP adresinizi, ziyaret tarih ve saatini, kullandığınız internet tarayıcısının türünü ve sizi bu siteye yönlendiren herhangi bir internet sitesinin URL adresini kaydedebilir.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Üçüncüsü: Çevrim İçi Anketler</strong></span></h3>
<p style="text-align: justify;">Web sitesi üzerinden doğrudan gerçekleştirdiğimiz anketler, sitemiz hakkındaki görüş ve değerlendirmelerinize ilişkin bazı verileri toplamamıza olanak tanır. Geri bildirimleriniz bizim için büyük önem taşımakta ve sitemizin seviyesini geliştirmemize yardımcı olmaktadır. İsminiz ve diğer bilgilerle ilgili verileri paylaşma konusunda tamamen özgürsünüz.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Dördüncüsü: Diğer Web Sitelerine Bağlantılar</strong></span></h3>
<p style="text-align: justify;">Web sitemiz, <a href="https://www.google.com/adsense"><span style="color: hsl(210,75%,60%);"><u>Google AdSense</u></span></a> gibi diğer internet sitelerine ait bağlantılar veya reklâmlar içerebilir. Bu sitelerin veri toplama yöntemlerinden sorumlu değiliz. Bu sitelerin gizlilik politikalarını ve içeriklerini kendi resmî siteleri üzerinden inceleyebilirsiniz.</p>
<p style="text-align: justify;">Web sitemizi ziyaret ettiğinizde reklam göstermek amacıyla üçüncü taraf reklam şirketlerinden yararlanabiliriz. Bu şirketler, ilgi alanlarınıza yönelik ürün ve hizmetlere dair reklamlar sunmak için bu siteye ve diğer web sitelerine yaptığınız ziyaretlerle ilgili bilgileri (isim, adres, e-posta adresi veya telefon numarası hariç) kullanma hakkına sahiptir. Bu konu hakkında daha fazla bilgi almak ve bu bilgilerin kullanımını engelleme seçeneklerini öğrenmek için <a href="https://policies.google.com/technologies/ads"><span style="color: hsl(210,75%,60%);"><u>lütfen buraya tıklayın</u></span></a>.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Beşincisi: Bilgilerin Açıklanması</strong></span></h3>
<p style="text-align: justify;">Elde ettiğimiz tüm kişisel verilerin gizliliğini ve mahremiyetini her zaman koruyacağız. Bu bilgiler yalnızca yasal bir zorunluluk olması hâlinde veya hukuka uyum sağlamak ya da bu siteye veya yararlanan taraflara ait mülkiyet haklarını savunmak veya korumak amacıyla iyi niyetle gerekli görüldüğünde açıklanacaktır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Altıncısı: Talep Ettiğiniz İşlemlerin Gerçekleştirilmesi İçin Gerekli Veriler</strong></span></h3>
<p style="text-align: justify;">Sizden herhangi bir kişisel veriye ihtiyaç duyduğumuzda, bunu tamamen kendi isteğinizle talep ederiz. Bu bilgiler, sizinle iletişime geçmemize ve taleplerinizi mümkün olduğu ölçüde yerine getirmemize yardımcı olur. Önceden yazılı onayınız alınmadan, tarafınızdan sağlanan veriler hiçbir şekilde üçüncü taraflara kendi pazarlama amaçları için satılmaz; istatistik ve araştırma amaçlı, kimliğinizi belirlemeyen toplu veriler bu kapsamın dışındadır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Yedincisi: Bizimle İletişime Geçtiğinizde</strong></span></h3>
<p style="text-align: justify;">Tarafınızdan sağlanan tüm veriler gizli kabul edilir. Çevrim içi olarak sunulan formlar, sitemizi geliştirmemize yardımcı olacak verilerin sağlanmasını gerektirir ve verdiğiniz bilgiler, bu site veya bağlı siteler tarafından sorularınıza, geri bildirimlerinize ya da taleplerinize yanıt vermek için kullanılır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Sekizincisi: Üçüncü Taraflara Bilgi Açıklanması</strong></span></h3>
<p style="text-align: justify;">Bu site veya bağlı siteler dışında hiçbir üçüncü taraf lehine bilgi satışı, ticareti veya ifşası yapılmaz. Bilgiler yalnızca yetkili bir yargı veya düzenleyici merci tarafından talep edilmesi hâlinde açıklanır.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Dokuzuncusu: Gizlilik Politikası ve Bilgi Mahremiyetinde Değişiklikler</strong></span></h3>
<p style="text-align: justify;">Gerekli görüldüğünde ve uygun olduğu durumlarda gizlilik politikası ve bilgi mahremiyeti hükümlerini değiştirme hakkını saklı tutarız. Değişiklikler burada veya ana gizlilik politikası sayfasında uygulanacak ve topladığımız veriler, kullanım şekilleri ve verilerin paylaşılacağı taraflar hakkında sizi sürekli olarak bilgilendireceğiz.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Onuncusu: Hesap Silme</strong></span></h3>
<section id="about-us-page">
<div>
<div>
<div>
<div>
<p style="text-align: right;">Siteye kişisel bilgilerinizle giriş yaptıysanız, kişisel bilgilerimi düzenle sayfasındaki hesap silme simgesine tıklayarak hesabınızı istediğiniz zaman silebilirsiniz.</p>
</div>
</div>
</div>
</div>
</section>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>Son Olarak</strong></span></h3>
<p style="text-align: justify;">Gerektiğinde, sitemizde yer alan “Bize Ulaşın” bağlantısı üzerinden veya info@ala3mal.org e-posta adresine yazarak bizimle iletişime geçebilirsiniz.</p>
<p style="text-align: justify;">Veri gizliliği ve mahremiyeti konusundaki endişe ve hassasiyetiniz bizim için son derece önemlidir. Bu politikanın bu hassasiyeti sağlamasını umuyoruz.</p>'
            ],

        ]);
        Page::create(['page_category_id'=>null,
            'header_show' => null,
            'special' => null,
            'locked' => 1,
            'ar' => ['name' => 'شروط الإستخدام', 'description' => '<p style="text-align: justify;">يرجى قراءة "شروط الاستخدام" هذه بعناية قبل استخدام موقعنا.</p>
<p style="text-align: justify;">يعتبر عملاؤنا الذين يستخدمون موقعنا هذا قد وافقوا على الشروط التالية:</p>
<p style="text-align: justify;">إن صفحات الويب على موقعنا وجميع الصفحات المرتبطة به مملوكة ومدارة من قبل وقف الخيرية</p>
<p style="text-align: justify;">أثناء استخدامك ("كمستخدم") لجميع الخدمات المقدمة على الموقع، فإنك تخضع للشروط التالية، أثناء استخدام هذه الخدمة والاستمرار في استخدامها على الموقع، ويُعتبر أنك قد قبلت أن لديك الحق والسلطة والأهلية القانونية لتوقيع عقد وفقاً للقوانين التي تلتزم بها، وأنك تجاوزت 18 عاماً، وأنك قرأت وفهمت هذا العقد وأنك ملزم بالشروط المكتوبة في العقد.</p>
<p style="text-align: justify;">يفرض هذا العقد حقوقاً والتزامات على الموقع المتعاقد عليه للطرفين ويعلن الطرفان أنهما سيفعلان الحقوق والالتزامات المذكورة بشكل كامل وصحيح وفي الوقت المناسب، ضمن الشروط المطلوبة في هذا العقد عند قبولهم لهذا العقد.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 1- &nbsp;المسؤوليات:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">تحتفظ الشركة دائماً بالحق في إجراء تغييرات على الأسعار والمنتجات والخدمات المعروضة.</li>
<li style="text-align: justify;">تقبل الشركة وتتعهد بأن يستفيد العضو من الخدمات الخاضعة للعقد بخلاف الأعطال الفنية.</li>
<li style="text-align: justify;">يوافق المستخدم مقدماً على عدم إجراء هندسة عكسية لاستخدام الموقع أو اتخاذ أي إجراء آخر للعثور على الكود المصدري أو الحصول عليه، وإلا فسيكون مسؤولاً عن الأضرار التي تلحق بأطراف ثالثة، وسيتم اتخاذ الإجراءات القانونية والجنائية.</li>
<li style="text-align: justify;">يكون المستخدم في أنشطته داخل الموقع، في أي جزء من الموقع أو في اتصالاته، مخالفاً للأخلاق العامة والقانون، ينتهك حقوق الغير، مضلل، عدواني، فاحش، إباحي، يضر بالحقوق الشخصية، ينتهك حقوق النشر، يروج لأنشطة غير قانونية يوافق على أنه لن ينتج أو يشارك المحتوى. بخلاف ذلك، فهو مسؤول مسؤولية كاملة عن الضرر الذي قد يحدث، وفي هذه الحالة تحتفظ سلطات "الموقع" بالحق في تعليق هذه الحسابات وإنهائها وبدء الإجراءات القانونية. لهذا السبب، فإنها تحتفظ بالحق في مشاركة طلبات المعلومات من السلطات القضائية فيما يتعلق بالنشاط أو حسابات المستخدمين.</li>
<li style="text-align: justify;">أعضاء الموقع مسؤولون عن علاقاتهم مع بعضهم البعض أو مع أطراف ثالثة.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 2- &nbsp;حقوق الملكية الفكرية:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">جميع حقوق الملكية الفكرية أو حقوق الملكية الفكرية غير المسجلة مثل الملكية والاسم التجاري والعلامة التجارية وبراءات الاختراع والشعار والتصميم والمعلومات والطريقة الموجودة على هذا الموقع مملوكة لمشغل الموقع وشركة مالكه أو الشخص المعني وتخضع لحماية القانون الوطني والدولي. زيارة هذا الموقع أو استخدام الخدمات الموجودة عليه لا يعطي أي حقوق لحقوق الملكية الفكرية المعنية.</li>
<li style="text-align: justify;">لا يمكن إعادة إنتاج المعلومات الموجودة على الموقع أو نشرها أو نسخها أو تقديمها و / أو نقلها بأي شكل من الأشكال. لا يمكن استخدام الموقع بالكامل أو جزء منه على موقع ويب آخر دون إذن.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 3- &nbsp;المعلومات السرية:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">لن تقوم الشركة بالإفصاح عن المعلومات الشخصية التي يرسلها المستخدمون عبر الموقع إلى أطراف ثالثة. هذه المعلومات الشخصية، تتضمن جميع أنواع المعلومات الأخرى لتحديد هوية المستخدم مثل اسم الشخص واللقب والعنوان ورقم الهاتف والهاتف المحمول وعنوان البريد الإلكتروني، وسيشار إليه بإيجاز باسم "المعلومات السرية".</li>
<li style="text-align: justify;">يمكن للمستخدم فقط استخدام الترويج والإعلان وما إلى ذلك. تقبل وتعلن أن الشركة التي تمتلك الموقع توافق على مشاركة اتصالاتها وحالة محفظتها ومعلوماتها الديموغرافية مع شركاتها الفرعية أو شركات المجموعة التابعة لها، على أن يقتصر استخدامها في نطاق الأنشطة التسويقية. يمكن استخدام هذه المعلومات الشخصية لتحديد ملف تعريف العميل داخل الشركة، لتقديم العروض الترويجية والحملات المناسبة لملف تعريف العميل وإجراء الدراسات الإحصائية.</li>
<li style="text-align: justify;">لا يجوز الكشف عن المعلومات السرية للسلطات العامة إلا في الحالات التي تطلب فيها هذه المعلومات من قبل السلطات الرسمية وعندما يكون الكشف عنها مطلوباً وفقاً لأحكام التشريعات الإلزامية المعمول بها.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 4- &nbsp;لا يوجد ضمان:</strong></span></h3>
<p style="text-align: justify;">يجب أن يكون بند الاتفاقية هذا سارياً إلى الحد الأقصى الذي يسمح به القانون المعمول به. يتم توفير الخدمات التي تقدمها الشركة "كما هي" و "كما هي متوفرة" وهي جميعاً ضمانات ضمنية، بما في ذلك أي ضمانات ضمنية لعدم الانتهاك. لا توجد ضمانات من أي نوع أو نظام أو غير ذلك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 5- &nbsp;التسجيل والأمن:</strong></span></h3>
<p style="text-align: justify;">يجب على المستخدم تقديم معلومات تسجيل صحيحة وكاملة وحديثة. خلاف ذلك، سيتم اعتبار هذه الاتفاقية منتهكة ويمكن إغلاق الحساب دون إبلاغ المستخدم.</p>
<p style="text-align: justify;">المستخدم مسؤول عن أمان كلمة المرور والحساب على الموقع ومواقع الطرف الثالث. خلاف ذلك، لا يمكن تحميل الشركة مسؤولية فقدان البيانات وانتهاكات الأمان أو تلف الأجهزة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 6- &nbsp;أسباب مجبرة:</strong></span></h3>
<p style="text-align: justify;">أسباب مثل عدم الخضوع لسيطرة الأطراف، الكوارث الطبيعية، والحرائق، والانفجارات، والحروب الأهلية، والحروب، وأعمال الشغب، والتحركات الشعبية، وإعلان التعبئة، والإضرابات، والإغلاق والأوبئة، وانقطاع البنية التحتية والإنترنت، وانقطاع التيار الكهربائي... كلها يتم الإشارة إليها باسم "أسباب مجبرة". إذا أصبحت الالتزامات غير مقبولة من قبل الأطراف، فإن الأطراف ليست مسؤولة عنها. خلال هذه الفترة، يتم تعليق حقوق والتزامات الأطراف الناشئة عن هذه الاتفاقية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 7- &nbsp;سلامة العقد وقابلية التطبيق:</strong></span></h3>
<p style="text-align: justify;">إذا أصبح أحد شروط هذا العقد غير صالح جزئياً أو كلياً، يظل باقي العقد سارياً.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 8- &nbsp;تعديلات العقد:</strong></span></h3>
<p style="text-align: justify;">يجوز للشركة تغيير الخدمات المقدمة على الموقع وشروط هذا العقد في أي وقت، كلياً أو جزئياً. ستكون التغييرات سارية المفعول من تاريخ نشرها على الموقع. تقع على عاتق المستخدم مسؤولية متابعة التغييرات، ويعتبر المستخدم قد قبل هذه التغييرات من خلال الاستمرار في الاستفادة من الخدمات المقدمة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 9- &nbsp;الإشعار:</strong></span></h3>
<p style="text-align: justify;">سيتم إرسال جميع الإشعارات إلى الأطراف ذات الصلة بهذه الاتفاقية من خلال عنوان البريد الإلكتروني المعروف للشركة وعنوان البريد الإلكتروني المحدد في نموذج عضوية المستخدم.</p>
<p style="text-align: justify;">يوافق المستخدم على أن العنوان الذي حدده عندما أصبح عضواً هو عنوان الإشعار الصحيح، وأنه سيبلغ الطرف الآخر كتابياً في غضون 5 أيام إذا تغير، وإلا فإن الإشعارات التي سيتم إرسالها إلى هذا العنوان ستعتبر صالحة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 10- &nbsp;اتفاق الإثبات:</strong></span></h3>
<p style="text-align: justify;">في جميع الخلافات التي قد تنشأ بين الأطراف بشأن المعاملات المتعلقة بهذا العقد، سيتم قبول دفاتر الأطراف وسجلاتهم ووثائقهم وسجلات الكمبيوتر وسجلات الفاكس كدليل وفقاً لقانون الإجراءات المدنية رقم 6100، ويوافق المستخدم على عدم الاعتراض على هذه السجلات.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 11- &nbsp;تسوية الخلافات:</strong></span></h3>
<p style="text-align: justify;">يُسمح لمحاكم ومكاتب التنفيذ بإسطنبول (المركزية) بحل أي خلاف ينشأ عن تنفيذ أو تفسير هذه الاتفاقية.</p>'],
            'en' => ['name' => 'شروط الإستخدام', 'description' => '<p style="text-align: justify;">يرجى قراءة "شروط الاستخدام" هذه بعناية قبل استخدام موقعنا.</p>
<p style="text-align: justify;">يعتبر عملاؤنا الذين يستخدمون موقعنا هذا قد وافقوا على الشروط التالية:</p>
<p style="text-align: justify;">إن صفحات الويب على موقعنا وجميع الصفحات المرتبطة به مملوكة ومدارة من قبل وقف الخيرية</p>
<p style="text-align: justify;">أثناء استخدامك ("كمستخدم") لجميع الخدمات المقدمة على الموقع، فإنك تخضع للشروط التالية، أثناء استخدام هذه الخدمة والاستمرار في استخدامها على الموقع، ويُعتبر أنك قد قبلت أن لديك الحق والسلطة والأهلية القانونية لتوقيع عقد وفقاً للقوانين التي تلتزم بها، وأنك تجاوزت 18 عاماً، وأنك قرأت وفهمت هذا العقد وأنك ملزم بالشروط المكتوبة في العقد.</p>
<p style="text-align: justify;">يفرض هذا العقد حقوقاً والتزامات على الموقع المتعاقد عليه للطرفين ويعلن الطرفان أنهما سيفعلان الحقوق والالتزامات المذكورة بشكل كامل وصحيح وفي الوقت المناسب، ضمن الشروط المطلوبة في هذا العقد عند قبولهم لهذا العقد.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 1- &nbsp;المسؤوليات:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">تحتفظ الشركة دائماً بالحق في إجراء تغييرات على الأسعار والمنتجات والخدمات المعروضة.</li>
<li style="text-align: justify;">تقبل الشركة وتتعهد بأن يستفيد العضو من الخدمات الخاضعة للعقد بخلاف الأعطال الفنية.</li>
<li style="text-align: justify;">يوافق المستخدم مقدماً على عدم إجراء هندسة عكسية لاستخدام الموقع أو اتخاذ أي إجراء آخر للعثور على الكود المصدري أو الحصول عليه، وإلا فسيكون مسؤولاً عن الأضرار التي تلحق بأطراف ثالثة، وسيتم اتخاذ الإجراءات القانونية والجنائية.</li>
<li style="text-align: justify;">يكون المستخدم في أنشطته داخل الموقع، في أي جزء من الموقع أو في اتصالاته، مخالفاً للأخلاق العامة والقانون، ينتهك حقوق الغير، مضلل، عدواني، فاحش، إباحي، يضر بالحقوق الشخصية، ينتهك حقوق النشر، يروج لأنشطة غير قانونية يوافق على أنه لن ينتج أو يشارك المحتوى. بخلاف ذلك، فهو مسؤول مسؤولية كاملة عن الضرر الذي قد يحدث، وفي هذه الحالة تحتفظ سلطات "الموقع" بالحق في تعليق هذه الحسابات وإنهائها وبدء الإجراءات القانونية. لهذا السبب، فإنها تحتفظ بالحق في مشاركة طلبات المعلومات من السلطات القضائية فيما يتعلق بالنشاط أو حسابات المستخدمين.</li>
<li style="text-align: justify;">أعضاء الموقع مسؤولون عن علاقاتهم مع بعضهم البعض أو مع أطراف ثالثة.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 2- &nbsp;حقوق الملكية الفكرية:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">جميع حقوق الملكية الفكرية أو حقوق الملكية الفكرية غير المسجلة مثل الملكية والاسم التجاري والعلامة التجارية وبراءات الاختراع والشعار والتصميم والمعلومات والطريقة الموجودة على هذا الموقع مملوكة لمشغل الموقع وشركة مالكه أو الشخص المعني وتخضع لحماية القانون الوطني والدولي. زيارة هذا الموقع أو استخدام الخدمات الموجودة عليه لا يعطي أي حقوق لحقوق الملكية الفكرية المعنية.</li>
<li style="text-align: justify;">لا يمكن إعادة إنتاج المعلومات الموجودة على الموقع أو نشرها أو نسخها أو تقديمها و / أو نقلها بأي شكل من الأشكال. لا يمكن استخدام الموقع بالكامل أو جزء منه على موقع ويب آخر دون إذن.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 3- &nbsp;المعلومات السرية:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">لن تقوم الشركة بالإفصاح عن المعلومات الشخصية التي يرسلها المستخدمون عبر الموقع إلى أطراف ثالثة. هذه المعلومات الشخصية، تتضمن جميع أنواع المعلومات الأخرى لتحديد هوية المستخدم مثل اسم الشخص واللقب والعنوان ورقم الهاتف والهاتف المحمول وعنوان البريد الإلكتروني، وسيشار إليه بإيجاز باسم "المعلومات السرية".</li>
<li style="text-align: justify;">يمكن للمستخدم فقط استخدام الترويج والإعلان وما إلى ذلك. تقبل وتعلن أن الشركة التي تمتلك الموقع توافق على مشاركة اتصالاتها وحالة محفظتها ومعلوماتها الديموغرافية مع شركاتها الفرعية أو شركات المجموعة التابعة لها، على أن يقتصر استخدامها في نطاق الأنشطة التسويقية. يمكن استخدام هذه المعلومات الشخصية لتحديد ملف تعريف العميل داخل الشركة، لتقديم العروض الترويجية والحملات المناسبة لملف تعريف العميل وإجراء الدراسات الإحصائية.</li>
<li style="text-align: justify;">لا يجوز الكشف عن المعلومات السرية للسلطات العامة إلا في الحالات التي تطلب فيها هذه المعلومات من قبل السلطات الرسمية وعندما يكون الكشف عنها مطلوباً وفقاً لأحكام التشريعات الإلزامية المعمول بها.</li>
</ol>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 4- &nbsp;لا يوجد ضمان:</strong></span></h3>
<p style="text-align: justify;">يجب أن يكون بند الاتفاقية هذا سارياً إلى الحد الأقصى الذي يسمح به القانون المعمول به. يتم توفير الخدمات التي تقدمها الشركة "كما هي" و "كما هي متوفرة" وهي جميعاً ضمانات ضمنية، بما في ذلك أي ضمانات ضمنية لعدم الانتهاك. لا توجد ضمانات من أي نوع أو نظام أو غير ذلك.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 5- &nbsp;التسجيل والأمن:</strong></span></h3>
<p style="text-align: justify;">يجب على المستخدم تقديم معلومات تسجيل صحيحة وكاملة وحديثة. خلاف ذلك، سيتم اعتبار هذه الاتفاقية منتهكة ويمكن إغلاق الحساب دون إبلاغ المستخدم.</p>
<p style="text-align: justify;">المستخدم مسؤول عن أمان كلمة المرور والحساب على الموقع ومواقع الطرف الثالث. خلاف ذلك، لا يمكن تحميل الشركة مسؤولية فقدان البيانات وانتهاكات الأمان أو تلف الأجهزة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 6- &nbsp;أسباب مجبرة:</strong></span></h3>
<p style="text-align: justify;">أسباب مثل عدم الخضوع لسيطرة الأطراف، الكوارث الطبيعية، والحرائق، والانفجارات، والحروب الأهلية، والحروب، وأعمال الشغب، والتحركات الشعبية، وإعلان التعبئة، والإضرابات، والإغلاق والأوبئة، وانقطاع البنية التحتية والإنترنت، وانقطاع التيار الكهربائي... كلها يتم الإشارة إليها باسم "أسباب مجبرة". إذا أصبحت الالتزامات غير مقبولة من قبل الأطراف، فإن الأطراف ليست مسؤولة عنها. خلال هذه الفترة، يتم تعليق حقوق والتزامات الأطراف الناشئة عن هذه الاتفاقية.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 7- &nbsp;سلامة العقد وقابلية التطبيق:</strong></span></h3>
<p style="text-align: justify;">إذا أصبح أحد شروط هذا العقد غير صالح جزئياً أو كلياً، يظل باقي العقد سارياً.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 8- &nbsp;تعديلات العقد:</strong></span></h3>
<p style="text-align: justify;">يجوز للشركة تغيير الخدمات المقدمة على الموقع وشروط هذا العقد في أي وقت، كلياً أو جزئياً. ستكون التغييرات سارية المفعول من تاريخ نشرها على الموقع. تقع على عاتق المستخدم مسؤولية متابعة التغييرات، ويعتبر المستخدم قد قبل هذه التغييرات من خلال الاستمرار في الاستفادة من الخدمات المقدمة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 9- &nbsp;الإشعار:</strong></span></h3>
<p style="text-align: justify;">سيتم إرسال جميع الإشعارات إلى الأطراف ذات الصلة بهذه الاتفاقية من خلال عنوان البريد الإلكتروني المعروف للشركة وعنوان البريد الإلكتروني المحدد في نموذج عضوية المستخدم.</p>
<p style="text-align: justify;">يوافق المستخدم على أن العنوان الذي حدده عندما أصبح عضواً هو عنوان الإشعار الصحيح، وأنه سيبلغ الطرف الآخر كتابياً في غضون 5 أيام إذا تغير، وإلا فإن الإشعارات التي سيتم إرسالها إلى هذا العنوان ستعتبر صالحة.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 10- &nbsp;اتفاق الإثبات:</strong></span></h3>
<p style="text-align: justify;">في جميع الخلافات التي قد تنشأ بين الأطراف بشأن المعاملات المتعلقة بهذا العقد، سيتم قبول دفاتر الأطراف وسجلاتهم ووثائقهم وسجلات الكمبيوتر وسجلات الفاكس كدليل وفقاً لقانون الإجراءات المدنية رقم 6100، ويوافق المستخدم على عدم الاعتراض على هذه السجلات.</p>
<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>&nbsp; 11- &nbsp;تسوية الخلافات:</strong></span></h3>
<p style="text-align: justify;">يُسمح لمحاكم ومكاتب التنفيذ بإسطنبول (المركزية) بحل أي خلاف ينشأ عن تنفيذ أو تفسير هذه الاتفاقية.</p>'],
            'tr' => [
                'name' => 'Kullanım Şartları',
                'description' => '<p style="text-align: justify;">Lütfen sitemizi kullanmadan önce bu “Kullanım Şartları”nı dikkatlice okuyunuz.</p>
<p style="text-align: justify;">Sitemizi kullanan müşterilerimizin aşağıdaki şartları kabul ettiği varsayılır:</p>
<p style="text-align: justify;">Web sitemizde yer alan tüm sayfalar ve bu sayfalara bağlı tüm içerikler Hayır Vakfı’na aittir ve Hayır Vakfı tarafından yönetilmektedir.</p>
<p style="text-align: justify;">Site üzerinde sunulan tüm hizmetleri (“kullanıcı” olarak) kullandığınız süre boyunca aşağıdaki şartlara tabi olursunuz. Bu hizmeti kullanmaya devam etmeniz; yürürlükteki mevzuata göre sözleşme yapma hak, yetki ve hukuki ehliyete sahip olduğunuzu, 18 yaşını doldurduğunuzu, bu sözleşmeyi okuduğunuzu, anladığınızı ve sözleşmede yer alan şartlarla bağlı olduğunuzu kabul ettiğiniz anlamına gelir.</p>
<p style="text-align: justify;">Bu sözleşme, taraflara karşılıklı hak ve yükümlülükler yükler ve taraflar bu sözleşmeyi kabul etmekle, belirtilen hak ve yükümlülükleri eksiksiz, doğru ve zamanında yerine getireceklerini beyan ederler.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>1- Sorumluluklar:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">Şirket, sunulan fiyatlar, ürünler ve hizmetler üzerinde her zaman değişiklik yapma hakkını saklı tutar.</li>
<li style="text-align: justify;">Şirket, teknik arızalar dışında, üyenin sözleşmeye tabi hizmetlerden yararlanacağını kabul ve taahhüt eder.</li>
<li style="text-align: justify;">Kullanıcı, siteyi kullanırken tersine mühendislik yapmayacağını, kaynak kodunu bulmaya veya elde etmeye yönelik herhangi bir girişimde bulunmayacağını peşinen kabul eder. Aksi hâlde üçüncü kişilere verilebilecek zararlardan sorumlu olacak ve hakkında hukuki ve cezai işlemler başlatılacaktır.</li>
<li style="text-align: justify;">Kullanıcı; site içindeki faaliyetlerinde, sitenin herhangi bir bölümünde veya iletişimlerinde genel ahlaka ve hukuka aykırı, başkalarının haklarını ihlal eden, yanıltıcı, saldırgan, müstehcen, pornografik, kişilik haklarına zarar veren, telif haklarını ihlal eden veya yasa dışı faaliyetleri teşvik eden içerikler üretmeyeceğini veya paylaşmayacağını kabul eder. Aksi durumda doğacak tüm zararlardan bizzat sorumludur. Bu hâllerde site yönetimi hesapları askıya alma, sonlandırma ve hukuki süreç başlatma hakkını saklı tutar. Ayrıca yetkili mercilerin talep etmesi hâlinde kullanıcı bilgilerini paylaşma hakkı da saklıdır.</li>
<li style="text-align: justify;">Site üyeleri, birbirleriyle veya üçüncü taraflarla olan ilişkilerinden kendileri sorumludur.</li>
</ol>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>2- Fikri Mülkiyet Hakları:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">Bu sitede yer alan tüm fikri mülkiyet hakları; mülkiyet, ticari unvan, marka, patent, logo, tasarım, bilgi ve yöntemler dâhil olmak üzere site işletmecisine veya ilgili hak sahibine aittir ve ulusal ve uluslararası hukuk tarafından korunmaktadır. Bu siteyi ziyaret etmek veya hizmetlerden yararlanmak, söz konusu fikri mülkiyet haklarına ilişkin herhangi bir hak vermez.</li>
<li style="text-align: justify;">Sitede yer alan bilgiler; izin alınmaksızın çoğaltılamaz, yayımlanamaz, kopyalanamaz, aktarılamaz veya başka bir sitede kısmen ya da tamamen kullanılamaz.</li>
</ol>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>3- Gizli Bilgiler:</strong></span></h3>
<ol style="list-style-type: lower-alpha;">
<li style="text-align: justify;">Şirket, kullanıcılar tarafından site üzerinden iletilen kişisel bilgileri üçüncü taraflarla paylaşmaz. Bu bilgiler; ad, soyad, adres, telefon numarası, cep telefonu ve e-posta adresi gibi kullanıcıyı tanımlamaya yarayan tüm bilgileri kapsar ve “Gizli Bilgiler” olarak anılır.</li>
<li style="text-align: justify;">Kullanıcı; tanıtım, reklam ve benzeri faaliyetler kapsamında, site sahibi şirketin iletişim bilgilerini, portföy durumunu ve demografik bilgilerini yalnızca pazarlama faaliyetleri çerçevesinde kullanılmak üzere bağlı ortaklıkları veya grup şirketleriyle paylaşabileceğini kabul eder. Bu bilgiler; müşteri profili oluşturmak, uygun kampanyalar sunmak ve istatistiksel çalışmalar yapmak amacıyla kullanılabilir.</li>
<li style="text-align: justify;">Gizli bilgiler, yalnızca yetkili resmi makamlarca talep edilmesi ve yürürlükteki zorunlu mevzuat hükümleri gereğince açıklanması gereken hâllerde kamu otoritelerine açıklanabilir.</li>
</ol>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>4- Garanti Yoktur:</strong></span></h3>
<p style="text-align: justify;">Bu sözleşme maddesi, yürürlükteki hukukun izin verdiği azami ölçüde geçerlidir. Şirket tarafından sunulan hizmetler “olduğu gibi” ve “mevcut olduğu şekilde” sunulmakta olup, ihlal etmeme dâhil olmak üzere herhangi bir zımni garanti içermez. Herhangi bir türde açık veya zımni garanti verilmemektedir.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>5- Kayıt ve Güvenlik:</strong></span></h3>
<p style="text-align: justify;">Kullanıcı, kayıt sırasında doğru, eksiksiz ve güncel bilgiler sunmakla yükümlüdür. Aksi hâlde bu sözleşme ihlal edilmiş sayılır ve kullanıcı hesabı bildirimsiz olarak kapatılabilir.</p>
<p style="text-align: justify;">Kullanıcı, site ve üçüncü taraf sitelerdeki hesap ve şifre güvenliğinden sorumludur. Veri kaybı, güvenlik ihlalleri veya donanım zararlarından şirket sorumlu tutulamaz.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>6- Mücbir Sebepler:</strong></span></h3>
<p style="text-align: justify;">Tarafların kontrolü dışında gerçekleşen doğal afetler, yangınlar, patlamalar, iç savaş, savaş, isyanlar, halk hareketleri, seferberlik ilanı, grev, lokavt, salgın hastalıklar, altyapı ve internet kesintileri, elektrik kesintileri gibi durumlar “mücbir sebep” olarak kabul edilir. Bu durumlarda taraflar yükümlülüklerinden sorumlu tutulmaz ve sözleşmeden doğan hak ve yükümlülükler askıya alınır.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>7- Sözleşmenin Bütünlüğü ve Geçerliliği:</strong></span></h3>
<p style="text-align: justify;">Bu sözleşmenin herhangi bir hükmünün kısmen veya tamamen geçersiz olması, diğer hükümlerin geçerliliğini etkilemez.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>8- Sözleşme Değişiklikleri:</strong></span></h3>
<p style="text-align: justify;">Şirket, sitede sunulan hizmetleri ve bu sözleşmenin şartlarını her zaman kısmen veya tamamen değiştirme hakkına sahiptir. Değişiklikler, sitede yayımlandığı tarihten itibaren geçerli olur. Kullanıcı, hizmetleri kullanmaya devam ederek bu değişiklikleri kabul etmiş sayılır.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>9- Bildirim:</strong></span></h3>
<p style="text-align: justify;">Bu sözleşmeye ilişkin tüm bildirimler, şirketin bilinen e-posta adresi ile kullanıcının üyelik formunda belirttiği e-posta adresi üzerinden yapılır.</p>
<p style="text-align: justify;">Kullanıcı, üyelik sırasında bildirdiği adresin geçerli tebligat adresi olduğunu, değişiklikleri 5 gün içinde yazılı olarak bildirmediği takdirde bu adrese yapılan bildirimlerin geçerli sayılacağını kabul eder.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>10- Delil Sözleşmesi:</strong></span></h3>
<p style="text-align: justify;">Taraflar arasında bu sözleşmeye ilişkin işlemlerden doğabilecek her türlü uyuşmazlıkta, tarafların defter, kayıt, belge, bilgisayar ve faks kayıtları, Hukuk Muhakemeleri Kanunu No: 6100 uyarınca delil olarak kabul edilecek olup, kullanıcı bu kayıtlara itiraz etmeyeceğini kabul eder.</p>

<h3 style="text-align: justify;"><span style="color: hsl(240,75%,60%);"><strong>11- Uyuşmazlıkların Çözümü:</strong></span></h3>
<p style="text-align: justify;">Bu sözleşmenin uygulanmasından veya yorumlanmasından doğabilecek uyuşmazlıkların çözümünde İstanbul (Merkez) Mahkemeleri ve İcra Daireleri yetkilidir.</p>'
            ],


        ]);
        //about_us
        Page::create(['page_category_id'=>null,
            'header_show' => null,
            'special' => null,
            'locked' => 1,
            'ar' => ['name' => 'من نحن', 'description' => '<h1><strong>وقف الخيرية</strong></h1>
<p>&nbsp;</p>
<p>* وقف الخيرية هي جمعية نفع عام خيرية تأسست في دولة الكويت عام 1982، تقوم بأعمالها الخيرية داخل الكويت وخارجها، وتعمل تحت مظلة وزارة الشئون الاجتماعية والعمل بدولة الكويت، وتهدف إلى:<br />1- نشر الإسلام الصحيح كما رسمه الرسول صلى الله عليه وسلم وفق فهم الصحابة رضوان الله عليهم.<br />2- تحذير الناس من البدع والمنكرات في الدين وتنقيته من هذه الشوائب.<br />3- إعانة الأسر المحتاجة والمتعففة داخل الكويت.<br />4- إغاثة الناس في الدول الفقيرة والمحتاجة حول العالم من خلال تقديم الغذاء والشراب واللباس والدواء.<br />5- بناء المساجد والمدارس والمستشفيات وحفر الآبار في هذه الدول الفقيرة والمحتاجة.</p>
<p><br /><strong>الرؤية :</strong>&nbsp;​​​الريادة والتميز في العمل الخيري<br />وفق الشريعة الإسلامية ووفقا للمعايير العلمية للجودة العالمية.<br /><strong>الرسالة :</strong>&nbsp;​​عمل مؤسسي متميز وفق تخطيط يستشرف المستقبل<br />- ذو بعد خيري ودعوي إبداعي يساهم مساهمة إيجابية في<br />تحقيق التكافل الاجتماعي والتوجيه الديني دعوة وتعليما.<br />- العمل على تنمية الأسرة وغرس العقيدة الإسلامية الصحيحة<br />في نفوس النشء ، والاستفادة من وسائل التقنية الحديثة<br />- إرساء قواعد التعليم والتربية من خلال منظومة تعليمية<br />متقدمة ونبذ العنف والإرهاب .<br />- الحصول على أعلى شهادات الجودة العالمية في العمل الإنساني<br />الدعوي .<br /><strong>القيم :</strong>&nbsp;​​​التميز / الريادة / الإبداع / الأمانة<br />الشراكة / التنمية البشرية / الجودة<br /><strong>ملتزمون بالكتاب والسنة بفهم سلف الأمة من الصحابة رضوان الله تعالى عنهم.</strong><br /><strong>والتابعين والأئمة الأعلام .</strong></p>
'],
            'en' => ['name' => 'من نحن', 'description' => '<h1><strong>وقف الخيرية</strong></h1>
<p>&nbsp;</p>
<p>* وقف الخيرية هي جمعية نفع عام خيرية تأسست في دولة الكويت عام 1982، تقوم بأعمالها الخيرية داخل الكويت وخارجها، وتعمل تحت مظلة وزارة الشئون الاجتماعية والعمل بدولة الكويت، وتهدف إلى:<br />1- نشر الإسلام الصحيح كما رسمه الرسول صلى الله عليه وسلم وفق فهم الصحابة رضوان الله عليهم.<br />2- تحذير الناس من البدع والمنكرات في الدين وتنقيته من هذه الشوائب.<br />3- إعانة الأسر المحتاجة والمتعففة داخل الكويت.<br />4- إغاثة الناس في الدول الفقيرة والمحتاجة حول العالم من خلال تقديم الغذاء والشراب واللباس والدواء.<br />5- بناء المساجد والمدارس والمستشفيات وحفر الآبار في هذه الدول الفقيرة والمحتاجة.</p>
<p><br /><strong>الرؤية :</strong>&nbsp;​​​الريادة والتميز في العمل الخيري<br />وفق الشريعة الإسلامية ووفقا للمعايير العلمية للجودة العالمية.<br /><strong>الرسالة :</strong>&nbsp;​​عمل مؤسسي متميز وفق تخطيط يستشرف المستقبل<br />- ذو بعد خيري ودعوي إبداعي يساهم مساهمة إيجابية في<br />تحقيق التكافل الاجتماعي والتوجيه الديني دعوة وتعليما.<br />- العمل على تنمية الأسرة وغرس العقيدة الإسلامية الصحيحة<br />في نفوس النشء ، والاستفادة من وسائل التقنية الحديثة<br />- إرساء قواعد التعليم والتربية من خلال منظومة تعليمية<br />متقدمة ونبذ العنف والإرهاب .<br />- الحصول على أعلى شهادات الجودة العالمية في العمل الإنساني<br />الدعوي .<br /><strong>القيم :</strong>&nbsp;​​​التميز / الريادة / الإبداع / الأمانة<br />الشراكة / التنمية البشرية / الجودة<br /><strong>ملتزمون بالكتاب والسنة بفهم سلف الأمة من الصحابة رضوان الله تعالى عنهم.</strong><br /><strong>والتابعين والأئمة الأعلام .</strong></p>
'],
            'tr' => [
                'name' => 'Hakkımızda',
                'description' => '<h1><strong>Vakf-ı Hayriye</strong></h1>
<p>&nbsp;</p>
<p>* Vakf-ı Hayriye, 1982 yılında Kuveyt Devleti’nde kurulmuş, kamu yararına faaliyet gösteren hayır derneğidir. Faaliyetlerini Kuveyt içinde ve dışında yürütmekte olup Kuveyt Sosyal İşler ve Çalışma Bakanlığı çatısı altında çalışmaktadır. Derneğin amaçları şunlardır:<br />
1- İslam’ı, Peygamber Efendimiz Hz. Muhammed’in (s.a.v.) çizdiği yol ve sahabenin anlayışı doğrultusunda doğru şekilde yaymak.<br />
2- İnsanları bid‘at ve dinî kötülüklerden sakındırmak ve dini bu tür unsurlardan arındırmak.<br />
3- Kuveyt içindeki ihtiyaç sahibi ve onurlu ailelere destek olmak.<br />
4- Dünya genelindeki yoksul ve muhtaç ülkelere gıda, içecek, giysi ve ilaç yardımı sağlayarak insani yardım ulaştırmak.<br />
5- Bu yoksul ve muhtaç ülkelerde camiler, okullar, hastaneler inşa etmek ve su kuyuları açmak.</p>

<p><br /><strong>Vizyon:</strong> İslami şeriat çerçevesinde ve uluslararası kalite standartlarına uygun olarak<br />
hayır çalışmalarında öncülük ve mükemmeliyet.</p>

<p><strong>Misyon:</strong> Geleceği öngören bir planlama ile yürütülen kurumsal ve seçkin bir çalışma anlayışı;<br />
- Sosyal dayanışmanın sağlanmasına ve davet ile eğitim yoluyla dinî rehberliğe<br />
olumlu katkı sunan hayır ve davet boyutuna sahip olmak.<br />
- Ailenin gelişimini desteklemek ve doğru İslami inancı yeni nesillerin<br />
kalplerine yerleştirmek, modern teknolojik araçlardan faydalanmak.<br />
- Gelişmiş bir eğitim sistemi aracılığıyla eğitim ve terbiyenin temellerini atmak,<br />
şiddet ve terörü reddetmek.<br />
- İnsani ve davet çalışmalarında en yüksek uluslararası kalite belgelerini elde etmek.</p>

<p><strong>Değerler:</strong> Mükemmeliyet / Öncülük / Yaratıcılık / Emanet bilinci<br />
Ortaklık / Beşeri gelişim / Kalite</p>

<p><strong>Sahabenin (Allah onlardan razı olsun) anlayışıyla Kitap ve Sünnet’e bağlıyız.</strong><br />
<strong>Tabiîn ve büyük İslam âlimlerinin yolunu esas alırız.</strong></p>'
            ],

        ]);
        //say
        Page::create(['page_category_id' => null,
            'header_show' => null,
            'special' => null,
            'locked' => 1,
            'ar' => ['name' => 'قالوا عنا', 'description' => '<h2 class="corporate_cstm"><strong>قالوا عن وقف الخيرية</strong></h2>
<p>&nbsp;</p>
<div class="corporate_cstm">
<p><strong>الشيخ عبدالعزيز بن باز:</strong>&nbsp;عُرض عليّ منهج الجمعية للدعوة والتوجيه فقرأته كله وألقيته منهجاً جيداً مناسباً.</p>
<p>وقال أيضاً: أهنئ إخواني القائمين على وقف الخيرية بما يسر الله لهم من الخير، ومن ذلك ما يبذلونه من جهود طيبة .. الشيخ/ عبدالعزيز بن باز ، مفتي المملكة العربية السعودية.</p>
<p><strong>الشيخ صالح آل فوزان:</strong>&nbsp;اطلعت على نسخة من منهج وقف الخيرية للدعوة والتوجيه فوجدته منهجاً صحيحاً يتمشى مع الكتاب والسنة وما تحتاجه الأمة . فضيلة الشيخ/ صالح بن فوزان بن عبدالله آل فوزان. عضو هيئة كبار العلماء ففي المملكة العربية السعودية</p>
<p><strong>الشيخ محمد بن العثيمين:</strong>&nbsp;اطلعت على كتاب ( مسيرة الخير)، وسرني كثيراً ما رأيت وما سمعت. فضيلة الشيخ/ محمد بن صالح العثيمين .&nbsp; &nbsp; &nbsp;* كتاب (مسيرة الخير) هو كتاب تعريفي يعرض مشاريع وأعمال وقف الخيرية</p>
<p><strong>الشيخ عبدالله العبيلان:&nbsp;</strong>وقف الخيرية، والذي وجهني لإلقاء المحاضرات والدروس التي تنظمها الجمعية في الكويت هو سماحة الشيخ/ عبدالعزيز بن باز. ... وإلى ساعتي هذه ولا أعلم أن وقف الخيرية تبنت أو دعت من خلال مطبوعاتها ونشراتها غير الدعوة السلفية . فضيلة الشيخ/ عبدالله بن صالح العبيلان</p>
<p><strong>الشيخ د.</strong>&nbsp;<strong>عبدالرحمن السديس:</strong>&nbsp;وقف الخيرية قمة من قمم الجمعيات العاملة لهذا الدين، ولعل خصائصها ومميزاتها بعقيدة السلف ومنهجهم، واهتمامها بالعلوم الشرعية والتأصيل العلمي. وهذه الجمعية علم متألق مرفرف في خدمة المنهج الصحيح، بجهودها المتميزة، ونُشهد الله أننا نُحب القائمين عليها، وندعو لهم . فضيلة الشيخ د/ عبدالرحمن بن عبدالعزيز السديس إمام وخطيب المسجد الحرام - بمكة المكرمة.</p>
<p><strong>الشيخ عبدالله المنيع:&nbsp;</strong>تشرفت بزيارة مقر وقف الخيرية ورأيت معرضاً يمثل نشاطها المتعدد في سبل الدعوة والتعليم والإغاثة والإعانة وتوعية المسلمين، فشكراً لهم وبارك الله فيهم وجعل عملهم صالحاً لوجهه الكريم. فضيلة الشيخ/ عبدالله المنيع. عضو لجنة الإفتاء وعضو هيئة كبار العلماء في المملكة العربية السعودية</p>
<p><strong>الشيخ صالح بن حميد:</strong>&nbsp;زُرت إخواننا في وقف الخيرية في دولة الكويت الشقيقة، وسرني ما رأيت من حُسن المبنى والمعنى، وما وفقهم الله فيه من مشاريع خيرية ومناشط دعوية وعلمية، وزادهم الله إحساناً وتوفيقاً . فضيلة الشيخ/ صالح بن عبدالله بن حميد رئيس مجلس الشورى السعودي وإمام وخطيب الحرم المكي.</p>
<p><strong>الشيخ صالح آل الشيخ:</strong>&nbsp;فهنيئاً لنا بهذه الجمعية التي نحسب أنها قامت على تقوى من الله، وحرص على التقيد بمنهج السلف، وإن لأحث من اطلع على هذه الأسطر أن يُسهم معهم في إنفاذ برامجهم وأعمالهم وأن يتبرع لهم، فأعمالهم خيرة وكبيرة في كل مكان . فضيلة الشيخ/ صالح بن عبدالعزيز آل الشيخ. وزير الشؤون الإسلامية - المملكة العربية السعودية .</p>
</div>'],
            'en' => ['name' => 'قالوا عنا', 'description' => '<h2 class="corporate_cstm"><strong>قالوا عن وقف الخيرية</strong></h2>
<p>&nbsp;</p>
<div class="corporate_cstm">
<p><strong>الشيخ عبدالعزيز بن باز:</strong>&nbsp;عُرض عليّ منهج الجمعية للدعوة والتوجيه فقرأته كله وألقيته منهجاً جيداً مناسباً.</p>
<p>وقال أيضاً: أهنئ إخواني القائمين على وقف الخيرية بما يسر الله لهم من الخير، ومن ذلك ما يبذلونه من جهود طيبة .. الشيخ/ عبدالعزيز بن باز ، مفتي المملكة العربية السعودية.</p>
<p><strong>الشيخ صالح آل فوزان:</strong>&nbsp;اطلعت على نسخة من منهج وقف الخيرية للدعوة والتوجيه فوجدته منهجاً صحيحاً يتمشى مع الكتاب والسنة وما تحتاجه الأمة . فضيلة الشيخ/ صالح بن فوزان بن عبدالله آل فوزان. عضو هيئة كبار العلماء ففي المملكة العربية السعودية</p>
<p><strong>الشيخ محمد بن العثيمين:</strong>&nbsp;اطلعت على كتاب ( مسيرة الخير)، وسرني كثيراً ما رأيت وما سمعت. فضيلة الشيخ/ محمد بن صالح العثيمين .&nbsp; &nbsp; &nbsp;* كتاب (مسيرة الخير) هو كتاب تعريفي يعرض مشاريع وأعمال وقف الخيرية</p>
<p><strong>الشيخ عبدالله العبيلان:&nbsp;</strong>وقف الخيرية، والذي وجهني لإلقاء المحاضرات والدروس التي تنظمها الجمعية في الكويت هو سماحة الشيخ/ عبدالعزيز بن باز. ... وإلى ساعتي هذه ولا أعلم أن وقف الخيرية تبنت أو دعت من خلال مطبوعاتها ونشراتها غير الدعوة السلفية . فضيلة الشيخ/ عبدالله بن صالح العبيلان</p>
<p><strong>الشيخ د.</strong>&nbsp;<strong>عبدالرحمن السديس:</strong>&nbsp;وقف الخيرية قمة من قمم الجمعيات العاملة لهذا الدين، ولعل خصائصها ومميزاتها بعقيدة السلف ومنهجهم، واهتمامها بالعلوم الشرعية والتأصيل العلمي. وهذه الجمعية علم متألق مرفرف في خدمة المنهج الصحيح، بجهودها المتميزة، ونُشهد الله أننا نُحب القائمين عليها، وندعو لهم . فضيلة الشيخ د/ عبدالرحمن بن عبدالعزيز السديس إمام وخطيب المسجد الحرام - بمكة المكرمة.</p>
<p><strong>الشيخ عبدالله المنيع:&nbsp;</strong>تشرفت بزيارة مقر وقف الخيرية ورأيت معرضاً يمثل نشاطها المتعدد في سبل الدعوة والتعليم والإغاثة والإعانة وتوعية المسلمين، فشكراً لهم وبارك الله فيهم وجعل عملهم صالحاً لوجهه الكريم. فضيلة الشيخ/ عبدالله المنيع. عضو لجنة الإفتاء وعضو هيئة كبار العلماء في المملكة العربية السعودية</p>
<p><strong>الشيخ صالح بن حميد:</strong>&nbsp;زُرت إخواننا في وقف الخيرية في دولة الكويت الشقيقة، وسرني ما رأيت من حُسن المبنى والمعنى، وما وفقهم الله فيه من مشاريع خيرية ومناشط دعوية وعلمية، وزادهم الله إحساناً وتوفيقاً . فضيلة الشيخ/ صالح بن عبدالله بن حميد رئيس مجلس الشورى السعودي وإمام وخطيب الحرم المكي.</p>
<p><strong>الشيخ صالح آل الشيخ:</strong>&nbsp;فهنيئاً لنا بهذه الجمعية التي نحسب أنها قامت على تقوى من الله، وحرص على التقيد بمنهج السلف، وإن لأحث من اطلع على هذه الأسطر أن يُسهم معهم في إنفاذ برامجهم وأعمالهم وأن يتبرع لهم، فأعمالهم خيرة وكبيرة في كل مكان . فضيلة الشيخ/ صالح بن عبدالعزيز آل الشيخ. وزير الشؤون الإسلامية - المملكة العربية السعودية .</p>
</div>'],
            'tr' => [
                'name' => 'Hakkımızda Söylenenler',
                'description' => '<h2 class="corporate_cstm"><strong>Vakf-ı Hayriye Hakkında Söylenenler</strong></h2>
<p>&nbsp;</p>
<div class="corporate_cstm">
<p><strong>Şeyh Abdulaziz bin Baz:</strong> Derneğin davet ve irşat metodunu inceledim, tamamını okudum ve onu iyi ve uygun bir metot olarak değerlendirdim.</p>
<p>Ayrıca şöyle demiştir: Vakf-ı Hayriye’de görev alan kardeşlerimi, Allah’ın kendilerine nasip ettiği hayırlı çalışmalarından dolayı tebrik ediyorum. Bu çalışmalar, onların ortaya koyduğu güzel gayretlerin bir parçasıdır. Şeyh Abdulaziz bin Baz – Suudi Arabistan Krallığı Müftüsü.</p>

<p><strong>Şeyh Salih el-Fevzan:</strong> Vakf-ı Hayriye’nin davet ve yönlendirme metoduna ait bir nüshayı inceledim ve onu Kur’an ve Sünnet’e uygun, ümmetin ihtiyaçlarını karşılayan sahih bir metot olarak buldum. Şeyh Salih bin Fevzan bin Abdullah el-Fevzan – Suudi Arabistan’da Büyük Âlimler Heyeti Üyesi.</p>

<p><strong>Şeyh Muhammed bin Salih el-Useymin:</strong> “Hayır Yolculuğu” adlı kitabı inceledim; gördüklerim ve duyduklarım beni çok memnun etti. Şeyh Muhammed bin Salih el-Useymin.
&nbsp;&nbsp;&nbsp;* “Hayır Yolculuğu” kitabı, Vakf-ı Hayriye’nin proje ve çalışmalarını tanıtan bir eserdir.</p>

<p><strong>Şeyh Abdullah el-Ubeylan:</strong> Kuveyt’te Vakf-ı Hayriye tarafından düzenlenen ders ve konferansları vermem yönünde beni teşvik eden zat, muhterem Şeyh Abdulaziz bin Baz olmuştur. Bugüne kadar Vakf-ı Hayriye’nin yayınları ve faaliyetleri aracılığıyla Selefi davetten başka bir çağrıyı benimsediğini veya davet ettiğini bilmiyorum. Şeyh Abdullah bin Salih el-Ubeylan.</p>

<p><strong>Şeyh Dr. Abdurrahman es-Sudeys:</strong> Vakf-ı Hayriye, bu dine hizmet eden derneklerin zirvelerinden biridir. Onu diğerlerinden ayıran özellikleri, selefin akidesine ve metoduna bağlılığı, şer‘i ilimlere ve ilmî temellendirmeye verdiği önemdir. Bu dernek, doğru metodu hizmetinde dalgalanan parlak bir bayraktır. Allah’a şahit tutarız ki yöneticilerini seviyoruz ve onlar için dua ediyoruz. Şeyh Dr. Abdurrahman bin Abdulaziz es-Sudeys – Mekke-i Mükerreme’de Mescid-i Haram’ın imam ve hatibi.</p>

<p><strong>Şeyh Abdullah el-Menia:</strong> Vakf-ı Hayriye’nin merkezini ziyaret etmekle şereflendim ve davet, eğitim, yardım, destek ve Müslümanları bilinçlendirme alanlarındaki çok yönlü faaliyetlerini yansıtan bir sergi gördüm. Kendilerine teşekkür eder, Allah’tan çalışmalarını bereketlendirmesini ve ihlasla kabul etmesini dilerim. Şeyh Abdullah el-Menia – Suudi Arabistan Fetva Komitesi ve Büyük Âlimler Heyeti Üyesi.</p>

<p><strong>Şeyh Salih bin Humeyd:</strong> Kardeşlerimiz Vakf-ı Hayriye’yi Kuveyt’te ziyaret ettim. Gerek bina gerekse içerik açısından gördüklerim beni memnun etti. Allah’ın kendilerine nasip ettiği hayır projeleri ile davet ve ilmî faaliyetleri takdire şayandır. Allah ihsanlarını ve muvaffakiyetlerini artırsın. Şeyh Salih bin Abdullah bin Humeyd – Suudi Arabistan Şura Meclisi Başkanı ve Mescid-i Haram imam ve hatibi.</p>

<p><strong>Şeyh Salih Âl eş-Şeyh:</strong> Allah’tan takva üzere kurulduğunu ve selefin metoduna bağlı kalmaya özen gösterdiğini düşündüğümüz bu dernekle iftihar ediyoruz. Bu satırları okuyan herkesi, program ve çalışmalarının hayata geçirilmesine katkıda bulunmaya ve bağış yapmaya davet ediyorum. Zira onların çalışmaları her yerde hayırlı ve büyüktür. Şeyh Salih bin Abdulaziz Âl eş-Şeyh – Suudi Arabistan İslam İşleri Bakanı.</p>
</div>'
            ],

        ]);
        //bank
        Page::create(['page_category_id'=>null,
            'header_show' => null,
            'special' => null,
            'locked' => 1,
            'ar' => ['name' => 'حسابتنا البنكية', 'description' => '<p>&nbsp;</p>
<h2 style="text-align: center;"><strong><span class="banka">GARANTİ BBVA</span></strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>العملة</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>رقم الحساب</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>رقم الأيبان</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2 style="text-align: center;"><strong>ZİRAAT KATILIM BANKASI</strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>D&Ouml;VİZ</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>HESAP NO</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>IBAN</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>'],
            'en' => ['name' => 'حسابتنا البنكية', 'description' => '<p>&nbsp;</p>
<h2 style="text-align: center;"><strong><span class="banka">GARANTİ BBVA</span></strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>العملة</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>رقم الحساب</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>رقم الأيبان</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2 style="text-align: center;"><strong>ZİRAAT KATILIM BANKASI</strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>D&Ouml;VİZ</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>HESAP NO</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>IBAN</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>'],
            'tr' => [
                'name' => 'Banka Hesaplarımız',
                'description' => '<p>&nbsp;</p>
<h2 style="text-align: center;"><strong><span class="banka">GARANTİ BBVA</span></strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>Para Birimi</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>Hesap Numarası</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>IBAN</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>

<h2 style="text-align: center;"><strong>ZİRAAT KATILIM BANKASI</strong></h2>
<p>&nbsp;</p>
<table class="tg" style="table-layout: fixed; width: 100%; height: 78.3752px;">
<tbody>
<tr style="height: 19.5938px;">
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>Para Birimi</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>Hesap No</strong></td>
<td class="tg-7btt" style="height: 19.5938px; width: 33.3618%;"><strong>IBAN</strong></td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>TL</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;6294432</td>
<td class="tg-0r18" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR98 0006 2000 0620 0006 2944 32</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>USD</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076844</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR35 0006 2000 0620 0009 0768 44</td>
</tr>
<tr style="height: 19.5938px;">
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;"><strong>EUR</strong></td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;9076843</td>
<td class="tg-c3ow" style="height: 19.5938px; width: 33.3618%;">&nbsp;TR62 0006 2000 0620 0009 0768 43</td>
</tr>
</tbody>
</table>'
            ],

        ]);
    }
}
