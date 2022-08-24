<?php
session_start();
if(!$_SESSION['login']){
   header('Location: /Student-Management/login.php');
   die;
}

include"db.php";
if(isset($_POST['submit'])){
    

        $fname =$_POST['fname'];
        $lname =$_POST['lname'];
        $dob =$_POST['dob'];
        $course =$_POST['course'];
        $gender =$_POST['gender'];
        $email =$_POST['email'];
       

       $target_path = "profile/"; 
	   $photoName = $_FILES['photo']['name'];
	   $target_path = $target_path.basename($_FILES['photo']['name']);
	   if(isset($photoName))
	   {
	    move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
	   }

       if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['dob']) && !empty($_POST['course']) && !empty($_POST['gender']) && !empty($_POST['email']) && !empty($_POST['photoName']));
        
        $query = "insert into students(fname,lname,dob,course,gender,email,photo)values('$fname','$lname','$dob','$course','$gender','$email','$photoName')";
        $run = mysqli_query($conn,$query) or die(mysqli_error());


        if($run){

        		 header('location:http://localhost/Student-Management/index.php');
           
        }
        else{
            echo"unable to save records";
        }

		}
		else{
   
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
					<h3>Add Student</h3>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="">First Name</label>
							<input type="text" name="fname" class="form-control" placeholder="Your First Name" required>
						</div>
						<div class="form-wrapper">
							<label for="">Last Name</label>
							<input type="text" name="lname" class="form-control" placeholder="Your Last Name" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="">DOB</label>
							<span class="lnr lnr-calendar-full"></span>
							<input type="" name="dob" class="form-control datepicker-here" data-language='en' data-date-format="dd M yyyy" id="dob" required>
						</div>
						<div class="form-wrapper">
							<label for="">Course</label>
							<select name="course" id="" class="form-control" required>
								<option value="" disabled selected="selected">Select</option>
								<option value="BA">BA</option>
								<option value="BBA">BBA</option>
								<option value="B.SC">B.SC</option>
								<option value="BCA">BCA</option>
								<option value="B.COM">B.COM</option>
							</select>
							<i class="zmdi zmdi-chevron-down"></i>
						</div>
					</div>
					<div class="form-row last">
						<div class="form-wrapper">
							<label for="">Gender</label>
							<input type="radio" name="gender" value="Male" required>Male<br>
							<input type="radio" name="gender" value="Female" required>Female<br>
							<input type="radio" name="gender" value="Others" required>Others
							<i class=""></i>
						</div>
						<div class="form-wrapper">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control" placeholder="xyz@gmail.com" required>
							<i class=""></i>
						</div>
					</div>
						<div class="form-wrapper">
							<label for="">Profile</label>
							<input type="file" name="photo" class="form-control" placeholder="" required>
						</div>
					<center>
					<button name="submit" type="submit" class="in" data-text="Save">
						<span>Save</span>
					</button>
					</center>
				</form>
			</div>
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>

		<!-- DATE-PICKER -->
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>

		
	</body>
</html>
