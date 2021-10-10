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
        <div class="col-xl-4 col-lg-2">
          <h3>E-wallet withdraw</h3>
        </div>
        <div class="col-xl-6 col-lg-8">

        </div>
      </div>
      <div class="row mt-5">
        <div class="col-xl-4 col-lg-2">
          @if(empty($releaseAmount))
          <h4>Releaseable Amount: 0 PKR</h4>
          @else
          <h4>Releaseable Amount: {{$releaseAmount}} PKR</h4>
          @endif

        </div>
      </div>


    </div>
    <div class="ps-section__content">

            <div class="ps-form__content">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="ps-block--shipping">

                            <div class="ps-block--payment-method">
                                <ul class="ps-tab-list">
                                    <li class="active"><a class="ps-btn ps-btn--sm" href="#visa">Bank account</a></li>

                                </ul>
                                <div class="ps-tabs">
                                    <div class="ps-tab active" id="visa">
                                      <form role="form" action='/withdraw_amount' method="post" class="ps-form--checkout require-validation"
                                                                       data-cc-on-file="false"
                                                                      data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                                      id="payment-form">
                                                                      @csrf

                                          <input type="hidden" name="amount" value="$subtotal">
                                          <div class="form-group required">
                                              <label>Name on card</label>
                                              <input class="form-control" type="text" name="name" required autocomplete='off'>
                                              <input type="hidden" name="method" value="bank">
                                          </div>
                                            <div class="form-group card required">
                                                <label>Account Number</label>
                                                <input class="form-control card-number" name="card_number" type="text" autocomplete='off' required>
                                            </div>
                                            <div class="form-group card required">
                                                <label>Phone Number</label>
                                                <input class="form-control card-number" name="phone_number" type="number" min="0" autocomplete='off' required>
                                            </div>
                                            <div class="form-group card required">
                                                <label>Bank</label>
                                                <input class="form-control card-number" name="bank" type="text" autocomplete='off' required>
                                            </div>
                                            <div class="form-group card required">
                                                <label>Amount</label>
                                                <input class="form-control card-number" name="amount" type="number" min="0" autocomplete='off' required>
                                            </div>

                                            <div class="form-group submit">
                                              @if(empty($releaseAmount))
                                                <button class="ps-btn ps-btn--fullwidth" style="color:gray" disabled>Not enough amount to withdraw</button>
                                              @elseif($releaseAmount == 0 || $releaseAmount < 0)
                                                <button class="ps-btn ps-btn--fullwidth" style="color:gray" disabled>Not enough amount to withdraw</button>
                                              @else
                                                <button class="ps-btn ps-btn--fullwidth" type="submit">Withdraw Now</button>
                                              @endif

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
                                    <form role="form" action='withdraw_amount' method="post" class="ps-form--checkout require-validation"
                                                                     data-cc-on-file="false"
                                                                    data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                                    id="payment-form">
                                                                    @csrf

                                        <input type="hidden" name="amount" value="$subtotal">
                                        <div class="form-group required">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" required autocomplete='off'>
                                            <input type="hidden" name="method" value="easypaisa">
                                        </div>

                                          <div class="form-group card required">
                                              <label>Phone Number</label>
                                              <input class="form-control card-number" name="phone_number" type="number" min="0" autocomplete='off' required>
                                          </div>

                                          <div class="form-group card required">
                                              <label>Amount</label>
                                              <input class="form-control card-number" name="amount" type="number" min="0" autocomplete='off' required>
                                          </div>

                                          <div class="form-group submit">
                                            @if(empty($releaseAmount))
                                              <button class="ps-btn ps-btn--fullwidth" style="color:gray" disabled>Not enough amount to withdraw</button>
                                            @elseif($releaseAmount == 0 || $releaseAmount < 0)
                                              <button class="ps-btn ps-btn--fullwidth" style="color:gray" disabled>Not enough amount to withdraw</button>
                                            @else
                                              <button class="ps-btn ps-btn--fullwidth" type="submit">Withdraw Now</button>
                                            @endif

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
