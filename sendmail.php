<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->Charset = 'UTF-8';
    $mail->IsHTML(true);

    $mail->IsSMTP();
    $mail->Host = "smtp.example.com";

    // optional
    // used only when SMTP requires authentication  
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp_username';
    $mail->Password = 'smtp_password';
    
    // From
    $mail->setFrom('dodiefiew@gmail.com', 'test');
    // To
    $mail->addAddress('henkel.vladislav@gmail.com');
    // Theme
    $mail->Subject = 'Hey!';

    // Mail body
    $body = '<h1>--- HIT ME UP! ---</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
    }

    $mail->Body = $body;

    if(!$mail->send()) {
        $message = 'Error';
    } else {
        $message = 'OK';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>