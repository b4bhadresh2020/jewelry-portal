<?php

use App\Category;
use App\Collection;
use App\Option;
use App\Product;
use App\ProductAttribute;
use App\ProductCollection;
use App\ProductImage;
use App\ProductPrice;
use App\ProductVariation;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Option\OptionRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\SubCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\File;


class ProductSeeder extends Seeder
{

    private  $category, $subCategory, $attribute, $option, $product;

    public function __construct(
        CategoryRepositoryInterface $category,
        SubCategoryRepositoryInterface $subCategory,
        AttributeRepositoryInterface $attribute,
        OptionRepositoryInterface $option,
        ProductRepositoryInterface $product
    ) {
        $this->subCategory  = $subCategory;
        $this->category     = $category;
        $this->attribute    = $attribute;
        $this->option       = $option;
        $this->product      = $product;
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

        foreach (range(1, 25) as $index) {
            $title = $slug  = $faker->words(rand(2, 5), true);
            $description    = $faker->paragraph;

            $productTranslations = [];
            foreach ($languages as $lang) {
                $productTranslations['title:' . $lang->code]          = $title;
                $productTranslations['description:' . $lang->code]    = $description .' '. $description .' '. $description;
                $productTranslations['sort_description:' . $lang->code]    = $description;

            }

            $categoryOrSub  = $this->getRandomCategoryOrSub();
            $categoryId     = $categoryOrSub['is_categry'] ? $categoryOrSub['id'] : null;
            $subCategoryId  = $categoryOrSub['is_categry'] ? null : $categoryOrSub['id'];
            $attributes     = $this->getAttributes($categoryId, $subCategoryId);

            // Create Product Based On random Category or Sub Category
            $product = Product::create(array_merge($productTranslations, [
                'slug'              => $slug,
                'status_id'         => 1,
                'step'              => 1,
                'category_id'       => $categoryId,
                'sub_category_id'   => $subCategoryId,
                'is_custom'         => 0
            ]));

            for ($i = 0; $i < rand(1, 3); $i++) {
                ProductCollection::create([
                    'product_id'    => $product->id,
                    'collection_id' =>  Collection::inRandomOrder()->first()->id
                ]);
            }

            // $attributesList = $optionList = $skuList = $stokList = $isDefaultList = $mrpList = $sellMrpList = [];
            $sku = '';
            for ($i = 0; $i < rand(2, 4); $i++) {
                $mrp = rand(1000, 500000);
                $sku          = Str::random(6);
                $stok         = rand(20, 500);
                $sellMrp      = $mrp;
                $mrp          = $mrp + rand(50, 3000);

                $storeAttributesArr = [
                    'product_id'            => $product->id,
                    'sku'                   => $sku,
                    'stock'                 => $stok,
                    'is_default'            => ($i == 0) ? 1 : 0,
                    'status_id'             => ProductAttribute::PUBLISH,
                ];
                $prosduct_attributes = ProductAttribute::create($storeAttributesArr);
                $sku = $prosduct_attributes->sku;
                $productPrice = [
                    'sku'               => $sku,
                    'mrp'               => $mrp,
                    'sell_price'        => $sellMrp,
                ];
                ProductPrice::create($productPrice);

                $getAttribute = $product->attributes();
                foreach ($getAttribute as $attribute) {
                    $options = [];
                    foreach ($attribute->attribute->option as $option) {
                        $options[] = $option->id;
                    }
                    $option_id = array_rand($options);

                    $item = [
                        'product_id' => $product->id,
                        'attribute_id' => $attribute->attribute_id,
                        'option_id' => $options[$option_id],
                        'sku' => $sku,
                        'product_id' => $product->id
                    ];
                    ProductVariation::create($item);
                }
                // $sku
                $productDefaultImg = ProductImage::create([
                    'sku' => $sku,
                    'is_default' => 1,
                ]);
                $productDefaultImg->media()->create($this->copyBanner(rand(1, 10)));
                foreach (range(1, 2) as $item) {
                    $productMultiImg = ProductImage::create([
                        'sku' => $sku,
                    ]);
                    $productMultiImg->media()->create($this->copyBanner(rand(0, 11)));
                }
            }
            if (Product::count() > 0) {
                $product->related_products =  implode(",", array_column(Product::inRandomOrder()->limit(4)->get()->toArray(), 'id'));
            }
            $product->step = 2;
            $product->status_id = 2;
            $product->save();
        }
    }

    /**
     * Other Helper Function
     */

    /**
     * get Random Category Or Sub Category
     */
    public function getRandomCategoryOrSub()
    {
        if (rand(0, 1) == 1) {
            return [
                'is_categry' =>  true,
                'id'         => Category::whereNotIn('id', SubCategory::pluck('category_id'))->inRandomOrder()->first()->id
            ];
        } else {
            return [
                'is_categry' => false,
                'id'         => SubCategory::inRandomOrder()->first()->id
            ];
        }
    }

    /**
     * Get assign attribute of category and sub category
     */
    public function getAttributes(...$args)
    {
        if ($args[0]) {
            return $this->attribute->findByCategoryId($args[0]);
        } else {
            return $this->attribute->findBySubCategoryId($args[1]);
        }
    }

    function copyBanner($index)
    {
        $imgArr = [
            "blog-2.jpg",
            "blog-3.jpg",
            "category1.jpg",
            "category2.jpg",
            "category3.jpg",
            "category4.jpg",
            "category5.jpg",
            "product1.jpg",
            "product2.jpg",
            "product3.jpg",
            "product4.jpg",
            "product5.jpg",
        ];
        $fileName = $imgArr[$index];
        $fromPath = 'assets/img/' . $fileName;

        $destPath = 'media/products/' . $fileName;
        copyFilePublicToStorage($fromPath, $destPath);

        return [
            'path'   => $destPath,
        ];
    }
}
