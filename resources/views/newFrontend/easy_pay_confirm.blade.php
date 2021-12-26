<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      function closethisasap(){
        document.forms["form1"].submit();
      }
    </script>
  </head>

  <body onload="closethisasap();">
    <form name="form1" action="https://easypaystg.easypaisa.com.pk/easypay/Confirm.jsf" method="POST">
      <input name="auth_token" value="{{$post_data['auth_token']}}" hidden="true">
      <br>
      <input name="postBackURL" value="{{route('easy.paisa.confirm')}}" type="num" hidden="true" />
      <!-- <button type="submit" name="button">Submit</button> -->
</form>
  </body>
</html>
