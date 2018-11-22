<script>
function btnPaymentItem(trorderid, noInv, projectName, sisa){
	// console.log(trorderid);
	$('#thisNominalPembayaran').val('');
	$('#thisTrOrderId').val(trorderid);
	$('#thisNoInv').val(noInv);
	$('#thisProjectName').val(projectName);
	$('#hargaForm').modal('show');
}
function removeListItemPembayaran(trorderid){
	$('tr.itemPembayaran_'+trorderid).remove();
}
</script>
<div class="container-fluid">
    <div class="row">
        <hr>
        <div class="col-sm-12">
            <div class="content"> 
				<?php echo $this->session->flashdata('message_system'); ?>
                <legend>FORM PEMBAYARAN</legend>
				<form action="<?php echo site_url('pembayaran/dpAct'); ?>" method="POST" target="_blank">
					<table class="table table-striped table-bordered">
                        <tr>
                            <td width="200px"><b>Customer</b> * </td>
                            <td>
								<select id="idcustomer" name="idcustomer" required="" class="form-control select select2-ajax" width="48">
                                    <?php if ($this->session->userdata('idcustomer')) { ?>
                                    <option value="<?php echo $this->session->userdata('idcustomer')?>"><?php echo getCustomer($this->session->userdata('idcustomer'))?></option>
                                    <?php }  ?>
                                </select>
                            </td>
						</tr>
                        <tr>
                            <td><b>Tipe Pembayaran</b> * </td>
                            <td>
								<select name="tipebayar" class="form-control">
									<option value="DP">DP</option>
								</select>
							</td>
						</tr>
                        <tr>
                            <td><b>Cara Pembayaran</b> * </td>
                            <td>
								<select name="carabayar" class="form-control" required>
									<option value="">~ Pilih Cara Pembayaran ~</option>
									<option value="Cash">Cash</option>
									<option value="Transfer">Transfer</option>
									<option value="EDC">Mesin EDC</option>
								</select>
                            </td>
						</tr>
                        <tr>
                            <td><b>Kode Khusus</b></td>
                            <td><input type="text" name="codekhusus" class="form-control"></td>
						</tr>
                        <tr>
                            <td><b>Keterangan</b></td>
                            <td><textarea name="keterangan" class="form-control"></textarea></td>
						</tr>
					</table>
 
					<button tabindex="3" type="button" id="btnCoba" class="" data-toggle="modal">
						<i class="fa fa-search"></i> Cari Invoice
					</button>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No Invoice</th>
							<th>Nama Project</th>
							<th>Nominal Pembayaran</th>
							<th>#</th>
						</tr>
						</thead>
						<tbody id="listItemPembayaran"></tbody>
					</table>
					<button type="submit" class="btn btn-info">Simpan</button>
				</form>
			</div>
		</div>
		
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="color-line"></div>
			<div class="modal-header text-center">
				<h4 class="modal-title">Modal title</h4>
				<!-- <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>#</th>
						<th>No Invoice</th>
						<th>Nama Project</th>
						<th>Tgl Order</th>
						<th>Tipe Order</th>
						<th>Nilai Invoice</th>
						<th>Sisa<br>Tagihan</th>
						<th>Pembayaran</th>
					</tr>
					</thead>
					<tbody id="listInv"></tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="hargaForm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<form id="nominalForm" class="form form-horizontal">
			<div class="modal-content">
				<div class="color-line"></div>
				<div class="modal-header text-center">
					<h4 class="modal-title">Nominal</h4>
					<!-- <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-sm-3">
							Nominal Pembayaran
						</div>
						<label for="" class="col-sm-9 control-label">
							<input type="text" name="harga" value="" class="form-control format-number txt-right" id="thisNominalPembayaran" required>
						</label>
					</div>
					<input type="hidden" name="trorderid" id="thisTrOrderId" value="">
					<input type="hidden" id="thisNoInv" value="">
					<input type="hidden" id="thisProjectName" value="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="btnItemForm" type="submit" class="ladda-button btn btn-primary" data-style="expand-left">
						Submit
					</button>
				</div>
				
				
			</div>
		</form>
	</div>
</div>

<script>

jQuery("#idcustomer").select2({
	placeholder:"~ Pilih Customer ~",
	allowClear:true,
	required:"",
	minimumInputLength:0,
	ajax:{
		url:"<?php echo site_url('customer/get_data')?>",
		dataType:"json",
		delay:250,
		data:function(params){
			return{
				term:params.term,page:params.page||1,parent:jQuery("#").val(),
			}
		},
		cache:true
	}
});

jQuery('#idcustomer').change(function(){
	
	id = $(this).val();
	
	jQuery.ajax({
		url: app_url+'/customer/order',
		data: { id : id, },
		// dataType: 'JSON',
		type: 'POST',
		success: function(response){
			$('#listInv').html(response);
		},
		error:function(response){
			console.log(response);
		}
	});
});
jQuery("#btnCoba").click(function() {
	$('#myModal').modal('show');
});
jQuery("#nominalForm").submit(function() {
	thisNominalPembayaran = $('#thisNominalPembayaran').val();
	thisTrOrderId = $('#thisTrOrderId').val();
	thisNoInv = $('#thisNoInv').val();
	thisProjectName = $('#thisProjectName').val();
	
	html = '<tr class="itemPembayaran_'+thisTrOrderId+'">';
	html += '<td>'+thisNoInv+'</td>';
	html += '<td>'+thisProjectName+'</td>';
	html += '<td>'+thisNominalPembayaran+'</td>';
	html += '<td><input type="hidden" name="trorderid[]" value="'+thisTrOrderId+'"><input type="hidden" name="pembayaran['+thisTrOrderId+']" value="'+thisNominalPembayaran+'"><button class="btn btn-danger" onclick="removeListItemPembayaran('+thisTrOrderId+')">Hapus</button></td>';
	html += '<tr>';
	
	$('#listItemPembayaran').append(html);
	$('#hargaForm').modal('hide');
	$('#myModal').modal('hide');
	return false;
});

</script>
