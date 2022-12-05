@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->

@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-login store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{ __('home.Checkout') }}
@endsection

@section('TitleURL')
{{ url('/cart')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
Checkout
@endsection

@section('cssAssets')
26e393dff2cfccb73d5f3c8433be85d2fdc9.css?v=7f711446
@endsection

@section('cssfile')
home
@endsection

@section('jsAssets')
c4cd4981133c7c0f792cf762de2922c8fdc9.js?v=7f711446
@endsection

@section('jsLibraries')
  <style type="text/css">
    .panel-title {
      display: inline;
      font-weight: bold;
    }
    .display-table {
      display: table;
    }

    .display-tr {
      display: table-row;
    }

    .display-td {
      display: table-cell;
      vertical-align: middle;
      width: 61%;
    }
  </style>
@endsection

@section('content')
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ __('home.Home') }}</a></li>
    <li><a href="">{{ __('home.Checkout') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.Quick Checkout') }}</span></h1>
  
  <div id="content" class="col-md-12 container">
  <?php 
    $totalPrice=0;
    $totalPriceDollar=0;
    $currency = session()->get('cur_currency');
    $symbol = session()->get('cur_symbol');
    if(count($cart) == 0) echo '<div><p style="text-align: center; color:#888; font-size:20px;">'.__('home.cart is empty') .'</p></div>'; 
    else { ?>
    <!-- Shopping Cart -->
    <div class="row">
      <div class="col-md-6 col-sm-12" style="margin: 0 auto;">
        <div class="checkout-section cart-section">
          <div class="headCheckout title section-title">{{ __('home.Shopping Cart') }}</div>
          <div class="section-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center td-image">{{ __('home.Image') }}</td>
                    <td class="text-center td-name">{{ __('home.Name') }}</td>
                    <td class="text-center td-qty">{{ __('home.Quantity') }}</td>
                    <td class="text-center td-price">{{ __('home.Unit Price') }}</td>
                    <td class="text-center td-total">{{ __('home.Total') }}</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cart as $item)
                    <?php 
                      $product = \App\Models\Product::find($item->product_id); 
                      if($item->quantity > $product->stock ) $cur_qty = $product->stock; 
                      else $cur_qty = $item->quantity;
                    ?>
                    <tr>
                      <td width="15%" class="text-center td-image"><a href="{{url('/product')}}/{{$product->id}}"><img src="{{IMAGE}}images/products/{{$product->image}}" alt="{{$product->name}}" title="{{$product->name}}" /></a></td>
                      <td width="25%"class="text-center td-name"><a href="{{url('/product')}}/{{$product->id}}">{{$product->name}}</a></td>
                      <td width="20%" class="text-center td-qty">{{$cur_qty}}</td>
                      <td width="20%" class="text-center td-price">
                        <div class="price">
                          <?php 
                            $old_price = $product->price*$currency;
                            $new_price = $old_price - $product->discount * $old_price /100 ;
                            if($product->discount)$price = $new_price;
                            else $price = $old_price;
                            $act_price = $price*$cur_qty;
                            $totalPrice += $act_price;
                           ?>
                          {{ $symbol .' '. $price }}
                        </div>
                      </td>
                      <td width="20%" class="text-center td-total">{{ $symbol .' '. $act_price }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div> 
        </div>
      </div>
    </div>
      
    <!-- Payment Method -->
    <div class="row">
      <div class="col-md-6 col-sm-12" style="margin: 0 auto;">
        <div class="checkout-section cart-section">
          <div class="headCheckout title section-title">{{ __('home.Payment Method') }}</div>
          <div class="section-body">
            <!-- Total Price -->
            <?php
              if ($symbol == '$')$totalPriceDollar = $totalPrice;
              else $totalPriceDollar = $totalPrice/$currency;
            ?>
            <p>
              <strong>{{ __('home.Total Price in Yours') }}:</strong>
              <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $totalPrice }}</b>
            </p>
            <p>
              <strong>{{ __('home.Total Price in USD') }}:</strong>
              <b style="color:rgba(46, 175, 35, 1);">$ {{ $totalPriceDollar }}</b>
            </p>
            <!-- Checkout -->
            <div style="margin-top: 1%;">
             
              <div class="panel panel-default credit-card-box" style="padding: 1%;">
                <div class="panel-body">
                  @if (Session::has('success-message'))
                    <div class="alert alert-success text-center" style="margin-bottom: 6px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                      <p>{{ Session::get('success-message') }}</p>
                    </div>
                  @elseif(Session::has('fail-message'))
                  <div class="alert alert-danger text-center" style="margin-bottom: 6px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                      <p>{{ Session::get('fail-message') }}</p>
                    </div>
                  @endif
                  <form 
                    role="form" 
                    action="{{ url('/checkout') }}" 
                    method="post" class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="payment-form">
                    @csrf
                    <input type="hidden" name="totalPriceDollar" value="{{ $totalPriceDollar }}">
                    <div class='form-row row'>
                      <div class='col-xs-12 form-group required'>
                        <label class='control-label'>{{ __('home.Name on Card') }}</label>
                        <input class='form-control' size='4' type='text'>
                      </div>
                    </div>
                    <div class='form-row row'>
                      <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>{{ __('home.Card Number') }}</label> 
                        <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                      </div>
                    </div>
                    <div class='form-row row'>
                      <div class='col-xs-12 col-md-4 form-group cvc required'>
                        <label class='control-label'>{{ __('home.CVC') }}</label> 
                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>{{ __('home.Expiration Month') }}</label> 
                        <input class='form-control card-expiry-month' placeholder='MM' size='2'  type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>{{ __('home.Expiration Year') }}</label> 
                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                      </div>
                    </div>
                    <div class='form-row row'>
                      <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>{{ __('home.correct the errors') }}</div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <button class="btn btn-danger btn-lg btn-block" type="submit">{{ __('home.Pay Now') }}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>        

            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>   
@endsection

@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
      var $form         = $(".require-validation"),
          inputSelector = ['input[type=email]', 'input[type=password]',
                           'input[type=text]', 'input[type=file]',
                           'textarea'].join(', '),
          $inputs       = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid         = true;
      $errorMessage.addClass('hide');
      $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    });
    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error').removeClass('hide').find('.alert').text(response.error.message);
      } 
      else {
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
      }
    }
  });
</script>


</body>
</html>
@endsection