<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayasTableSeeder extends Seeder
{
    public function run()
    {
        $wilayas = [
            ['wilaya_code' => 1, 'wilaya_name_fr' => 'Adrar', 'wilaya_name_ar' => 'أدرار'],
            ['wilaya_code' => 2, 'wilaya_name_fr' => 'Chlef', 'wilaya_name_ar' => 'الشلف'],
            ['wilaya_code' => 3, 'wilaya_name_fr' => 'Laghouat', 'wilaya_name_ar' => 'الأغواط'],
            ['wilaya_code' => 4, 'wilaya_name_fr' => 'Oum El Bouaghi', 'wilaya_name_ar' => 'أم البواقي'],
            ['wilaya_code' => 5, 'wilaya_name_fr' => 'Batna', 'wilaya_name_ar' => 'باتنة'],
            ['wilaya_code' => 6, 'wilaya_name_fr' => 'Béjaïa', 'wilaya_name_ar' => 'بجاية'],
            ['wilaya_code' => 7, 'wilaya_name_fr' => 'Biskra', 'wilaya_name_ar' => 'بسكرة'],
            ['wilaya_code' => 8, 'wilaya_name_fr' => 'Béchar', 'wilaya_name_ar' => 'بشار'],
            ['wilaya_code' => 9, 'wilaya_name_fr' => 'Blida', 'wilaya_name_ar' => 'البليدة'],
            ['wilaya_code' => 10, 'wilaya_name_fr' => 'Bouira', 'wilaya_name_ar' => 'البويرة'],
            ['wilaya_code' => 11, 'wilaya_name_fr' => 'Tamanrasset', 'wilaya_name_ar' => 'تمنراست'],
            ['wilaya_code' => 12, 'wilaya_name_fr' => 'Tébessa', 'wilaya_name_ar' => 'تبسة'],
            ['wilaya_code' => 13, 'wilaya_name_fr' => 'Tlemcen', 'wilaya_name_ar' => 'تلمسان'],
            ['wilaya_code' => 14, 'wilaya_name_fr' => 'Tiaret', 'wilaya_name_ar' => 'تيارت'],
            ['wilaya_code' => 15, 'wilaya_name_fr' => 'Tizi Ouzou', 'wilaya_name_ar' => 'تيزي وزو'],
            ['wilaya_code' => 16, 'wilaya_name_fr' => 'Alger', 'wilaya_name_ar' => 'الجزائر'],
            ['wilaya_code' => 17, 'wilaya_name_fr' => 'Djelfa', 'wilaya_name_ar' => 'الجلفة'],
            ['wilaya_code' => 18, 'wilaya_name_fr' => 'Jijel', 'wilaya_name_ar' => 'جيجل'],
            ['wilaya_code' => 19, 'wilaya_name_fr' => 'Sétif', 'wilaya_name_ar' => 'سطيف'],
            ['wilaya_code' => 20, 'wilaya_name_fr' => 'Saïda', 'wilaya_name_ar' => 'سعيدة'],
            ['wilaya_code' => 21, 'wilaya_name_fr' => 'Skikda', 'wilaya_name_ar' => 'سكيكدة'],
            ['wilaya_code' => 22, 'wilaya_name_fr' => 'Sidi Bel Abbès', 'wilaya_name_ar' => 'سيدي بلعباس'],
            ['wilaya_code' => 23, 'wilaya_name_fr' => 'Annaba', 'wilaya_name_ar' => 'عنابة'],
            ['wilaya_code' => 24, 'wilaya_name_fr' => 'Guelma', 'wilaya_name_ar' => 'قالمة'],
            ['wilaya_code' => 25, 'wilaya_name_fr' => 'Constantine', 'wilaya_name_ar' => 'قسنطينة'],
            ['wilaya_code' => 26, 'wilaya_name_fr' => 'Médéa', 'wilaya_name_ar' => 'المدية'],
            ['wilaya_code' => 27, 'wilaya_name_fr' => 'Mostaganem', 'wilaya_name_ar' => 'مستغانم'],
            ['wilaya_code' => 28, 'wilaya_name_fr' => 'M\'Sila', 'wilaya_name_ar' => 'المسيلة'],
            ['wilaya_code' => 29, 'wilaya_name_fr' => 'Mascara', 'wilaya_name_ar' => 'معسكر'],
            ['wilaya_code' => 30, 'wilaya_name_fr' => 'Ouargla', 'wilaya_name_ar' => 'ورقلة'],
            ['wilaya_code' => 31, 'wilaya_name_fr' => 'Oran', 'wilaya_name_ar' => 'وهران'],
            ['wilaya_code' => 32, 'wilaya_name_fr' => 'El Bayadh', 'wilaya_name_ar' => 'البيض'],
            ['wilaya_code' => 33, 'wilaya_name_fr' => 'Illizi', 'wilaya_name_ar' => 'إليزي'],
            ['wilaya_code' => 34, 'wilaya_name_fr' => 'Bordj Bou Arreridj', 'wilaya_name_ar' => 'برج بوعريريج'],
            ['wilaya_code' => 35, 'wilaya_name_fr' => 'Boumerdès', 'wilaya_name_ar' => 'بومرداس'],
            ['wilaya_code' => 36, 'wilaya_name_fr' => 'El Tarf', 'wilaya_name_ar' => 'الطارف'],
            ['wilaya_code' => 37, 'wilaya_name_fr' => 'Tindouf', 'wilaya_name_ar' => 'تندوف'],
            ['wilaya_code' => 38, 'wilaya_name_fr' => 'Tissemsilt', 'wilaya_name_ar' => 'تيسمسيلت'],
            ['wilaya_code' => 39, 'wilaya_name_fr' => 'El Oued', 'wilaya_name_ar' => 'الوادي'],
            ['wilaya_code' => 40, 'wilaya_name_fr' => 'Khenchela', 'wilaya_name_ar' => 'خنشلة'],
            ['wilaya_code' => 41, 'wilaya_name_fr' => 'Souk Ahras', 'wilaya_name_ar' => 'سوق أهراس'],
            ['wilaya_code' => 42, 'wilaya_name_fr' => 'Tipaza', 'wilaya_name_ar' => 'تيبازة'],
            ['wilaya_code' => 43, 'wilaya_name_fr' => 'Mila', 'wilaya_name_ar' => 'ميلة'],
            ['wilaya_code' => 44, 'wilaya_name_fr' => 'Aïn Defla', 'wilaya_name_ar' => 'عين الدفلى'],
            ['wilaya_code' => 45, 'wilaya_name_fr' => 'Naâma', 'wilaya_name_ar' => 'النعامة'],
            ['wilaya_code' => 46, 'wilaya_name_fr' => 'Aïn Témouchent', 'wilaya_name_ar' => 'عين تموشنت'],
            ['wilaya_code' => 47, 'wilaya_name_fr' => 'Ghardaïa', 'wilaya_name_ar' => 'غرداية'],
            ['wilaya_code' => 48, 'wilaya_name_fr' => 'Relizane', 'wilaya_name_ar' => 'غليزان'],
            ['wilaya_code' => 49, 'wilaya_name_fr' => 'Timimoun', 'wilaya_name_ar' => 'تيميمون'],
            ['wilaya_code' => 50, 'wilaya_name_fr' => 'Bordj Badji Mokhtar', 'wilaya_name_ar' => 'برج باجي مختار'],
            ['wilaya_code' => 51, 'wilaya_name_fr' => 'Ouled Djellal', 'wilaya_name_ar' => 'أولاد جلال'],
            ['wilaya_code' => 52, 'wilaya_name_fr' => 'Béni Abbès', 'wilaya_name_ar' => 'بني عباس'],
            ['wilaya_code' => 53, 'wilaya_name_fr' => 'In Salah', 'wilaya_name_ar' => 'عين صالح'],
            ['wilaya_code' => 54, 'wilaya_name_fr' => 'In Guezzam', 'wilaya_name_ar' => 'عين قزام'],
            ['wilaya_code' => 55, 'wilaya_name_fr' => 'Touggourt', 'wilaya_name_ar' => 'تقرت'],
            ['wilaya_code' => 56, 'wilaya_name_fr' => 'Djanet', 'wilaya_name_ar' => 'جانت'],
            ['wilaya_code' => 57, 'wilaya_name_fr' => 'El M\'Ghair', 'wilaya_name_ar' => 'المغير'],
            ['wilaya_code' => 58, 'wilaya_name_fr' => 'El Meniaa', 'wilaya_name_ar' => 'المنيعة']
        ];

        DB::table('wilayas')->insert($wilayas);
    }
}
