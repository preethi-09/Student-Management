<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error  {color: #FF0000;}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="js/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="images/logo.png" rel="icon">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include 'db.php';
    $error="";
        $usernameErr = $passwordErr = "";
        $username = $password = "";
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
              
            } 

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
           
        if(count($_POST)>0) {
       
        $result = mysqli_query($conn,"SELECT * FROM users WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");

        $row  = mysqli_fetch_array($result);
        $_SESSION['login'] = true;

        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["username"] = $row['username'];
          header("Location:index.php");
        } else {
         $error = "Invalid Username or Password !";
         
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

   
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Student Login</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label><br>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                                 <span class="error">*<?php echo $usernameErr;  ?></span>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label><br>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                <span class="error">*<?php echo $passwordErr; ?></span>

                            </div>
                             <div class="error"><?php if($error!=""){ echo $error;}?>
                             </div>
                   
                          
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Login"/>
                                &nbsp&nbsp&nbsp&nbsp<b><a href="signup.php" style="font-size:17px ;" >Create an account</a></b>
                            </div>
                        </form> 
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
