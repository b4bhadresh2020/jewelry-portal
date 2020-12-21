<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->offerList() as $offer) {
            $levelOneMenu = Offer::create(array_merge($this->getLangData($offer), [
                'header'  =>  $offer['header'],
                'title' =>  $offer['title'],
                'description' =>  $offer['description'],
                'link_text' =>  $offer['link_text'],
                'link_url' =>  $offer['link_url'],
                'offer_image' =>  $this->copyImage($offer['offer_image']),
            ]));
        }
    }

    public function offerList()
    {
        return [
            [
                'header' => null,
                'title'  =>  'THE KAY RING  CUSTOMIZER',
                'description'  => '20% OFF',
                'link_text'  =>  'Show Now',
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'benner-pattern.png',
            ],
            [
                'header' => null,
                'title'  =>  'ENGAGEMENT RINGS',
                'description'  =>  '20% OFF',
                'link_text'  =>  'Show Now',
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'benner-pattern.png',
            ],
            [
                'header' => null,
                'title'  =>  'PEARL  BRACELET',
                'description'  =>  '20% OFF',
                'link_text'  =>  'Show Now',
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'benner-pattern.png',
            ],
            [
                'header' => 'Up To 30% Off',
                'title'  =>  'DIAMOND ENGAGEMENT RING',
                'description'  =>  'Find Your Perfect Match In Our Wedding Ring Collection',
                'link_text'  =>  'Show Now',
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'signal-block.png',
            ],
            [
                'header' => null,
                'title'  => null,
                'description'  => null,
                'link_text'  => null,
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'product-left.jpg',
            ],
            [
                'header' => null,
                'title'  => null,
                'description'  => null,
                'link_text'  => null,
                'link_url'  =>  'http://127.0.0.1:8000/',
                'offer_image'  => 'product-left.jpg',
            ],
        ];
    }

    public function getLangData($menu)
    {
        $LanguageList   = findLanguage();
        $temp = [];
        foreach ($LanguageList as  $item) {
            $temp['title:' . $item->code] = $menu['title'] . ($item->code == "en" ? '' : " " . $item->code);
        }
        return $temp;
    }

    function copyImage($fileName)
    {

        $fromPath = 'assets/img/' . $fileName;

        $destPathForDesktop = 'media/offerProduct/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPathForDesktop);

        return $destPathForDesktop;
    }
}
