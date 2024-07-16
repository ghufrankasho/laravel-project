<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\orderMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use  Gloudemans\Shoppingcart\Facades\Cart;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Setting;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->settings =  Setting::pluck('value_actual', 'key');
    }
    public function checkout()
    {
        // Generate SEO 
        SEOMeta::setTitle(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setDescription(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        SEOMeta::setCanonical(\URL::current());

        OpenGraph::setDescription(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setTitle(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', app()->getLocale());
        OpenGraph::addProperty('content', app()->getLocale());
        OpenGraph::addProperty('site_name', unserialize($this->settings[app()->getLocale() . '_site_name']));

        TwitterCard::setTitle(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        TwitterCard::setSite(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));

        JsonLd::setTitle((__('messages.Checkout')) . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::setDescription(__('messages.Checkout') . ' - ' . unserialize($this->settings[app()->getLocale() . '_site_name']));
        JsonLd::addImage(asset('frontend/images/logo.png'));

        return view('frontend.checkout.checkout');
    }

    // normal order
    // public function checkoutStore(Request $request)
    // {
    //     date_default_timezone_set('Asia/Dubai');
    //     if(Cart::instance('shopping')->count() == 0){
    //         return redirect()->route('/', ['locale' => app()->getLocale()]);
    //     }
    //     $this->validate(
    //         $request,
    //         [
    //             'first_name' => 'string|required',
    //             'last_name' => 'string|required',
    //             'email' => 'email|required',
    //             'mobile_number' => 'string|required',
    //             'address' => 'string|required',
    //             'country' => 'string|required',
    //             // 'zip_code' => 'string|required',
    //             'city' => 'string|required'
    //         ]
    //     );
    //     // save data
    //     $order = $request->all();
    //     $order['full_name']  = $request->input('first_name') . ' ' . $request->input('last_name');
    //     $order['total_amount'] = Cart::instance('shopping')->subtotal();
    //     $status = Order::create($order);
    //     if (!$status) {
    //         return  back()->with('error', 'Some thing went wrong');
    //     }
    //     $lastOrder = DB::table('orders')->latest()->first();
    //     $detail = [];
    //     foreach (Cart::instance('shopping')->content() as $item) {
    //         $detail['product_id'] =  $item->model->id;
    //         $detail['order_id'] = $lastOrder->id;
    //         $detail['quantity'] = $item->qty;
    //         $detail['price'] = $item->price;
    //         OrderDetail::insert($detail);
    //     }
    //     Mail::to($lastOrder->email)->bcc($lastOrder->email)->cc('info@yemenproducts.com')->send(new orderMail($lastOrder));
    //     Cart::instance('shopping')->destroy();
    //     return redirect()->route('complete', ['locale' => app()->getLocale()]);
    // }

    // checkoutStore via what up 
    public function checkoutStore(Request $request)
    {
        $amount = 0;
        $messages = '';
        foreach (Cart::instance('shopping')->content() as $item) {
            $photo = explode(',', $item->model->photo);
            $title = $item->options->property_name ? $item->name . ' ' . $item->options->property_name : $item->name;
            $quantity = (int) $item->options->productQuantity; // Convert to integer
            $price = (float) $item->options->productPrice; // Convert to float
            if ($price === null) {
                $price = 0; // Assign 0 if price is null
            } else {
                $price = (float) $price; // Convert to float
            }
            $amount += $quantity * $price; // Accumulate the total amount
            $link = url(app()->getLocale() . '/product/' . $item->model->slug);
            // Check if the link starts with "http://" and add "https://" if needed
            if (strpos($link, 'http://') === 0) {
                $link = 'https://' . substr($link, 7);
            }
            $messages .= __('messages.The product ') . ': ' . $title . ' %0a';
            $messages .= __('messages.The quantity ') . ': ' . $quantity . ' %0a';
            $messages .= __('messages.The price ') . ': ' . $price . ' %0a';
            $messages .= __('messages.More info ') . ' ' . $link . ' %0a';
            $messages .= '------------------------------------------------------------------------%0a';
        }



        if (session()->has('coupon') && session()->get('coupon') != '' && $amount  > 0) {
            $messages .= __('messages.Coupons') . session('coupon')['value'] . ' ... ';
            $messages .=  ' %0a';
            $messages .= __('messages. Subtotal is ') . str_replace(',', '', $amount) - session('coupon')['value'];
        } else {
            $messages .= __('messages. Subtotal is ') . $amount;
        }

        if ($request->ajax()) {
            $response['status'] =  true;
            $header = view('frontend.elements.render.count')->render();
            $cartDetail = view('frontend.elements.render.cart')->render();
            $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();

            $response['header'] = $header;
            $response['cart-detail'] = $cartDetail;
            $response['checkout-cart-total'] = $checkoutCartTotal;
        }
        // order via what up 
        // 
        $visitorCountry = $_SERVER["HTTP_CF_IPCOUNTRY"] ?? null; // Get the visitor's country from Cloudflare (or null if not available)

        if ($visitorCountry === 'TR') { // 'TR' is the ISO code for Turkey
            $linkWhatsUp = Setting::where('key', 'whatsup_tr')->select('value_actual')->first()['value_actual'];
        } else {
            $linkWhatsUp = Setting::where('key', 'whatsup')->select('value_actual')->first()['value_actual'];
        }

        $response['whatsuplink'] = unserialize($linkWhatsUp) . '?text=' . $messages;

        // save in db
        date_default_timezone_set('Asia/Dubai');
        // save data
        $order['full_name']  = 'Order via what up';
        $order['email']  = '';
        $order['mobile_number']  = '';
        $order['address']  = '';
        $order['country']  = '';
        $order['city']  = '';
        $order['sub_total'] = (session()->has('coupon') && session()->get('coupon') != '') ? session()->get('coupon')['value'] : 0;
        $order['total_amount'] = (session()->has('coupon') && session()->get('coupon') != '') ? ($amount - floatval(session()->get('coupon')['value'])) : $amount;

        Order::create($order);
        $lastOrder = DB::table('orders')->latest()->first();
        $detail = [];
        foreach (Cart::instance('shopping')->content() as $item) {
            $detail['product_id'] = $item->model->id;
            $detail['order_id'] = $lastOrder->id;
            $detail['quantity'] = $item->options->productQuantity;
            $price = (float) $item->options->productPrice; // Convert to float
            if ($price === null) {
                $price = 0; // Assign 0 if price is null
            } else {
                $price = (float) $price; // Convert to float
            }
            $detail['price'] = $price;
            OrderDetail::insert($detail);
        }

        // Mail::to($lastOrder->email)->bcc($lastOrder->email)->cc('info@yemenproducts.com')->send(new orderMail($lastOrder));
        Cart::instance('shopping')->destroy();
        session()->put('coupon', '');
        return json_encode($response);
    }


    // public function checkoutStore(Request $request)
    // {
    //     $messages = '';
    //     foreach (Cart::instance('shopping')->content() as $item) {

    //         $photo = explode(',', $item->model->photo);
    //         $title = $item->options->property_name ? $item->name . ' ' . $item->options->property_name : $item->name;
    //         $quantity = $item->qty;
    //         $price = $item->price;
    //         // $amount = $item->subtotal() ;
    //         $amount = $quantity * $price;
    //         $link =  url(app()->getLocale() . '/product-detail/' . $item->model->slug);
    //         $messages .= __('messages.The product ').$title . ' ...';
    //         $messages .= __('messages.The quantity ').$quantity . ' ...';
    //         $messages .= __('messages.The price ').$price . ' ... ';
    //         $messages .=  ' %0a';
    //         // $messages .= __('messages.More info ').$link . ' %0a';
    //         $messages .= '-------------------------------------------------%0a';
    //     }
    //     $messages .= __('messages. Subtotal is ') . Cart::subtotal();

    //     if ($request->ajax()) {
    //         $response['status'] =  true;
    //         $header = view('frontend.elements.render.count')->render();
    //         $cartDetail = view('frontend.elements.render.cart')->render();
    //         $checkoutCartTotal = view('frontend.elements.render.checkout-cart-total')->render();

    //         $response['header'] = $header;
    //         $response['cart-detail'] = $cartDetail;
    //         $response['checkout-cart-total'] = $checkoutCartTotal;
    //     }
    //     // order via what up 
    //     // 
    //     $linkWhatsUp = Setting::where('key', 'whatsup')->select('value_actual')->first()['value_actual'];
    //     $response['whatsuplink'] = unserialize($linkWhatsUp) . '?text=' . $messages;
    //     // save in db
    //     date_default_timezone_set('Asia/Dubai');
    //     // save data
    //     $order['full_name']  = 'Order via what up';
    //     $order['email']  = '';
    //     $order['mobile_number']  = '';
    //     $order['address']  = '';
    //     $order['country']  = '';
    //     $order['city']  = '';

    //     $order['total_amount'] = Cart::instance('shopping')->subtotal();
    //     Order::create($order);
    //     $lastOrder = DB::table('orders')->latest()->first();
    //     $detail = [];
    //     foreach (Cart::instance('shopping')->content() as $item) {
    //         $detail['product_id'] =  $item->model->id;
    //         $detail['order_id'] = $lastOrder->id;
    //         $detail['quantity'] = $item->qty;
    //         $detail['price'] = $item->price;
    //         OrderDetail::insert($detail);
    //     }
    //     // Mail::to($lastOrder->email)->bcc($lastOrder->email)->cc('info@yemenproducts.com')->send(new orderMail($lastOrder));
    //     Cart::instance('shopping')->destroy();
    //     return json_encode($response);
    // }


    public function complete()
    {
        $order = $lastOrder = DB::table('orders')->latest()->first();
        // Generate SEO 
        SEOMeta::setTitle(__('Successfully Created Order'));
        SEOMeta::setDescription(__('Successfully Created Order'));
        SEOMeta::setCanonical(URL('/'));

        OpenGraph::setDescription(__('Successfully Created Order'));
        OpenGraph::setTitle(__('Successfully Created Order'));
        OpenGraph::setUrl(URL('/'));
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(__('Successfully Created Order'));
        TwitterCard::setSite(__('Successfully Created Order'));

        JsonLd::setTitle((__('Successfully Created Order')));
        JsonLd::setDescription(__('Successfully Created Order'));
        JsonLd::addImage(asset('frontend/images/logo.png'));
        return view('frontend.checkout.complete', compact('order'));
    }
}
