<?php

namespace App\Repositories\Attribute;

use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Attribute;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\Storage;

class AttributeRepository implements AttributeRepositoryInterface
{
    /**
     * @param Request $request
     * @return Attribute
     */
    public function store($request)
    {
        $data = $request->except('image');
        $attribute = Attribute::create($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->hashMedia($attribute, $image);
        }

        return $attribute;
    }

    /**
     * @param int $id
     * @return Attribute
     */
    public function findById($id)
    {
        return  Attribute::find($id);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return boolean
     */
    public function update($request, $id)
    {
        $data = $request->except('_token', '_method', 'image');
        $attribute = $this->findById($id)->update($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->hashMedia($this->findById($id), $image);
        }
        return $attribute;
    }

    /**
     * @param Request $request
     * @return Attribute
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Attribute::orderBy('order', 'ASC')->paginate($items);
    }

    /**
     * @return Attribute[id, lang.name]
     */
    public function findByStatus($status)
    {
        return Attribute::select('id')
            ->where('status', $status)->get();
    }

    public function findByCategoryId($categoryId)
    {
        $category = Category::where('status', Category::PUBLISH)->find($categoryId);
        return @$category->attributeAssign;
    }

    public function findBySubCategoryId($subCategoryId)
    {
        $subCategory = SubCategory::where('status', SubCategory::PUBLISH)->find($subCategoryId);
        return  @$subCategory->attributeAssign;
    }

    public function assignAttribute($request)
    {
        $data = [];
        if ($request->has('sub_category_id')) {
            $data = SubCategory::find($request->sub_category_id);
        } else {
            $data = Category::find($request->category_id);
        }
        if ($data->attributeAssign) {
            $data->attributeAssign()->delete();
        }
        if ($request->attribute_id) {
            $attributes = array_keys($request->attribute_id);
            foreach ($attributes as $value) {
                $data->attributeAssign()->create(['attribute_id' => $value]);
            }
        }
        return $data;
    }


    /**
     *  @param int $sub_category_id
     *  @return AssignAttribute
     */
    public function findAssignAttributeByCategory($categoryId)
    {
        $assignAttributeId = array_column($this->findByCategoryId($categoryId)->toArray(), 'attribute_id');
        $assignAttribute = Attribute::whereIn('id', $assignAttributeId)->get();
        return $assignAttribute;
    }

    /**
     *  @param int $sub_category_id
     *  @return AssignAttribute
     */
    public function findAssignAttributeBySubCategory($subCategoryId)
    {
        $assignAttributeId = array_column($this->findBySubCategoryId($subCategoryId)->toArray(), 'attribute_id');
        $assignAttribute = Attribute::whereIn('id', $assignAttributeId)->get();
        return $assignAttribute;
    }


    // Other Helper
    /**
     * @param Attribute $attribute
     * @param $request
     */

    function hashMedia($attributeImage, $image)
    {
        $newMediaPath       = Storage::disk()->put('media/attributes', $image);

        if ($attributeImage->wasRecentlyCreated) {
            $attributeImage->media()->create([
                'path' => $newMediaPath,
            ]);
        } else {

            $oldMediaPath       = isset($attributeImage->media->path) ? $attributeImage->media->path : null;
            if ($oldMediaPath) {
                $attributeImage->media()->update([
                    'path' => $newMediaPath
                ]);
                Storage::disk()->delete($oldMediaPath);
            } else {
                $attributeImage->media()->create([
                    'path' => $newMediaPath,
                ]);
            }
        }
    }

    function reorderAttribute($request)
    {
        $newOrder    =    explode(",", $request->sortOrder);
        // dd($newOrder);
        $n  =   0;
        foreach ($newOrder as $id) {
            $attributeUpdate = ['order' => $n];
            $updateOrder = $this->findById($id)->update($attributeUpdate);
            $n++;
        }
        return $updateOrder;
    }
}
