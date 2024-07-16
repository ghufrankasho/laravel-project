<table class="cart-table">
    <thead style="text-align: center;">
        <tr>
            <th class="product-name " colspan="2">{{ __('messages.PRODUCT') }}</th>
            <th class="product-price">{{ __('messages.PRICE') }}</th>
            <th class="product-quantity">{{ __('messages.QUANTITY') }}</th>
            <th class="product-subtotal">{{ __('messages.TOTAL') }}</th>
            <th class="product-remove">&nbsp;</th>
        </tr>
    </thead>
    <?php $hasPrice = false; ?>
    <tbody style="text-align: center;">
        <?php $finalCartPrice = 0; ?>
        @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content()->sortBy('id') as $item)
            <tr>
                @php
                    $photo = explode(',', $item->model->photo);
                @endphp
                <td class="product-thumbnail">
                    <a href="{{ url(app()->getLocale() . '/product/' . $item->model->slug) }}"
                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                        <img src="{{ $photo[0] }}" class="img-fluid fle" alt="{{ $item->title }}">
                    </a>
                </td>
                <td class="product-name">
                    <a href="{{ url(app()->getLocale() . '/product/' . $item->model->slug) }}"
                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                        {{ $item->model->title }}
                    </a>
                    @if ($item->model->dimension)
                        <span class="font-light n-1">{{ $item->model->dimension }}</span>
                    @endif
                </td>

                <td class="product-price">
                    @if ($item->price > 0)
                        <?php $hasPrice = true; ?>
                        <span class="price">{{ $item->options->productPrice }}</span>
                    @else
                        <span
                            style="color: #d3122a;font-weight:normal !important">{{ __('messages.Wait Quotation') }}</span>
                    @endif
                </td>
                <td class="product-quantity">
                    <div class="pro-qty d-inline-block mx-0 update-quantity" data-id="{{ $item->rowId }}"
                        data-original-min="{{ $item->options->original_minimum_quantity }}"
                        id="qty-input-{{ $item->rowId }}" data-product-id="{{ $item->id }}">
                        <a href="#" class="dec qty-btns-click">-</a>
                        <?php
                        // $calcuateFinalQunatity = $item->qty * $item->options->min;
                        ?>
                        <?php $calcuateFinalQunatity = $item->options->productQuantity; ?>
                        <input type="text" readonly value="{{ $calcuateFinalQunatity }}"
                            min="{{ $item->price ? 1 : $item->options->min }}"
                            data-original-value={{ $calcuateFinalQunatity }} data-price="{{ $item->price }}"
                            data-product-price="{{ $item->options->productPrice }}">
                        <a href="#" class="inc qty-btns-click">+</a>
                    </div>
                </td>

                <td class="total-price">
                    <span class="price">
                        @if ($item->subtotal() > 0)
                            <span class="price show-price">
                                {{-- {{ $item->options->subtotal ? $item->options->subtotal : $item->subtotal() }} --}}
                                {{ $item->options->productQuantity * $item->options->productPrice }}
                            </span>
                        @else
                            <span
                                style="color: #d3122a; font-weight:normal !important">{{ __('messages.Wait Quotation') }}
                            </span>
                        @endif

                    </span>
                </td>

                <td class="product-remove delete-from-cart" data-id="{{ $item->rowId }}">
                    <a href="#">
                        <i class="ion-android-close"></i>
                    </a>
                </td>
                <?php $calculateFinalPrice = $item->options->productQuantity * $item->options->productPrice; ?>
                <?php $finalCartPrice = $finalCartPrice + $calculateFinalPrice; ?>
            </tr>
        @endforeach

    </tbody>

</table>

<br />
@if (Cart::instance('shopping')->count() > 0 && $hasPrice)
    <div class="col-lg-12 mb-80">
        <!--=======  coupon area  =======-->

        <div class="cart-coupon-area pb-30">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-md-30 mb-sm-30">
                    <!--=======  coupon form  =======-->

                    <div class="lezada-form coupon-form">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-7 mb-sm-10">
                                    <input type="text" class="code"
                                        placeholder="{{ __('messages.Enter your coupon code') }}">
                                </div>
                                <div class="col-md-5">
                                    <a
                                        class="lezada-button lezada-button--medium star apply-coupon">{{ __('messages.apply coupon') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--=======  End of coupon form  =======-->
                </div>


            </div>
        </div>

        <!--=======  End of coupon area  =======-->
    </div>
    <br />
    <br />
@endif

<div class="col-xl-4 offset-xl-8 col-lg-5 offset-lg-7 pr-0">
    <div class="cart-calculation-area">
        <h2 class="mb-40">{{ __('messages.CART TOTALS') }}</h2>

        <table class="cart-calculation-table mb-30">
            @if (session()->has('coupon') && session()->get('coupon') != '' && Cart::instance('shopping')->count() > 0)
                <th>{{ __('messages.Coupon') }}</th>
                <td style="font-size: 24px;font-weight: 600;line-height: 48px;color: #333;">
                    {{ session('coupon')['value'] }}</td>
            @endif
            <tr>
                <th>{{ __('messages.SUPTOTAL') }}</th>
                <td class="total" id="total-price">
                    @if (session()->has('coupon') && session()->get('coupon') != '' && Cart::instance('shopping')->count() > 0)
                        {{ str_replace(',', '', $finalCartPrice) - session('coupon')['value'] }}
                    @else
                        <span id="total-price">{{ $finalCartPrice }}</span>
                        {{-- {{ Cart::subtotal() }} --}}
                    @endif
                </td>
            </tr>
            <tr>
                <th>{{ isset($settings['tax-one']) ? unserialize($settings['tax-one']) : '' }}</th>
            </tr>
            {{-- <tr>
                    <th>{{ __('messages.ORDER TOTAL') }}</th>
                    <td class="total">
                     
                    </td>
                </tr> --}}

        </table>
        @if (Cart::instance('shopping')->count())
            <div class="cart-calculation-button text-center">
                <a class="lezada-button lezada-buttons mb-40--medium order-via-whatsup" style=" width:100%; padding:5%">
                    {{ __('messages.ORDER NOW BY WHATSAPP') }} <i class="fa fa-whatsapp"></i>
                </a>
            </div>
        @endif
    </div>
</div>
