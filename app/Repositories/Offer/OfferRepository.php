<?php

namespace App\Repositories\Offer;

use App\Repositories\Offer\OfferRepositoryInterface;
use App\Offer;
use App\OfferTranslation;
use Illuminate\Support\Facades\Storage;

class OfferRepository implements OfferRepositoryInterface
{
    /**
     * @param array $attributes
     * @return
     */
    public function store($attributes)
    {
        $offer = $this->findall();
        if (count($offer) != 6) {
            $OfferPath  = null;
            if ($attributes->hasFile('offer_image')) {
                $image = $attributes->file('offer_image');
                $OfferPath = Storage::disk()->put('media/offerProduct', $image);
            }

            $data = $attributes->except(['offer_image']);
            $imagesArray = ['offer_image' => $OfferPath];
            $OfferAdd = array_merge($data, $imagesArray);

            $offer = Offer::create($OfferAdd);
            return $offer;
        }
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update($id, $attributes)
    {
        $offer = $this->findById($id);
        if ($attributes->hasFile('offer_image')) {
            $image = $attributes->file('offer_image');
            $offerPath = Storage::disk()->put('media/offerProduct', $image);
        } else {
            $offerPath = $offer->offer_image;
        }
        $data = $attributes->except(['offer_image']);
        $imagesArray = ['offer_image' => $offerPath];
        $OfferUpdate = array_merge($data, $imagesArray);
        return  $this->findById($id)->update($OfferUpdate);
    }

    /**
     * @return
     */
    public function findAll()
    {
        return Offer::all();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return Offer::find($id);
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
        return Offer::paginate($items);
    }

    public function offerStatusUpdate($id)
    {
        $offer = $this->findById($id);
        if ($offer->status == 0) {
            $offers = $this->findById($id)->update(['status' => 1]);
            return $offers;
        }
        if ($offer->status == 1) {
            $offers =  $this->findById($id)->update(['status' => 0]);
            return $offers;
        }
    }
}
