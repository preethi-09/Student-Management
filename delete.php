<?php
session_start();
if(!$_SESSION['login']){
   header("location:login.php");
   die;
}

include 'db.php';
$result = mysqli_query($conn,"SELECT * FROM students");

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $sql = "DELETE FROM `students` WHERE `id`='$id'";
     $result = $conn->query($sql);
     if ($result == TRUE) 
     {
        $_SESSION['status']="Your details have been deleted!";
        header('location:http://localhost/Student-Management/index.php') ;
}
    else

    {
        echo "Error:" . $sql . "<br>" . $conn->error;
          }
} 
?>
