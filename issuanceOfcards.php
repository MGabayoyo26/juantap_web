<?php 
$conn= new mysqli('localhost', 'root', '', 'tsts_db') or die (mysqli_error($mysqli));

if (isset($_POST['Submit'])){
    
    $rfid = $_POST['rfid'];
    $gcan = $_POST['gcan'];
    $types = $_POST['types'];

    $conn->query("INSERT INTO cards (rfid, gcan, types) VALUES ('$rfid', '$gcan', '$types')");

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

}

//To check keys if already exist on the db
function checkKeys($conn, $randStr){
  //run inside the database
  $sql =  "SELECT * FROM cards";
  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){
      if ($row['gcan'] == $randStr) {
          $keyExists = true;
          break;
      }else{
      $keyExists = false;
      }
  }
  return $keyExists;
}

//To generate key
function generateKey($conn){

  date_default_timezone_set('Asia/Manila');
      $first = date ("Ymd");
      $second = date ("hi");
      $comb = "012345678901234567890123456789";
      $shfl = str_shuffle($comb);
      $pin = substr($shfl,0,4);


  $randStr = $first.$second.$pin;

  $checkKey = checkKeys($conn, $randStr);

  while ($checkKey == true){
  $randStr = $first.$second.$pin;
  $checkKey = checkKeys($conn, $randStr);
  }
  return $randStr;
}

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
  #btnsubmit{
      height: 40px;
      width: 200px;
    }
</style>
<br> 

<?php
 if (isset($_SESSION['message'])):?>

 <div class="alert alert-<?=$_SESSION['msg_type']?>">
  <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
  ?>
</div>
<?php endif; ?>
<br>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card border-teal">
			<div class="card-header bg-teal text-center" id="cardfont" >
				<b>ISSUANCE OF CARDS</b>
			</div>
			<div class="card-body station-field">
				
<br>
<div class="container-fluid">
	<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <span> <button class="btn btn-info" type="button"> <i class="far fa-credit-card"></i>&nbsp;Scan Card</button> </span>
  </form>
</nav>
<br>
	<div id="msg"></div>
	
	<form action="" method="POST" >	
		<input type="hidden" name="id" value="">
		<div class="form-group">
			<label for="">RFID</label>
			<input type="text" name="rfid" id="rfid" class="form-control" value="" required>
		</div>
		<div class="form-group">
			<label for="">Generated Card Account Number</label>
			<input type="text" name="gcan" id="gcan" class="form-control" value="<?php echo generateKey($conn);?>" readonly required>
		</div>
		
		
			<input type="hidden" name="type" value="3">
		
		<div class="form-group">
			<label for="types">Type of Card</label>
			<select name="types" id="types" class="custom-select">
				<option >Ordinary</option>
				<option >Driver</option>
				<option >Discount - Senior Citizen</option>
				<option >Discount - Student</option>
				<option >Discount - PWD</option>
			</select>
		</div>
		<br>
		<div class="row">
				<div class="col-md-12">
            <div class="text-center">
                <button class="btn btn-success" type="Submit" name="Submit" id="btnsubmit" >Submit</button>
             </div>
				</div>
		</div>
		<br>
	</form>
</div>
				<div class="row">
					<div id="msg" class="col-md-12"></div>
				</div>
			</div>
		</div>
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
	.station-field .item{
		cursor: pointer;
	}
	.station-field .item:hover{
		opacity: .7;
	}
</style>
