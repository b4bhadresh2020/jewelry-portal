<?php

namespace App\Repositories\Faq;

use App\Repositories\Faq\FaqRepositoryInterface;
use App\Faq;
use App\FaqTranslation;


class FaqRepository implements FaqRepositoryInterface
{
    /**
     * @param array $attributes
     * @return
     */
    public function store($attributes){
        unset($attributes['files']);
        $faq = Faq::create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return
     */
    public function update($id,$attributes){
        unset($attributes['files']);
        return  $this->findById($id)->update($attributes);
    }

    /**
     * @return
     */
    public function findAll(){

        return Faq::where('status',1)->get();
    }

    /**
     * @return
     */
    public function findById($id){
        return Faq::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false){
        if($forceDelete){
            Faq::find($id)->deleteTranslations();
            return $this->findById($id)->forceDelete();
        }else{
            Faq::find($id)->deleteTranslations();
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return
     */
    public function filterWithPaginate(){
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Faq::where('status',1)->paginate($items);
    }

    public function deleteFaqByCategoryId($id)
    {
       $faqs= Faq::where('faq_category_id', $id)->get();
       foreach ($faqs as $faq) {
                Faq::find($faq->id)->deleteTranslations();
                Faq::find($faq->id)->delete();
       }
       return  true;
    }

}
