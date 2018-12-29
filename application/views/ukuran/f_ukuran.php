<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2)=='update') ? 'EDIT':'TAMBAH' ?> KATEGORI PRODUK</legend>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('ukuran/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('ukuran/update/'.$ukuran['idukuran'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Nama Ukuran</b> * </td>
                    <td>
						<input type="text" name="namaukuran" class="form-control" value="<?=isset($ukuran['namaukuran'])?$ukuran['namaukuran']:set_value('namaukuran');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Panjang</b> * </td>
                    <td>
						<input type="text" name="panjang" class="form-control" value="<?=isset($ukuran['panjang'])?$ukuran['panjang']:set_value('panjang');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Lebar</b> * </td>
                    <td>
						<input type="text" name="lebar" class="form-control" value="<?=isset($ukuran['lebar'])?$ukuran['lebar']:set_value('lebar');?>" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('ukuran') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>