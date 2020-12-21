<?php

namespace App\Repositories\Banner;

use App\Repositories\Banner\BannerRepositoryInterface;
use App\Banner;
use App\BannerTranslation;
use Illuminate\Support\Facades\Storage;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @param array $attributes
     * @return
     */
    public function store($request)
    {
        $bannerPath = $mobileBannerPath = null;
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $bannerPath = Storage::disk()->put('media/banner', $image);
        }
        if ($request->hasFile('mobile_banner')) {
            $image = $request->file('mobile_banner');
            $mobileBannerPath = Storage::disk()->put('media/mobileBanner', $image);
        }
        $data = $request->except(['banner', 'mobile_banner', 'position']);
        $imagesArray = ['banner' => $bannerPath, 'mobile_banner' => $mobileBannerPath, 'position' => rand(10, 100)];
        $bannerAdd = array_merge($data, $imagesArray);

        $banner = Banner::create($bannerAdd);
        return $banner;
    }

    public function seederStore($attributes)
    {
        return Banner::create($attributes);
    }



    /**
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update($id, $request)
    {
        $banner = $this->findById($id);
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $bannerPath = Storage::disk()->put('media/banner', $image);
        } else {
            $bannerPath = $banner->banner;
        }
        if ($request->hasFile('mobile_banner')) {
            $image = $request->file('mobile_banner');
            $mobileBannerPath = Storage::disk()->put('media/mobileBanner', $image);
        } else {
            $mobileBannerPath = $banner->mobile_banner;
        }
        $data = $request->except(['banner', 'mobile_banner']);
        $imagesArray = ['banner' => $bannerPath, 'mobile_banner' => $mobileBannerPath];
        $bannerUpdate = array_merge($data, $imagesArray);
        return  $this->findById($id)->update($bannerUpdate);
    }

    /**
     * @return
     */
    public function findAll()
    {
        return Banner::orderBy('position', 'ASC')->get();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return Banner::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            Banner::find($id)->deleteTranslations();
            return $this->findById($id)->delete();
        } else {
            Banner::find($id)->deleteTranslations();
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return
     */
    public function reOrderBanner($request)
    {
        $newOrder    =    explode(",", $request->sortOrder);
        $n  =   0;
        foreach ($newOrder as $id) {
            $bannerUpdate = ['position' => $n];
            $updateOrder = $this->findById($id)->update($bannerUpdate);
            $n++;
        }
        return $updateOrder;
    }
}
