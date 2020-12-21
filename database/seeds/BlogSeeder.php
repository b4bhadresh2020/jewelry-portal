<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Blog;

class BlogSeeder extends Seeder
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

        foreach (range(1, 50) as $index) {
            $title                  = $faker->words(rand(2, 5), true);
            $short_description      = $faker->words(rand(5, 7), true);
            $long_description       = $faker->paragraph . "<br>" . $faker->paragraph . "<br>" . $faker->paragraph;

            $blogTranslations = [];
            foreach ($languages as $lang) {
                $blogTranslations['title:' . $lang->code] = $title;
                $blogTranslations['short_description:' . $lang->code] = $short_description;
                $blogTranslations['long_description:' . $lang->code] = $long_description;
            }

            Blog::create(array_merge($blogTranslations, [
                'image' => $this->copyBanner()
            ]));
        }
    }

    function copyBanner()
    {
        $imgArr = [
            "blog-1.jpg",
            "blog2.jpg",
            "blog-2.jpg",
            "blog3.jpg",
            "blog-3.jpg",
            "blog4.jpg",
            "blog5.jpg",
            "blog6.jpg",
            "bestsellers1.png"
        ];
        $fileName = $imgArr[rand(0, 8)];
        $fromPath = 'assets/img/' . $fileName;

        $destPath = 'media/blog' . $fileName;
        copyFilePublicToStorage($fromPath, $destPath);

        return $destPath;
    }
}
