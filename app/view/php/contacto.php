<?php
 
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $motivo_consulta = "";
    $visitor_message = "";
     
    if(isset($_POST['visitor_name'])) {
      $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['motivo-consulta'])) {
        $motivo_consulta = filter_var($_POST['motivo-consulta'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
     
    if($motivo_consulta == "queja") {
        $recipient = "quejas@mail.com";
    }
    else if($motivo_consulta == "reserva") {
        $recipient = "reservas@mail.com";
    }
    else if($motivo_consulta == "masinfo") {
        $recipient = "maisinfo@mail.com";
    }
    else if($motivo_consulta == "otro") {
        $recipient = "otrosasuntos@mail.com";
    }

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
     
    if(mail($recipient, $email_title, $visitor_message, $headers)) {
        echo "<p>Muchas gracias por contactar con nosotros, $visitor_name. 
                 Recibiras un mensaje en las próximas 24 horas con una respuesta.</p>";
    } else {
        echo '<p>Lo sentimos, revise sus datos y vuelva a enviar la consulta.</p>';
    }
     
} 
?>