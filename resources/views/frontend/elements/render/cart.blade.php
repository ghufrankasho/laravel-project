<div class="cart-overlay" id="cart-overlay">
    <div class="cart-overlay-close inactive"></div>
    <div class="cart-overlay-content">
        <!--=======  close icon  =======-->

        <span class="close-icon" id="cart-close-icon">
            <a href="javascript:void(0)">
                <i class="ion-android-close"></i>
            </a>
        </span>

        <div class="offcanvas-cart-content-container">
            <h3 class="cart-title">{{ __('messages.Cart') }}</h3>
            <div class="cart-product-wrapper">
                <div class="cart-product-container  ps-scroll">
                    <?php $finalCartPrice = 0; ?>
                    @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                        <div class="single-cart-product">
                            <span class="cart-close-icon delete-from-cart" data-id="{{ $item->rowId }}">
                                <a href="#">
                                    <i class="ti-close"></i>
                                </a>
                            </span>
                            @php
                                $photo = explode(',', $item->model->photo);
                            @endphp
                            <div class="image">
                                <a href="{{ url(app()->getLocale() . '/product/' . $item->model->slug) }}"
                                    rel="alternate" hreflang="{{ app()->getLocale() }}">
                                    <img src="{{ $photo[0] }}" class="img-fluid" alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="content">
                                <h5>
                                    <a href="{{ url(app()->getLocale() . '/product/' . $item->model->slug) }}"
                                        rel="alternate" hreflang="{{ app()->getLocale() }}">
                                        {{ $item->model->title }}
                                    </a>
                                </h5>
                                <?php $calculateFinalPrice = $item->options->productQuantity * $item->options->productPrice; ?>
                                <p>
                                    <span class="cart-count">
                                        {{ $item->options->productQuantity }}
                                        x
                                        {{ $item->options->productPrice ?? 0 }}
                                        {{-- x --}}
                                        {{-- {{ $item->price > 0 ? $item->options->min /  $item->price : '' }} --}}
                                    </span>
                                    =
                                    <span class="discounted-price">{{ $calculateFinalPrice . __('messages.AED ') }}
                                    </span>
                                </p>
                                <?php $finalCartPrice = $finalCartPrice + $calculateFinalPrice; ?>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="cart-subtotal">
                    <span class="subtotal-title">{{ __('messages.Subtotal:') }}</span>
                    <span class="subtotal-amount">
                        {{-- {{ Cart::subtotal() }} --}}
                        <?= $finalCartPrice ?>
                    </span>
                </p>
                @if (Cart::instance('shopping')->count() > 0)
                    <div class="cart-buttons">
                        <a href="{{ route('cart', app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                            {{ __('messages.Checkout') }}
                        </a>
                        {{-- <a href="{{ route('checkout', app()->getLocale()) }}">{{ __('messages.Checkout') }}</a> --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
