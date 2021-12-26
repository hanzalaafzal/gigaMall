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
    <form name="form1" action="https://easypaystg.easypaisa.com.pk/tpg" method="POST">
      <input name="storeId" value="{{$post_data['storeId']}}" hidden="true">
      <br>
      <input name="amount" value="10.0" hidden="true" />
            <br>
      <input name="postBackURL" value="{{route('easy.paisa.postback')}}" hidden="true" />
            <br>
      <input name="orderRefNum" value="{{$post_data['orderRefNum']}}" hidden="true"/>
            <br>
      <input name="autoRedirect" value="1" hidden="true">
            <br>
      <input name="encryptedHashRequest" value="{{$post_data['encryptedHashRequest']}}" hidden="true">
      <input name="paymentMethod" value="OTC_PAYMENT_METHOD" hidden="true">
            <br>
      <!-- <button type="submit" name="button">submit</button> -->
      </form>
  </body>
</html>
