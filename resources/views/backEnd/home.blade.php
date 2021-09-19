@extends('backEnd.layout')
@section('headerInclude')
    <link rel="stylesheet" type="text/css" href="{{ URL::to("backEnd/assets/styles/flags.css") }}"/>
@endsection
@section('content')
    <div class="padding p-b-0">
        <div class="margin">
            <h5 class="m-b-0 _300">{{ trans('backLang.hi') }} <span class="text-primary">{{ Auth::user()->name }}</span>, {{ trans('backLang.welcomeBack') }}
            </h5>
        </div>
        <!-- <a href="http://bazaarsy.com/public/cron/shops" class="btn btn-primary">Refresh Referral System</a> -->
    </div>
@endsection
