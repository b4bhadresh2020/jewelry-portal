<?php

namespace App\Repositories\Seller;

use App\Repositories\Seller\SellerRepositoryInterface;
use App\Seller;
use Illuminate\Support\Facades\Storage;

class SellerRepository implements SellerRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Seller
     */
    public function store($request)
    {
        $seller = Seller::create($request->except([
            'image'
        ]));
        $this->hashMedia($seller, $request);
        return $seller;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update($request, $id)
    {
        $seller = $this->findById($id);

        $this->hashMedia($seller, $request);
        $seller->update($request->except([
            'image', '_token', '_method'
        ]));

        return $seller;
    }

    /**
     * @return Seller
     */
    public function findAll()
    {
        return Seller::all();
    }

    /**
     * @return Seller
     */
    public function findById($id)
    {
        return Seller::find($id);
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
     * @return Seller
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        $status = request('status') ?? Seller::PUBLISH;
        return Seller::where('status', $status)->paginate($items);
    }


    // Other Helper
    /**
     * @param Seller $seller
     * @param $request
     */
    function hashMedia($seller, &$request)
    {
        if ($request->hasFile('image')) {
            $image              = $request->file('image');
            $newMediaPath       = Storage::disk()->put('media/seller', $image);
            // wasRecentlyCreated is used to check recored is create recently or not
            if ($seller->wasRecentlyCreated) {
                $seller->media()->create([
                    'path' => $newMediaPath,
                ]);
            } else {
                $oldMediaPath       = isset($seller->media->path) ? $seller->media->path : null;
                if ($oldMediaPath) {
                    $seller->media()->update([
                        'path' => $newMediaPath
                    ]);
                    Storage::disk()->delete($oldMediaPath);
                } else {
                    $seller->media()->create([
                        'path' => $newMediaPath,
                    ]);
                }
            }
        }
    }
    public function changeStatus($id, $status)
    {
        $arr = ['status' => $status];
        return $this->findById($id)->update($arr);
    }

    //Fetch publish seller
    public function findByPublishSeller()
    {
        return Seller::where('status', 1)->get();
    }
}