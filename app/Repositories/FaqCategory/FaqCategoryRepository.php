<?php

namespace App\Repositories\FaqCategory;

use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepositoryInterface;
use App\FaqCategory;
use App\FaqCategoryTranslation;


class FaqCategoryRepository implements FaqCategoryRepositoryInterface
{

    private $faq;
    public function __construct(FaqRepositoryInterface $faq)
    {
        $this->faq = $faq;
    }

    /**
     * @param $request
     * @return
     */
    public function store($request)
    {
        return FaqCategory::create($request->all());
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return
     */
    public function update($attributes, $id)
    {

        return  $this->findById($id)->update($attributes);
    }

    /**
     * @return
     */
    public function findAll()
    {
        return FaqCategory::with('faq')->where('status', 1)->get();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return FaqCategory::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            $faqCategory = $this->findById($id);
            $this->faq->deleteFaqByCategoryId($faqCategory->id);
            $this->findById($id)->deleteTranslations();
            return $this->findById($id)->forceDelete();
        } else {
            $faqCategory = $this->findById($id);
            $this->faq->deleteFaqByCategoryId($faqCategory->id);
            $this->findById($id)->deleteTranslations();
            return $this->findById($id)->delete();
        }
    }


    /**
     * @return
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return FaqCategory::paginate($items);
    }

    public function findByStatus($status)
    {
        return FaqCategory::select('id')
            ->where('status', $status)
            ->listsTranslations('name')->get();
    }
}
