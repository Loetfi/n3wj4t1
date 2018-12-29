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
					<!-- <th>Satuan Project</th> -->
					<th>Tgl Order</th>
					<th>Cover</th>
					<th>Isi</th>
					<th>Tipe Order</th>
					<th>Deadline</th>
					<th>Qty</th>
					<!-- <th> Kertas </th>
						<th> Laminating </th> -->
						<th> Finishing </th>
						<!-- <th> finishing2 </th> -->
						<th> Catatan </th>
						<th>Harga Jual</th>
						<th></th>  
						<?php foreach ($detail as $order) { ?>
						<tr>
							<!-- <td><?php echo $order->satuanproject; ?> </td> -->
							<td><?php echo $order->tglorder; ?> 
								<br>
								<p>Detail</p>
								<p>sales : <?php echo getSales($order->sales); ?></p> 
								
							</td>
							<td>
								<p>ukurancover : <?php echo getUkuran($order->ukurancover); ?></p>
								<p>mesincover : <?php echo getMesin($order->mesincover); ?></p>
								<p>cetakcover : <?php echo getCetak($order->cetakcover); ?></p>
								<p>bahancover : <?php echo getProduk($order->bahancover); ?></p>
								<p>laminatingcover : <?php echo getLaminating($order->laminatingcover); ?></p>
							</td>
							<td>
								<p>banyakhalamanisi : <?php echo $order->banyakhalamanisi; ?></p>
								<p>cetakisi : <?php echo getCetak($order->cetakisi); ?></p>
								<p>detailhalaman1 : <?php echo $order->detailhalaman1; ?></p>
								<p>mesinisi1 : <?php echo getMesin($order->mesinisi1); ?></p>
								<p>detailhalaman2 : <?php echo $order->detailhalaman2; ?></p>
								<p>mesinisi2 : <?php echo getMesin($order->mesinisi2); ?></p>
								<p>bahanisi : <?php echo getProduk($order->bahanisi); ?></p>
							</td>
							<td><?php echo $order->tipeorder; ?> </td>
							<td><?php echo $order->deadline; ?> </td> 
							<td><?php echo $order->qty; ?> </td>  
							<td> 
								<?php 
								$datanya = explode(',', $order->finishing1);
								foreach ($datanya as $fin) {
									echo getFinishingSatu($fin);
									echo "<br>";
								}    ?> </td>
								
								<td> <?php echo $order->notes; ?> </td>
								<td><?php echo $order->hargajual != "" ? number_format($order->hargajual) : ""; ?></td>

								<td>
									<a href="<?php echo site_url('rincianbiaya/index?id='.$order->trorderdetailid.'&orderid='.$order->trorderid) ?>" class="view_data btn btn-primary btn-xs"  >Rincian Biaya</a>
									<a href="<?php echo site_url('cetak/qr/'.$order->trorderid) ?>" class="view_data btn btn-success btn-xs"><i class="fa fa-qrcode"></i> Cetak QR</a>
								</td>

							</tr>
							<?php } ?>
						</table>

					</div>
				</div>
			</div>
		</div>
