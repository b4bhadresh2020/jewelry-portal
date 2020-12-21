<?php

use App\Attribute;
use App\Category;
use App\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getLanguage = findLanguage();
        $sub_categories = $this->categoriesList();
        $categories = array_keys($sub_categories);

        foreach ($categories as $key => $category) {
            $categoryArr = [];
            foreach ($getLanguage as $item) {
                $categoryArr['name:' . $item->code] = $category;
            }
            $categoryArr['slug'] = $category;
            $categoryData = Category::create($categoryArr);
            $this->addMedia($categoryData);

            if (count($sub_categories[$category]) != 0) {
                foreach ($sub_categories[$category] as $key1 => $subcategory) {
                    $subCategoryArr = [];
                    $subCategoryArr['category_id'] = $categoryData->id;
                    foreach ($getLanguage as $item) {
                        $subCategoryArr['name:' . $item->code]   = $subcategory;
                    }
                    $subCategoryArr['slug'] = $subcategory;
                    $subCategoryData = SubCategory::create($subCategoryArr);
                    $this->addMedia($subCategoryData, true);
                    $this->assign($subCategoryData);
                }
            } else {
                $this->assign($categoryData);
            }
        }
    }

    public function categoriesList()
    {
        return [
            'EARRINGS' => [
                'STUDS',
                'DROPS',
                'SUO DHAGA',
                'JHUMKAS',
                'CHANDBALI',
            ],
            'RINGS' => [
                'ENGAGEMENT',
                'COUPLE BANDS',
                'OFFICE WEAR',
                'STACKABLE',
                'COCKTAIL',
            ],
            'PENDANTS' => [
                'ALPHABET',
                'RELIGIOUS',
                'HEART SHAPED',
                'LOCKETS',
                'OFFICE WEAR',
            ],
            'NECKLACES' => [
                'MANGALSUTRAS',
                'DIAMOND NECKLACES',
                'PEARL NECKLACES',
                'SOLITAIRE NECKLACES',
                'EVERYDAY WEAR',
            ],
            'Bracelets' => [
                'Bracelets One',
                'Bracelets Two',
                'Bracelets Three',
                'Bracelets Four',
                'Bracelets Five',
            ],
            'Diamonds' => [
                'Diamonds One',
                'Diamonds Two',
                'Diamonds Three',
                'Diamonds Four',
                'Diamonds Five',
            ],
            'Watches' => [
                'Watches One',
                'Watches Two',
                'Watches Three',
                'Watches Four',
                'Watches Five',
            ],
            'Chains' => [
                'Chains One',
                'Chains Two',
                'Chains Three',
                'Chains Four',
                'Chains Five',
            ],
            'Charms' => [
                'Charms One',
                'Charms Two',
                'Charms Three',
                'Charms Four',
                'Charms Five',
            ],
            'Cufflinks' => [
                'Cufflinks One',
                'Cufflinks Two',
                'Cufflinks Three',
                'Cufflinks Four',
                'Cufflinks Five',
            ],
            'Coins' => [
                'Coins One',
                'Coins Two',
                'Coins Three',
                'Coins Four',
                'Coins Five',
            ],
            "GIFT CARD" => [],
            "Neckwear" => [],
            "Other" => []
        ];
    }

    public function addMedia($cat, $isSubCategory = false)
    {
        if ($isSubCategory) {
            $imgArr = [
                "subcategory1.png",
                "subcategory2.png",
                "subcategory3.png",
                "subcategory4.png",
                "subcategory5.png",
                "subcategory6.png",
            ];
            $fileName = $imgArr[rand(0, 5)];
            $fromPath = 'assets/img/' . $fileName;

            $destPath = 'media/subcategory' . $fileName;
            copyFilePublicToStorage($fromPath, $destPath);
            $cat->media()->create([
                'path' => $destPath,
            ]);
        } else {
            $cat->media()->create([
                'path' => "media/categories/" . $cat->name . ".png",
            ]);
        }
    }

    public function assign($cat)
    {
        $attributes = array_column(Attribute::inRandomOrder()->limit(2)->get()->toArray(), 'id');
        foreach ($attributes as $value) {
            $cat->attributeAssign()->create(['attribute_id' => $value]);
        }
    }
}
