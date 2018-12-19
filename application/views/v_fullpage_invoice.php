<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Invoice</title>

    <!-- Bootstrap -->
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<style type="text/css">
  		hr {
  			margin-top: 20px;
		    margin-bottom: 20px;
		    border: 0;
		    border-top: 1px solid #333;
  		}
  	</style>
	<div class="row">
		<div class="col-md-12">
			<h4><b>Project Name : <?php echo @$inv['projectname']?></b></h4>

			<img src="<?php echo @$qrcode ?>" class="img img-square" style="width: 120px; height: 120px">
			<hr>

			<h5><b>Detail Customer</b></h5>
			<p>Nama : <?php echo $inv['name']; ?></p>
			<p>Alamat : <?php echo $inv['address']; ?></p>
			<p>No. Telp : <?php echo $inv['phone']; ?></p>
			<hr>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<td>Project</td>
						<td>Keterangan</td>
						<td>Qty</td>
						<td>@Harga</td>
						<td>Harga</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($item as $row): ?>
					<tr>
						<td><?php echo @$row['satuanproject']; ?></td>
						<td>
							<?php echo @$row['namaBahan']; ?><br>
							Laminating: <?php echo @$row['namalaminating']; ?><br>
							Cetak: <?php echo @$row['attributecetak']; ?><br>
							Notes: <?php echo @$row['notes']; ?>
						</td>
						<td><?php echo @$row['qty']; ?></td>
						<td><?php echo number_format((@$row['totalharga']/@$row['qty']),2); ?></td>
						<td><?php echo number_format(@$row['totalharga'],2); ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>	
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>