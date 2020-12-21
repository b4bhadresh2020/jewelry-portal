<?php

namespace App\Repositories\CustomCategory;

use App\Repositories\CustomCategory\CustomCategoryRepositoryInterface;
use App\CustomCategory;
use App\CustomSubCategory;


class CustomCategoryRepository implements CustomCategoryRepositoryInterface
{
    /**
     * @param $request
     * @return CustomCategory
     */
    public function store($request)
    {
        $request->merge(['slug' => request('name:en')]);
        return  CustomCategory::create($request->all());
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($id, $request)
    {

        return $this->findById($id)->update($request);
    }

    /**
     * @return CustomCategory
     */
    public function findAll()
    {
        return CustomCategory::all();
    }

    /**
     * @return CustomCategory
     */
    public function findById($id)
    {
        return CustomCategory::find($id);
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
     * @return CustomCategory
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        $status = request('status') ?? CustomCategory::PUBLISH;
        return CustomCategory::where('status', $status)->paginate($items);
    }

    public function findByStatus($status)
    {
        return CustomCategory::select('id')
            ->where('status', $status)
            ->listsTranslations('name')->get();
    }

    public function changeStatus($id, $status)
    {
        $arr = ['status' => $status];
        $this->findById($id)->update($arr);
        $customSubCategory = CustomSubCategory::whereIn('custom_category_id', CustomCategory::where('id', $id)->pluck('id'))->update($arr);
        return $customSubCategory;
    }
}