<?php
    include 'db_connect.php';
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
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
</style>
<br> <br> 
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card border-teal">
            <div class="card_body">
            <div class="row justify-content-center pt-4">
                <label for="" class="mt-2">Month</label>
                <div class="col-sm-3">
                    <input type="date" name="date" id="date" value="<?php echo $date ?>" class="form-control">
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <table class="table table-bordered" id='report-list'>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">Ticket No.</th>
                            <th class="">Origin</th>
                            <th class="">Destination</th>
                            <th class="">Passenger Type</th>
                            <th class="">Amount</th>
                            <th class="">Processedd By</th>
                        </tr>
                    </thead>
                    <tbody>
			          <?php
                      $i = 1;
                      $total = 0;
                      $station = $conn->query("SELECT * FROM stations");
                        $sname_arr = array();
                        while($row = $station->fetch_array()){
                            $sname_arr[$row['id']] = ucwords($row['station']);
                        }
                        $ptype = array('','Adult','Student','Senior');
                      $tickets = $conn->query("SELECT t.*,u.name as uname FROM tickets t inner join users u on u.id = t.processed_by where date(t.date_created) = '$date' order by unix_timestamp(t.date_created) asc ");
                      if($tickets->num_rows > 0):
			          while($row = $tickets->fetch_array()):
                      $total += $row['price'];
			          ?>
			          <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td>
                            <p> <b><?php echo $row['ticket_no'] ?></b></p>
                        </td>
                        <td>
                            <p> <b><?php echo $sname_arr[$row['station_from']] ?></b></p>
                        </td>
                        <td>
                            <p> <b><?php echo $sname_arr[$row['station_to']] ?></b></p>
                        </td>
                         <td>
                            <p> <b><?php echo $ptype[$row['passenger_type']] ?></b></p>
                        </td>
                        <td>
                            <p class="text-right"> <b><?php echo number_format($row['price'],2) ?></b></p>
                        </td>
                        <td>
                            <p> <b><?php echo ucwords($row['uname']) ?></b></p>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                        else:
                    ?>
                   
                    <?php 
                        endif;
                    ?>
			        </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th class="text-right"><?php echo number_format($total,2) ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <hr>
                <div class="col-md-12 mb-4">
                    <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<noscript>
	<style>
		table#report-list{
			width:100%;
			border-collapse:collapse
		}
		table#report-list td,table#report-list th{
			border:1px solid
		}
        p{
            margin:unset;
        }
		.text-center{
			text-align:center
		}
        .text-right{
            text-align:right
        }
	</style>
</noscript>
<script>
$('#report-list').dataTable()
$('#date').change(function(){
    location.replace('index.php?page=daily_report&date='+$(this).val())
})
$('#print').click(function(){
        $('#report-list').dataTable().fnDestroy()
		var _c = $('#report-list').clone();
		var ns = $('noscript').clone();
            ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write('<p class="text-center"><b>Daily Report (<?php echo date("F d,Y",strtotime($date)) ?>)</b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
            $('#report-list').dataTable()
		}, 500);
	})
</script>