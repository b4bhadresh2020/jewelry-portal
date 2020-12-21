<?php

namespace App\Repositories\Testimonial;

use App\Repositories\Testimonial\TestimonialRepositoryInterface;
use App\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     * @param $request
     * @return Testimonial
     */
    public function store($request)
    {
        $testimonial = Testimonial::create($request->except([
            'image', '_token'
        ]));
        $this->hashMedia($testimonial, $request);
        return $testimonial;
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($request, $id)
    {
        $testimonial = $this->findById($id);
        $this->hashMedia($testimonial, $request);
        return $testimonial->update($request->except([
            'image', '_token', '_method'
        ]));
    }

    /**
     * @return Testimonial
     */
    public function findAll()
    {
        return Testimonial::all();
    }

    /**
     * @return Testimonial
     */
    public function findById($id)
    {
        return Testimonial::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        $testimonial = $this->findById($id);
        @self::deleteMedia($testimonial);
        return ($forceDelete) ? $testimonial->forceDelete() : $testimonial->delete();
    }

    /**
     * @return Testimonial
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Testimonial::paginate($items);
    }

    function hashMedia($testimonial, &$request)
    {
        if ($request->hasFile('image')) {
            $image              = $request->file('image');
            $newMediaPath       = Storage::disk()->put('media/services', $image);
            // wasRecentlyCreated is used to check recored is create recently or not
            if ($testimonial->wasRecentlyCreated) {
                $testimonial->media()->create([
                    'path' => $newMediaPath,
                ]);
            } else {
                $oldMediaPath       = isset($testimonial->media->path) ? $testimonial->media->path : null;
                if ($oldMediaPath) {
                    $testimonial->media()->update([
                        'path' => $newMediaPath
                    ]);
                    Storage::disk()->delete($oldMediaPath);
                } else {
                    $testimonial->media()->create([
                        'path' => $newMediaPath,
                    ]);
                }
            }
        }
    }

    static function deleteMedia($testimonial)
    {
        Storage::disk()->delete($testimonial->media->path);
        $testimonial->delete();
    }
}
