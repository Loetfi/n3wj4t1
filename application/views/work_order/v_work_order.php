<div class="container-fluid">
	<div class='row'>
		<div class='col-md-12 breadcumb'>
			<div class="breadcumb-content">
				<h3>Work Order</h3>                    
			</div>
		</div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="content">

				<table class="table table-striped" id="myTable">
					<thead>
						<tr><th style="width:50px">No</th>
							<th>Customer</th>
							<th>Nama Project</th>
							<th>Tgl Order</th>
							<th>Tipe Order</th>
							<th>Total Harga</th>
							<th>Sisa Pembayaran</th>
							<th>Deadline</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

    var nTable = $("#myTable").DataTable({
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo site_url('work_order/get_data') ?>",
            type:'POST',
        }
    });
</script> 