<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2)=='update') ? 'EDIT':'TAMBAH' ?> SALES</legend>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('sales/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('sales/update/'.$sales['idsales'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Nama sales</b> * </td>
                    <td>
						<input type="text" name="namasales" class="form-control" value="<?=isset($sales['namasales'])?$sales['namasales']:set_value('namasales');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Jabatan</b> * </td>
                    <td>
						<input type="text" name="namajabatan" class="form-control" value="<?=isset($sales['namajabatan'])?$sales['namajabatan']:set_value('namajabatan');?>" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('sales') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>