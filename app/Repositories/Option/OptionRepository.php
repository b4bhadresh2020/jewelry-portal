<?php

namespace App\Repositories\Option;

use App\Repositories\Option\OptionRepositoryInterface;
use App\Option;
use Illuminate\Support\Facades\Storage;

class OptionRepository implements OptionRepositoryInterface
{
    /**
     * @return Option
     */
    public function findAll(){
        return Option::all();
    }

     /**
     * @return Option
     */
    public function findById($id){
        return  Option::find($id);
    }

    /**
     * @param arry $attribute
     * @return Option
     */
    public function store($request){
        $data = $request->except('image');
        $option = Option::create($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->hashMedia($option, $image);
        }

        return $option;
    }

    public function update($request, $id){
        $data = $request->except('_token', '_method', 'image');
        $option = $this->findById($id)->update($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->hashMedia($this->findById($id), $image);
        }

        return $option;
    }

    public function filterWithPaginate(){
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Option::paginate($items);
    }

    /**
     *  @param int $attribute_id
     *  @return Option
     */
    public function findByAttributeId($attribute_id)
    {
        return Option::where('attribute_id',$attribute_id)->get();
    }

    /* helper  */
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
}
