<?php
    //This file recieves email from another file after validation is complete, then uses PHPMailer API to send an email to the requested user
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "../vendor/autoload.php";

    $email=$_SESSION['email'];
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = '465';
    $mail->SMTPSecure='ssl';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username="ziad.shaker0@gmail.com";
    $mail->Password="zizo2002";
    $mail->From = "ziad.shaker0@gmail.com";
    $mail->FromName = "Ziad Fehr";
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Subject Text";
    $mail->Body = "<H3>Password Reset</H3>";
    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    /*
    $Emailcheck=$_SESSION['email'];
    $file="../Invoices/Student.txt";
    $ct=-1;
    $linearr=[];
    $filetype=fopen($file,'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($filetype)){
        $line=fgets($filetype);
        $Arrline=explode($seperator,$line);
        ++$ct;
        if($Arrline[3]==$Emailcheck && $Arrline[7]!=""){
            echo "<br>";
            $pass=$Arrline[4];
            $liner=str_replace($pass,"yes",$line);
            $crl = file( $file, FILE_IGNORE_NEW_LINES );
            $crl[$ct] = $liner;
            file_put_contents($file, implode("\n", $crl));
            fclose($filetype);
            break;
            
       }
    }
    fclose($filetype);*/
    session_reset();
?>

