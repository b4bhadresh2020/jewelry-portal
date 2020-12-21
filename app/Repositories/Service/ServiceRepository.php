<?php

namespace App\Repositories\Service;

use App\Service;
use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @param $request
     * @return Service
     */
    public function store($request)
    {
        $service = Service::create($request->except([
            'image'
        ]));
        $this->hashMedia($service, $request);
        return $service;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return
     */
    public function update($request, $id)
    {
        $service = $this->findById($id);
        $this->hashMedia($service, $request);
        $service->update($request->except([
            'image', '_token', '_method'
        ]));

        return $service;
    }

    /**
     * @return
     */
    public function findAll()
    {
        return Service::all();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return Service::find($id);
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
     * @return
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Service::paginate($items);
    }

    function hashMedia($service, &$request)
    {
        if ($request->hasFile('image')) {
            $image              = $request->file('image');
            $newMediaPath       = Storage::disk()->put('media/services', $image);
            // wasRecentlyCreated is used to check recored is create recently or not
            if ($service->wasRecentlyCreated) {
                $service->media()->create([
                    'path' => $newMediaPath,
                ]);
            } else {
                $oldMediaPath       = isset($service->media->path) ? $service->media->path : null;
                if ($oldMediaPath) {
                    $service->media()->update([
                        'path' => $newMediaPath
                    ]);
                    Storage::disk()->delete($oldMediaPath);
                } else {
                    $service->media()->create([
                        'path' => $newMediaPath,
                    ]);
                }
            }
        }
    }
}
