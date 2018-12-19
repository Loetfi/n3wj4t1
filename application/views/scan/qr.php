<div class="container-fluid">
	<div class="content">
		
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= $this->session->flashdata('message') ?>
			</div>
		<?php endif ?>

		<br><br> 
		<div class="form-group">
			<legend><?php echo @$title; ?></legend>
		</div>

		<form action="" method="POST" class="form-inline" role="form">

			<div class="form-group">
				<label class="sr-only" for="">Fokuskan cursor pada isian dibawah.</label>
				<input type="text" class="form-control" id="" placeholder="Scan disini" name="qr">
			</div> 
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<?php if ($this->input->post('qr')) { ?>
		
		<?php if (!empty(@$data)) { ?>
			<br><br>
			<div class="alert alert-info">
				Dibawah ini adalah hasil dari scan
			</div>
			<table class="table table-striped table-desa">
				<thead>
					<tr>
						<th>Customer</th>
						<th>Nama Project</th>
						<th>Tgl Order</th>
						<th>Tipe Order</th>
						<th>Total Harga</th>
						<th>Aksi</th>
					</tr>
					<tr>
						<td><?php echo $data['name']; ?></td>
						<td><?php echo $data['projectname']; ?></td>
						<td><?php echo date('d F Y  H:i:s ',strtotime($data['tglorder'])); ?></td>
						<td><?php echo $data['tipeorder']; ?></td>
						<td>Rp. <?php echo number_format($data['totalharga']); ?></td>
						<td>
							<a href="" class="btn btn-sm btn-primary">Cetak Tagihan</a>
							<a href="" class="btn btn-sm btn-success"> Surat Jalan</a>
						</td>
					</tr>
				</thead>
			</table>
		<?php } else { ?>
			<br><br>
			<div class="alert alert-danger">
				Maaf, QR tidak ditemukan.
			</div>

		<?php } }?>
	</div>
</div>

