<?php

session_start();
include"db.php";
if(isset($_GET['id']))
        {
            $query ="select * from students where id='".$_GET['id']."'";
            $run = mysqli_query($conn,$query);
        }


    if(isset($_POST['submit']))
    {
     
        $firstname =$_POST['fname'];
        $lname =$_POST['lname'];
        $dob =$_POST['dob'];
        $course =$_POST['course'];
        $gender =$_POST['gender'];
        $email =$_POST['email'];
      
       
       $fname = $_FILES['photo']['name'];
      
      
       if($_FILES['photo']['size'] == 0)
       {

        $query = "UPDATE students set fname='$firstname',lname='$lname',dob='$dob',course='$course',gender='$gender',email='$email' where id='".$_GET['id']."'";
        $result=mysqli_query($conn ,$query);


        if($result)
        {
            header('location:http://localhost/crud-project/index.php');
        }
        else{
            echo mysqli_error($conn);
        }

       }
       else {
     
        $target_path = "profile/"; 
        $photoName = $_FILES['photo']['name'];
        $target_path = $target_path.basename($_FILES['photo']['name']);

        if(isset($photoName))
        {
        move_uploaded_file($_FILES['photo']['tmp_name'],$target_path);
        }
       


        $query = "UPDATE students set fname='$firstname',lname='$lname',dob='$dob',course='$course',gender='$gender',email='$email',photo='$photoName ' where id='".$_GET['id']."'";
        $result=mysqli_query($conn ,$query); 

        if($result){

                 header('location:http://localhost/crud-project/index.php');
           
        }
        else
        {
            echo mysqli_error($conn); 
        }

       }    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- LINEARICONS -->
        <link rel="stylesheet" href="fonts/linearicons/style.css">

        <!-- MATERIAL DESIGN ICONIC FONT -->
        <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <link href="images/logo.png" rel="icon">

        <!-- DATE-PICKER -->
        <link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">
        
        <!-- STYLE CSS -->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <div class="wrapper">
            <div class="inner">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h3>Edit Student</h3>
                    <?php
                     while ($row = $run-> fetch_assoc())
                    { 
                        $profile = $row['photo'];
                        $firstName = $row['fname'];
                        $lastName = $row['lname'];
                        $dob = $row['dob'];
                        $course = $row['course'];
                        $gender = $row['gender'];
                        $email = $row['email'];

                    }

                        ?>
                    <div class="form-row">
                        <div class="form-wrapper">
                            <label for="">First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="Your First Name" value="<?php echo $firstName; ?>" required>
                        </div>
                        <div class="form-wrapper">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Your Last Name" value="<?php echo $lastName; ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-wrapper">
                            <label for="">DOB</label>
                            <span class="lnr lnr-calendar-full"></span>
                            <input type="" name="dob" class="form-control datepicker-here" data-language='en' data-date-format="dd M yyyy" id="dob" value="<?php echo $dob; ?>" required>
                        </div>
                        <div class="form-wrapper">
                            <label for="">Course</label>
                            <select name="course" id="" class="form-control" required>
                                <option value="" disabled selected="selected">Select</option>
                                <option <?php if($course=="BA"){echo "selected";}?> value="BA">BA</option>
                                <option <?php if($course=="BBA"){echo "selected";}?> value="BBA">BBA</option>
                                <option <?php if($course=="B.SC"){echo "selected";}?> value="B.SC">B.SC</option>
                                <option <?php if($course=="BCA"){echo "selected";}?> value="BCA">BCA</option>
                                <option <?php if($course=="B.COM"){echo "selected";}?> value="B.COM">B.COM</option>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="form-row last">
                        <div class="form-wrapper">
                            <label for="">Gender</label>
                            <input type="radio" name="gender" value="Male" <?php if($gender=="Male"){echo "checked";}?> required>Male<br>
                            <input type="radio" name="gender" value="Female"<?php if($gender=="Female"){echo "checked";}?> required>Female<br>
                            <input type="radio" name="gender" value="Others"<?php if($gender=="Others"){echo "checked";}?> required>Others
                            <i class=""></i>
                        </div>
                        <div class="form-wrapper">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="xyz@gmail.com" value="<?php echo $email; ?>" required>
                            <i class=""></i>
                        </div>
                    </div>

                    <div class="form-wrapper">
                            <label for="">Profile</label>
                            <input type="file" name="photo" class="form-control">
                            <br>
                            <img width="100px" height="100px" src="profile/<?php echo $profile;?> "> 
                        </div>
                          

                    <center>
                    <button name="submit" type="submit" class="update" data-text="Update">
                        <span>Update</span>
                    </button>
                    </center>
                </form>
            </div>
        </div>
        
        <script src="js/jquery-3.3.1.min.js"></script>

        <!-- DATE-PICKER -->
        <script src="vendor/date-picker/js/datepicker.js"></script>
        <script src="vendor/date-picker/js/datepicker.en.js"></script>

        <script src="js/main.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
    </body>
</html>
