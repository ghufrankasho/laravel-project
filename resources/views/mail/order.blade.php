<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <title>Order Confirmation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
</head>

<body style="font-family: "Work Sans",sans-serif;font-size: 15px;font-weight: 400;font-style: normal;line-height: 24px;position: relative;visibility: visible;color: #777;background-color: #fff;">
    <div class="container pt-5 pb-5" style="max-width: 960px;color: #777;background-color: #fff;width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12" style="flex: 0 0 50%;max-width: 50%;">
                <h3 style="line-height: 30px;font-size:24px;font-family: "Work Sans",sans-serif;font-weight: 400;margin-top: 0;color: #333;">Order ID is PR#{{ $details->id }}</h3>
                <p style="margin-top: 0;margin-bottom: 1rem;">Hey {{ $details->full_name }}</p>
                <p style="margin-top: 0;margin-bottom: 1rem;">Your Order Has Been succefully Created</p>
                <p style="margin-top: 0;margin-bottom: 1rem;">Below , You will see the details- of your order</p>
                <br />
                <br />
                <br />

            </div>
        </div>

        <div class="checkout-page-area mb-130" style="margin-bottom: 130px !important;">
            <div class="container"style="max-width: 960px;color: #777;background-color: #fff;width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
                 <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
                    <div class="col-12" style="flex: 0 0 100%;max-width: 100%;">
                        <div class="lezada-form">
                            <form class="checkout-form" method="POST">
                            <div class="row row-40" style="margin-left: -15px;margin-right: -15px;">
                                <div class="col-lg-7 mb-20" style="-ms-flex: 0 0 60%;flex: 0 0 60%;max-width: 60%;margin-bottom: 20px !important;float:left">
                                    <!-- Billing Address -->
                                    <div id="billing-form" class="mb-40">
                                                 <h4 class="checkout-title" style="color:#000;font-weight: bold;font-size: 20px;font-weight: 700;line-height: 23px;margin-bottom: 30px;text-decoration: underline;text-transform: capitalize;">{{ __('Billing Address') }}</h4>
                                              <div class="row" style="margin-right: -15px;margin-left: -15px;width:542px">
                                                <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Name</label>
                                                    <input readonly type="text" name="first_name" value="{{ $details->full_name }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px">
                                                </div>
                                                <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Email</label>
                                                    <input readonly type="email" required name="email" value="{{ $details->email }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px">
                                                </div>
                                              </div>    
                                             <div class="row" style="margin-right: -15px;margin-left: -15px;width:542px">
                                               <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                    
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Phone Number</label>
                                                    <input readonly type="text" required name="mobile_number" value="{{ $details->mobile_number }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>
                                                </div>
                                            
    
                                                 <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                     <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Address</label>
                                                    <input readonly type="text" required name="address" value="{{ $details->address }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>
                                                </div>
                                            </div>
                                           <div class="row" style="margin-right: -15px;margin-left: -15px;width:542px">
                                                  <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                    
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Country</label>
                                                    <input readonly type="text" required name="country"  value="{{ $details->country }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>
                                                </div>
    
                                                <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">
                                                 
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your City</label>
                                                    <input readonly type="text" required name="city" value="{{ $details->city }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>
                                                </div>
                                            </div>
                                            <!--<div class="row" style="margin-right: -15px;margin-left: -15px;width:542px">-->
                                            <!--     <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">-->
                                                  
                                            <!--        <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your State</label>-->
                                            <!--        <input readonly type="text" required name="state" placeholder="{{ __('State') }}" value="{{ $details->state }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>-->
                                            <!--    </div>-->
    
                                            <!--    <div class="col-md-12 col-12 mb-20" style="max-width:50%;float: left;width: 50%;">-->
                                                    
                                            <!--        <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Your Zip Code</label>-->
                                            <!--        <input readonly type="text" required name="zip_code" placeholder="{{ __('Zip Code*') }}" value="{{ $details->zip_code }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>-->
                                            <!--    </div>-->
                                            <!-- </div>-->
                                             <div class="row" style="margin-right: -15px;margin-left: -15px;width:542px">
                                                <div class="col-md-6 col-12 mb-20">
                                                    
                                                    <label style="font-size: 15px;font-weight: 500;line-height: 24px;letter-spacing: 1px;text-transform: uppercase;color: #333;">Created Date</label>
                                                    <input readonly type="text" required name="" placeholder="{{ __('Zip Code*') }}" value="{{ $details->created_at }}" style="border:1px ;border-radius: 0;margin-bottom: 15px;line-height: 23px;border-bottom: 2px solid #ccc;background: 0 0;transition: all .3s ease-in-out;color: #333;border: 1px solid transparent;font-size: 14px;display: block;width: 100%;padding: 9.5px 0;border-bottom:1px"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                               

                                <div class="col-lg-5" style="-ms-flex: 0 0 40%;flex: 0 0 40%;max-width: 40%;float:right">
                                    <div class="row">
                                        <!-- Cart Total -->
                                        <div class="col-12 mb-60">
                                            <h4 class="checkout-title" style="color:#000;font-size: 20px;font-weight: 700;line-height: 23px;margin-bottom: 30px;text-decoration: underline;text-transform: capitalize;">{{ __('Cart Total') }}</h4>
                                            <div class="checkout-cart-total" style="padding: 45px;background-color: #f2f2f2;">
                                                <h4 style="color:#000;font-weight: bold;line-height: 23px;margin-top: 0;margin-bottom: 25px;fonst-size:18px">{{ __('Product') }} <span>{{ __('Total') }}</span></h4>
                                                <ul style="border-bottom: 1px solid #999999;padding-left:0px">
                                                    @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                                        <li style="font-size: 14px;font-weight: 500;line-height: 23px;display: block;margin-bottom: 16px;color: #777777;">
                                                            {{ $item->name }} X {{ $item->qty }}
                                                            <span style="float: right;color: #333333;">{{ $item->subtotal() }}</span>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <h4 style="color:#000;font-weight: bold;line-height: 23px;margin-top: 0;margin-bottom: 25px;fonst-size:18px">{{ __('Grand Total') }}  <span style="float: right;color: #333333;">{{ Cart::subtotal() }}</span>
                                                </h4>
                                            </div>

                                        </div>

                                    </div>
                                </div>
 </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
             <p>Best Regards</p>
        <p>Team Yemmen Products</p>
        </div>
       
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
