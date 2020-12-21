<?php

namespace App\Http\Controllers;

use App\User;
use App\Attribute;
use App\Category;
use App\Media;
use App\Option;
use App\Product;
use App\ProductAttribute;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Activitylog\Models\Activity;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{
    public function __construct(
        CategoryRepositoryInterface $category,
        SubCategoryRepositoryInterface $subCategory,
        ProductRepositoryInterface $product,
        ProductAttributeRepositoryInterface $productAttribute
    ) {
        $this->category = $category;
        $this->subCategory = $subCategory;
        $this->product = $product;
        $this->productAttribute = $productAttribute;
    }

    public function index()
    {
        $this->__usefullPlugin();
        $this->__testTranslations();
        $this->__testLiveWire();
        $this->__testActivityLog();
        $this->__testFileUpload();
        $this->__testCart();
        $this->__testProductModule();
    }

    function __usefullPlugin()
    {
        /**
         * https://github.com/Astrotomic/laravel-translatable
         * https://laravel-livewire.com/docs/2.x/quickstart
         * https://spatie.be/docs/laravel-activitylog/v3/introduction
         * https://github.com/Crinsane/LaravelShoppingcart
         * https://github.com/darryldecode/laravelshoppingcart
         */
    }

    function __testTranslations()
    {
        // echo "<h1>Welcome In Testing Mode</h1><br>";

        //create new main category
        // $data = [
        //     'en' => ['name' => 'Testing English'],
        // ];
        // $mainCategory = Category::create($data);

        // $data = [
        //     'en' => ['name' => 'dsgtdf English'],
        // ];
        // Category::find(24)->update($data);

        //get any main category
        // $mainCategory = Category::first()->toArray();
        // return  $mainCategory;

        // App::setLocale('fr');
        // $mainCategory = Category::first();
        // echo  $mainCategory->name;
        // echo "<br>";
        // echo  $mainCategory->translate('en')->name;


        // update any with multiple language in main category
        // $data = [
        //     'en' => ['name' => 'Earrings Update In English'],
        //     'fr' => ['name' => 'Earrings Update In french'],
        // ];
        // $mainCategory = Category::first()->update($data);

        // update any with single language in main category
        // $data = [
        //     'en' => ['name' => 'Earrings In English'],
        // ];
        // $mainCategory = Category::first()->update($data);


        // delete all translations
        // Category::first()->deleteTranslations();

        // delete french translation
        // Category::first()->deleteTranslations('fr');

        // delete french and english translation
        // Category::first()->deleteTranslations(['fr', 'en']);

        //delete any full
        // Category::find(22)->deleteTranslations();
        // Category::find(22)->delete();


        //upload image with new category
        // $data = [
        //     'en' => ['name' => 'Earrings In English'],
        //     'fr' => ['name' => 'Earrings In french'],
        // ];
        // $mainCategory = Category::create($data);
        // $mainCategory->media()->create([
        //     'name' => "Earrings name",
        //     'path' => "testing/path/example_of_earrings.png",
        // ]);

        // Media::create([
        //     'name' => "testing name",
        //     'path' => "testing/path/example_of_ring.png",
        //     'mediaable' => "test mediaable",
        //     'mediaable_id' => "123",
        // ]);

        // Media::find(1)->update([
        //     'path' => 'testing.png'
        // ]);

        // $data = [
        //     'category_id' => 2,
        //     'en' => ['name' => 'Ear Earrings In English'],
        //     'fr' => ['name' => 'Ear Earrings Ring In french'],
        // ];
        // $subCategory = SubCategory::create($data);
        // $subCategory->media()->create([
        //     'name' => "Ear Earrings name",
        //     'path' => "testing/path/example.png",
        // ]);

        // $subCategory = SubCategory::first();
        // echo $subCategory->category->name;

        // search in main category translation
        // $mainCategory = Category::whereTranslation('name','Ring In English')->get();
        // dd($mainCategory->toArray());

        // search in sub category translation
        // $subCategory = SubCategory::whereTranslation('name','Ear Earrings Ring In french')->get();
        // dd($subCategory->toArray());

        // search in sub category based on main category id
        // App::setLocale('fr');
        // $subCategory = SubCategory::whereHas('category',function($query){
        //     $query->where('id',2);
        // })->get();
        // dd($subCategory->toArray());

        // search in sub category based on main category name in translation table
        // $subCategory = SubCategory::whereHas('category',function($query){
        //     $query->whereTranslation('name','Ring In English');
        // })->get();
        // dd($subCategory->toArray());
    }

    function __testLiveWire()
    {
        /*

            livewire php to js trigger
                //php
                $this->dispatchBrowserEvent('name-updated', ['newName' => 1233]);
                // js
                <script>
                    window.addEventListener('name-updated', event => {
                        alert('Name updated to: ' + event.detail.newName);
                    })
                </script>
            // other
                    wire:submit.prevent="search($event.target.innerText)"
                    $this->runJs('alert("1");');
        */
    }

    function __testFileUpload()
    {
        // $mainCategory = Category::create($request->except([
        //     'image'
        // ]));
        // if ($request->hasFile('image')) {
        //     $image              = $request->file('image');
        //     $fileName           = Storage::disk()->put('media/categories/', $image);
        //     $mainCategory->media()->create([
        //         'path' => $fileName,
        //     ]);
        // }

        // $faker = Faker::create();
        // $image = $faker->image();
        // $imageFile = new File($image);
        // return $newMediaPath = Storage::disk()->put('fackers', $imageFile);

        // Copy Any File From public folder to storage folder
        // $fileName = "Banner-1.png";
        // $fromPath = public_path('assets/img/' . $fileName);
        // $destPath = storage_path('app/public/b');

        // if (!File::exists($destPath)) {
        //     File::makeDirectory($destPath, 0777, true, true);
        // }
        // File::copy($fromPath, $destPath . "/" . $fileName);

        // or
        // $fileName = "Banner-1.png";
        // $fromPath = 'assets/img/' . $fileName;
        // $destPath = 'b/' . $fileName;
        // copyFilePublicToStorage($fromPath, $destPath);


    }

    function __testActivityLog()
    {
        // activity()->log('Look mum, I logged something');

        // return Activity::all();

        // activity('log_name')
        //     ->performedOn(Category::first()) // subject
        //     ->causedBy(User::first()) // activity by user
        //     // ->withProperties(['customProperty' => 'customValue']) // if any other fields we can store in this
        //     ->log('Look mum, I logged something'); // msg]
    }

    function __testProductModule()
    {
        // dd(ProductAttribute::first()->defaultImage->media[0]->path);
        // dd(ProductAttribute::first()->images);

        // $product1 = Product::query()->with(['category.attributeAssign'])->first();
        // $product2 = Product::query()->with(['subCategory.attributeAssign'])->first();
        // dd([$product1, $product2]);

        // $product = Product::find(1)->attributes();
        // dd($product);
        // $products = Product::query()
        //     ->when(
        //         $product->isSubCategory(),
        //         function ($query) {
        //             return $query->with(['subCategory.attributeAssign']);
        //         },
        //         function ($query) {
        //             return $query->with(['category.attributeAssign']);
        //         }
        //     )
        //     ->first();
        // if ($product->isSubCategory()) {
        //     dd($products->subCategory->attributeAssign[0]->attribute->name);
        // } else {
        //     dd($products->category->attributeAssign[0]->attribute->name);
        // }
        // $getAttribute = Product::find(1)->attributes();
        // $attributes = [];
        // foreach ($getAttribute as $attribute) {
        //     $options = [];
        //     foreach ($attribute->attribute->option as $option) {
        //         $options[] = [
        //             'id' => $option->id,
        //             'name' => $option->name,
        //         ];
        //     }


        //     $item = [
        //         'id' => $attribute->attribute->id,
        //         'name' => $attribute->attribute->name,
        //         'options' => $options
        //     ];

        //     $attributes[] = $item;
        // }
        // dd($attributes);

        // $product = Product::find(1);
        // dd($product);

        // $defaultAttribute = $this->product->findDefaultAttributeBySlug("ipsam-iste-et-repellat-quis");
        // dd($defaultAttribute->product->relatedProducts());
        // $defaultAttribute->product->attributes()[1]->attribute->name;

    }

    function __testCart()
    {
    }
}
