<?php

use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Http\Request;

class BannerSeeder extends Seeder
{

    public function __construct(BannerRepositoryInterface $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Faker::create();
        $languages      = findLanguage();
        foreach (range(0, 3) as $index) {

            $header         = $faker->words(rand(2, 5), true);
            $title          = $faker->words(rand(2, 5), true);
            $link_text      = $faker->words(2, true);
            $description    = $faker->words(rand(2, 5), true);

            $bannerTranslations = [];
            foreach ($languages as $lang) {
                $bannerTranslations['header:' . $lang->code]        = $header;
                $bannerTranslations['title:' . $lang->code]         = $title;
                $bannerTranslations['link_text:' . $lang->code]     = $link_text;
                $bannerTranslations['description:' . $lang->code]   = $description;
            }

            $bannerImgArr = $this->copyBanner($index);
            $storableArr = (array_merge($bannerTranslations, [
                'link_url'          => "http://127.0.0.1:8000/",
                'position'          => $index,
                'banner'            => $bannerImgArr["desktop"],
                'mobile_banner'     => $bannerImgArr["mobile"],
            ]));

            $this->banner->seederStore($storableArr);
        }
    }


    function copyBanner($index)
    {
        $imgArr = [
            "Slider-1.jpg",
            "Slider-2.jpg",
            "Slider-3.jpg",
            "Slider-4.jpg"
        ];
        $fileName = $imgArr[$index];
        $fromPath = 'assets/img/' . $fileName;

        $destPathForDesktop = 'media/banner/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPathForDesktop);
        $destPathForMobile = 'media/mobileBanner/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPathForMobile);

        return [
            'desktop'   => $destPathForDesktop,
            'mobile'    => $destPathForMobile,
        ];
    }
}