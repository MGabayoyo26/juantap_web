


<?php

$conn= new mysqli('localhost', 'root', '', 'tsts_db') or die (mysqli_error($mysqli));

if (isset($_POST['Submit'])){
    $driverAccountNo = $_POST['driver_accountNo'];
    $driverName = $_POST['driver_name'];
    $driverMobile = $_POST['driver_mobileNum'];
    $driverEmail = $_POST['driver_email'];

    $conn->query("INSERT INTO drivers_tbl (driver_accountNo, driver_name, driver_mobileNum, driver_email) VALUES ('$driverAccountNo', '$driverName', '$driverMobile', '$driverEmail')") or
        die($mysqli->error);
}
?>

<!doctype html>
<html lang="en">
  <head>
   
 
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
   .border-teal{
    border-color:#69DADB;
    border-width: 4px;
   }
    .bg-teal{
      background: #69DADB;
    }
    .bg-gradient-primary{
        background: rgb(119,172,233);
        background: linear-gradient(149deg, rgba(119,172,233,1) 5%, rgba(83,163,255,1) 10%, rgba(46,51,227,1) 41%, rgba(40,51,218,1) 61%, rgba(75,158,255,1) 93%, rgba(124,172,227,1) 98%);
    }
    .btn-primary-gradient{
        background: linear-gradient(to right, #1e85ff 0%, #00a5fa 80%, #00e2fa 100%);
    }
    .btn-danger-gradient{
        background: linear-gradient(to right, #f25858 7%, #ff7840 50%, #ff5140 105%);
    }
    .station-field .item{
      cursor: pointer;
    }
    .station-field .item:hover{
      opacity: .7;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .pax{
      width:35px;
      text-align:center;
    }
    .reserved table p{
      margin:unset;
    }
</style>


<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-driver">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="driverAccountNo">Driver's Account Number</label>
			<input type="text" name="driverAccountNo" id="driverAccountNo" class="form-control" value="<?php echo isset($meta['driver_accountNo']) ? $meta['driver_accountNo']: '' ?>" required>
		</div>
    <div class="form-group">
			<label for="driverName">Driver's Name</label>
			<input type="text" name="driverName" id="driverName" class="form-control" value="<?php echo isset($meta['driver_name']) ? $meta['driver_name']: '' ?>" required  autocomplete="off">
		</div>
		
      <div class="form-group">
			<label for="driverMobile">Driver's Mobile Number</label>
			<input type="text" name="driverMobile" id="driverMobile" class="form-control" value="<?php echo isset($meta['driver_mobileNum']) ? $meta['driver_mobileNum']: '' ?>" required  autocomplete="off">
		</div>
		
        <div class="form-group">
			<label for="driverEmail">Driver's Email</label>
			<input type="text" name="driverEmail" id="driverEmail" class="form-control" value="<?php echo isset($meta['driver_email']) ? $meta['driver_email']: '' ?>" required  autocomplete="off">
		</div>
	</form>
</div>
<script>
    $('table').dataTable();

$('.edit_user').click(function(){
    uni_modal('Edit User','manage_driver.php?id='+$(this).attr('data-id'))
})
$('.delete_jeep').click(function(){
		_conf("Are you sure to delete this information?","delete_driverInfo",[$(this).attr('data-id')])
	})
	function delete_driverInfo($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_driverInfo',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
    $('#manage-driver').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_driverInfo',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Account number already exist</div>')
					end_load()
				}
			}
		})
	})

</script>