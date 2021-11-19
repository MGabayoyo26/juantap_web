<?php

$conn= new mysqli('localhost', 'root', '', 'tsts_db') or die (mysqli_error($mysqli));

if (isset($_POST['Submit'])){
    $platenumber = $_POST['platenumber'];
    $station = $_POST['station'];
    $comment = $_POST['comment'];

    $conn->query("INSERT INTO jeeps (platenumber, station, comment) VALUES ('$platenumber', '$station', '$comment')") or
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
	
	<form action="" id="manage-jeep">	
		<input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id']: '' ?>">
		<div class="form-group">
			<label for="platenumber">Plate Number</label>
			<input type="text" name="platenumber" id="platenumber" class="form-control" value="<?php echo isset($_POST['platenumber']); ?>" required>
		</div>
    <!--
		<div class="form-group"  id="station-field">
			<label for="station_id">Station</label>
			<select name="station_id" id="station_id" class="custom-select select2">
				<option value=""></option>
		
			</select>
		</div>
      -->
      
    <div class="form-group">
			<label for="station">station</label>
			<input type="text" name="station" id="station" class="form-control" value="<?php echo isset($_POST['station']) ? $_POST['station']: '' ?>" required  autocomplete="off">
		</div>
		
      <div class="form-group">
			<label for="comment">Comment</label>
			<input type="text" name="comment" id="comment" class="form-control" value="<?php  ?>" required  autocomplete="off">
		</div>
		
		

	</form>
</div>
<script>
    $('table').dataTable();
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



    $('#manage-jeep').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_jeep',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
        else{
					$('#msg').html('<div class="alert alert-danger">Plate number already exist</div>')
					end_load()
				}
			}
		})
	})

  $('#manage-jeep').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_comment',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
        else{
					$('#msg').html('<div class="alert alert-danger">Plate number already exist</div>')
					end_load()
				}
			}
		})
	})
  

</script>