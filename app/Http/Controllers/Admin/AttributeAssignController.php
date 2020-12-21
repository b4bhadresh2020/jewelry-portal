<?php

namespace App\Http\Controllers\Admin;

use App\AttributeAssign;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssignAttributeRequest;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeAssignController extends Controller
{
    private  $category, $subCategory, $attribute;

    public function __construct(
        CategoryRepositoryInterface $category,
        SubCategoryRepositoryInterface $subCategory,
        AttributeRepositoryInterface $attribute,
        ProductRepositoryInterface $product
    ) {
        $this->subCategory  = $subCategory;
        $this->category     = $category;
        $this->attribute    = $attribute;
        $this->product    = $product;
    }


    public function index()
    {
        if (!userHasPermission('assign-attribute')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "javascript:void(0)", 'name' => "Settings"],
            ['link' => "/admin/assign-attr", 'name' => "Assign Attribute"],
        ];

        $categories = $this->category->findByStatus(Category::PUBLISH);
        $attributes =  $this->attribute->findByStatus(true);

        return view('admin.assign-attribute.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'categories'    => $categories,
            'attributes'    => $attributes,
        ]);
    }

    public function assignAttribute(AssignAttributeRequest $request)
    {
        $attribute = $this->attribute->assignAttribute($request);
        if ($attribute) {
            Session::flash('toast_success', 'Attribute assigned');
        } else {
            Session::flash('toast_error', 'something went wrong');
        }
        return redirect()->back();
    }

    public function findSubCategoryByCategory($categoryId)
    {
        $data['subCategories']  = $this->subCategory->findSubCategoryByCategoryId($categoryId);
        $data['totalSubCategories'] = count($this->subCategory->findSubCategoryByCategoryId($categoryId)->toArray());

        if ($data['totalSubCategories'] == 0) {
            $data['attributes'] = $this->attribute->findByCategoryId($categoryId);
            $data['totalProduct'] = $this->product->countFindByCategoryId($categoryId);
        }

        return response()->json($data);
    }

    public function getAttributeBySubcategory($subCategoryId)
    {
        $data['attributes'] = $this->attribute->findBySubCategoryId($subCategoryId);
        $data['totalProduct'] = $this->product->countFindBySubCategoryId($subCategoryId);
        return response()->json($data);
    }
}
