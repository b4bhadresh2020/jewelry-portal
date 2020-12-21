<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Product;
use App\ProductAttribute;
use App\ProductVariation;
use App\SubCategory;
use App\Discount;
use App\Attribute;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{

    private  $productAttribute;

    public function __construct(
        ProductAttributeRepositoryInterface $productAttribute
    ) {
        $this->productAttribute = $productAttribute;
    }

    /**
     * Display a listing of the cart.
     *
     */
    public function cart()
    {
        $carts = Cart::getContent();
        return view('customer.product.cart', ['carts' => $carts]);
    }

    /**
     * Store product into cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        if ($request->product_attribute_id) {
            $productAttribute = $this->productAttribute->findById($request->product_attribute_id);
            if ($productAttribute) {
                $attributes = [];
                $attributes['make_to_order']  =   $request->make_to_order;
                if ($request->engraving) {
                    $attributes['engraving']  = [
                        'name' => $request->engraving_name,
                        'font' => $request->engraving_font,
                    ];
                } else {
                    $attributes['engraving'] = null;
                }
                Cart::add(
                    $request->product_attribute_id,
                    $productAttribute->product->{'title:' . getLocale()},
                    $productAttribute->productPrice->sell_price,
                    $request->quantity,
                    $attributes,
                    $productAttribute
                );
            }
        }
        return Cart::getContent()->count();
    }

    /**
     * Remove product into cart.
     *
     */
    public function removeCart($id)
    {
        Cart::remove($id);
        return Cart::getContent()->count();
    }


    /**
     * Quantity update into cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateQtyCart(Request $request)
    {
        $carts = Cart::getContent();
        $count = count($request->id);
        foreach ($carts as  $cart) {
            for ($i = 0; $i < $count; $i++) {
                if ($cart->id == $request->id[$i]) {
                    $cart->quantity = $request->quantity[$i];
                }
            }
        }
        return true;
    }

    /**
     * Store cart grand amount into session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addGrandAmount(Request $request)
    {
        Session::put('grand_amount', $request->amount);
    }

    /**
     * All cart remove.
     *
     */
    public function clear()
    {
        Cart::clear();
        return Cart::getContent()->count();
    }
}