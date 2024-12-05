<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = Setting::create($this->articles());

        $contact->addMedia(__DIR__ . '/setting_img/logo.svg')->preservingOriginal()->toMediaCollection();
    }

    public function articles(): array
    {
        return [
            'address:ar' => 'المؤنسية طريق الشيخ حسن بن حسين بن علي',
            'address:en' => 'Al Cheikh Hasan Ibn Hussein Ibn Ali, Al Munsiyah, Riyadh 13246',
            'phone' => '+01019113472',
            'email' => 'info@info.com',
            'whatsapp' => 'https://wa.me/201019113472',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instegram.com',
            'x' => 'https://x.com',
            'linkedin' => 'https://linkedin.com',

            'footer_description:en' => 'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
            'footer_description:ar' => 'لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.',
        ];
    }
}
