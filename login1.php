<!DOCTYPE html>

<html lang="en" style="background: linear-gradient(to right, #1597E5, #193498);">
<?php 
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
// }
ob_end_flush();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | JUANTAP</title>
    <link rel="stylesheet" href="assets/css1/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css1/styleLOGIN.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

<style type="text/css">
    

.btn-custom {
    background-color: #113CFC;
    border: 2px solid #113CFC;
    color: #fff;
    font-size: 14px;
    transition: all 0.5s;
    border-radius: 5px;
    letter-spacing: 1px;
    text-transform: capitalize;
}
.btn-custom:hover{
    opacity: 0.8;
}
</style>

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
</head>

<body style="background: linear-gradient(to right, #1597E5, #193498);">
     <!--navbar container-->
    <div class="container-fluid" style="background-color: gradient;"> 
        <nav class="navbar navbar-expand-lg navbar-dark gradient">
            <div class="container">
                <a class="navbar-brand" href="landingpg.php"><img src="assets/images/LOGO.png" alt="" /></a>
            </div>
        </nav>
    </div>
    <!--login container-->  
      <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-5">
                <div class="account_box bg-light">
                    <p class="mb-0 text-center mt-3 fs-5"><a class="text-dark ">Sign In</a></p>
                    <form id="login-form">
                        <div class="col-lg-12 mt-3">
                            <label class="text-dark">Username</label>
                            <input type="text"  id="username" name="username" class="form-control trial-input" placeholder="ex.12345678" required>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label class="text-dark">Password</label>
                            <input type="password"  id="password" name="password" class="form-control trial-input" placeholder="Password" required>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <p><a class="text-dark mr-2" href="#" >Forgot your password ?</a></p>
                        </div>
                         <div class="col-lg-12">
                            <button style="background-color: #113CFC" class="btn btn-custom w-100 mt-3 text-light">LOGIN</button>   
                        </div> 
                       
                    </form>
                </div> 
            </div>
        </div>
      </div>
       <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!--FONTAWESOME-->
    <script src="https://kit.fontawesome.com/9eca0b2e8a.js" crossorigin="anonymous"></script>
    <!--BOOTSTRAP-->
    <script src="js/bootstrap.min.js"></script>	

    
<script>
    $('#login-form').submit(function(e){
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'ajax.php?action=login',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success:function(resp){
                if(resp > -1){
                    if(resp == 0)
                        location.href ='index.php?page=home';
                    else
                        location.href ='ticketing/index.php';
                }else{
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
</script>   
</body>
</html>