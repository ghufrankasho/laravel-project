<div class="checkout-cart-total">
    <h4>{{ __('messages.PRODUCT') }} <span>{{ __('messages.TOTAL') }}</span></h4>
    <ul>
        @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
            <li>
                {{ $item->name }} X {{ $item->qty }}
                <span>{{ $item->subtotal() }}</span>
            </li>
        @endforeach

    </ul>
    <h4>{{ __('messages.GRAND TOTAL') }} <span>{{ Cart::subtotal() }}</span></h4>
</div>
@if (Cart::instance('shopping')->count() > 0)
    <button class="lezada-button lezada-button--medium mt-30">{{ __('messages.PLACE ORDER') }}</button>
@endif
