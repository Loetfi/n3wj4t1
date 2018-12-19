<div class="container-fluid">
	<div class="content">

		<h4>Detail Customer</h4>
		<b><?php echo $inv['name']; ?></b><br>
		<?php echo $inv['address']; ?><br>
		<?php echo $inv['phone']; ?><hr>

		<h4>Project Name: <?php echo @$inv['projectname']; ?></h4>
		<img src="<?php echo @$qrcode; ?>" class="img img-rounded" style="width: 120px; height: 120px;">
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="width:15%">Satuan Project</th>
					<th>Keterangan</th>
					<th>Qty</th>
					<th>@Harga</th>
					<th>Harga</th>
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
