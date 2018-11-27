<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(3) == 'update') ? 'EDIT':'TAMBAH'?> PENGGUNA</legend>

		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<?php if($this->uri->segment(3) == 'create'): ?>
			<form action="<?= site_url('manajemen/user/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('manajemen/user/update/'.$user['iduser'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
				<tr>
                    <td width="200px"><b>Group</b> * </td>
                    <td>
                    	<select style="width: 100%;" class="form-control populate placeholder" name="idgroup" id="idgroup" required></select>
                    </td>
				</tr>
                <tr>
                    <td width="200px"><b>Nama</b> * </td>
                    <td>
						<input type="text" name="name" class="form-control" value="<?=isset($user['name'])?$user['name']:set_value('name');?>" required>
                    </td>
				</tr>
				<tr>
					<td width="200px"><b>Username</b> * </td>
                    <td>
						<input type="text" name="username" class="form-control" value="<?=isset($user['username'])?$user['username']:set_value('username');?>" 
						<?= ($this->uri->segment(3) == 'update') ? 'readonly':'required' ?>>
                    </td>
                </tr>
                <tr>
					<td width="200px"><b>Password</b> * </td>
                    <td>
						<input type="password" name="password" class="form-control" value="" required>
                    </td>
				</tr>
				<tr>
					<td width="200px"><b>Confirm Password</b> * </td>
                    <td>
						<input type="password" name="confirm_password" class="form-control" value="" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('manajemen/user') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#idgroup').select2({
            width: 'resolve',
            data: <?php echo $list_group; ?>
        });

        <?php if($this->uri->segment(3) == 'update'): ?>
            <?php $idgroup = isset($user['idgroup']) ? $user['idgroup'] : 1 ; ?>
            $('#idgroup').val(<?=$idgroup?>).trigger('change');
        <?php endif ?>
	})
</script>