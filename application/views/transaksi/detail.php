<!-- <?php print_r($detail); ?> -->
<div class="container-fluid">
	<div class='row'>
		<div class='col-md-12 breadcumb'>
			<div class="breadcumb-content">
			ORDER                    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="content">
				
				<h4><?php echo $header->projectname; ?></h4>

				<table class="table table-bordered table-hover">
					<th>Satuan Project</th>
					<th>Tgl Order</th>
					<th>Tipe Order</th>
					<th>Deadline</th>
					<th>Qty</th>
					<th> Kertas </th>
					<th> Laminating </th>
					<th> Finishing </th>
					<th> finishing2 </th>
					<th> Catatan </th>
					<th>Harga Jual</th>
					<th></th> 

					<?php foreach ($detail as $order) { ?>
					<tr>
						<td><?php echo $order->satuanproject; ?> </td>
						<td><?php echo $order->tglorder; ?> </td>
						<td><?php echo $order->tipeorder; ?> </td>
						<td><?php echo $order->deadline; ?> </td> 
						<td><?php echo $order->qty; ?> </td> 
						<td> <?php echo getProduk($order->kertas); ?> </td>
						<td> <?php echo getLaminating($order->laminating); ?> </td>
						<td> 
							<?php 
							$datanya = explode(',', $order->finishing1);
							foreach ($datanya as $fin) {
								echo getFinishingSatu($fin);
								echo "<br>";
							}    ?> </td>
							<td> <?php echo $order->finishing2; ?> </td>
							<td> <?php echo $order->notes; ?> </td>
							<td><?php echo $order->hargajual != "" ? number_format($order->hargajual) : ""; ?></td>
							<td>
								<a href="<?php echo site_url('rincianbiaya/index?id='.$order->trorderdetailid.'&orderid='.$order->trorderid) ?>" class="view_data btn btn-primary btn-xs"  >Rincian Biaya</a>
							</td>

						</tr>
						<?php } ?>
					</table>

				</div>
			</div>
		</div>
	</div>
