<?php
$error =  $email = "";

include 'config/connect.php';

if (isset($_GET["token"]) && isset($_GET["action"]) && ($_GET["action"]=="reset")){

  $token = $_GET["token"];

  $email = $_GET["email"];

  $curDate = date("Y-m-d H:i:s");

  $query = "SELECT * FROM `users` WHERE `token`= '$token'";

  print_r($query);

  $resp = mysqli_query($conn, $query);

  $row = mysqli_num_rows($resp);

  if ($row == ""){
    $error = '<h2>Invalid Link</h2>
    <p>The link is invalid/expired. Either you did not copy the correct link
    from the email, or you have already used the key in which case it is
    deactivated.</p>
    <p><a href="https://www.allphptricks.com/forgot-password/index.php">
    Click here</a> to reset password.</p>';
  }else{
    $row = mysqli_fetch_assoc($resp);

    $expDate = $row['expDate'];

    if ($expDate >= $curDate){ ?>

      <form method="post" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <div class="form-group">
          <label><strong>Enter New Password:</strong></label>
          <input type="password" name="pass1" maxlength="15" required />
        </div>
        <div class="form-group">
          <label><strong>Re-Enter New Password:</strong></label>
          <input type="password" name="pass2" maxlength="15" required/>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Reset Password" />
        </div>
      </form>

        <?php
        }else{
          $error .= "<h2>Link Expired</h2>
          <p>The link is expired. You are trying to use the expired link which
          as valid only 24 hours (1 days after request).<br /><br /></p>";
        }
      }

      if($error!=""){
        echo "<div class='error'>".$error."</div><br />";
      }
      } // isset email key validate end

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $error="";
        $pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
        $pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);

        $curDate = date("Y-m-d H:i:s");
        if ($pass1 != $pass2){
          $error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
        }

        if($error != ""){
          echo "<div class='error'>".$error."</div><br />";
        }else{
          $pass1 = md5($pass1);
          
          $updateQuery = "UPDATE users SET password = '$pass1' WHERE email = '$email'";

          print_r($updateQuery);
          $updateQueryResult = mysqli_query($conn, $updateQuery);
          print_r($updateQueryResult);
          $delQuery = "DELETE FROM users token = '$token' WHERE email = '$email'";
          print_r($delQuery);
          if($updateQueryResult) {?>
            <script type="text/javascript">
              toastr.succss("Password updated successfully");
            </script>
            <?php
          }
        }
      }