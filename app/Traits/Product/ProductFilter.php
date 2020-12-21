<?php


namespace App\Traits\Product;

use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;

trait ProductFilter
{

    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return Product|Illuminate\Support\Collection
     */
    public function applyFilter(Request $request)
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        $products = ProductAttribute::query()
            ->where('status_id', ProductAttribute::PUBLISH)
            // Apply Category Filter
            ->when(
                $request->sub_category_id,
                function ($query) use ($request) {
                    return $query->whereHas('product', function ($productQuery) use ($request) {
                        return $productQuery->where('sub_category_id', $request->sub_category_id);
                    });
                },
                function ($query) use ($request) {
                    return $query->when($request->category, function ($subQuery) use ($request) {
                        return $subQuery->whereHas('product', function ($productQuery) use ($request) {
                            return $productQuery->whereIn('category_id', $request->category);
                        });
                    });
                }
            )
            // Apply Attribute Filter
            ->when(
                $request->attribute,
                function ($productQuery) use ($request) {
                    $optionsArr = [];
                    foreach ($request->attribute as $attribute_id => $options) {
                        $optionsArr = array_merge($optionsArr, $options);
                    }
                    $optionsArr = array_unique($optionsArr);

                    return $productQuery->whereHas(
                        'productVariation',
                        function ($productVariationQuery) use ($optionsArr) {
                            return $productVariationQuery->whereIn('option_id', $optionsArr)
                                ->where('status_id', ProductAttribute::PUBLISH);
                        }
                    );
                }
            )
            // Apply Price Filter
            ->when(
                $request->min_price && $request->max_price,
                function ($query) use ($request) {
                    return $query->whereHas('productPrice', function ($productPriceQuery) use ($request) {
                        return $productPriceQuery->whereBetween('sell_price', [$request->min_price, $request->max_price]);
                    });
                }
            )
            // Apply Sorting
            ->when(
                $request->productSortBy && in_array($request->productSortBy, [Product::SORT_A_TO_Z, Product::SORT_Z_TO_A]),
                function ($query) use ($request) {
                    return $query->whereHas('product', function ($productQuery) use ($request) {
                        return $productQuery->orderByTranslation(
                            'title',
                            $request->productSortBy == Product::SORT_A_TO_Z ? 'ASC' : 'DESC'
                        );
                    });
                }
            )
            ->when(
                $request->productSortBy && in_array($request->productSortBy, [Product::SORT_PRICE_LOW_TO_HIGH, Product::SORT_PRICE_HIGH_TO_LOW]),
                function ($query) use ($request) {
                    return $query->whereHas('productPrice', function ($productPriceQuery) use ($request) {
                        return $productPriceQuery->orderBy(
                            'sell_price',
                            $request->productSortBy == Product::SORT_PRICE_LOW_TO_HIGH ? 'ASC' : 'DESC'
                        );
                    });
                }
            )
            // ->get()->toArray();
            ->paginate($items);
        // prettyPrint($products);
        return $products;
    }
}
