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
    #new_jeep{
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
	<br> <br>
	<div class="col-lg-12">
		<div class="card border-teal ">
			<div class="card-header bg-teal text-center" id="cardfont"><b>E-JEEP LIST</b></div>
			<div class="card-body">
			
				<div class="row bg-light">
					<div class="col-sm-12">
						<button class="btn btn-info my-2" id="new_jeep"><i class="fa fa-plus"></i>&nbsp; New Jeep</button>
					</div>
				</div>
			<br>
				<table class="table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Plate Number</th>
					<th class="text-center">Station</th>
					<th class="text-center">Comments</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
					 
                     
 					$jeep = $conn->query("SELECT * FROM jeeps order by platenumber asc");
 					$i = 1;
 					while($row= $jeep->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
                        <?php echo $row['platenumber'] ?>
					 </td>
				 	<td>
						 <?php echo $row['station'] ?>
					 </td>
				 	<td>
					 <?php echo $row['comment'] ?>
				 	</td>
				 	<td>
				 		<center>
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-sm">Action</button>
							  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu">
							    <a class="dropdown-item edit_jeep" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_jeep" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
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
$('#new_jeep').click(function(){
	uni_modal('New E-Jeep','manage_ejeeps.php')
})
$('.edit_jeep').click(function(){
	uni_modal('Edit Information','manage_ejeeps.php?id='+$(this).attr('data-id'))
})
$('.delete_jeep').click(function(){
		_conf("Are you sure to delete this information?","delete_jeep",[$(this).attr('data-id')])
	})
	function delete_jeep($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_jeep',
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