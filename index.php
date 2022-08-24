<?php
include 'db.php' ;
$sql="SELECT * FROM students";
$result=$conn->query($sql);
$result = mysqli_query($conn,"SELECT *FROM students");
session_start();

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $sql = "DELETE FROM `students` WHERE `id`='$id'";
     $result = $conn->query($sql);
     if ($result == TRUE) 
     {
        header('location:index.php') ;
}
    else

    {
        echo "Error:" . $sql . "<br>" . $conn->error;
          }
} 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Details</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="images/logo.png" rel="icon">
  
  <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>  
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>  
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"> </script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  
</head>
<body>
  <div class="container">
        <h1 style="text-align:center; font-family:'times new roman';color:red">STUDENTS DETAILS</h1>
         <p class='text-right'><a href='logout.php' class='btn btn-danger'>Logout</a></p>
         <a href='register/add.php' class='btn btn-success'>Add</a>
         <br><br>
  <table id="example" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>DOB</th>
                <th>COURSE</th>
                <th>GENDER</th>
                <th>EMAIL</th>
                <th>PROFILE</th>
                <th>VIEW</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
           <?php
            while ($row=$result->fetch_assoc()){ ?>
                <tr id="<?php echo $row['id']?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['course']; ?></td>               
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                     <td><img width="100px" height="100px" src="register/profile/<?php echo $row['photo'];?> "></td>
                     
                    <td><a href="http://localhost/Student-Management/view.php?id=<?php echo$row["id"];?>" class="btn btn-primary">View</a></td>
                    <td><a href="http://localhost/Student-Management/register/update.php?id=<?php echo$row["id"];?>" class="btn btn-success">Edit</a></td>
                   <td><input type="button" name="delete" value="Delete" class=" delete btn btn-primary"></td>

                    <script type="text/javascript">
                                $(document).ready(function() {
                                $(".delete").click(function(){
                                 swal({
                                    title: "Are You Sure?",
                                    text: "Are you sure you want to delete this record permanently?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((willDelete) => {
                                    if (willDelete) {

                                        var id = $(this).parents("tr").attr("id");

                                        window.location.href="http://localhost/Student-Management/delete.php?id="+id+"";
                                        swal("Your record is deleted!", {
                                            icon: "success",
                                        });
                                    } else {
                                        swal("Your record is safe!", {
                                            icon: "success",
                                        });
                                    }
                                });
                                 });
                            });
</script>

                   
                    
           </tr>
                <?php
            }?>
          

        </tbody>
      </table>
    </div>

  <script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable();
});</script>
        </tbody>
</body>

</html>
