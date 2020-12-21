<?php

namespace App\Repositories\Language;

use App\Language;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\Pipeline\Pipeline;

class LanguageRepository implements LanguageRepositoryInterface {

    /**
     * @return Language[]|null
     */
    public function findAll(){
        return Language::orderBy('order','ASC')->get();
    }

    /**
     * @return Language[]|null
     */
    public function findActive(){
        return Language::where('status', true)
                    ->orderBy('order','ASC')->get();
    }

    /**
     * @return Language[]|null
     */
    public function findFront(){
        return Language::where('is_visible', true)
                    ->orderBy('order','ASC')->get();
    }

    /**
     * @param arry $attribute
     * @return bool
     */
    public function batchUpdate(array $attribute){
        if(array_key_exists('name',$attribute)){
            $isVisibleArr = $attribute['is_visible']    ?? [];
            $statusArr    = $attribute['status']        ?? [];
            $codeArr      = $attribute['code'];
            foreach ($attribute['name'] as $id => $name) {
                $updateData = [
                    "name"          => $name,
                    "is_visible"    => ($codeArr[$id] != 'en') ? (array_key_exists($id, $isVisibleArr)  ? true : false) : true,
                    "status"        => ($codeArr[$id] != 'en') ? (array_key_exists($id, $statusArr)     ? true : false) : true,
                ];
                Language::where('id', $id)->update($updateData);
            }
            session([
                'getLanguage'           => $this->findAll(),
                'findActiveLanguage'    => $this->findActive(),
                'findFrontLanguage'     => $this->findFront()
            ]);
            return true;
        }
    }
}
