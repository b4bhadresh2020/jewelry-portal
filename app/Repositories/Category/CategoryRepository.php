<?php

namespace App\Repositories\Category;

use App\Category;
use App\CategoryImage;
use App\Http\Requests\Admin\CategoryRequest;
use App\SubCategory;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @param $request
     * @return Category
     */
    public function store($request)
    {

        $request->merge(['slug' => request('name:en')]);
        $category = Category::create($request->except([
            'image', 'banner_image', 'offer_image'
        ]));
        if ($request->hasFile('image')) {
            $categoryImage =    CategoryImage::create(['category_id' => $category->id, 'type' => 'category']);
            $image              = $request->file('image');
            $this->hashMedia($categoryImage, $image);
        }

        if ($request->hasFile('banner_image')) {
            $categoryImage =    CategoryImage::create(['category_id' => $category->id, 'type' => 'banner']);
            $image              = $request->file('banner_image');
            $this->hashMedia($categoryImage, $image);
        }

        if ($request->hasFile('offer_image')) {
            $categoryImage =    CategoryImage::create(['category_id' => $category->id, 'type' => 'offer']);
            $image              = $request->file('offer_image');
            $this->hashMedia($categoryImage, $image);
        }

        return $category;
    }

    public function findAll()
    {
        return  Category::where('status', Category::PUBLISH)->get();
    }

    public function findById($id)
    {
        return  Category::find($id);
    }

    public function update($request, $id)
    {
        if (!isset($request->offer_banner_visibility)) {
            $request->merge(['offer_banner_visibility' => 0]);
        }

        $category = $this->findById($id);
        if ($request->hasFile('image')) {
            $categoryImage = CategoryImage::where('category_id', $id)
                ->where('type', 'category')
                ->first();
            if (empty($categoryImage)) {
                $categoryImage =  CategoryImage::create(['category_id' => $id, 'type' => 'category']);
            }
            $image = $request->file('image');
            $this->hashMedia($categoryImage, $image);
        }

        if ($request->hasFile('banner_image')) {
            $categoryImage = CategoryImage::where('category_id', $id)
                ->where('type', 'banner')
                ->first();
            if (empty($categoryImage)) {
                $categoryImage =    CategoryImage::create(['category_id' => $id, 'type' => 'banner']);
            }
            $image = $request->file('banner_image');
            $this->hashMedia($categoryImage, $image);
        }

        if ($request->hasFile('offer_image')) {
            $categoryImage = CategoryImage::where('category_id', $id)
                ->where('type', 'offer')
                ->first();
            if (empty($categoryImage)) {
                $categoryImage =    CategoryImage::create(['category_id' => $id, 'type' => 'offer']);
            }
            $image = $request->file('offer_image');
            $this->hashMedia($categoryImage, $image);
        }
        // $this->hashMedia($category, $request);
        $category->update($request->except([
            'image', 'offer_image', '_token', '_method', 'banner_image'
        ]));

        // Add Log
        activity(config('activitylog.log_name.category', 'other'))
            ->performedOn($category) // subject
            ->causedBy(Auth::user()) // activity by user
            ->log($category->name . ' category edited'); // msg

        return $category;
    }

    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        $status = request('status') ?? Category::PUBLISH;
        return Category::where('status', $status)->paginate($items);
    }

    public function findByStatus($status)
    {
        return Category::select('id')
            ->where('status', $status)
            ->listsTranslations('name')->get();
    }

    // Other Helper
    /**
     * @param Category $category
     * @param $request
     */

    function hashMedia($categoryImage, $image)
    {
        $newMediaPath       = Storage::disk()->put('media/categories', $image);

        if ($categoryImage->wasRecentlyCreated) {
            $categoryImage->media()->create([
                'path' => $newMediaPath,
            ]);
        } else {

            $oldMediaPath       = isset($categoryImage->media[0]->path) ? $categoryImage->media[0]->path : null;
            if ($oldMediaPath) {
                $categoryImage->media()->update([
                    'path' => $newMediaPath
                ]);
                Storage::disk()->delete($oldMediaPath);
            } else {
                $categoryImage->media()->create([
                    'path' => $newMediaPath,
                ]);
            }
        }
    }

    public function findBySlug(string $slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public function changeStatus($id, $status)
    {
        $arr = ['status' => $status];
        $this->findById($id)->update($arr);
        $subCategory = SubCategory::whereIn('category_id', Category::where('id', $id)->pluck('id'))->update($arr);
        return $subCategory;
    }
}
