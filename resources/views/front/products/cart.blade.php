<?php
      use App\Models\Cart;
      use App\Models\Product;
?>
@extends('layouts.front_layout.front_layout')

@section('title', )


@section('content')

<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Cart</a></li>
          <li>
            <a class="breadcrumb-item float-right" href="{{ url('/') }}">Continue Shopping</a>
          </li>
        </ol>
      </nav>
</div>

<div class="row py-5 mt-4 align-items-center">
    <!-- For Demo Purpose -->
    <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
        <img src="https://res.cloudinary.com/mhmd/image/upload/v1569543678/form_d9sh6m.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
        <h3>I'm Already Registered</h3>
    </div>

    <!-- Registeration Form -->
    <div class="col-md-7 col-lg-6 ml-auto">
        <form action="#">
            <div class="row">
                <div class="input-group col-lg-12 mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                            <i class="fa fa-user text-muted"></i>
                        </span>
                    </div>
                    <input id="firstName" type="text" name="firstname" placeholder="Username" class="form-control bg-white border-left-0 border-md">
                </div>
                <div class="input-group col-lg-12 mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                            <i class="fa fa-lock text-muted"></i>
                        </span>
                    </div>
                    <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                </div>
                <div class="form-group col-lg-12 mx-auto mb-0">
                    <a href="#" class="btn btn-primary btn-block py-2">
                        <span class="font-weight-bold">Login</span>
                    </a>
                </div>
                <div class="text-center w-100 mt-4  ">
                    <p class="text-muted font-weight-bold">Create Account   ? <a href="#" class="text-primary ml-2">Register</a></p>
                </div>
            </div>
        </form>
    </div>
</div>

<section>
    <div class="row">
      <div class="col-lg-8">
        <div class="mb-3">
          <div class="pt-4 wish-list">
            <h5 class="mb-4">Cart (<span>{{ $cartCount }}</span> items)</h5>
            <?php
              $total_price = 0;
              $totalDiscountedPrice = 0;
            ?>
            @foreach ($userCartItems as $item)
                <?php $attrPrice =  Cart::getProductAttrPrice($item['product_id'], $item['size']);
                       $discounted_price = Cart::getDiscountedPrice($item['product_id'], $item['size']);
                ?>
                <div class="row mb-4">
                    <div class="col-md-5 col-lg-3 col-xl-3">
                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                        <img class="img-fluid w-100"
                        src="{{ asset('images/product_images/medium/' .$item['product']['main_image']) }}" alt="Sample">
                    </div>
                    </div>
                    <div class="col-md-7 col-lg-9 col-xl-9">
                    <div>
                        <div class="d-flex justify-content-between">
                        <div>
                            <h5>{{ $item['product']['product_name'] }}</h5>
                            <p class="mb-2 text-muted text-uppercase small">{{ $item['product']['product_code'] }}</p>
                            <p class="mb-2 text-muted text-uppercase small">Color: {{ $item['product']['product_color'] }}</p>
                            <p class="mb-2 text-muted text-uppercase small">Size: {{ $item['size'] }}</p>

                            @if ($discounted_price > 0)
                            <p class="mb-2 text-muted text-uppercase small">Price: Rp. {{ number_format($discounted_price) }}</p>
                            @else
                            <p class="mb-2 text-muted text-uppercase small">Price: Rp. {{ number_format($attrPrice) }}</p>
                            @endif

                        </div>
                        <div>
                            <div class="def-number-input number-input safari_only mb-0 w-100">
                                <label class="small" for="quantity">Quantity</label>
                                <input type="number" class="form-control" value="{{ $item['quantity'] }}" id="quantity">
                            </div>
                            {{-- <small id="passwordHelpBlock" class="form-text text-muted text-center">
                              @if (!empty($item['product']['product_discount']))
                                  <p class="small"><del>{{$item['product']['product_discount']}}</del> -
                                  <p>
                                      (Disc: &nbsp; {{ $item['product']['product_discount'] }}%)
                                  </p>
                              @else
                                  @if (!empty($item['category']['category_discount']))
                                  (Disc: &nbsp; {{ $item['product']['category']['category_discount'] }}%)
                                  @else
                                  (Disc: &nbsp; {{ $item['product']['category']['category_discount'] }}%)
                                  @endif
                              @endif
                            </small> --}}
                        </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#!" type="button" class="card-link-secondary small text-uppercase mr-3"><i
                                class="fas fa-trash-alt mr-1"></i> Remove item </a>
                            <a href="#!" type="button" class="card-link-secondary small text-uppercase"><i
                                class="fas fa-heart mr-1"></i> Move to wish list </a>
                        </div>
                            @if ($discounted_price > 0)
                                <p class="mb-0"><span class="">Sub Total : <strong id="summary">Rp. {{ number_format($discounted_price * $item['quantity']) }}</strong></span></p class="mb-0">
                            @else
                                <p class="mb-0"><span class="">Sub Total : <strong id="summary">Rp. {{ number_format($attrPrice * $item['quantity']) }}</strong></span></p class="mb-0">
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
                <?php
                    if($discounted_price > 0){
                        $total_price = $total_price + ($discounted_price * $item['quantity']);
                    } else {
                        $total_price = $total_price + ($attrPrice * $item['quantity']);
                    }
                ?>
            @endforeach
            <hr class="mb-4">
            <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> Do not delay the purchase, adding
              items to your cart does not mean booking them.</p>
          </div>
        </div>
        <div class="mb-3">
          <div class="pt-4">
            <h5 class="mb-4">Expected shipping delivery</h5>
            <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
          </div>
        </div>
        <div class="mb-3">
          <div class="pt-4">
            <h5 class="mb-4">We accept</h5>
            <img class="mr-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa">
                <img class="mr-2" width="45px"
                src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                alt="American Express">
            <img class="mr-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard">
            <img class="mr-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
              alt="PayPal acceptance mark">
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="mb-3">
          <div class="pt-4">
            <h5 class="mb-3">The total amount of</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Temporary amount
                <span>
                    Rp. {{ number_format($total_price) }}
                </span>
              </li>
              {{-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                 Total Discount
                <span></span>
              </li> --}}
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <select name="ship" id="ship">
                    <option value="">Select Shipping</option>
                    @foreach ($shipData as $ship)
                    <option value="{{ $ship['id'] }}">{{ $ship['address'] }} = {{ $ship['price'] }}</option>
                    @endforeach
                </select>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Total Amount
                <span>Rp. {{  number_format($total_price) }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Grand total</strong>
                  <strong>
                    <p class="mb-0">(Include Shipping)<p>
                  </strong>
                </div>
                <span><strong>Rp. {{ number_format($total_price) }}</strong></span>
              </li>
            </ul>

            <button type="button" class="btn btn-primary btn-block">go to checkout</button>

          </div>
        </div>

        <div class="mb-3">
          <div class="pt-4">

            <label for="dicount">Add a discount code </label>
            <input type="text" id="discount-code" class="form-control font-weight-light"
            placeholder="Enter discount code">

        </div>
      </div>
    </div>
</section>

@endsection
