@extends('frontEnd.layout')
@section('content')
<body>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<div class="container">

    <h1>E-Wallet Withdraw</h1>
    <h4>Releaseable amount: {{$releaseAmount}} PKR</h4>
    @if (Session::has('message'))
        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif
    <div class="row" style="margin-top: 2%">
        <div class="col-md-5  ">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Bank Account Details</h3>
                    </div>
                </div>
                <div class="panel-body">



                    <form role="form" action="/withdraw_amount" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                    id="payment-form">
                        @csrf

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text' name="name">
                            </div>
                        </div>

                         <input type="hidden" name="method" value="bank">

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Account Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="card_number" required>
                            </div>

                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Phone Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="phone_number" required>
                            </div>

                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Bank</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="bank" required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Amount</label>
                                <input
                                    class='form-control' type='text' name="amount" required>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" style="margin-top: 2%" type="submit">Withdraw Now</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-2 text-center">
            <h1 style="line-height: 200px">OR</h1>
        </div>

        <div class="col-md-5 ">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Easypaisa Details</h3>

                    </div>
                </div>
                <div class="panel-body">


                    <form role="form" action="withdraw_amount" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="pk_test_51H2omrEBrijIcOQ027RdCxqbHjgHG7kQgdEmhrX8A9N9TzO8uqOzup9mf10Q2d9Hid3qMo87UOfymhfPoceLTS5F00oXrc9IhR"
                                                    id="payment-form">
                        @csrf


                         <div class='form-row row'>
                             <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name</label>
                                <input class='form-control' size='4' type='text' name="name" required>
                            </div>


                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Account Number</label>
                                <input class='form-control' size='4' type='text' name="card_number" required>
                            </div>

                        </div>



                        <input type="hidden" name="method" value="easypaisa">

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Phone Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="phone_number" required>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Amount</label>
                                <input
                                    class='form-control' type='text' name="amount" required>
                            </div>
                        </div>



                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">

                                <button class="btn btn-primary btn-lg btn-block" style="margin-top: 2%" type="submit">Withdraw Now</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
