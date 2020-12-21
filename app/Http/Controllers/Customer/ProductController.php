<?php

namespace App\Http\Controllers\Customer;

use App\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use Illuminate\Http\Request;
use App\Product;
use App\ProductAttribute;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    private $category, $subCategory, $product, $productAttribute, $attribute;

    public function __construct(
        CategoryRepositoryInterface $category,
        SubCategoryRepositoryInterface $subCategory,
        ProductRepositoryInterface $product,
        ProductAttributeRepositoryInterface $productAttribute,
        AttributeRepositoryInterface $attribute
    ) {
        $this->category = $category;
        $this->subCategory = $subCategory;
        $this->product = $product;
        $this->productAttribute = $productAttribute;
        $this->attribute = $attribute;
    }

    /*********************************************************************************************************
        Products | Products | Products | Products | Products | Products | Products | Products | Products
     **********************************************************************************************************/

    /**
     * View | All Products (Main Product Filter Page)
     * @param Request $request
     * @return view('customer.product.index')
     */
    public function products(Request $request)
    {
        $productContent = "";
        $request->merge([
            'page' => 1,
        ]);
        $productAttributes = $this->product->applyFilter($request);
        foreach ($productAttributes as $productAttribute) {
            $productContent .= view('customer.items.product.layout.grid', [
                'productAttribute' => $productAttribute
            ]);
        }

        return view('customer.product.index', [
            'categories'            => $this->category->findByStatus(true),
            'attributes'            => $this->attribute->findByStatus(true),
            'productSortOptions'    => Product::SORT_MAPPING,
            'productContent'        => $productContent,
            'totalProducts'         => $productAttributes->total(),
            'selectedCategory'      => null,
            'selectedSubCategory'   => null,
        ]);
    }

    /**
     * View | Specific Category Wise Products
     * @param Request $request
     * @param string $mainCategorySlug
     * @return view('customer.product.index')
     */
    public function productsByCategory(Request $request, string $mainCategorySlug)
    {
        $category = $this->category->findBySlug($mainCategorySlug);
        if ($category) {
            $request->merge([
                'page'      => 1,
                'category'  => [$category->id]
            ]);
            $productAttributes = $this->product->applyFilter($request);
            $productContent = "";
            foreach ($productAttributes as $productAttribute) {
                $productContent .= view('customer.items.product.layout.grid', [
                    'productAttribute' => $productAttribute
                ]);
            }
            return view('customer.product.index', [
                'attributes'            => $this->attribute->findByStatus(true),
                'productSortOptions'    => Product::SORT_MAPPING,
                'productContent'        => $productContent,
                'totalProducts'         => $productAttributes->total(),
                'selectedCategory'      => $category,
                'selectedSubCategory'   => null,
            ]);
        } else {
            return view('customer.product.product-not-found');
        }
    }

    /**
     * View | Specific Sub Category Wise Products
     * @param Request $request
     * @param string $mainCategorySlug
     * @param string $subCategorySlug
     * @return view('customer.product.index')
     */
    public function productsBySubCategory(Request $request, string $mainCategorySlug, string $subCategorySlug)
    {
        $category = $this->category->findBySlug($mainCategorySlug);
        if ($category) {
            $selectedSubCategory = $this->subCategory->findBySlug($subCategorySlug);
            $request->merge([
                'page'              => 1,
                'category'          => [$category->id],
                'sub_category_id'   => $selectedSubCategory->id ?? 0,
            ]);
            $productAttributes = $this->product->applyFilter($request);
            $productContent = "";
            foreach ($productAttributes as $productAttribute) {
                $productContent .= view('customer.items.product.layout.grid', [
                    'productAttribute' => $productAttribute
                ]);
            }
            return view('customer.product.index', [
                'attributes'            => $this->attribute->findByStatus(true),
                'productSortOptions'    => Product::SORT_MAPPING,
                'productContent'        => $productContent,
                'totalProducts'         => $productAttributes->total(),
                'selectedCategory'      => $category,
                'selectedSubCategory'   => $selectedSubCategory,
            ]);
        } else {
            return view('customer.product.product-not-found');
        }
    }

    /**
     * Ajax | Related To All Main Product Filters
     * @param Request $request
     * @param int $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxProductsFilter(Request $request, int $page)
    {
        $productContent = "";
        $request->merge(['page' => $page]);
        $productAttributes = $this->product->applyFilter($request);
        foreach ($productAttributes as $productAttribute) {
            if ($request->productLayoutStyle == "grid") {
                $productContent .= view('customer.items.product.layout.grid', [
                    'productAttribute' => $productAttribute
                ]);
            } elseif ($request->productLayoutStyle == "list") {
                $productContent .= view('customer.items.product.layout.list', [
                    'productAttribute' => $productAttribute
                ]);
            }
        }
        return response()->json([
            'data'              => $productContent,
            'totalProducts'     => $productAttributes->total()
        ]);
    }


    /*********************************************************************************************************
        Single Product | Single Product | Single Product | Single Product | Single Product | Single Product
     **********************************************************************************************************/

    /**
     * This function is view of single product
     */

    public function singleProductView(Request $request, $slug, $sku = null)
    {
        $defaultAttribute = ($sku == null) ?
            $this->product->findDefaultAttributeBySlug($slug) :
            $this->productAttribute->findBySku($sku);

        if ($defaultAttribute) {
            return view('customer.product.single-view', [
                'defaultAttribute' => $defaultAttribute,
                'owlCarouselData'   => (string) view('customer.items.product.single-product-sidebar', [
                    'productAttribute' => $defaultAttribute
                ]),
            ]);
        } else {
            return view('customer.product.product-not-found');
        }
    }

    /**
     * Ajax | Single Product Variation Level Based On Product Slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxProductVariation(Request $request)
    {
        $returnJson['status'] =  $returnJson['data'] = false;
        if ($request->attribute && $request->product_id) {
            $query = "SELECT pa.sku FROM `product_attributes` as pa ";
            $i = 0;
            foreach ($request->attribute as $attribute_id => $option_id) {
                $i++;
                if ($i == 1) {
                    $query .= " JOIN product_variations as pv{$i} ON
                                pv{$i}.sku = pa.sku and
                                pv{$i}.product_id = pa.product_id and
                                pv{$i}.attribute_id={$attribute_id} and
                                pv{$i}.option_id={$option_id} AND
                                pv{$i}.product_id='{$request->product_id}' ";
                } else {
                    $query .= " JOIN product_variations as pv{$i} ON
                                pv{$i}.sku = pv" . ($i - 1) . ".sku and
                                pv{$i}.product_id = pv" . ($i - 1) . ".product_id and
                                pv{$i}.attribute_id={$attribute_id} and
                                pv{$i}.option_id={$option_id} ";
                }
            }
            $query .= "group BY sku";
            $sku = DB::select($query);
            $sku = (count($sku) == 1) ? $sku[0]->sku : null;
            if ($sku) {
                $returnJson['status'] = true;
                $productAttribute = ProductAttribute::where('sku', $sku)->first();
                $productAttribute->productPrice;
                $default_image_path = getMediaUrlToMedia($productAttribute->defaultImage->media[0]);

                $returnJson['data'] = $productAttribute;
                $returnJson['data']['default_image_path']   = $default_image_path;
                $returnJson['data']['isStockAvailable']     = $productAttribute->isStockAvailable();
                $returnJson['data']['owlCarouselData']      = (string) view('customer.items.product.single-product-sidebar', [
                    'productAttribute' => $productAttribute
                ]);
            }
        }
        return response()->json($returnJson);
    }

    /*********************************************************************************************************
        Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews
     **********************************************************************************************************/

    /**
     * Ajax | Add Review
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->errors()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        } else {
            $review = $this->product->productReview($request);
            if ($review) {
                return [
                    'msg'    => 'review Add Successfully..!',
                    'review' => $review
                ];
            }
        }
    }
}
