<div class="container-fluid">
	<div class="content">
		<legend>FORM <?= ($this->uri->segment(2) == 'update') ? 'EDIT':'TAMBAH'?> DATA PRODUK</legend>

		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<?php if($this->uri->segment(2) == 'create'): ?>
			<form action="<?= site_url('product/create') ?>" method="POST">
		<?php else: ?>
			<form action="<?= site_url('product/update/'.$product['idproduct'].'') ?>" method="POST">
		<?php endif ?>
			<table class="table table-striped table-bordered">
				<tr>
                    <td width="200px"><b>Unit</b> * </td>
                    <td>
                    	<select style="width: 100%;" class="form-control populate placeholder" name="idproduct_unit" id="idproduct_unit" required></select>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Kategori</b> * </td>
                    <td>
                    	<select style="width: 100%;" class="form-control populate placeholder" name="idproduct_category" id="idproduct_category" required></select>
                    </td>
				</tr>
                <tr>
                    <td width="200px"><b>Barcode</b> * </td>
                    <td>
						<input type="text" name="barcode" class="form-control" value="<?=isset($product['barcode'])?$product['barcode']:set_value('barcode');?>" required>
                    </td>
				</tr>
				<tr>
                    <td width="200px"><b>Nama</b> * </td>
                    <td>
						<input type="text" name="name" class="form-control" value="<?=isset($product['name'])?$product['name']:set_value('name');?>" required>
                    </td>
				</tr>
				<tr>
					<td width="200px"><b>Price</b></td>
                    <td>
						<input type="number" name="price" class="form-control" value="<?=isset($product['price'])?$product['price']:set_value('price');?>">
                    </td>
                </tr>
                <tr>
					<td width="200px"><b>Stock</b> *</td>
                    <td>
						<input type="number" name="stock" class="form-control" value="<?=isset($product['stock'])?$product['stock']:set_value('stock');?>">
                    </td>
                </tr>
                <tr>
                    <td width="200px"><b>Deskripsi</b></td>
                    <td>
						<textarea class="form-control" name="description" rows="3"><?=isset($product['description'])?$product['description']:set_value('description');?></textarea>
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
		$('#idproduct_category').select2({
            width: 'resolve',
            data: <?php echo $list_category; ?>
        });

        <?php if($this->uri->segment(2) == 'update'): ?>
            <?php $idproduct_category = isset($product['idproduct_category']) ? $product['idproduct_category'] : 1 ; ?>
            $('#idproduct_category').val(<?=$idproduct_category?>).trigger('change');
        <?php endif ?>

        $('#idproduct_unit').select2({
            width: 'resolve',
            data: <?php echo $list_unit; ?>
        });

        <?php if($this->uri->segment(2) == 'update'): ?>
            <?php $idproduct_unit = isset($product['idproduct_unit']) ? $product['idproduct_unit'] : 1 ; ?>
            $('#idproduct_unit').val(<?=$idproduct_unit?>).trigger('change');
        <?php endif ?>
	})
</script>