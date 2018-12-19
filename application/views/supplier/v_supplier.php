<div class="container-fluid">
	<div class="content">
		
		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<a class='btn btn-sm btn-default'
		href="<?= site_url('supplier/create') ?>"> 
			<span class='glyphicon glyphicon-plus'></span>  
			 Tambah
		</a>
		<br><br>
		<table class="table table-striped" id="myTable">
			<thead>
				<tr>
					<th style="width:7%">No</th>
					<th>Nama</th>
					<th>No. Telp</th>
					<th>Address</th>
					<th>Deskripsi</th>
					<th style="width: 15%">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script>
	var nTable = $("#myTable").DataTable({
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo site_url('supplier/get_data') ?>",
            type:'POST',
        }
    });
</script>
