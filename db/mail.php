<?php
/**
 * Created by PhpStorm.
 * User: pdkhang
 * Date: 07-Oct-17
 * Time: 6:39 PM
 */
function Guiemail ($title, $content,$addressfrom,$namefrom,$addressto,$nameto,$server,$port,$username,$pass,$ser){
    require_once('../Mail/PHPMailerAutoload.php');
//require 'Mail/PHPMailerAutoload.php';
    $mail = new PHPMailer;
//    $mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->CharSet = 'UTF-8';
    $mail->Host = $server;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $username;                 // SMTP username
    $mail->Password = $pass;     // SMTP password
    $mail->SMTPSecure = $ser;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to
    $mail->SMTPKeepAlive=true;
    $mail->setFrom($addressfrom, $namefrom);
    $mail->addAddress($addressto, $nameto);     // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $content;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mail->send()) {
      return true; // không có lỗi

    }
    else {

        return false; // Có lỗi
    }
}
?>
