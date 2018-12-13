<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2) == 'update') ? 'EDIT':'TAMBAH'?> CUSTOMER</legend>

		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('customer/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('customer/update/'.$customer['idcustomer'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
				<tr>
                    <td width="200px"><b>Nama</b> * </td>
                    <td>
						<input type="text" name="name" class="form-control" value="<?=isset($customer['name'])?$customer['name']:set_value('name');?>" required>
                    </td>
				</tr>
                <tr>
                    <td width="200px"><b>Jenis Kelamin</b> * </td>
                    <td>
						<label class="radio-inline">
                            <input type="radio" name="gender" value="perempuan" <?=(isset($customer['gender']) == 'perempuan') ? 'checked':'';?>>
                            Perempuan
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="laki-laki" <?=(isset($customer['gender']) == 'perempuan') ? 'checked':'';?>>
                            Laki - Laki
                        </label>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Alamat</b> * </td>
                    <td>
                    	<textarea name="address" class="form-control" rows="3" required><?=isset($customer['address'])?$customer['address']:set_value('address');?></textarea>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>No Telp</b> * </td>
                    <td>
						<input type="text" name="phone" class="form-control" value="<?=isset($customer['phone'])?$customer['phone']:set_value('phone');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Perusahaan</b> </td>
                    <td>
						<input type="text" name="organization" class="form-control" value="<?=isset($customer['organization'])?$customer['organization']:set_value('organization');?>">
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('customer') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
	})
</script>