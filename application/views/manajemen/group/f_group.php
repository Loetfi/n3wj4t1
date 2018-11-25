<div class="container-fluid">
	<div class="content">
		<legend>FORM TAMBAH GROUP</legend>

		<?php if($this->uri->segment(3) == 'create'): ?>
			<form action="<?= site_url('manajemen/group/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('manajemen/group/update/'.$group['idgroup'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Nama Group</b> * </td>
                    <td>
						<input type="text" name="group_name" class="form-control" value="<?=isset($group['group_name'])?$group['group_name']:set_value('group_name');?>" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('manajemen/group') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>