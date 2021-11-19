<?php include('db_connect.php');?>


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

</style>

<div class="container-fluid">
	<br> <br>
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-station">
				<div class="card border-teal">
					<div class="card-header bg-teal text-center" id="cardfont" >
						  <b> ADD NEW ROUTE FORM </b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div id="msg" class="form-group"></div>
							<div class="form-group">
								<label class="control-label"> Route</label>
								<input type="text" class="form-control" name="station">
							</div>
							<div class="form-group">
								<label class="control-label">Address</label>
								<textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-success btn-sm col-sm-3 offset-md-3">Save</button>
								<button class="btn btn-sm btn-dark col-sm-3" type="button" onclick="$('#manage-station').get(0).reset()">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card border-teal">
					<div class="card-header bg-teal text-center" id="cardfont">
						<b> STATION LIST </b>
					</div>
					<div class="card-body">

						<table class="table table-bordered table-hover">

							<!-- search
							<div class="container"> 
								<div class="row height d-flex justify-content-center align-items-center">
									<div class="col-md-6"> 
										<div class="search"> <i class="fa fa-search"></i> 
											<input type="text" id="filter" class="form-control"  placeholder="">  
										</div> 
									</div> 
								</div>
							</div>
						end here -->
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Station Info.</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 1;
								$station = $conn->query("SELECT * FROM stations order by station asc");
								while($row=$station->fetch_assoc()):
								?>

								<tr >
									<td class="text-center">
										 <?php echo $i++ ?> </td>
									<td class="">
										<p>Name: <b><?php echo $row['station'] ?></b></p>
										<p><small>Address: <b><?php echo $row['address'] ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-info edit_station" type="button" data-id="<?php echo $row['id'] ?>" data-address="<?php echo $row['address'] ?>" data-station="<?php echo $row['station'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_station" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										<button class="btn btn-sm btn-success station-rates"  type="button" data-id="<?php echo $row['id'] ?>">Manage Rates</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}

</style>
<script>
	$('#manage-station').on('reset',function(){
		$('input:hidden').val('')
	})
	
	$('#manage-station').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_station',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html('<div class="alert alert-danger">Station already exist.</div>')
					end_load()
				}
			}
		})
	})
	$('.edit_station').click(function(){
		start_load()
		var cat = $('#manage-station')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='station']").val($(this).attr('data-station'))
		cat.find("[name='address']").val($(this).attr('data-address'))
		end_load()


		/*uni_modal('Edit station','manage_station.php?id='+$(this).attr('data-id')) */

	})
	$('.delete_station').click(function(){
		_conf("Are you sure to delete this station?","delete_station",[$(this).attr('data-id')])
	})

	$('.station-rates').click(function(){
		uni_modal("Station Origin: "+$(this).attr('data-station'),"manage_prices.php?id="+$(this).attr('data-id'),"mid-large");
	})

	function delete_station($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_station',
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
	$('table').dataTable()
</script>


<br> <br>
<!--  Manage fare Rates 

<style>
	
.search {
    position: relative;
    box-shadow: 0 0 40px rgba(51, 51, 51, .1);
    
}

.search input {
    height: 30px;
    text-indent: 25px;
   
}

.search input:focus {
    box-shadow: none;
    border: 2px solid #69DADB;
}

.search .fa-search {
    position: absolute;
    top: 10px;
    left: 16px
}

.search button {
    position: absolute;
    top: 5px;
    right: 5px;
    height: 50px;
    width: 110px;
    background: #69DADB;
}
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.station-field .item{
		cursor: pointer;
	}
	.station-field .item:hover{
		opacity: .7;
	}
</style>

-->
<!--
<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		
		<div class="card border-teal ">
			<div class="card-header bg-teal">
				<b> Manage Destination Rates </b>
			</div>
			<div class="card-body station-field"> 
				
				<div class="container"> 
					<div class="row height d-flex justify-content-center align-items-center">
						<div class="col-md-6"> 
							<div class="search"> <i class="fa fa-search"></i> 
								<input type="text" id="filter" class="form-control"  placeholder="">  
							</div> 
						</div> 
					</div>
				</div>
				 

				<br> <br>
				<div class="row">
					<?php 
						$station = $conn->query("SELECT * FROM stations order by station asc");
						while($row= $station->fetch_assoc()):
					?>
					<div class="col-md-4 py-2">
						<div class="card bg-light border item" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['station'] ?>">
							<div class="card-body">
								<div class="row justify-content-center align-center">
									<h5><b><?php echo ucwords($row['station']) ?></b></h5>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
				<div class="row">
					<div id="msg" class="col-md-12"></div>
				</div>
			</div>
		</div>
	</div>
	</div>	
<br> 
</div>
<script>
	$('#filter').keyup(function(){
		var filter = $(this).val()
		$('.station-field .item').each(function(){
			var txt = $(this).text()
			if((txt.toLowerCase()).includes(filter.toLowerCase()) == true){
				$(this).parent().toggle(true)
			}else{
				$(this).parent().toggle(false)
			}
		})
		if($('.station-field .item:visible').length > 0){
			$('.station-field #msg').html('')
		}else{
			$('.station-field #msg').html('<div class="row justify-content-center align-center"><h4 class="text-center">No Result</h4></div>')
		}
	})
	$('.station-field .item').click(function(){
		uni_modal("Station Origin: "+$(this).attr('data-name'),"manage_prices.php?id="+$(this).attr('data-id'),"mid-large");
	})
</script> 


-->