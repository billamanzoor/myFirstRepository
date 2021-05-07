<?php
     if (isset($_POST['submit'])) {
        $email = $_REQUEST['email'];
        $message = $_REQUEST['message'];

      // Set your email address where you want to receive emails. 
       $to = 'alihassan@gmail.com';
       $subject = 'Contact Request From Website';
       $headers = "From:  <".$email."> \r\n";
       $send_email = mail($to,$subject,$message,$headers);

       echo ($send_email) ? 'success' : 'error';

  }?>