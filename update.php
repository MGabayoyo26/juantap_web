<?php
include 'db_connect.php';
//check condition
$id=$_GET['updateid'];

$sql="Select * from `jeep` where id=$id";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$platenumber=$row['platenumber'];
$station=$row['station'];
$comment=$row['comment'];


if(isset($_POST['submit'])){
    $platenumber=$_POST['platenumber'];
    $station= $_POST['station'];
    $comment=$_POST['comment'];
    


    $sql="update `jeeps` set id=$id, platenumber='$platenumber', station='$station', comment='$comment' where id=$id";
    //this query allows excecute query 2 para
    $result=mysqli_query($conn,$sql);
    if ($result){
      // echo "updated successfully";
       header('location:display.php');
    }
    else{
        die(mysqli_error($conn));
    }
}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>crud operation</title>
  </head>
  <body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label >Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name"  autocomplete="off" value=<?php echo $name;?>>
            </div>

            <div class="form-group">
                <label >Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" autocomplete="off" value=<?php echo $email;?>>
            </div>

            <div class="form-group">
                <label >Mobile</label>
                <input type="text" class="form-control" placeholder="Enter your mob num" name="mobile"  autocomplete="off" value=<?php echo $mobile;?>>
            </div>

            
            <div class="form-group">
                <label >Password</label>
                <input type="text" class="form-control" placeholder="Enter your password" name="password" value=<?php echo $password;?>>
            </div>


            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>

  </body>
</html>