<?php
include 'db.php';

$usernameErr = $passwordErr = $confirmErr="";
$username =$password = $confirm = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
  if (empty($_POST["username"])) {
    $usernameErr = "Name is required!";
  } 
  else 
    {
      $username = test($_POST["username"]);
    }
 

    if (empty($_POST["password"])) {
    $passwordErr = "Password is required!";

     } 
        else 
    {
      $password = test($_POST["password"]);
      if(strlen($password) < 6) {
        $passwordErr = "Password must be minimum of 6 characters";
        } 
    }
 
  if (empty($_POST["confirm"])) {
    $confirmErr = "Confirm password is required!";

  } 
  else 
    {
      $confirm = test($_POST["confirm"]);
      if($password != $confirm) {
        $confirmErr = "Password and Confirm Password doesn't match";
}
    }

    if ($username !="" && $password !="" && $confirm !=""  ) 
    {

        if ($_POST['password'] == $_POST['confirm']) {

       $query="insert into users(username,password,confirm)values('$username','$password','$confirm')";
        $run=mysqli_query($conn,$query); 
       


    if($run)
    {
       
        header('location:login.php');
    }
    else{
        echo("Something went wrong!");
    }

    }
}

}


function test($form) 
{
  $form = trim($form);
  $form = stripslashes($form);
  $form= htmlspecialchars($form);
  return $form;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
.error {color: #FF0000;}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="js/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="images/logo.png" rel="icon">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
 <div class="main">
     <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign Up</h2>
                        <form method="POST"  class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label><br>
                                <input type="text" name="username" id="username" placeholder="Your Name"/>
                                <span class="error">*<?php echo $usernameErr;  ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label><br>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                <span class="error">*<?php echo $passwordErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock"></i></label><br>
                                <input type="password" name="confirm" id="confirm" placeholder="Repeat your password"/>
                                <span class="error">*<?php  echo $confirmErr; ?></span>
                            </div>

                             
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <b><a href="login.php" class="" style="font-size:17px ;">I am already member</a></b>
                    </div>
                </div>
            </div>
        </section>
      </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
