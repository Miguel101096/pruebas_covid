<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Proyecto Ingeniería de Software 2 | EPN</title>

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600" rel="stylesheet">

  <!-- BASE CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/vendors.css" rel="stylesheet">

  <!-- YOUR CUSTOM CSS -->
  <link href="css/custom.css" rel="stylesheet">

  <script type="text/javascript">
  function delayedRedirect(){
    window.location = "cita.php"
  }
  </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 4000)" style="background-color:#fff;">
<!--
  

-->
  <?php
/*Reservar los una habitación por medio de una intefaz web, con los siguientes datos: Fecha de ingreso y salida, tipo de habitación
cantidad de niños y de adultos, requerimientos especiales para la habitación como tipo de alimentación, tipo de privacidad,
servicios extras como bebida de bienvenida, desayuno, cena, retiro del aeropuerto, se debe enviar nombres, apellidos, correo y teléfono para tomar contacto con el cliente
luego de llenar la reserva.
Se puede ver las características de las habitaciones y los datos del hotel
El programa envia un correo de confirmación al cliente y al hotel con los datos ingresados.
Se ingresa los datos a una base de datos para  reportes.

Al programa podrán logearse recepcionita o administrador del hotel para ver las reservas, gestionar habitaciones y ponerse en contacto con el cliente que solicitó la reserva.
El cliente recibirá una notificación que su orden a sido atendida por la recepcionista del hotel y recibirá información extra como el número de la habitación asignada, la hora de ingreso y llegada
permitidas, hora de limpieza, precio final de la reservam incluido requerimientos especiales, y los datos para el depósito bancario a la cuenta del hotel.

Por medio de un link que recibirá al correo electrónico el cliente podrá aceptar los datos enviados por la recepcionista y aceptar para proceder con el método de pago y adjuntar la foto del
del pago bancario.
*/



  include('session.php');
  //echo "aqui".$_SESSION['login_user'];



  $sql1 = 'select * from escollan_software2.admin where username = "'.$_SESSION['login_user'].'"';
  //echo $sql1 . "<br>";
  $sth1=FETCH_SQL($sql1);
  while($result1 = $sth1->fetch(PDO::FETCH_OBJ)){
    $rol=$result1->rol;
    $nombres_usuario=$result1->nombres;
    $correo=$result1->correo;
  }

  $sql = 'select id from escollan_software2.citas where fecha = "'.$_POST['fecha'].'" and hora = "'.$_POST['hora'].'"';
  //echo $sql . "<br>";
  $id=FETCH_VAR($sql);
  //echo $id;
  
    if (isset($id)) {
        
        echo '
        <div id="success">
    <div class="icon icon--order-success svg">
      <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
        <g fill="none" stroke="#8EC343" stroke-width="2">
          <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
          <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
        </g>
      </svg>
    </div>
    <h4>
        <span>
            Estimado '.$nombres_usuario.' cita ya registrada 
        </span>
        Gracias por su tiempo vuelva a intentarlo
    </h4>
    <small>Será redirigido en 5 segundos.</small>
  </div>
        ';


    }
    else{

          //echo $correo;

  
  $to = $correo;/* YOUR EMAIL HERE */
  $subject = "Recordatorio de Cita Covid 19";
  $headers = "From: Administrador <maritzol.tenemaza@epn.edu.ec>";
  $message = "Cita Creada\n";
  


  $message .= "\nNombres: " . $nombres_usuario;
  $message .= "\nRol " . $rol;
  $message .= "\nEmail: " . $correo;

  //Receive Variable
  $sentOk = mail($to,$subject,$message,$headers);

  //Confirmation page
  $user = "moncayodeibi@gmail.com";
  $usersubject = "Reserva Cita Prueba Covid 19";
  $userheaders = "From: moncayodeibi@gmail.com\n";
  /*$usermessage = "Thank you for your time. Your quotation request is successfully submitted.\n"; WITH OUT SUMMARY*/
  //Confirmation page WITH  SUMMARY

  $usermessage = "Gracias por su tiempo. Su requerimiento ha sido enviado.
  Te responderemos cuanto antes.\n\nRESUMEN\n\n$message";
  mail($user,$usersubject,$usermessage,$userheaders);

  $sql4 = 'insert into escollan_software2.citas
        (id,cedula,fecha,hora,doctor)
         VALUES (null,"'.$_SESSION['login_user'].'","'.$_POST['fecha'].'","'.$_POST['hora'].'","Dr. Eduardo Carrera")';
        //echo $sql4;
  
  
        //echo "estoy aaqui";
        $sth4 = FETCH_SQL($sql4);


        echo '
        <div id="success">
    <div class="icon icon--order-success svg">
      <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
        <g fill="none" stroke="#8EC343" stroke-width="2">
          <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
          <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
        </g>
      </svg>
    </div>
    <h4><span>Su cita está reservada</span>Gracias por su tiempo</h4>
    <small>Será redirigido en 5 segundos.</small>
  </div>
        ';

    }

   

  

  ?>
  <!-- END SEND MAIL SCRIPT -->

  
</body>
</html>
