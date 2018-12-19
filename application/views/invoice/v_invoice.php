<div class="container-fluid">
	<div class="content">
		
		<?php if ($this->session->flashdata('message')): ?>
		  	<div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
		    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    	<?= $this->session->flashdata('message') ?>
		  	</div>
		<?php endif ?>

		<h3>Invoice</h3>
		<table class="table table-striped" id="myTable">
			<thead>
				<tr>
					<th style="width:7%">No</th>
					<th>Customer</th>
					<th>Nama Project</th>
					<th>Harga</th>
					<th>Status</th>
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
            url: "<?php echo site_url('inv/get_data') ?>",
            type:'POST',
        }
    });
</script>