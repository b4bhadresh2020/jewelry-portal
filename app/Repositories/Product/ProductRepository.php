<?php

namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Product;
use App\ProductAttribute;
use App\ProductCollection;
use App\ProductImage;
use App\ProductPrice;
use App\ProductStatus;
use App\ProductVariation;
use App\Review;
use App\Subcategory;
use App\Traits\Product\ProductFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    use ProductFilter;

    /**
     * @param array $attributes
     * @return Product
     */
    public function store(array $attributes)
    {
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function update($id, array $attributes)
    {
    }

    /**
     * @return ProductAttribute
     */
    public function findAll()
    {
        return ProductAttribute::all();
    }

    /**
     * @return Product
     */
    public function findById($id)
    {
        return Product::find($id);
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
     * @return Product
     */
    public function filterWithPaginate()
    {
    }

    /**
     * @return ProductStatus
     */
    public function findAllStatus()
    {
        return ProductStatus::all();
    }

    /**
     * @param array $attributes
     * @return Product
     */
    public function saveProductDetail(array $attributes)
    {
        if (isset($attributes['product_id'])) {
            return $this->saveOldProductDetail($attributes);
        } else {
            unset($attributes['product_id']);
            return $this->saveNewProductDetail($attributes);
        }
    }

    /**
     * @param array $attributes
     * @return Product
     */
    public function saveProductVariation(array $attributes)
    {
        if (isset($attributes['product_attribute_id'])) {
            return $this->saveOldProductVariation($attributes);
        } else {
            unset($attributes['product_attribute_id']);
            unset($attributes['deleted_media']);
            return $this->saveNewProductVariation($attributes);
        }
    }

    /**
     * @param array $attributes
     * @return Product
     */
    public function saveDefaultProduct(array $attributes)
    {
        DB::beginTransaction();
        ProductAttribute::where('product_id', $attributes['product_id'])->update(['is_default' => 0]);
        $productAttribute = ProductAttribute::find($attributes['is_default'])->update(['is_default' => 1]);
        DB::commit();
        return $productAttribute;
    }

    public function findProductByCategoryIdOrSubCategoryId($categoryId)
    {
        return Product::where('category_id', $categoryId)
            ->whereHas('productAttribute', function ($q) {
                $q->where('is_default', 1);
            })
            ->get();
    }

    /* Helper Function */
    /* Product Detail */
    public function saveNewProductDetail($attributes)
    {
        DB::beginTransaction();
        $attributes['step'] = 1;
        if (array_key_exists('sub_category_id', $attributes)) {
            $attributes['category_id'] = null;
        } else {
            $attributes['sub_category_id'] = null;
        }

        if (array_key_exists('related_products', $attributes)) {
            $attributes['related_products'] = implode(',', $attributes['related_products']);
        }

        $attributes['is_custom'] = (array_key_exists('is_custom', $attributes)) ? 1 : 0;

        if (array_key_exists('collection_name', $attributes)) {
            $collections = array_keys($attributes['collection_name']);
            unset($attributes['collection_name']);
            $product = Product::create($attributes);

            foreach ($collections as $key => $collection_id) {
                $collectionArr = [
                    'product_id'    => $product->id,
                    'collection_id' => $collection_id
                ];
                ProductCollection::create($collectionArr);
            }
        } else {
            $product = Product::create($attributes);
        }
        DB::commit();
        return [
            'product_id' => $product->id,
            'is_sub_category' => $product->isSubCategory(),
            'attribute_list' => $this->findAttributeAndOptionToArray($product->id),
            'product_attributes' => $this->findProductVariationToArray($product->id),
        ];
    }

    public function saveOldProductDetail($attributes)
    {
        DB::beginTransaction();

        if (array_key_exists('sub_category_id', $attributes)) {
            $attributes['category_id'] = null;
        } else {
            $attributes['sub_category_id'] = null;
        }

        $attributes['is_custom'] = (array_key_exists('is_custom', $attributes)) ? 1 : 0;
        $productId   = $attributes['product_id'];
        unset($attributes['product_id']);
        $product = $productUpdate = $this->findById($productId);

        if (array_key_exists('related_products', $attributes)) {
            $attributes['related_products'] = implode(',', $attributes['related_products']);
        }

        if (array_key_exists('collection_name', $attributes)) {
            $collections = array_keys($attributes['collection_name']);
            unset($attributes['collection_name']);
            $productUpdate->update($attributes);

            $productCollection = ProductCollection::where('product_id', $productId);
            $productCollectionId = $productCollection->pluck('collection_id');
            $productCollections = array_values(array_diff(convertObjectToArray($productCollectionId), $collections));
            $newProductCollection = array_values(array_diff(convertObjectToArray($collections), convertObjectToArray($productCollectionId)));
            ProductCollection::where('product_id', $productId)->whereIn('collection_id', $productCollections)->delete();

            foreach ($newProductCollection as $collection_id) {
                ProductCollection::create([
                    'collection_id' => $collection_id,
                    'product_id' => $productId
                ]);
            }
        } else {
            $productUpdate->update($attributes);
        }

        DB::commit();
        return [
            'product_id' => $productId,
            'is_sub_category' => $product->isSubCategory(),
            'attribute_list' => $this->findAttributeAndOptionToArray($productId),
            'product_attributes' => $this->findProductVariationToArray($productId),
        ];
    }

    /* Product Variations */
    public function saveNewProductVariation($attributes)
    {
        $productFlag = false;
        $totalProductVariation = ProductAttribute::where('product_id', $attributes['product_id'])->count();
        if ($totalProductVariation == 0) {
            $productFlag = true;
        }

        DB::beginTransaction();
        /* Store Attribute  */
        $productAttrArr = [
            "sku"           => $attributes['sku'],
            "stock"         => $attributes['stock'],
            "product_id"    => $attributes['product_id'],
            "status_id"     => ProductAttribute::PUBLISH,
            "is_default"    => ($productFlag == true) ? 1 : 0,
        ];
        $productAttribute =  ProductAttribute::create($productAttrArr);

        $productPriceArr = [
            "sku"           => $productAttribute->sku,
            "mrp"           => $attributes['mrp'],
            "sell_price"    => $attributes['sell_price'],
        ];

        ProductPrice::create($productPriceArr);

        foreach ($attributes['attribute_id'] as $key => $product) {
            $productArr = [
                "product_id"    => $attributes['product_id'],
                "attribute_id"  => $attributes['attribute_id'][$key],
                "option_id"     => $attributes['option_id'][$key],
                "sku"           => $attributes['sku'],
            ];

            ProductVariation::create($productArr);
        }

        $path  = 'media/products';
        if (array_key_exists('default_image', $attributes)) {
            $productImagesArr = [
                'is_default' => 1,
                'sku' => $productAttribute->sku,
            ];
            $productImage     = ProductImage::create($productImagesArr);
            $image            = $attributes['default_image'];
            $this->hashMedia($productImage, $image, $path);
        }

        if (array_key_exists('multiple_image', $attributes)) {
            foreach ($attributes['multiple_image'] as  $multipleImage) {
                $productImagesArr = [
                    'sku' => $productAttribute->sku,
                ];
                $productImage     = ProductImage::create($productImagesArr);
                $this->hashMedia($productImage, $multipleImage, $path);
            }
        }

        if ($productFlag) {
            $this->findById($attributes['product_id'])->update([
                'step' => 2,
                'status_id' => ProductAttribute::PUBLISH,
            ]);
        }

        DB::commit();
        return $this->findProductVariationToArray($attributes['product_id']);
    }

    public function saveOldProductVariation($attributes)
    {
        DB::beginTransaction();
        /* Store Attribute  */
        $productAttrArr = [
            "stock"         => $attributes['stock'],
        ];

        $productAttribute =  ProductAttribute::find($attributes['product_attribute_id']);
        $productAttribute->update($productAttrArr);

        $productPriceArr = [
            "mrp"           => $attributes['mrp'],
            "sell_price"    => $attributes['sell_price'],
        ];

        ProductPrice::where('sku', $productAttribute->sku)->update($productPriceArr);

        foreach ($attributes['attribute_id'] as $key => $product) {
            $productArr = [
                "option_id"     => $attributes['option_id'][$key],
            ];
            $productVariationIds = ProductVariation::where('sku', $productAttribute->sku)->pluck('id');
            ProductVariation::where('sku', $productAttribute->sku)->find($productVariationIds[$key])->update($productArr);
        }

        $this->deleteMedia($attributes['deleted_media']);

        $path  = 'media/products';
        if (array_key_exists('default_image', $attributes)) {
            $productMedia = ProductImage::where('sku', $productAttribute->sku)->where('is_default', 1)->first();

            /* Product Image Delete */
            if ($productMedia) {
                $imgPath = $productMedia->media[0]->path;
                $media = $this->findProductImageById($productMedia->id);
                $media->media()->delete();
                $media->delete();
                Storage::disk()->delete($imgPath);
            }

            $productImagesArr = [
                'is_default' => 1,
                'sku' => $productAttribute->sku,
            ];
            $productImage     = ProductImage::create($productImagesArr);
            $image            = $attributes['default_image'];
            $this->hashMedia($productImage, $image, $path);
        }

        if (array_key_exists('multiple_image', $attributes)) {
            foreach ($attributes['multiple_image'] as  $multipleImage) {
                $productImagesArr = [
                    'sku' => $productAttribute->sku,
                ];
                $productImage     = ProductImage::create($productImagesArr);
                $this->hashMedia($productImage, $multipleImage, $path);
            }
        }

        DB::commit();
        return $this->findProductVariationToArray($attributes['product_id']);
    }

    public function findAttributeAndOptionToArray($id)
    {
        $getAttribute = $this->findById($id)->attributes();
        $attributes = [];
        foreach ($getAttribute as $attribute) {

            $options = [];
            foreach ($attribute->attribute->option as $option) {
                $options[] = [
                    'id' => $option->id,
                    'name' => $option->name,
                ];
            }


            $item = [
                'id' => $attribute->attribute->id,
                'name' => $attribute->attribute->name,
                'order' => $attribute->attribute->order,
                'options' => $options
            ];

            $attributes[] = $item;
        }

        return __sortArray($attributes, 'order');
    }

    public function hashMedia($product, $image, $path)
    {
        $newMediaPath       = Storage::disk()->put($path, $image);
        $product->media()->create([
            'path' => $newMediaPath,
        ]);
    }

    public function findProductVariationToArray($product_id)
    {
        $getAttribute = $this->findById($product_id)->attributes();
        $productVariations = [
            'attributeKey' => [],
            'item'         => []
        ];

        foreach ($getAttribute as $attribute) {
            $productVariations['attributeKey'][] = [
                'name' => $attribute->attribute->name,
                'order' => $attribute->attribute->order,
            ];
        }

        $productAttribute = ProductAttribute::with([
            'defaultImage',
            'defaultImage.media',
            'imagesWithoutDefault',
            'imagesWithoutDefault.media',
            'images',
            'images.media',
            'productVariation',
            'productVariation.attribute',
            'productVariation.options',
            'productPrice'
        ])->where('product_id', $product_id)
            ->get();

        foreach ($productAttribute as $key => $productAttr) {
            $productVariations['attributeKey'] = [];
            $items = [
                'id' =>  $productAttr->id,
                'image' =>  @$productAttr->defaultImage->media[0],
                'options' => [],
            ];

            foreach ($productAttr->productVariation as $variation) {
                $attributeOrder = $variation->attribute->order;
                $productVariations['attributeKey'][] = [
                    'name' => $variation->attribute->name,
                    'order' => $attributeOrder,
                ];

                $items['options'][] = [
                    'name' => $variation->options->name,
                    'attribute_order' => $attributeOrder,
                ];

                $items['option_ids'][] = [
                    'id' => $variation->options->id,
                    'attribute_order' => $attributeOrder,
                ];
            }

            $items['options'] = __sortArray($items['options'], 'attribute_order');
            $items['option_ids'] = __sortArray($items['option_ids'], 'attribute_order');

            $items['price']             = $productAttr->productPrice->mrp;
            $items['sku']             = $productAttr->sku;
            $items['is_default']        = $productAttr->is_default;
            $items['product_variation'] = $productAttr;
            $productVariations['item'][$key]  = $items;
        }

        $productVariations['attributeKey'] = __sortArray($productVariations['attributeKey'], 'order');
        return $productVariations;
    }

    public function deleteMedia($attributes)
    {
        if (isset($attributes)) {
            $mediaIds     = explode(',', $attributes);
            foreach ($mediaIds as $mediaId) {
                $productImage = $this->findProductImageById($mediaId);
                if ($productImage) {
                    Storage::disk()->delete($productImage->media[0]->path);
                    $productImage->media()->delete();
                    $productImage->delete();
                }
            }
        }
    }

    public function findProductImageById($productImageId)
    {
        return ProductImage::find($productImageId);
    }

    public function findDefaultAttributeBySlug(string $slug)
    {
        return ProductAttribute::where('is_default', true)->with('review')
            ->whereHas('product', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->first();
    }

    public function findByStatus($status = ProductAttribute::PUBLISH)
    {
        return Product::where('status_id', $status)->get();
    }

    public function findByCategoryId($categoryId)
    {
        $subCategoryId = SubCategory::where('category_id', $categoryId)->pluck('id');
        return Product::whereIn('sub_category_id', $subCategoryId)->orWhere('category_id', $categoryId)->get();
    }

    public function countFindByCategoryId($categoryId)
    {
        $subCategoryId = SubCategory::where('category_id', $categoryId)->pluck('id');
        return Product::whereIn('sub_category_id', $subCategoryId)->orWhere('category_id', $categoryId)->count();
    }

    public function countFindBySubCategoryId($subCategoryId)
    {
        return Product::where('sub_category_id', $subCategoryId)->count();
    }

    public function findBySubCategoryId($subCategoryId)
    {
        return Product::where('sub_category_id', $subCategoryId)->get();
    }

    public function productReview($request)
    {
        $data = [
            'product_attribute_id' => $request->attribute_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ];
        $review = Review::create($data);
        $review->user_id = $review->users->first_name;
        $review->created_at = date('d-M-Y', strtotime($review->created_at));
        return $review;
    }
}
