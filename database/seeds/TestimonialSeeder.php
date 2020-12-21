<?php

use Illuminate\Database\Seeder;
use App\Testimonial;
use Faker\Factory as Faker;

class TestimonialSeeder extends Seeder
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

        foreach (range(1, 35) as $index) {
            $name           = $faker->name;
            $role           = $faker->words(2, true);
            $description    = $faker->paragraph;

            $testimonialTranslations = [];
            foreach ($languages as $lang) {
                $testimonialTranslations['name:' . $lang->code]          = $name;
                $testimonialTranslations['role:' . $lang->code]          = $role;
                $testimonialTranslations['description:' . $lang->code]    = $description;
            }
            $testimonial = Testimonial::create($testimonialTranslations);
            $this->addMedia($testimonial);
        }
    }

    public function addMedia($testimonial)
    {
        $testimonial->media()->create([
            'path' => "https://i.pravatar.cc/150?img=" . rand(1, 70),
        ]);
    }
}