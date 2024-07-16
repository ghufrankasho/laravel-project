<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use  Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Discount;

class CartController extends Controller
{
    public function __construct()
    {
        $this->settings =  Setting::pluck('value_actual', 'key');
    }
    public function cart()
    {
        // $product = Product::where(['status' => 'active', 'slug' => $request->slug])->get()->first();

        // if (!$product) {
        //     return back()->with('error', 'Data Not Found');
        // }
        // Generate SEO 
        SEOMeta::setTitle(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle((__('messages.SHOPPING CART')) . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription(__('messages.SHOPPING CART') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::addImage(asset('frontend/images/logo.png'));
        return view('frontend.cart.cart');
    }

    public function cartStore(Request $request)
    {
        // product id ==> quantity 
        $productId  = $request->input('productId');
        $productQuantity  = $request->input('productQuantity');
        $totalPrice = $request->input('totalPrice');
        // $selectedProperties  = $request->input('selectedProperties')  ?
        //     Property::withTranslation()
        //     ->translatedIn(app()->getLocale())
        //     ->where('id', $request->input('selectedProperties'))
        //     ->get()
        //     ->first() : '';
        $product = Product::getProductByCart($productId);
        // if (
        //     empty($selectedProperties)
        //     && !empty($product[0]['properties'][0])
        // ) {
        //     $selectedProperties =  $product[0]['properties'][0];
        // }
        // $price =  !empty($selectedProperties) ?
        //     $selectedProperties['value'] :
        //     $product[0]['price'];
        $price =  $product[0]['price'] ? $totalPrice : 0;
        $photo = explode(',', $product[0]['photo'])[0];
        //  get minimum quantity from category
        $getMinimumQuantity  = Category::select('starts_from')->where(['id' => $product[0]['cat_id']])->get()->first();
        $calculateMinQuantity =  isset($getMinimumQuantity->starts_from)  && !empty($getMinimumQuantity->starts_from) ? $getMinimumQuantity->starts_from :     $product[0]['minimum_quantity'];
        if ($product[0]['price']) {
            $finalTotalQuantity = 1;
            $min =  $productQuantity;
        } else {
            $min = isset($getMinimumQuantity->starts_from)  && !empty($getMinimumQuantity->starts_from) ? $getMinimumQuantity->starts_from :     $product[0]['minimum_quantity'];
            $finalTotalQuantity = $productQuantity / $calculateMinQuantity;
        }
        $result = Cart::instance('shopping')->add(
            $productId,
            $product[0]['title'],
            $finalTotalQuantity,
            $price,
            [
                'photo' => $photo,
                'cat_id' => $product[0]['cat_id'],
                'property_name' => !empty($selectedProperties['name'])
                    ? $selectedProperties['name'] : '',
                'property_id' => !empty($selectedProperties['id'])
                    ?  $selectedProperties['id'] : '',
                // if there is minimum quantity from category 
                'min' =>   $min,
                'original_minimum_quantity' =>  isset($getMinimumQuantity->starts_from)  && !empty($getMinimumQuantity->starts_from) ? $getMinimumQuantity->starts_from :     $product[0]['minimum_quantity'],
                'productQuantity' => $productQuantity,
                'totalPrice' => $totalPrice,
                'productPrice' => $product[0]['price']
            ]
        )->associate('App\Models\Product');
        if ($result) {
            $response = [
                'status' =>  true,
                'productId' => $productId,
                'total' => Cart::subtotal(),
                'cartCount' => Cart::instance('shopping')->count(),
                'message' => __('messages.The Item Was Added To Your Cart Successfully'),
            ];
        }
        if ($request->ajax()) {
            // count of orders in cart
            $header = view('frontend.elements.render.count')->render();
            // render the content of cart
            $cartDetail = view('frontend.elements.render.cart')->render();

            $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();

            $response['header'] = $header;
            $response['cart-detail'] = $cartDetail;
            $response['checkout-cart-total'] = $checkoutCartTotal;
        }
        return json_encode($response);
    }

    public function cartUpdate(Request $request)
    {
        $this->validate($request, [
            'productQuantity' => 'required|numeric'
        ]);

        $cartId = $request->input('cartId');
        $productQuantity = $request->input('productQuantity');
        $totalPrice = $request->input('totalPrice');

        $getOldCart = Cart::instance('shopping')->get($cartId);
        $options = $getOldCart->options->toArray();
        $options['productQuantity'] = $productQuantity;

        // Calculate the new subtotal based on updated quantity and price
        $subtotal = $options['productQuantity'] * $options['productPrice'];
        $options['subtotal'] = $subtotal;

        $cartItem = Cart::instance('shopping')->update($cartId, ['options' => $options]);

        $response['status'] =  true;
        $response['message'] = __('messages.Quantity was updated Successfully');
        $response['total'] = Cart::subtotal();

        if ($request->ajax()) {
            $header = view('frontend.elements.render.count')->render();
            $cartDetail = view('frontend.elements.render.cart')->render();
            $cartList = view('frontend.elements.render.cart-list')->render();
            $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();
            $response['header'] = $header;
            $response['cart-detail'] = $cartDetail;
            $response['cart-list'] = $cartList;
            $response['checkout-cart-total'] = $checkoutCartTotal;
        }
        return json_encode($response);
    }

    public function cartDelete(Request $request)
    {
        $cartId  = $request->input('cartId');
        Cart::instance('shopping')->remove($cartId);
        $response['status'] =  true;
        $response['total'] = Cart::subtotal();
        $response['cartCount'] = Cart::instance('shopping')->count();
        $response['message'] = __('messages.The Item Was Removed From Your Cart Successfully');
        if ($request->ajax()) {
            $header = view('frontend.elements.render.count')->render();
            $cartDetail = view('frontend.elements.render.cart')->render();
            $cartList = view('frontend.elements.render.cart-list')->render();
            $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();

            $response['header'] = $header;
            $response['cart-detail'] = $cartDetail;
            $response['cart-list'] = $cartList;
            $response['checkout-cart-total'] = $checkoutCartTotal;
        }

        return json_encode($response);
    }


    public function applyCoupon(Request $request)
    {

        try {
            // check the code 
            // get last one and check is active and valid 
            // apply coupons and 
            $code = $request->input('code');
            $totalAmount = $request->input('totalAmount');

            if (!isset($code) || empty($code)) {
                $response = [
                    'status' =>  false,
                    'message' => __('messages.Please Enter Coupon'),
                ];
                return json_encode($response);
            }
            $coupon = Discount::where(
                [
                    'status' => 'active',
                    'code' => $code,
                ]
            )->orderBy('id', 'desc')->first();

            if (is_null($coupon)) {
                $response = [
                    'status' =>  false,
                    'message' => __('messages.Invalid Coupon , Please Enter Valid Coupon'),
                ];
                return json_encode($response);
            }
            if ($totalAmount !== '') {
                $totalPrice = $totalAmount;
            } else {
                $totalPrice = Cart::instance('shopping')->subtotal();
                $totalPrice = floatval(str_replace(',', '', $totalPrice)); // Remove comma and convert to float
            }
            if ($totalPrice < 20.00) {
                $response = [
                    'status' =>  false,
                    'message' => __('messages.The minimum amount that we can apple coupon 20 AED'),
                ];
                return json_encode($response);
            }
            // register in session
            session()->put(
                'coupon',
                [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'value' => $coupon->discount($totalPrice)
                ]
            );
            if ($request->ajax()) {
                // $header = view('frontend.elements.render.count')->render();
                $cartDetail = view('frontend.elements.render.cart')->render();
                $cartList = view('frontend.elements.render.cart-list')->render();
                $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();

                // $response['header'] = $header;
                $response['cart-detail'] = $cartDetail;
                $response['cart-list'] = $cartList;
                $response['checkout-cart-total'] = $checkoutCartTotal;
                $response['status'] = true;
                $response['message'] = __('messages.Coupon Applied Successfully');
            }
            return json_encode($response);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage());
        }
        //       'msg' =>  __('messages.Please Enter Coupon'),
    }
}
