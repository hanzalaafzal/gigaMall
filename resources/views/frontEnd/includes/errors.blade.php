<style type="text/css">
    .m-b-0{
        margin: 30px !important;
    }
</style>

@if($errors ->any())
  @foreach($errors->all() as $error)
    <div class="message error xmalert alert-box" id="sessionMessage" style="visibility: visible; opacity: 1; position: fixed; z-index: 100000; transition: all 0.3s ease-in-out 0s; top: 30px; bottom: auto; left: auto; right: 30px;">
       <div class="message-type"></div>
       <p class="text-header">Error Occurred</p>
       <p class="info"><p>{{ $error }}</p></p>
       <img class="close-btn" src="{{url('frontEnd/images/dashboard/notif-close-icon.png')}}" alt="close-icon">
   </div>
  @endforeach
@endif

@if(Session::has('doneMessage'))
    <div class="message success xmalert alert-box" id="sessionMessage" style="visibility: visible; opacity: 1; position: fixed; z-index: 100000; transition: all 0.3s ease-in-out 0s; top: 30px; bottom: auto; left: auto; right: 30px;">
       <div class="message-type"></div>
       <p class="text-header">Success</p>
       <p class="info">{{ Session::get('doneMessage') }}</p>
       <img class="close-btn" src="{{url('frontEnd/images/dashboard/notif-close-icon.png')}}" alt="close-icon">                     
    </div>
@endif

@if(Session::has('errorMessage'))
    <div class="message error xmalert alert-box" id="sessionMessage" style="visibility: visible; opacity: 1; position: fixed; z-index: 100000; transition: all 0.3s ease-in-out 0s; top: 30px; bottom: auto; left: auto; right: 30px;">
       <div class="message-type"></div>
       <p class="text-header">Error Occurred</p>
       <p class="info">{{ Session::get('errorMessage') }}</p>
       <img class="close-btn" src="{{url('frontEnd/images/dashboard/notif-close-icon.png')}}" alt="close-icon">
   </div>
@endif

@if(Session::has('infoMessage'))
    <div class="message info xmalert alert-box" id="sessionMessage" style="visibility: visible; opacity: 1; position: fixed; z-index: 100000; transition: all 0.3s ease-in-out 0s; top: 30px; bottom: auto; left: auto; right: 30px;">
       <div class="message-type"></div>
       <p class="text-header">Information</p>
       <p class="info">{{ Session::get('infoMessage') }}</p>
       <img class="close-btn" src="{{url('frontEnd/images/dashboard/notif-close-icon.png')}}" alt="close-icon">                     
    </div>
@endif


@if(Session::has('warningMessage'))
    <div class="message error xmalert alert-box" id="sessionMessage" style="visibility: visible; opacity: 1; position: fixed; z-index: 100000; transition: all 0.3s ease-in-out 0s; top: 30px; bottom: auto; left: auto; right: 30px;">
       <div class="message-type"></div>
       <p class="text-header">Wrning</p>
       <p class="info">{{ Session::get('warningMessage') }}</p>
       <img class="close-btn" src="{{url('frontEnd/images/dashboard/notif-close-icon.png')}}" alt="close-icon">
   </div>
@endif

<script type="text/javascript">
    $('#sessionMessage').on('click',function(){
        $('#sessionMessage').css('visibility','hidden');
    });
    setTimeout(function() {
        $('#sessionMessage').css('visibility','hidden');
    }, 4000);
</script>

