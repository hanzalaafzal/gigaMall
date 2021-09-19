@extends('frontEnd.vendor.layout')
@section('dashboard')

<style type="text/css">
	.profile-notifications {
	    margin: 0 auto 15px;
	}
  #end_date{
        font-weight: 600;
    margin-right: 30px;
  }
  .ref_code{
          position: absolute;
    top: 4px;
    left: 10px;
  }
  .shop_package{
    position: absolute;
    top: 4px;
    left: 17%;
  }
  .allow_products{
    position: absolute;
    top: 4px;
    left: 30%;
  }
  .total_products{
      position: absolute;
    top: 4px;
    left: 50%;
  }
  .profile-notification .profile-notification-date p {
        line-height: 100px;
  }
  .profile-notification .profile-notification-body p {
      line-height: 100px;
  }
  @media screen and (max-width: 667px){
    .profile-notifications {
	    margin: 0 auto 15px;
	}
  #end_date{
        font-weight: 600;
    margin-right: 15px;
  }
  .ref_code{
     position: absolute;
    top: 30px;
    left: 11px;
  }
  .shop_package{
   position: absolute;
    top: 55px;
    left: 4%;
  }
  .allow_products{
   position: absolute;
    top: 30px;
    left: 55%;
  }
  .total_products{
     position: absolute;
    top: 55px;
    left: 55%;
  }
  .profile-notification .profile-notification-date p {
        line-height: 100px;
	   padding-top: 45px;
  }
  .profile-notification .profile-notification-body p {
      line-height: 20px !important;
	 
  }
	  .profile-notification .profile-notification-body {
    padding-left: 5px;
    position: relative;
}
	  .active{
		  padding-top: 45px;
	  }
	  .profile-notification{
		  margin-top: 78px;
	  }
	  .profile-notification {
    float: left;
    width: 270px;
    height: 220px;
    margin-right: 30px;
}
  }
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
   <!-- HEADLINE -->
   <div class="headline buttons primary">
      <h4>My Shops <small style="color: gray">({{ Request::segment(2) }})</small></h4>
      <div class="shops-buttons">
        <a href="{{route('myShopsRenewal')}}" class="button primary <?php if(Route::currentRouteName() == 'myShopsRenewal'){echo "dark-light";} ?>">Renewal<small> ({{$count['renewal']}})</small></a>
        <a href="{{route('myShopsDisable')}}" class="button primary <?php if(Route::currentRouteName() == 'myShopsDisable'){echo "dark-light";} ?>">Disable<small> ({{$count['disable']}})</small></a>
        <a href="{{route('myShopsPending')}}" class="button primary <?php if(Route::currentRouteName() == 'myShopsPending'){echo "dark-light";} ?>">Pending<small> ({{$count['pending']}})</small></a>
        <a href="{{route('myShopsActive')}}" class="button primary <?php if(Route::currentRouteName() == 'myShopsActive'){echo "dark-light";} ?>">Active<small> ({{$count['active']}})</small></a>
        <a href="{{route('myShops')}}" class="button primary <?php if(Route::currentRouteName() == 'myShops'){echo "dark-light";} ?>" >All <small>({{$count['all']}})</small></a>
      </div>
   </div>
   <!-- /HEADLINE -->

   @if(count($shops)>0)
    <!-- PROFILE NOTIFICATIONS -->
   @foreach($shops as $shop)
    <div class="profile-notifications">
      <!-- PROFILE NOTIFICATION -->
      <div class="profile-notification">
         <div class="profile-notification-date active_top ">
            <p>{{$shop->status }}</p>
         </div>
         <div class="profile-notification-body" style="">
            <!-- <figure class="user-avatar">
               <img src="images/avatars/avatar_02.jpg" alt="user-avatar">
            </figure> -->
            <p>
              <span>
                @if($shop->status != 'Pending')
                  <small id="end_date" <?php if($shop->status == 'Renewal'){echo "style='color:red'";}?> > End Date ( {{date("d-m-Y", strtotime($shop->end_date))}} )</small>
                @endif
                {{$shop->title}}
              </span>
            </p>

         </div>
         <div class="profile-notification-type">
          <div class="recommendation-wrap" style="margin-top: 17px;">
                @if($shop->status == 'Active')
                  <a title="View" href="{{route('shopView',$shop->slug)}}" class="recommendation good hoverable open-recommendation-form">
                    <i class="far fa-eye"></i>
                  </a>
                @else
                  <a title="View" href="{{route('shopEdit',$shop->slug)}}" class="recommendation good hoverable open-recommendation-form">
                    <i class="far fa-eye"></i>
                  </a>
                @endif
                <a title="Edit" href="{{route('shopEdit',$shop->slug)}}" class="recommendation bad hoverable open-recommendation-form">
                    <i class="far fa-edit"></i>
                </a>
                <!-- <a title="Delete" href="{{route('shopDelete',$shop->slug)}}" class="recommendation bad hoverable open-recommendation-form">
                    <i class="far fa-trash-alt"></i>
                </a> -->
            </div> 
            <span class="type-icon icon-heart primary"><!-- 
              <a href="" class="button button secondary">Edit</a>
              <a href="" class="button dark-light">View</a>   -->

            </span>
         </div>
         
            <div>
                <p><span class="ref_code">Referral Code: {{$shop->ref_code}} </span></p>
            </div>
            <div>
                <p><span class="shop_package">Package: {{$shop->packages->name}} </span></p>
            </div>
            <div>
                <p><span class="allow_products">Allow Products: {{$shop->packages->products}} </span></p>
            </div>
            <div>
                <p><span class="total_products">Total Products: {{count($shop->products)}} </span></p>
            </div>
      </div>
      <!-- PROFILE NOTIFICATION -->
   </div>
   @endforeach
   <!-- /PROFILE NOTIFICATIONS -->

   <!-- PAGER -->
   <div class="pager-lara">
    {{$shops->links()}}
   </div>
   <!-- /PAGER -->
   @else
    <div style="text-align: center;color: lightgray;">
      <h4>No Shop Listed</h4>
    </div>
   @endif
</div>
<!-- DASHBOARD CONTENT -->


@endsection