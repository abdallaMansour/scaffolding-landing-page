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
            'phone' => '+966501206599',
            'email' => 'info@asos.sa',
            'whatsapp' => '+966501206599',
            'facebook' => 'this is my facebook',
            'instagram' => 'this is my instagram',
            'x' => 'this is my x',
            'linkedin' => 'https://www.linkedin.com/company/2ososelbnaa/?originalSubdomain=sa',

            'footer_description:en' => 'Asos Al-Qimma Company is your ideal partner in construction and building. If you have any inquiries or need more information about our services, please do not hesitate to get in touch with us. We are here to serve you and provide the support needed to realize your vision for your project.',
            'site_name:en' => 'Asos',
            'footer_description:ar' => 'شركة أسس القمة هي شريكك المثالي في مجال البناء والتشييد. إذا كانت لديك أي استفسارات أو تحتاج إلى مزيد من المعلومات حول خدماتنا، لا تتردد في التواصل معنا. نحن هنا لخدمتك وتقديم الدعم اللازم لتحقيق رؤيتك في مشروعك.',
            'site_name:ar' => 'أسس',
        ];
    }
}
