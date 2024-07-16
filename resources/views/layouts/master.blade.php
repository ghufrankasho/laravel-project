<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('frontend.elements.head')
        <!-- Meta Pixel Code -->
        <style>
            .lz-loading,.lz-error {
                background: #F1F1FA;
                width: 400px;
                height: 300px;
                display: block;
                margin: 10px auto;
                border: 0;
                }
        </style>
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1485077948989214');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1485077948989214&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
</head>

<body>

    @include('frontend.elements.header')
    <br />


    {{-- @if (Request::segment(2) == '')
        @include('frontend.elements.sidepanale')
    @endif --}}
    @yield('content')
    @include('frontend.elements.footer')
    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->
    <!-- jQuery -->
    <script src="{{ secure_asset('frontend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/plugins.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/main.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ secure_asset('frontend/js/lazyload.min.js') }}"></script>
     <script>
 
        (function() {
            function logElementEvent(eventName, element) {
                //console.log(Date.now(), eventName, element.getAttribute("data-src"));
            }

            var callback_enter = function(element) {
                logElementEvent("🔑 ENTERED", element);
            };
            var callback_exit = function(element) {
                logElementEvent("🚪 EXITED", element);
            };
            var callback_loading = function(element) {
                logElementEvent("⌚ LOADING", element);
            };
            var callback_loaded = function(element) {
                logElementEvent("👍 LOADED", element);
            };
            var callback_error = function(element) {
                logElementEvent("💀 ERROR", element);
                // element.src = "https://via.placeholder.com/440x560/?text=Error+Placeholder";
            };
            var callback_finish = function() {
                logElementEvent("✔️ FINISHED", document.documentElement);
            };
            var callback_cancel = function(element) {
                logElementEvent("🔥 CANCEL", element);
            };

            var ll = new LazyLoad({
                class_applied: "lz-applied",
                class_loading: "lz-loading",
                class_loaded: "lz-loaded",
                class_error: "lz-error",
                class_entered: "lz-entered",
                class_exited: "lz-exited",
                // Assign the callbacks defined above
                callback_enter: callback_enter,
                callback_exit: callback_exit,
                callback_cancel: callback_cancel,
                callback_loading: callback_loading,
                callback_loaded: callback_loaded,
                callback_error: callback_error,
                callback_finish: callback_finish
            });
        })();
    </script>
    {{-- <script src="{{ asset('frontend/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution-active.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/extensions/revolution.extension.parallax.min.js') }}"></script>
     --}}
    
   
 

    <script>
        //  {{-- ORDER ON WHATSAPP --}}
        $(document).on("click", ".add-to-cart", function(e) {
            e.preventDefault();
            // $(this).data('quantity')
            let productId = $(this).data('product-id');
            let productQuantity = $('body').find('.get-quanitiy-' + productId).val();
            // let price  = $('body').find('.get-quanitiy-' + productId).attr('data-price');
            let totalPrice = parseFloat($('body').find('.get-quanitiy-' + productId).parent().parent().find(
                '.show-price').html());

            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('cart.store', app()->getLocale())) }}";
            let wordBegoreSend = "{{ __('messages.Loading...') }}";
            let wordafterSend = "{{ __('messages.ADD TO CART') }}";
            //  add test
            // if (window.location.protocol === "http:") {
                 path = path.replace("http://", "https://");
            // }

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    productId: productId,
                    productQuantity: productQuantity,
                    totalPrice: totalPrice,
                    _token: token
                },
                beforeSend: function() {
                    $('body').find('.add-to-cart-btn-' + productId).html(
                        '<i class="fa fa-spinner fa-spin"></i> {{ __('messages.Loading...') }}');

                    $('body').find('#add-to-cart-' + productId).html(
                        '<i class="fa fa-spinner fa-spin"></i> {{ __('messages.Loading...') }}');
                    $('body').find('.add-to-cart-btn #add-to-cart-' + productId).html(
                        '<i class="fa fa-spinner fa-spin"></i> {{ __('messages.Loading...') }}');
                },
                complete: function() {
                    $('body').find('.add-to-cart-btn-' + productId).html(
                        '{{ __('messages.ADD TO CART') }}');
                    $('#add-to-cart-' + productId).html('{{ __('messages.ADD TO CART') }}');
                    $('body').find('.add-to-cart-btn #add-to-cart-' + productId).html(
                        '{{ __('messages.ADD TO CART') }}');
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body .cart-detail').html(data['cart-detail']);
                        $('body .checkout-cart-total').html(data['checkout-cart-total']);
                        swal({
                            title: "{{ __('messages.Successfully Added!') }}",
                            text: data['message'],
                            icon: "success",
                            button: "Ok!",
                        });
                        // window.open(data['whatsuplink'], "_blank");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Remove from Cart 
        $(document).on("click", ".delete-from-cart", function(e) {
            e.preventDefault();
            let cartId = $(this).data('id');
            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('cart.delete', app()->getLocale())) }}";
            path = path.replace("http://", "https://");
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cartId: cartId,
                    _token: token
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body .cart-detail').html(data['cart-detail']);
                        $('body #cart-list').html(data['cart-list']);
                        $('body .checkout-cart-total').html(data['checkout-cart-total']);
                        swal({
                            title: "{{ __('messages.Successfully Removed!') }}",
                            text: data['message'],
                            icon: "success",
                            button: "Ok!",
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Update Quantity
        $(document).on("click", ".update-quantity", function(e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            let cartId = $(this).data('id');
            let spinner = $(this);
            let input = spinner.closest('div.update-quantity').find('input[type="text"]');
            var originalMinimumQuantity = parseFloat($(this).data("original_minimum_quantity"));
            if (input == originalMinimumQuantity) {
                return false;
            }
            // if (input.val() == 1) {
            //     return false;
            // }

            if (input.val() != 1) {
                let newVal = parseFloat(input.val());
                $('#qty-input-' + cartId).val(newVal);
            }
            updateCart(cartId);
        });

        // Update Cart
        function updateCart(id) {
            let cartId = id;
            let productQuantity = parseFloat($('#qty-input-' + cartId).val());
            let productId = $('#qty-input-' + cartId).attr('data-product-id');
            let minVal = parseInt($('#qty-input-' + cartId).attr('data-original-min'));
            let totalPrice = parseFloat($('#qty-input-' + cartId).parent().closest("tr").find(".show-price").html());
            let originalValue = parseFloat($('#qty-input-' + cartId).find('input').attr('data-original-value'));
            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('cart.update', app()->getLocale())) }}";

            path = path.replace("http://", "https://");
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cartId: cartId,
                    productQuantity: productQuantity,
                    // minVal: minVal,
                    _token: token,
                    totalPrice: totalPrice ? totalPrice : 0,
                    productId: productId,
                    // originalValue: originalValue,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body .cart-detail').html(data['cart-detail']);
                        $('body #cart-list').html(data['cart-list']);
                        // $('body .checkout-cart-total').html(data['checkout-cart-total']);
                        swal({
                            title: "{{ __('messages.Successfully Updated!') }}",
                            text: data['message'],
                            icon: "success",
                            button: "Ok!",
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        // submit the form for searching
        $(document).on("click", ".search", function(e) {
            $('.search-form').submit();
        });

        //  {{-- request order --}}
        //  this is use when i want to order via what up in quick view
        // use this function in cart page
        var requestOrder = false;
        var locked = false;
        $(document).on("click", ".request-order", function(e) {
            // e.preventDefault();
            if (requestOrder) {
                return false;
            }
            requestOrder = true;
            let productId = $(this).data('product-id');
            let productQuantity = $('body').find('.get-quanitiy-' + productId).val();
            let totalPrice = parseFloat($('body').find('.get-quanitiy-' + productId).parent().parent().find(
                '.show-price').html());
            let price = parseFloat($(this).data('price'));
            // let selectedProperties = $('.product-properites .properties-options-' + productId).val();
            // if (selectedProperties == '') {
            //     $('.properties').addClass('border border-danger');
            //     requestOrder = false;
            //     return false;
            // } else {
            //     $('.properties').removeClass('border border-danger');
            // }
            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('cart.store', app()->getLocale())) }}";
            let wordBegoreSend = "{{ __('messages.Loading...') }}";
            let wordafterSend = "{{ __('messages.WHATSAPP QUOTE') }}";

            path = path.replace("http://", "https://");

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    productId: productId,
                    productQuantity: productQuantity,
                    // selectedProperties: $('.product-properites .properties-options-' + productId).val(),
                    totalPrice: parseFloat(price * productQuantity),
                    _token: token
                },
                beforeSend: function() {
                    $('body').find('.request-order').html(
                        '<span><i class="fa fa-spinner fa-spin"></i> {{ __('messages.Loading...') }}</span>'
                    );
                },
                complete: function() {
                    $('body').find('.request-order').html(
                        '<span><i class="fa  fa-whatsapp"></i> {{ __('messages.WHATSAPP QUOTE') }}</span>'
                    );
                },
                success: function(data) {
                    requestOrder = false;
                    if (data['status']) {
                        let token = "{{ csrf_token() }}";
                        let path = "{{ secure_url(route('checkout.store', app()->getLocale())) }}";
                        path = path.replace("http://", "https://");
                        $.ajax({
                            url: path,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                _token: token
                            },
                            success: function(data) {
                                locked = false;
                                if (data['status']) {
                                    $('body #header-ajax').html(data['header']);
                                    $('body .cart-detail').html(data['cart-detail']);
                                    $('body .checkout-cart-total').html(data[
                                        'checkout-cart-total']);
                                    if (navigator.userAgent.indexOf("Safari") != -1) {
                                        window.location.replace(data['whatsuplink']);
                                    } else {
                                        window.open(data['whatsuplink'], '_blank')
                                    }
                                }

                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });



        // order via whats up 
        // use this function in cart page
        var locked = false;
        $(document).on("click", ".order-via-whatsup", function(e) {
            if (locked) {
                return false;
            }
            locked = true;
            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('checkout.store', app()->getLocale())) }}";
            let wordBegoreSend = "{{ __('messages.Loading...') }}";
            let wordafterSend = "{{ __('messages.DIRECT QUOTATION') }}";
            path = path.replace("http://", "https://");
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: token
                },
                beforeSend: function() {
                    $('body').find('.order-via-whatsup').html(
                        '<i class="fa fa-spinner fa-spin"></i> {{ __('messages.Loading...') }}');
                },
                complete: function() {

                },
                success: function(data) {
                    locked = false;
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body .cart-detail').html(data['cart-detail']);
                        $('body .checkout-cart-total').html(data['checkout-cart-total']);
                        $('body').find('.order-via-whatsup').html(
                            '{{ __('messages.DIRECT QUOTATION') }}');
                        if (navigator.userAgent.indexOf("Safari") != -1) {
                            window.location.replace(data['whatsuplink']);
                        } else {
                            window.open(data['whatsuplink'], '_blank')
                        }
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        //  apply coupon
        $(document).on("click", ".apply-coupon", function(e) {
            e.preventDefault();
            let code = $('.code').val();
            if (code == '') {
                $('.code').addClass('border border-danger');
                return false;
            }
            $('.apply-coupon').html('<i class="fa fa-spinner fa-spin"></i>{{ __('messages.Applying...') }}');
            // $('#coupon-form').submit();
            let token = "{{ csrf_token() }}";
            let path = "{{ secure_url(route('apply-coupon', app()->getLocale())) }}";
            let totalAmount =  parseFloat($('#total-price').html(), 10);

            path = path.replace("http://", "https://");

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    code: code,
                    _token: token,
                    totalAmount:totalAmount
                },
                success: function(data) {

                    if (data['status']) {
                        window.location
                        $('.apply-coupon').html('{{ __('messages.Apply Coupon') }}');
                        $('.code').val('');
                        $('body #header-ajax').html(data['header']);
                        $('body .cart-detail').html(data['cart-detail']);
                        $('body .checkout-cart-total').html(data['checkout-cart-total']);
                        $('body').find('.shop_table button').remove();
                        swal({
                            title: "{{ __('messages.Successfully Added!') }}",
                            text: data['message'],
                            icon: "success",
                            button: "Ok!",
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        $('.apply-coupon').html('{{ __('messages.Apply Coupon') }}');
                        $('.code').val('');
                        $('body').find('.shop_table button').remove();
                        swal({
                            title: "{{ __('messages.Failed!') }}",
                            text: data['message'],
                            icon: "error",
                            button: "Ok!",
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                    swal({
                        title: "Error",
                        text: error.message,
                        button: "Ok!",
                    });
                }
            });
        });
        /*----------  Scroll to top  ----------*/

        $(".scroll-top").on("click", function() {
            $("html,body").animate({
                    scrollTop: 0
                },
                2000
            );
        });

        $(document).on("click", ".qty-btns-click", function(e) {
            calculateOneItemPrice = 0;
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            //  if has price will get value one else it will get the value of each category
            var getMinimumValue = parseFloat($button.parent().find("input").attr("min"));
            var originalMinimumQuantity = parseFloat($button.parent().attr("data-original-min"));
            //  the price pf package
            var price = parseFloat($button.parent().find("input").attr("data-price"));
            var totalPriceForEachRow = parseFloat($button.closest("tr").find(".show-price").html());
            var originalMinQuantity = parseFloat($button.parent().attr('data-original-min'));
            var dataProductPrice = parseFloat($button.parent().find("input").attr('data-product-price'));
            if (price > 0 && !isNaN(price)) {
                // calculateOneItemPrice = parseFloat(originalMinimumQuantity / price);
                calculateOneItemPrice = price;
                calculateOneItemPrice = 1;
            } else {
                calculateOneItemPrice = originalMinimumQuantity
            }
            if ($button.hasClass("inc")) {

                var newInputQuantity = parseFloat(oldValue) + calculateOneItemPrice;
                if (price > 0 && !isNaN(price)) {
                    finalPrice = newInputQuantity * dataProductPrice;
                    var showPrice = $button.closest("tr").find(".show-price").html(finalPrice);
                }

            } else {
                // Don't allow decrementing below originalMinimumQuantity
                if (oldValue == originalMinQuantity) {
                    return false;
                }
                var newInputQuantity = parseFloat(oldValue) - calculateOneItemPrice;
                if (price > 0 && !isNaN(price)) {
                    let finalPrice = newInputQuantity * dataProductPrice;
                    $button.closest("tr").find(".show-price").html(finalPrice);
                }
                if (oldValue > 0) {
                    var newInputQuantity = parseFloat(oldValue) - calculateOneItemPrice;
                    // console.log(oldValue)
                    if (newInputQuantity == 0) {
                        return newInputQuantity = calculateOneItemPrice;
                    }
                } else {
                    newInputQuantity = calculateOneItemPrice;
                }
            }
            $button.parent().find("input").val(newInputQuantity);
        });

        //  this shit for only procut
        $(document).on("click", ".qty-btns-click-product", function(e) {
            calculateOneItemPrice = 0;
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            
            //  if has price will get value one else it will get the value of each category
            var getMinimumValue = parseFloat($button.parent().find("input").attr("min"));
            var originalMinimumQuantity = parseFloat($button.parent().attr("data-original-min"));
            //  the price pf package
            var price = parseFloat($button.parent().find("input").attr("data-price"));
            var totalPriceForEachRow = parseFloat($button.closest("tr").find(".show-price").html());
            var originalMinQuantity = parseFloat($button.parent().attr('data-original-min'));
            var dataProductPrice = parseFloat($button.parent().find("input").attr('data-product-price'));
            if (price > 0 && !isNaN(price)) {
                // calculateOneItemPrice = parseFloat(originalMinimumQuantity / price);
                calculateOneItemPrice = price;
                calculateOneItemPrice = 1;
            } else {
                calculateOneItemPrice = originalMinimumQuantity
            }
            if ($button.hasClass("inc")) {
                var newInputQuantity = parseFloat(oldValue) + calculateOneItemPrice;
                if (price > 0 && !isNaN(price)) {
                    finalPrice = newInputQuantity * dataProductPrice;
                    var showPrice = $button.closest(".shop-product__description").find(".show-price").html(finalPrice);
                }

            } else {
                // Don't allow decrementing below originalMinimumQuantity
                if (oldValue == originalMinQuantity) {
                    return false;
                }
                var newInputQuantity = parseFloat(oldValue) - calculateOneItemPrice;
                if (price > 0 && !isNaN(price)) {
                    let finalPrice = newInputQuantity * dataProductPrice;
                    $button.closest(".shop-product__description").find(".show-price").html(finalPrice);
                }
                if (oldValue > 0) {
                    var newInputQuantity = parseFloat(oldValue) - calculateOneItemPrice;
                    // console.log(oldValue)
                    if (newInputQuantity == 0) {
                        return newInputQuantity = calculateOneItemPrice;
                    }
                } else {
                    newInputQuantity = calculateOneItemPrice;
                }
            }
            $button.parent().find("input").val(newInputQuantity);
        });
    </script>
    {{--<script>
        document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages = document.querySelectorAll("img.lazy");    
  var lazyloadThrottleTimeout;
  
  function lazyload () {
    if(lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }    
    
    lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
    }, 20);
  }
  
  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});
    </script>--}}
    <div class="cart-detail">
        @include('frontend.elements.render.cart')
    </div>
    @yield('scripts')
</body>

</html>
