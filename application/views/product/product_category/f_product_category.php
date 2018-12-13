<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2)=='update') ? 'EDIT':'TAMBAH' ?> KATEGORI PRODUK</legend>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('product_category/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('product_category/update/'.$product_category['idproduct_category'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
                <tr>
                    <td width="200px"><b>Kategori</b> * </td>
                    <td>
						<input type="text" name="name" class="form-control" value="<?=isset($product_category['name'])?$product_category['name']:set_value('name');?>" required>
                    </td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?= site_url('product_category') ?>" class="btn btn-default">Kembali</a>
						<button type="submit" class="btn btn-info">Simpan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>