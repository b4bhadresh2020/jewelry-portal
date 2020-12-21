<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
            foreach ($getLanguage as $item) {
                $serviceArr['title:' . $item->code] = $service['title'];
                $serviceArr['description:' . $item->code] = $service['description'];
            }
            $serviceData = Service::create($serviceArr);
            $this->addMedia($serviceData, $key);
        }
    }
    public function servicesList()
    {
        return [
            [
                'title' => "BEST",
                'description' => "DESIGNS"
            ],
            [
                'title' => "CERTIFIED",
                'description' => "JEWELLERY"
            ],
            [
                'title' => "EASY",
                'description' => "EXCHANGE"
            ],
            [
                'title' => "FREE",
                'description' => "INSURANCE"
            ],
            [
                'title' => "LIFE TIME",
                'description' => "EXCHANGE"
            ],
            [
                'title' => "BIS",
                'description' => "HALLMARKED"
            ],
            [
                'title' => "CUSTOMIZATION",
                'description' => "OPTIONS"
            ]
        ];
    }

    public function addMedia($serviceData, $key)
    {
        $imgArr = [
            "services-1.jpg",
            "services-2.jpg",
            "services-3.jpg",
            "services-4.jpg",
            "services-5.jpg",
            "services-6.jpg",
            "services-7.jpg",
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