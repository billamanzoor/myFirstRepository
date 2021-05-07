<?php

$email = $_REQUEST["email"];

if (!empty($email)) {
  $query = "SELECT * FROM users WHERE email = '".$email."'";

  include 'config/connect.php';

  $result = mysqli_query($conn, $query);

  $num_rows = $result->num_rows;

  $link = 'http://localhost/gallery-app/new_pass.php';

  $response = "";
  if ($num_rows == 1) {
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $token = md5(2418*2+$email);
    $addtoken = substr(md5(uniqid(rand(),1)),3,10);
    $token = $token . $addtoken;

    $updateToken = "UPDATE  users SET token = '$token', expDate = '$expDate' WHERE email = '$email'";
    print_r($updateToken);
    mysqli_query($conn, $updateToken); 
    
    /*
    $output='<p>Dear user,</p>';
    $output.='<p>Please click on the following link to reset your password.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p><a href="http://localhost/gallery-app/new_pass.php?
    token='.$token.'&email='.$email.'&action=reset" target="_blank">
    </a></p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
    $output.='<p>If you did not request this forgotten password email, no action
    is needed, your password will not be reset. However, you may want to log into
    your account and change your security password as someone may have guessed it.</p>';
    $output.='<p>Thanks,</p>';
    $output.='<p>AllPHPTricks Team</p>';
    $body = $output;
*/

    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    require 'PHPMailer-master/src/Exception.php';
    require 'vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    //Enable SMTP debugging.
    $mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password
    $mail->Username = "bilalmanzoor1122@gmail.com";
    $mail->Password = "03347867724";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;
    $mail->From = "bilalmanzoor1122@gmail.com";
    $mail->FromName = "gallery-App";
    $mail->addAddress($email, "Recepient Name");
    $mail->isHTML(true);
    $mail->Subject = "Reset Password";
    $msg = "Hi there, click on this <a href=\"new_pass.php?token=" . $token . "\">link</a> to
    reset your password on our site";
    $mail->Body = '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
  xmlns:v="urn:schemas-microsoft-com:vml"
  xmlns:o="urn:schemas-microsoft-com:office:office">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">
    <style>
    html,
    body {
      margin: 0 auto !important;
      padding: 0 !important;
      height: 100% !important;
      width: 100% !important;
      background: #fff;
    }
    * {
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
      outline: none !important;
    }
    table {
      border-spacing: 0 !important;
      border-collapse: collapse !important;
      table-layout: fixed !important;
      margin: 0 auto !important;
    }
    img {
      -ms-interpolation-mode:bicubic;
    }
    a {
      text-decoration: none;
    }
    *[x-apple-data-detectors],
    .unstyle-auto-detected-links *,
    .aBn {
      border-bottom: 0 !important;
      cursor: default !important;
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }
    .a6S {
      display: none !important;
      opacity: 0.01 !important;
    }
   .btn{
      border-radius: 0;
      background: #0d1b1770;
      color: #ffffffe6;
      padding: 10px 20px;
      display: inline-block;
      font-weight: 500;
   }
   h1,h2,h3,h4,h5,h6{
     color: #000000;
     margin-top: 0;
     font-weight: 400;
   }
   body{
     font-weight: 400;
     font-size: 15px;
     line-height: 1.8;
     color: rgba(0,0,0,.4);
   }
   a{
     color: #000000;
   }
   .hero .text h2{
    color: #000;
    font-size: 20px;
    font-weight: 700;
    line-height: 1.4;
    letter-spacing: 2px;
    margin-bottom: 25px;
   }
   .hero .text h3{
    color: #8c8c8c;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.5;
        max-width: 360px;
    margin: auto;
    margin-bottom: 40px;
   }
   ul.social li{
     display: inline-block;
     margin-right: 35px;
   }
   .footer ul{
     margin: 0;
     padding: 0;
     text-align: center;
     margin-bottom: 50px;
   }
   .footer ul li{
     list-style: none;
   }
   .footer ul li a{
     color: rgba(0,0,0,1);
   }
   @media only screen and (max-device-width: 414px) {
      .btn {
        font-size: 10px;
      }
      .hero .text h2{
        font-size: 16px;
      }
    }
 </style>
  </head>
  <body width="100%" style="margin: 0; padding: 0 !important;
    background-color:#fff;">
    <center style="width: 100%; background: #edf2f7; padding:50px 0;">
      <div style="max-width: 600px;with:100%;padding:15px; margin: 0 auto; background: #fff;"
        class="email-container">
        <table align="center" role="presentation" cellspacing="0"
          cellpadding="0" border="0" width="100%" style="margin: auto;">
          <tr>
            <td valign="middle" class="hero" style="padding: 2em 0 4em
              0;">
              <table>
                <tr>
                  <td>
                    <div class="text" style="padding: 0 2.5em; text-align:
                      center;">
                      <h2>FORGOT YOUR PASSWORD?</h2>
                      <h3>You are receiving this email because we received a
                        password reset request for your account.</h3>
                      <p><a href="http://localhost/gallery-app/new_pass.php?token='.$token.'&email='.$email.'&action=reset" target="_blank" class="btn " style="color:#fff;">RESET YOUR PASSWORD</a></p>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table align="center" role="presentation" cellspacing="0"
          cellpadding="0" border="0" width="100%" style="margin: auto;"
          class="footer">
          <tr>
            <td class="bg_light" style="text-align: center;">
              <p style="font-size: 14px;
                font-weight: 600;
                color: #8c8c8c;margin-bottom: 8px;line-height: 1.5;">This
                password reset link will expire in 60 minutes. <br>If you did
                not
                request a password reset, no further action is required.</p>
            </td>
          </tr>
          <tr>
            <td class="bg_light" style="text-align: center;">
              <p style="font-size: 12px;
                font-weight: 400;
                color: #959595;margin: 0;"></p>
            </td>
          </tr>
        </table>
      </div>
    </center>
  </body>
</html>';
    $mail->AltBody = "This is the plain text version of the email content";

    try {
      $mail->send();
      $response = [
        'status' => 'success',
        'message' => 'A reset passowrd link has been sent to your email, please check inbox.'
      ];
    } catch (Exception $e) {
      $response = [
        'status' => 'error',
        'message' => 'Mailer Error: ' . $mail->ErrorInfo
      ];
    }
  } else {
    $response = [
      'status' => 'error',
      'message' => 'Email does not exist, please try again.'
    ];
  }

  if(!empty($response)) {
    $respJason = json_encode($response);
    echo $respJason;
  }
}
?>