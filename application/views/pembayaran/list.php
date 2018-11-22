<div class="container-fluid">
    <div class="row">
        <hr>
        <div class="col-sm-12">
            <div class="content"> 
				<?php echo $this->session->flashdata('message_system'); ?>
                <legend>LIST PEMBAYARAN</legend>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>NO</th>
							<th>Customer</th>
							<th>Tipe Pembayaran</th>
							<th>Nominal</th>
							<th>Tgl Pembayaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0; foreach($list as $row){ ?>
						<tr>
							<td><?php echo ++$no; ?></td>
							<td>
								<?php echo $row['name']; ?><br>
								<?php echo $row['phone']; ?>
							</td>
							<td><?php echo $row['tipebayar']; ?></td>
							<td><?php echo number_format($row['nominal'],2); ?></td>
							<td><?php echo $row['tglbayar']; ?></td>
							<td><a href="<?php echo site_url('pembayaran/detail/'.$row['pembayaranid']); ?>" class="btn btn-xs btn-primary">Detail</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				
			</div>
		</div>
		
	</div>
</div>

