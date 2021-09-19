<style type="text/css">
    .m-b-0{
        margin: 30px !important;
    }
</style>

@if($errors ->any())
    <div class="alert alert-danger m-b-0">
        <ul>
            @foreach($errors->all() as $error)
                <li><p>{{ $error }}</p></li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('doneMessage'))
<div class="alert alert-success m-b-0">
    <p>{{ Session::get('doneMessage') }}</p>
</div>
@endif

@if(Session::has('errorMessage'))
    <div class="alert alert-danger m-b-0">
        <p>{{ Session::get('errorMessage') }}</p>
    </div>
@endif

@if(Session::has('infoMessage'))
    <div class="alert alert-info m-b-0">
        <p>{{ Session::get('infoMessage') }}</p>
    </div>
@endif


@if(Session::has('warningMessage'))
    <div class="alert alert-warning m-b-0">
        <p>{{ Session::get('warningMessage') }}</p>
    </div>
@endif

