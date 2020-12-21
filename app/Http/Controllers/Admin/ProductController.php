<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductVariationRequest;
use App\Http\Requests\Admin\Product\Step1Request;
use App\ProductAttribute;
use Illuminate\Http\Request;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Collection\CollectionRepositoryInterface;
use App\Repositories\Option\OptionRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Junges\ACL\Exceptions\UnauthorizedException;

class ProductController extends Controller
{

    private  $category, $subCategory, $attribute, $option, $product, $collection, $productAttribute;

    public function __construct(
        CategoryRepositoryInterface $category,
        SubCategoryRepositoryInterface $subCategory,
        AttributeRepositoryInterface $attribute,
        OptionRepositoryInterface $option,
        ProductRepositoryInterface $product,
        CollectionRepositoryInterface $collection,
        ProductAttributeRepositoryInterface $productAttribute
    ) {
        $this->subCategory = $subCategory;
        $this->category = $category;
        $this->attribute = $attribute;
        $this->option = $option;
        $this->product = $product;
        $this->collection = $collection;
        $this->productAttribute = $productAttribute;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-product')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
        ];

        return view('admin.product.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-product')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];

        $category = $this->category->findByStatus(Category::PUBLISH);
        $collections = $this->collection->findAll();
        $relatedProducts = $this->product->findByStatus();

        return view('admin.product.create.form', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'categories' => $category,
            'collections'  => $collections,
            'relatedProducts'  => $relatedProducts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-product')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];

        $category = $this->category->findByStatus(Category::PUBLISH);
        $collections = $this->collection->findAll();

        $productDetails = $this->product->findById($id);
        $oldProductCollections = $productDetails->productCollection->pluck('collection_id')->toArray();

        $dlSubCategoryId = $dlCategoryId = 0;
        if ($productDetails->isSubCategory()) {
            $dlSubCategoryId = $productDetails->subCategory->id;
            $dlCategoryId = $productDetails->subCategory->category->id;
        } else {
            $dlCategoryId = $productDetails->category_id;
        }

        $relatedProducts = $this->product->findByStatus();
        return view('admin.product.edit.form', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'categories' => $category,
            'collections'  => $collections,
            'productDetails' => $productDetails,
            'oldProductCollections' => $oldProductCollections,
            'category_handle' => [
                'isSubCategory' => $productDetails->isSubCategory(),
                'category_id' => $dlCategoryId,
                'sub_category_id' => $dlSubCategoryId
            ],
            'relatedProducts' => $relatedProducts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*********************************************************************************
     * * * * * * * * * * * * * * * * * Start Ajax * * *  * * * * * * * * * * * * * * *
     *********************************************************************************/

    public function findSubCategoryByCategory(Request $request, $id)
    {
        $subCategories = $this->subCategory->findSubCategoryByCategoryId($id);
        return response()->json([
            'subCategories'         => $subCategories,
            'totalSubCategories'    => $subCategories->count(),
        ]);
    }

    public function ajexSaveProductDetails(Step1Request $request)
    {
        if (!userHasAnyPermission('add-product', 'edit-product')) throw UnauthorizedException::forPermissions();

        try {
            $request->merge(['slug' => request('title:en')]);
            $product = $this->product->saveProductDetail($request->all());
            $product['attribute_list'] = (string) view('admin.items.product.attribute_dropdown', [
                'attributes' => $product['attribute_list']
            ]);

            $product['productVariations'] = (string) view('admin.items.product.product_variation', [
                'productVariations' => $product['product_attributes'],
                'status' => ProductAttribute::DRAFT,
            ]);
            return response()->json($product);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function ajexSaveProductVariation(ProductVariationRequest $request)
    {
        if (!userHasAnyPermission('add-product', 'edit-product')) throw UnauthorizedException::forPermissions();

        try {
            $products = $this->product->saveProductVariation($request->all());
            $products['productVariations'] = (string) view('admin.items.product.product_variation', [
                'productVariations' => $products,
                'status' => ProductAttribute::PUBLISH,
            ]);
            return response()->json($products);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    /*********************************************************************************
     * * * * * * * * * * * * * * * * * Other Page Load Events * * *  * * * * * * * * * * * * * * *
     *********************************************************************************/

    public function finish(Request $request)
    {
        if ($request->has('is_default')) {
            $this->product->saveDefaultProduct($request->all());
            Session::flash('toast_success', 'Product Create Successfully!');
            return redirect('admin/product');
        } else {
            Session::set('save_product_status', ProductAttribute::DRAFT);
            Session::flash('toast_success', 'Product save as draft!');
            return redirect('admin/product');
        }
    }

    public function changeStatus($id, $status)
    {
        if ($this->productAttribute->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Product Status Changed!');
        }
        return redirect()->back();
    }
}
