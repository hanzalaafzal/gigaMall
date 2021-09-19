@extends('newFrontend.layout')


@section('main_content')
<div class="ps-section--vendor ps-vendor-milestone">
    <div class="container">
        <div class="ps-section__header">

            <h4>HOW TO SHOP</h4>
        </div>
        <div class="ps-section__content">
            <div class="ps-block--vendor-milestone">
                <div class="ps-block__left">
                    <h4>Create your account</h4>
                    <ul>
                        <li>Creating your account is fast and easy. Simply enter some information about your business and your store is ready for the next step. Next, get your eCom Store set up by following simple video tutorials. If you've got several different products or services, then you can create as many eCom Stores as you need.</li>

                    </ul>
                </div>
                <div class="ps-block__right"><img src="{{asset('assets/img/vendor/milestone-1.png')}}" alt=""></div>
                <div class="ps-block__number"><span>1</span></div>
            </div>
            <div class="ps-block--vendor-milestone reverse">
                <div class="ps-block__left">
                    <h4>Browse our shop items</h4>
                    <ul>
                        <li>Find almost any item for sale in our worldwide marketplace. Whether you're looking for products, services, giftcards, or any digital item, you'll most likely find it in our marketplace. If you can't find an item, simply send an email to suggestions ebazzarpk.com and let us know of the item you're looking for.</li>

                    </ul>
                </div>
                <div class="ps-block__right"><img src="{{asset('assets/img/vendor/milestone-2.png')}}" alt=""></div>
                <div class="ps-block__number"><span>2</span></div>
            </div>
            <div class="ps-block--vendor-milestone">
                <div class="ps-block__left">
                    <h4>Shopping Cart and Checkout</h4>
                    <ul>
                        <li>We make it easy for you to complete your purchase. Just add your item to your shopping cart and pay using the payment options your seller is offering. If you have any questions, communicate with the seller using email or our chat option.</li>

                    </ul>
                </div>
                <div class="ps-block__right"><img src="{{asset('assets/img/vendor/milestone-4.png')}}" alt=""></div>
                <div class="ps-block__number"><span>3</span></div>
            </div>
            <div class="ps-block--vendor-milestone reverse">
                <div class="ps-block__left">
                    <h4>Delivery at your door step.</h4>
                    <ul>
                        <li> e-Bazarr will make sure the product reaches you in stipulated time and in A-one condition.</li>

                    </ul>
                </div>
                <div class="ps-block__right"><img src="{{asset('assets/img/vendor/milestone-3.png')}}" alt=""></div>
                <div class="ps-block__number"><span>4</span></div>
            </div>
        </div>
    </div>
</div>

@endsection
