<?php

namespace App\Repositories\CustomSubCategory;

use App\Repositories\CustomSubCategory\CustomSubCategoryRepositoryInterface;
use App\CustomSubCategory;
use Illuminate\Pipeline\Pipeline;

class CustomSubCategoryRepository implements CustomSubCategoryRepositoryInterface
{
    /**
     * @param $request
     * @return CustomSubCategory
     */
    public function store($request)
    {
        $request->merge(['slug' => request('content:en')]);
        return  CustomSubCategory::create($request->all());
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($id, $request)
    {
        $customSubCategory = CustomSubCategory::find($id);
        $customSubCategory->update($request);
        return $customSubCategory;
    }

    /**
     * @return CustomSubCategory
     */
    public function findAll()
    {
        return CustomSubCategory::all();
    }

    /**
     * @return CustomSubCategory
     */
    public function findById($id)
    {
        return CustomSubCategory::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            return $this->findById($id)->forceDelete();
        } else {
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return CustomSubCategory
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return  app(Pipeline::class)
            ->send(CustomSubCategory::query())
            ->through([
                \App\QueryFilters\CustomSubCategory\CustomCategoryId::class,
                \App\QueryFilters\CustomSubCategory\Status::class,
            ])
            ->thenReturn()
            ->paginate($items);
    }

    /**
     * @return CustomSubCategory|null
     */
    public function findByStatus($status)
    {
        return CustomSubCategory::where('status', $status)->get();
    }

    public function changeStatus($id, $status)
    {
        return $this->findById($id)->update(['status' => $status]);
    }
}
