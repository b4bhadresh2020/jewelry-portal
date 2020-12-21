<?php

use App\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getLanguage = findLanguage();
        $services = $this->servicesList();
        foreach ($services as $key => $service) {
            $serviceArr = [];
            $serviceArr['title'] = $service['title'];
            $serviceArr['subtitle'] = $service['subtitle'];
            $serviceData = Seller::create($serviceArr);
            $this->addMedia($serviceData, $key);
        }
    }
    public function servicesList()
    {
        return [
            [
                'title' => "BEST",
                'subtitle' => "DESIGNS"
            ],
            [
                'title' => "CERTIFIED",
                'subtitle' => "JEWELLERY"
            ],
            [
                'title' => "EASY",
                'subtitle' => "EXCHANGE"
            ],
            [
                'title' => "FREE",
                'subtitle' => "INSURANCE"
            ],
            [
                'title' => "LIFE TIME",
                'subtitle' => "EXCHANGE"
            ],
            [
                'title' => "BEST",
                'subtitle' => "DESIGNS"
            ],
            [
                'title' => "CERTIFIED",
                'subtitle' => "JEWELLERY"
            ],
            [
                'title' => "EASY",
                'subtitle' => "EXCHANGE"
            ],
            [
                'title' => "FREE",
                'subtitle' => "INSURANCE"
            ],
            [
                'title' => "EASY",
                'subtitle' => "EXCHANGE"
            ],
        ];
    }

    public function addMedia($serviceData, $key)
    {
        $imgArr = [
            "bestsellers1.png",
            "bestsellers2.png",
            "bestsellers3.png",
            "bestsellers4.png",
            "bestsellers5.png",
            "bestsellers6.png",
            "bestsellers7.png",
            "bestsellers8.png",
            "bestsellers9.png",
            "bestsellers10.png",
        ];

        $fileName = $imgArr[$key];
        $fromPath = 'assets/img/' . $fileName;

        $destPath = 'media/services/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPath);

        $serviceData->media()->create([
            'path' => $destPath,
        ]);
    }
}
