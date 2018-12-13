<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2) == 'update') ? 'EDIT':'TAMBAH'?> SUPPLIER</legend>

		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('supplier/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('supplier/update/'.$supplier['idsupplier'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Nama</b> * </td>
                    <td>
						<input type="text" name="name" class="form-control" value="<?=isset($supplier['name'])?$supplier['name']:set_value('name');?>" required>
                    </td>
				</tr>
				<tr>
					<td width="200px"><b>No. Telp</b> * </td>
                    <td>
						<input type="text" name="phone" class="form-control" value="<?=isset($supplier['phone'])?$supplier['phone']:set_value('phone');?>" required>
                    </td>
                </tr>
                <tr>
                    <td width="200px"><b>Alamat</b></td>
                    <td>
						<textarea class="form-control" name="address" rows="3"><?=isset($supplier['address'])?$supplier['address']:set_value('address');?></textarea>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Deskripsi</b></td>
                    <td>
						<textarea class="form-control" name="description" rows="3"><?=isset($supplier['description'])?$supplier['description']:set_value('description');?></textarea>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('supplier') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>