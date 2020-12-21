<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::truncate();
        Language::insert(
            [
                [
                    'name' => "English",
                    'code' => "en",
                    'order' => 1
                ],
                [
                    'name' => "Spanish",
                    'code' => "es",
                    'order' => 2
                ],
                [
                    'name' => "French",
                    'code' => "fr",
                    'order' => 3
                ],
                [
                    'name' => "German",
                    'code' => "de",
                    'order' => 4
                ],
                [
                    'name' => "Italian",
                    'code' => "it",
                    'order' => 5
                ],
                [
                    'name' => "Danish",
                    'code' => "da",
                    'order' => 6
                ],
                [
                    'name' => "Russian",
                    'code' => "ru",
                    'order' => 7
                ],
            ]
        );

        session([
            'getLanguage'           => findLanguage(),
            'findActiveLanguage'    => findActiveLanguage(),
            'findFrontLanguage'     => findFrontLanguage()
        ]);
    }
}
