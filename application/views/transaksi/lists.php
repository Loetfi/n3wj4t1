<div class="container-fluid">
	<!-- <div class='row'>
		<div class='col-md-12 breadcumb'>
			<div class="breadcumb-content">
			ORDER                    
			</div>
		</div> 
	</div> -->
	<div class="row">
		<div class="col-md-12">
			<div class="content">
				<h4>List Transaksi</h4>
				<!-- <div class="row">
                    <div class="col-md-6">
                        <select id="idcustomer" name="idcustomer" required="" class="form-control select select2-ajax" width="48"></select>
                    </div>
				</div>
                
                <br> -->
				<table class="table table-striped table-desa">
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
<input type="hidden" id="tmpCusId" value="">
<script type="text/javascript">

    var nTable = $(".table-desa").DataTable({
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo site_url('transaksi/ambildata') ?>",
            type:'POST',
			// data:{
				// idcustomer: $('#tmpCusId').val()
			// }
        }
    });
        
    jQuery("#idcustomer").select2({
        placeholder:"~ Cari Customer ~",
        allowClear:true,
        required:"",
        minimumInputLength:0,
        ajax:{
            url:"<?php echo site_url('customer/get_data')?>",
            dataType:"json",delay:250,
            data:function(params){
                return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}
            },
            cache:true
        }
    });
	$('#idcustomer').on("select2:selecting", function(e) {
		thisVal = $(this).val();
		console.log(thisVal);
		
		if (thisVal != null){
			// $.ajax({ 
				// method: 'POST', 
				// type: 'json', 
				// url: '<?php echo site_url('transaksi/ambildata') ?>', 
				// data: { 
					// idcustomer: thisVal, 
				// }, 
				// beforeSend: function( ) { 
					// // $('.card-loading').css('display','block'); 
				// }, 
				// success: function(thisData) {
					// console.log(thisData);
				// }, 
				// error: function() { 
					// // alert('Some Error. Please Try Again'); 
				// }, 
				// complete: function(){ 
					// // $('.card-loading').css('display','none'); 
				// } 
			// }); 
			// $('#tmpCusId').val(thisVal);
		}
	});
</script> 

</div>
</div>
</div>
</div>
