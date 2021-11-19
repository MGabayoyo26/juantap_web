<?php 

?>

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
	
    #new_driver{
		left: 50px;
        width: 130px;
        height: 40px;
		font-size:15px;
		color:white;
    }
	#cardfont{
		font-size:15px;
	}
</style>
<div class="container-fluid">
	<br>
	
	<br>
	<div class="col-lg-12">
		<div class="card border-teal ">
			<div class="card-header bg-teal text-center" id="cardfont"><b>ACCOUNTS</b></div>
			<div class="card-body">
				<nav class="navbar navbar-light bg-light">
					<form class="form-inline">
					<span> <a  href="index.php?page=accounts"> <button  class="btn btn-outline-info  btn-outline-info mr-3" type="button" >Passengers</button> </a> </span>
						<span> <a  href="index.php?page=driver'saccount"> <button class="btn btn-info" type="button">Drivers</button> </a></span>
					</form>
				</nav>

		<div class="row ">
					<div class="col-sm-12">
						<button class="btn btn-info my-2" id="new_driver"><i class="fa fa-plus"></i>&nbsp; Add Driver</button>
					</div>
		</div>
<br>
				<table class="table-striped table-bordered" >
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Account Number</th>
					<th class="text-center">Driver's Name</th>
					<th class="text-center">Mobile Number</th>
					<th class="text-center">Email</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					
 					$driversInfo = $conn->query("SELECT * FROM drivers_tbl");
					//$result = mysqli_query($conn, $driversInfo);
					$i = 1;
 					while($row=mysqli_fetch_assoc($driversInfo)):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++; ?>
				 	</td>
				 	<td>
				 		<?php echo $row['driver_accountNo']; ?>
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['driver_name']); ?>
				 	</td>
				 	<td>
				 		<?php echo $row['driver_mobileNum']; ?>
				 	</td>
					 <td>
				 		<?php echo $row['driver_email']; ?>
				 	</td>
				 	<td>
				 		<center>
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-sm">Action</button>
							  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu">
							    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_driverInfo" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
							  </div>
							</div>
						</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>

<script>
	$('table').dataTable();
$('#new_driver').click(function(){
	uni_modal('New Driver','add_driver.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','add_driver.php?id='+$(this).attr('data-id'))
})
$('.delete_driverInfo').click(function(){
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
</script>