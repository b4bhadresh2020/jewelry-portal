<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\FaqCategory;
use App\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Faker::create();
        $languages      = findLanguage();

        foreach (range(1, 7) as $faqCategoryIndex) {
            $faqCategoryTranslations = [];
            foreach ($languages as $lang) {
                $faqCategoryTranslations['name:' . $lang->code] = $faker->words(rand(2, 5), true);
            }

            $faqCategory = FaqCategory::create(array_merge($faqCategoryTranslations, [
                'status' => 1
            ]));

            foreach (range(1, rand(7, 10)) as $faqIndex) {
                $faqTranslations = [];
                foreach ($languages as $lang) {
                    $faqTranslations['question:' . $lang->code] = $faker->words(rand(5, 6), true);
                    $faqTranslations['answer:' . $lang->code] = $faker->paragraph . " " . $faker->paragraph;
                }

                Faq::create(array_merge($faqTranslations, [
                    'status' => 1,
                    'faq_category_id' => $faqCategory->id
                ]));
            }
        }
    }
}
