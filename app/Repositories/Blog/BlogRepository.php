<?php

namespace App\Repositories\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Blog;


class BlogRepository implements BlogRepositoryInterface
{
    /**
     * @param $attributes
     * @return
     */
    public function store($attributes)
    {
        if ($attributes->hasFile('image')) {
            $image              = $attributes->file('image');
            $newMediaPath       = Storage::disk()->put('media/blog', $image);
        }
        $data = $attributes->except(['image']);
        $bolgAdd = array_merge($data, ['image' => $newMediaPath]);
        return Blog::create($bolgAdd);
    }

    /**
     * @param int $id
     * @param $attributes
     * @return boolean
     */
    public function update($attributes, $id)
    {
        $blog = $this->findById($id);
        if ($attributes->hasFile('image')) {
            $image              = $attributes->file('image');
            $newMediaPath       = Storage::disk()->put('media/blog', $image);
        } else {
            $newMediaPath       = $blog->image;
        }
        $data = $attributes->except(['image']);
        $blog->update(array_merge($data, ['image' => $newMediaPath]));

        return $blog;
    }

    /**
     * @return
     */
    public function findAll()
    {
        return Blog::orderby('id', 'DESC')->get();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return Blog::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            blog::find($id)->deleteTranslations();
            return $this->findById($id)->forceDelete();
        } else {
            blog::find($id)->deleteTranslations();
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [15, 25, 50])) ? request()->items : 15;
        return Blog::paginate($items);
    }
}
