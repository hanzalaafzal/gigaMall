
@extends('newFrontend.layout')

@push('css')
  <style>
  .card {
    background-color: transparent;
    border:0px;
  }
  </style>

@endpush
@section('main_content')

<div class="container">
    <div class="ps-section__header mt-5">
      <div class="row">

        <div class="col-xl-8 col-lg-8">
              <h3>Recharge your wallet</h3>
        </div>
      </div>
      @if(session('doneMessage'))
      <div class="row">
        <div class="col-xl-8 col-lg-8">
              <div class="alert alert-success">
                <p>{{session('doneMessage')}}</p>
              </div>
        </div>
      </div>
      @endif


    </div>
    <div class="ps-section__content">

            <div class="ps-form__content">
                <div class="row">

                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="ps-block--shipping">

                            <div class="ps-block--payment-method">
                                <ul class="ps-tab-list">
                                    <li class="active"><a class="ps-btn ps-btn--sm" href="#visa">Visa / Master Card</a></li>

                                </ul>
                                <div class="ps-tabs">
                                    <div class="ps-tab active" id="visa">
                                      <form role="form" action='{{route("postRecharge")}}' method="post" class="ps-form--checkout require-validation"
                                                                       data-cc-on-file="false"
                                                                      data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                                      id="payment-form">
                                                                      @csrf
                                          <input class="form-control" type="text" name="method" value="card" hidden autocomplete='off'>

                                          <div class="form-group required">
                                              <label>Name on card</label>
                                              <input class="form-control" type="text" autocomplete='off'>
                                          </div>
                                            <div class="form-group card required">
                                                <label>Card number</label>
                                                <input class="form-control card-number" type="text" size='20' autocomplete='off'>
                                            </div>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label>Expiration Date</label>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group expiration required">
                                                                    <input class="form-control card-expiry-month" type="text" size='2' placeholder="MM" autocomplete='off'>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group expiration required">
                                                                    <input class="form-control card-expiry-year" type="text" size='4' placeholder="YYYY" autocomplete='off'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group cvc required">
                                                        <label>CVV</label>
                                                        <input class="form-control card-cvc" type="text" placeholder="042" autocomplete='off'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-md-12 error form-group hide' style="display:none">
                                                    <div class='alert-danger alert'>Please correct the errors and try
                                                        again.</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Amount to recharge</label>
                                                <input class="form-control" type="text" name="amount" size='20' autocomplete='off' required>
                                            </div>
                                            <div class="form-group submit">
                                                <button class="ps-btn ps-btn--fullwidth" type="submit">PAY NOW</button>
                                            </div>

                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12">
                      <h2>OR</h2>
                    </div>

                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                      <div class="ps-block--shipping">

                          <div class="ps-block--payment-method">
                              <ul class="ps-tab-list">
                                  <li class="active"><a class="ps-btn ps-btn--sm" href="#visa">Easy Paisa</a></li>

                              </ul>
                              <div class="ps-tabs">
                                  <div class="ps-tab active" id="visa">
                                    <form role="form" action='{{route("postRecharge")}}' method="post" class="ps-form--checkout require-validation"
                                                                     data-cc-on-file="false"
                                                                    data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                                    id="payment-form">
                                                                    @csrf


                                        <div class="form-group required">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" required autocomplete='off'>
                                            <input type="hidden" name="method" value="easypaisa">
                                        </div>

                                          <div class="form-group card required">
                                              <label>Phone Number</label>
                                              <input class="form-control card-number" name="phone_number" type="text" min="0" autocomplete='off' required>
                                          </div>

                                          <div class="form-group card required">
                                              <label>Amount to recharge</label>
                                              <input class="form-control card-number" name="amount" type="number" min="0" autocomplete='off' required>
                                          </div>


                                          <div class="form-group submit">

                                              <button class="ps-btn ps-btn--fullwidth" type="submit">PAY NOW</button>


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
</div>

@endsection

@push('jss')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");

  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;

        console.log($inputs)

        $errorMessage.addClass('hide');

        $('.is-invalid').removeClass('is-invalid');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.addClass('is-invalid');
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
            $('.error')
                .removeClass('hide')
                .css('display','block')
                .find('.alert')
                .text(response.error.message);

        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
@endpush
