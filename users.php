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
	#cardfont{
		font-size:15px;
	}
	#editbtn{
		color:white;
	}
</style>
<div class="container-fluid">
	<br> <br>
	<div class="col-lg-12">
		<div class="card border-teal  ">
			<div class="card-header bg-teal text-center" id="cardfont"><b>USER LIST</b></div>
			<div class="card-body">
				<div class="row bg-light">
					<div class="col-lg-12">
							<button class="btn btn-info" id="new_user"><i class="fa fa-plus"></i> New user</button>
					</div>
				</div>
			<br>
				<table class="table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Type</th>
					<th class="text-center">Station Handles</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff");
 					$sname[0] = "N/A";
 					$station = $conn->query("SELECT * FROM stations");
 					while($row=$station->fetch_assoc()){
 						$sname[$row['id']] = ucwords($row['station']);
 					}
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['name']) ?>
				 	</td>
				 	
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<?php echo $type[$row['type']] ?>
				 	</td>
				 	<td>
				 		<?php echo isset($sname[$row['station_id']]) ? $sname[$row['station_id']] : 'Station Removed' ?>
				 	</td>
				 	<td>
				 		<center>
							<div class="btn-group text-white">
							<!--
							  <button type="button" class="btn btn-primary btn-sm">Action</button>
							  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button> -->
							 
							<span>	<button type="button" class="btn btn-success btn-sm text-white mr-1" >  <a class="dropdown-item edit_user text-light" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'><b> Edit </b></a> </button> </span>
							
							<span>	<button type="button" class="btn btn-danger btn-sm text-white">    <a class="dropdown-item delete_user text-light" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'> <b>Delete </b></a> </button> </span>
							
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
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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