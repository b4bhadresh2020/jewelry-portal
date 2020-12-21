<?php

namespace App\Repositories\SubCategory;

use App\Category;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\SubCategory;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Request;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{

    /**
     * @return SubCategory
     */
    public function findAll()
    {
        return SubCategory::all();
    }

    /**
     * @return SubCategory|null
     */
    public function findByStatus($status)
    {
        return SubCategory::where('status', $status)->get();
    }


    /**
     * @return SubCategory
     */
    public function findById($id)
    {
        return  SubCategory::find($id);
    }

    /**
     * @param $request
     * @return SubCategory
     */
    public function store($request)
    {
        $request->merge(['slug' => request('name:en')]);
        $subCategory = SubCategory::create($request->except([
            'image'
        ]));
        $this->hashMedia($subCategory, $request);
        return $subCategory;
    }

    public function update($request, $id)
    {
        $subCategory = SubCategory::find($id);
        $this->hashMedia($subCategory, $request);
        $subCategory->update($request->except([
            'image', '_token', '_method'
        ]));

        // Add Log
        activity(config('activitylog.log_name.category', 'other'))
            ->performedOn($subCategory) // subject
            ->causedBy(Auth::user()) // activity by user
            ->log($subCategory->name . ' sub category edited'); // msg

        return $subCategory;
    }

    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return  app(Pipeline::class)
            ->send(SubCategory::query())
            ->through([
                \App\QueryFilters\SubCategory\CategoryId::class,
                \App\QueryFilters\SubCategory\Status::class,
            ])
            ->thenReturn()
            ->paginate($items);
    }

    public function findSubCategoryByCategoryId($categoryId)
    {
        return SubCategory::select('id')
            ->listsTranslations('name')
            ->where('status', 1)
            ->where('category_id', $categoryId)
            ->get();
    }

    // Other Helper
    /**
     * @param SubCategory $subCategory
     * @param $request
     */
    function hashMedia($subCategory, &$request)
    {
        if ($request->hasFile('image')) {
            $image                  = $request->file('image');
            $newMediaPath           = Storage::disk()->put('media/categories', $image);
            // wasRecentlyCreated is used to check recored is create recently or not
            if ($subCategory->wasRecentlyCreated) {
                $subCategory->media()->create([
                    'path' => $newMediaPath,
                ]);
            } else {
                $oldMediaPath       = isset($subCategory->media->path) ? $subCategory->media->path : null;
                if ($oldMediaPath) {
                    $subCategory->media()->update([
                        'path' => $newMediaPath
                    ]);
                    Storage::disk()->delete($oldMediaPath);
                } else {
                    $subCategory->media()->create([
                        'path' => $newMediaPath,
                    ]);
                }
            }
        }
    }

    public function countByCategoryId($categoryId)
    {
        return SubCategory::select('id')->listsTranslations('name')->where('status', 1)->where('category_id', $categoryId)->count();
    }

    public function findBySlug(string $slug)
    {
        return SubCategory::where('slug', $slug)->first();
    }

    public function changeStatus($id, $status)
    {
        return $this->findById($id)->update(['status' => $status]);
    }
}
