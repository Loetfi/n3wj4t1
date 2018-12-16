<div class="container-fluid">
	<div class="content">
		
		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<a class='btn btn-xs btn-default' style="margin-left: 1000px;"
		href="<?= site_url('customer/create') ?>"> 
			<span class='glyphicon glyphicon-plus'></span>  
			 Tambah
		</a>
		<br><br>
		<table class="table table-striped" id="myTable">
			<thead>
				<tr>
					<th style="width:7%">No</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>No. Telp</th>
					<th>Alamat</th>
					<th>Perusahaan</th>
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
            url: "<?php echo site_url('customer/get_datatables') ?>",
            type:'POST',
        }
    });
</script>
