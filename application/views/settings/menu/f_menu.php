<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(3)=='update') ? 'EDIT':'TAMBAH' ?> MENU</legend>

		<?php if($this->uri->segment(3) == 'create'): ?>
			<form action="<?= site_url('settings/menu/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('settings/menu/update/'.$menu['MenuId'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Menu</b> * </td>
                    <td>
						<input type="text" name="Name" class="form-control" value="<?=isset($menu['Name'])?$menu['Name']:set_value('Name');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Url/Link</b> * </td>
                    <td>
						<input type="text" name="Url" class="form-control" value="<?=isset($menu['Url'])?$menu['Url']:set_value('Url');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Parent</b> * </td>
                    <td>
                    	<select style="width: 100%;" class="form-control populate placeholder" name="ParentId" id="parent_id" required></select>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Urutan Ke</b> * </td>
                    <td>
						<input type="text" name="PositionNumber" class="form-control" value="<?=isset($menu['PositionNumber'])?$menu['PositionNumber']:set_value('PositionNumber');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Ikon</b> * </td>
                    <td>
						<input type="text" name="Icon" class="form-control" value="<?=isset($menu['Icon'])?$menu['Icon']:set_value('Icon');?>" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('settings/menu') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#parent_id').select2({
            width: 'resolve',
            data: <?php echo $list_menu; ?>
        });

        <?php if($this->uri->segment(3) == 'update'): ?>
            <?php $parent_id = isset($menu['ParentId']) ? $menu['ParentId'] : 1 ; ?>
            $('#parent_id').val(<?=$parent_id?>).trigger('change');
        <?php endif ?>
	})
</script>