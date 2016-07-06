<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mail envoyé depuis le formulaire de contact du Cabinet Schmidt </title> 
    <style type="text/css">
      table{
        width:100%;
      }
    </style>
  </head>

  <body>
    <table>
      <!-- body -->
      <td>
        <tr>
          <h3>{{$identity}} (<a href="mailto:{{$email}}">{{$email}}</a>) de la société {{$company}} vous a envoyé un email depuis le site du <a href="https://cabinet-schmidt.com">Cabinet Schmidt</a></h3>
        </tr>
        <!-- button -->
        <!-- /button -->
        <tr>
          <p style="text-decoration:underline; font-weight:bold">Objet</p>
          <p>{{$purpose}}</p>
          <br>
          <p style="text-decoration:underline; font-weight:bold">Contenu</p>
          <p>{{$comment}}</p>
        </tr>
      </td> 
    </table>

  </body>
</html>