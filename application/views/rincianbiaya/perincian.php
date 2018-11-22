 
<div class="col-sm-12">
	<div class="content">   

		<p><a onclick="return confirm('Apakah kamu yakin ? ');" href="<?php echo site_url('transaksi/detail/'.$_GET['orderid']) ?>" class="btn btn-primary">Kembali</a></p>
		<br> 


		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-info">
					<!-- <div class="panel-heading"> -->
						<h3 class="panel-title"><center>PERINCIAN PEKERJAAN</center></h3>
					<!-- </div> -->
					<div class="panel-body">
						<?php //print_r($project['projectname']); ?>
						<table class="table table-hover table-bordered">
							<tr>
								<th>NAMA PROJECT</th>
								<th>JENIS PESANAN</th>
								<th>KETERANGAN</th>
								<th>QTY</th>
								<!-- <th>HARGA JUAL SATUAN</th> -->
								<!-- <td>SATUAN</td> -->
								<!-- <Th>UPRICE</Th> -->
								<!-- <Th>JUMLAH</Th> -->
							</tr>

							<tr>
								<td><?php echo $project['projectname']; ?></td>
								<td><?php echo $ambildetail['tipeorder']; ?> </td>
								<td><?php echo $ambildetail['satuanproject']; ?> </td>
								<td><?php echo $ambildetail['qty']; ?> </td> 
								<!-- <td></td>  -->
								<!-- <td>00</td> -->
								<!-- <td> 00</td> -->
							</tr>
						</table>


					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-success">
					<!-- <div class="panel-heading"> -->
						<h3 class="panel-title">Input Perincian Biaya</h3>
					<!-- </div> -->
					<div class="panel-body">
						<form action="<?php echo site_url('rincianbiaya/savekeranjang?id='.$_GET['id'].'&orderid='.$_GET['orderid']) ?>" method="POST" role="form">

							<table class="table">
								<tr>
									<td width="200px">Jenis Rincian Biaya</td>
									<td> 

										<div class="form-group">
											<!-- <label for="" class="col-sm-1 control-label">-</label> -->
											<div class="col-sm-12">

												<div class="input-group">
                                                    <input class="form-control" name="koderincianbiaya" id="barcode" placeholder="" width="100px" type="text">
                                                    <span class="input-group-btn">
                                                        <button class="product-search  btn btn-success" type="button"><i class="fa fa-search"></i> Cari</button>
                                                    </span>
                                                </div> 
											</div>
											<label class="col-sm-7 control-label txt-left">
												<div id="l_product_name" class="l-product-name"></div>
											</label>
										</div>


									</td>
								</tr>
								<tr>
									<td>Qty</td>
									<td>
										<input type="text" name="qty" id="volume" class="form-control" value="" required="required" title="">
									</td>
								</tr>
								<tr>
									<td>Harga Satuan</td>
									<td>
										<input type="text" name="hargarincian" id="harganya" class="form-control txt-right" value="" required="required" title="" >
									</td>
								</tr>
								<tr>
									<td>Jumlah Harga</td>
									<td>
										<input type="text" name="totalrincian" class="form-control" value="" required="required" title="" readonly="" id="jumlah">

									</td>
								</tr>
								<tr>
									<td>Jumlah Harga</td>
									<td><button type="submit" class="btn btn-primary btn-sm">Input</button></td>
								</tr>
							</table> 



						</form>
					</div>
				</div>

			</div>
		</div>



		<?php echo $this->session->flashdata('message_system'); ?>
		<div class="panel panel-success">


			<!-- <div class="panel-heading"> -->
				<h3 class="panel-title"><center>PERINCIAN BIAYA</center></h3>
			<!-- </div>  -->

			<div class="panel-body">

				<table class="table table-striped table-bordered">
					<tr>
						<th>NO.</th>
						<th>KODE BIAYA</th>
						<th>JENIS PEKERJAAN</th>
						<!-- <td>SATUAN</td> -->
						<Th>QTY</Th>
						<Th>UPRICE</Th>
						<TH>JUMLAH</TH>
						<TH>Aksi</TH>
					</tr>

					<?php $no = 1 ;  
					if (count($databiaya) > 0) { 
						foreach ($databiaya as $items) { ?> 
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo getStockName($items['koderincian']); ?></td>
							<td></td>
							<td><?php echo $items['qty']; ?></td>
							<td><?php echo $items['uprice']; ?></td>
							<td><?php echo number_format($items['jumlah']); ?></td>
							<td>
								<a onclick="return confirm('Apakah kamu yakin ? ');" href="<?php echo site_url('rincianbiaya/removekeranjang/'.$items['trorderrincianid'].'/'.@$_GET['id'].'/'.@$_GET['orderid']) ?>" class="btn btn-danger btn-xs">Remove</a>
							</td>
						</tr>
						<?php 
						@$totalHarga += $items['jumlah'];
						$no++; 
					} 

				} else { 
					echo "<tr><td colspan='7'> Belum ada item rincian biaya </td></tr>"; 
				}
				?>

				<tr>
					<td colspan="5"></td>
					<td colspan="2" id="htmlHargaJual">
									<!-- 
									<?php if ($ambildetail['hargajual'] == ''){ ?>
									<form id="saveHargaJual">
									<div class="input-group input-group-sm">
										<?php echo @$totalHarga; ?>
										<input type="hidden" name="trorderdetailid" id="trorderdetailid" value="<?php echo $ambildetail['trorderdetailid']; ?>">
										<input type="text" name="hargaJual" id="hargaJual" class="form-control" value="<?php echo @$ambildetail['hargajual']; ?>">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-info btn-flat" type="button">Simpan</button>
										</span>
									</div>
									</form>
									<?php } else { echo number_format(@$ambildetail['hargajual'],2); } ?>
								-->
								<?php echo number_format(@$totalHarga,2); ?>
							</td>
						</tr>
					</table>
				</div>
			</div> 


		</div>
	</div>
</div>
</div> 


<script type="text/javascript">
	$("#volume").keyup(function(){
		total = $("#volume").val()* $("#harganya").val();
		$("#jumlah").val(total);
	});

	$("#harganya").keyup(function(){
		total = $("#volume").val()* $("#harganya").val();
		$("#jumlah").val(total);
	});
</script>


<div class="modal fade az-modal az-modal-product" data-width="800">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div class="az-modal-close" data-dismiss="modal" aria-hidden="true">
					<div class="caret-close"></div>
					<div class="modal-btn-close">
						<button type="button" class="close">X</button>
					</div>
				</div>
				<h4 class="modal-title"><span>Add</span>&nbsp;Produk</h4>

			</div>
			<div class="modal-body"><div class='pos-relative btn-top-table'>
				&nbsp;&nbsp;<button class="btn btn-info btn-select-all-product btn-xs" type="button"><i class="fa fa-check-square-o"></i> Select All</button>

				&nbsp;&nbsp;<button class="btn btn-info btn-unselect-all-product btn-xs" type="button"><i class="fa fa-square-o"></i> Clear Selection</button>

				&nbsp;&nbsp;<button class="btn btn-danger btn-delete-selected-product btn-xs" type="button"><span class="glyphicon glyphicon-remove"></span> Delete Selection Data</button>

				&nbsp;&nbsp;<span class="selected-data-product"></span>
			</div><table class=' az-table table table-bordered table-striped table-condensed table-hover dt-responsive display nowrap' id='product'>	<thead><tr role='row' class='heading'><th width='10px' class='no-sort'>No</th><th width='' class=''>Barcode</th><th width='' class=''>Nama</th><th width='80px' class=''>Satuan</th><th width='' class=''>Harga</th><th width='50px' class=''>Stok</th><th width='80px' class='no-sort'>Aksi</th></tr><tr role='row' class='filter'><td></td><td><input type='text' class='form-control full-width form-filter' id='f_sqgjaVC728gWHmiE85RnRvpCvWYA7E7qTezHcLI2xOFOicYUq7BPlDx6JLQHrvs+wlxFdiokUrpMH0jcXshRcw==' name='f_sqgjaVC728gWHmiE85RnRvpCvWYA7E7qTezHcLI2xOFOicYUq7BPlDx6JLQHrvs+wlxFdiokUrpMH0jcXshRcw==' data-filter='f_sqgjaVC728gWHmiE85RnRvpCvWYA7E7qTezHcLI2xOFOicYUq7BPlDx6JLQHrvs+wlxFdiokUrpMH0jcXshRcw=='/></td><td><input type='text' class='form-control full-width form-filter' id='f_DYMi7wWz+9HypyU39mgErdSiSSLeapQJa93s38diUrYc16ErkxBiBZd9CwByz+4Vf8VGP+fRTijKZEubGUIauw==' name='f_DYMi7wWz+9HypyU39mgErdSiSSLeapQJa93s38diUrYc16ErkxBiBZd9CwByz+4Vf8VGP+fRTijKZEubGUIauw==' data-filter='f_DYMi7wWz+9HypyU39mgErdSiSSLeapQJa93s38diUrYc16ErkxBiBZd9CwByz+4Vf8VGP+fRTijKZEubGUIauw=='/></td><td></td><td></td><td></td>	<td><button class="btn btn-primary filter-submit full-width" type="button" id="btn_filter_product"><i class="fa fa-search"></i>&nbsp;&nbsp;Filter</button>	</td></tr>	</thead>	<tbody>	</tbody></table>    		</div>
			<div class="modal-footer">
				<div class="pull-right">
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".product-search").click(function() {
			show_modal("product");
			jQuery(".az-modal .modal-title-text").text("Pilih Product");
		});

		jQuery("body").on("click", ".btn-select-product", function() {
			var barcode = jQuery(this).attr("data-barcode");
			jQuery("#barcode").val(barcode); 
			jQuery("#total").focus();
			jQuery("#idproduct").val(jQuery(this).attr("data-idproduct"));
			jQuery("#product_name").val(jQuery(this).attr("data-name"));
			jQuery("#l_product_name").text(jQuery(this).attr("data-name"));
			jQuery("#harganya").val(jQuery(this).attr("data-price"));
			jQuery(".l-product-price").val(thousand_separator(jQuery(this).attr("data-price")));
		});


	});

		// suvi edit
		jQuery("#saveHargaJual").submit(function() {
			trorderdetailid = $('#trorderdetailid').val();
			hargaJual = $('#hargaJual').val();
			
			jQuery.ajax({
				url: app_url+"order/saveHargaJual",
				data: {
					id : trorderdetailid,
					hargaJual : hargaJual,
				},
				type: "POST",
				success: function(response){
					$('#htmlHargaJual').html(response);
				},
				error:function(response){
					console.log(response);
				}
			});
			// alert('masuk');
			return false;
		});

		function get_single_product() {
			show_loading();
			jQuery.ajax({
				url: app_url+"product/get_single_product",
				data: {
					"barcode" : jQuery("#barcode").val(),
				},
				dataType: "JSON",
				type: "POST",
				success: function(response){
					hide_loading();
					if (response.sMessage != "") {
						bootbox.alert({
							title: "Error",
							message: response.sMessage
						});
					}
					else {
						jQuery("#idproduct").val(response.result[0].idproduct);
						jQuery("#product_name").val(response.result[0].name);
						jQuery("#l_product_name").text(response.result[0].name);
						jQuery(".l-product-price").val(thousand_separator(response.result[0].price));
						jQuery("#total").focus();
					}
				},
				error:function(response){
					console.log(response);
				}
			});
		}
	</script>

	<form class="form-horizontal az-form" id="form_product" name="form" method="post">
		<input type="hidden" name="idtransaction_group" tabindex="1" id="idtransaction_group" value=""/>

   <!--  <div class="form-group">
        <label for="" class="col-sm-1 control-label">Qty</label>
        <div class="col-sm-1">
            <input class="form-control txt-center format-number" tabindex="2" type="number" min="1" name="qty" id="qty" placeholder="1" maxlength="5" />
        </div>
    </div> -->
</form>

<!-- <div class="transaction-group-code-div">
    Nota &nbsp;
    <input style="width:150px;" type='text' id='transaction_group_code_hd' readonly value='NOTA171213V5FJU4'/>
</div>

<div class="transaction-price">
    0</div>


<div class="transaction-btn">
    <button tabindex="3" class="btn btn-primary" type="button" id="btn_add_transaction"><i class="fa fa-plus"></i> Add</button>&nbsp;
    <button tabindex="4" class="btn btn-primary" type="button" id="btn_payment"><i class="fa fa-floppy-o"></i> Payment</button>&nbsp;
    <a href="http://ido.awanesia.com/index.php/transaction"><button tabindex="5" class="btn btn-info" type="button"><i class="fa fa-file-o"></i> New Transaction</button></a>
</div>
<br> -->

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#barcode").focus();

		jQuery("#btn_add_transaction").click(function() {
			add_transaction();
		});

		jQuery("#barcode, #qty").on("keyup", function(e) {
			jQuery("#l_product_name").text("");
			if (e.keyCode == 13) {
				add_transaction();
			}
		});

		jQuery("#btn_hold").click(function() {
			hold_transaction();
		});

		jQuery("#btn_payment").click(function() {
			show_modal("payment");
			jQuery(".az-modal .modal-title").text("Payment");
		});

		jQuery(document).on("hidden.bs.modal", ".modal", function () {
			jQuery("#barcode").focus();
		});

		function add_transaction() {
			show_loading();
			jQuery.ajax({
				url: app_url+'transaction/add_transaction',
				data: {
					"barcode" : jQuery("#barcode").val(),
					"qty" : jQuery("#qty").val(),
					"idcustomer" : jQuery("#idcustomer").val(),
					"transaction_date" : jQuery("#transaction_date").val(), 
					"idtransaction_group" : jQuery("#idtransaction_group").val()
				},
				dataType: 'JSON',
				type: 'POST',
				success: function(response){
					hide_loading();
					if (response.sMessage != "") {
						bootbox.alert({
							title: "Error",
							message: response.sMessage
						});
					}
					else {
						jQuery("#idtransaction_group").val(response.idtransaction_group);
					}

					var dtable = jQuery('#transaction').dataTable({bRetrieve:true});
					dtable.fnDraw();

					jQuery("#barcode").val("");
					jQuery("#l_product_name").text("");
					jQuery("#qty").val("");
					jQuery("#barcode").focus();

					jQuery(".transaction-price").html(response.final_price);
					jQuery("#btn_hold").prop("disabled", false);
				},
				error:function(response){
					console.log(response);
				}
			});
		}

		function hold_transaction() {
			jQuery.ajax({
				url: app_url+'transaction/hold_transaction',
				data: {
					"idtransaction_group" : jQuery("#idtransaction_group").val()
				},
				dataType: 'JSON',
				type: 'POST',
				success: function(response){
					if (response.sMessage != "") {
						bootbox.alert({
							title: "Error",
							message: response.sMessage
						});
					}
					else {
						bootbox.alert({
							title: "Success",
							message: "Transaksi Berhasil Ditahan"
						});
						location.href = "http://ido.awanesia.com/index.php/transaction";
					}
				},
				error:function(response){
					console.log(response);
				}
			});
		}

	});
</script>

</div> <!-- end content -->
</div> <!-- end col-md-12 -->
</div> <!-- end row -->
</div> 


<script type='text/javascript'>function show_modal(id){jQuery('.az-modal-'+id).modal({backdrop:'static',keyboard:true})}function show_loading(){jQuery(".az-loading").show()}function hide_loading(){jQuery(".az-loading").hide()}function clear(){jQuery(".az-modal form input").not(".x-hidden").val("");jQuery(".az-modal form select").each(function(index,value){if(jQuery(this).hasClass("select2-ajax")){jQuery(this).val("").trigger("change")}else{jQuery(this).val(jQuery(this).find("option:first").val()).trigger("change")}});jQuery(".az-modal form textarea").val("");var t_ckeditor=jQuery(".az-modal form .ckeditor");jQuery(t_ckeditor).each(function(){var id_ckeditor=jQuery(this).attr('id');CKEDITOR.instances[id_ckeditor].setData('')});var filter_table=jQuery(".filter-tabel select");jQuery(filter_table).each(function(){var fil=jQuery(this).attr("fil");jQuery("#"+fil).val(jQuery("#f"+fil).val())});jQuery('#l_product_name').text('-')}function edit(url,id,form,table_id,callback){show_loading();clear();$.ajax({type:"POST",url:url,data:{id:id,},success:function(response){var f_input=jQuery('#'+form+' input');var arr_ajax=[];jQuery.each(response[0],function(index,valu){jQuery('#'+index).val(valu).trigger("change");if(jQuery('#'+index).hasClass("format-number")){jQuery('#'+index).val(thousand_separator(jQuery('#'+index).val()))}var ajax_=index;if(ajax_.indexOf("ajax_")>=0){arr_ajax.push(ajax_)}});if(arr_ajax.length>0){jQuery.each(arr_ajax,function(index_arr,value_arr){var idajax=value_arr.replace("ajax_","");if(response[0][value_arr]!=null){jQuery("#"+idajax+".select2-ajax").append(new Option(response[0][value_arr],response[0][idajax],true,true)).trigger('change')}})}var t_area=jQuery("#"+form+' .ckeditor');jQuery(t_area).each(function(){var id_ckeditor=jQuery(this).attr('id');CKEDITOR.instances[id_ckeditor].setData(response[0][id_ckeditor])});hide_loading();callback(response)},error:function(response){hide_loading()},dataType:"json"});jQuery(".modal-title span").text("Edit");show_modal(table_id)};function save(url,form,vtable,callback,data){show_loading();var formdata=new FormData();var txt_ckeditor=jQuery(form+' .ckeditor');jQuery(txt_ckeditor).each(function(){var id_ckeditor=jQuery(this).attr("id");CKEDITOR.instances[id_ckeditor].updateElement()});$.each(jQuery('#'+form).serializeArray(),function(a,b){formdata.append(b.name,b.value)});if(!data){data=[]}jQuery.each(data,function(ke,va){formdata.append(ke,jQuery(va).val())});$.ajax({url:url,data:formdata,processData:false,contentType:false,type:'POST',dataType:"json",success:function(response){hide_loading();if(response.sMessage!=""){var err_response=response.sMessage;err_response=err_response.replace(/\n/g,"<br>");bootbox.alert({title:'Error',message:err_response})}else{bootbox.alert({title:"Success",message:"Save data success"});jQuery(".az-modal").modal("hide");var dtable=jQuery('#'+vtable).dataTable({bRetrieve:true});dtable.fnDraw();callback(response)}},error:function(response){console.log(response);hide_loading()}})}function remove(url,id,vtable,callback){bootbox.confirm({title:"Delete data",message:"Are you sure for delete?",callback:function(result){if(result==true){$.ajax({url:url,type:"post",dataType:"json",data:{id:id},success:function(response){if(response.err_code>0){bootbox.alert({title:"Error",message:response.err_message})}else{var dtable=jQuery('#'+vtable).dataTable({bRetrieve:true});dtable.fnDraw();callback(response)}},error:function(er){bootbox.alert({title:"Error",message:"Delete data failed "+er})}})}}})}function thousand_separator(x){if(typeof x!=='undefined'){return x.toString().replace(/\./g,'').replace(/\B(?=(\d{3})+(?!\d))/g,".")}}function remove_separator(x){if(typeof x!=='undefined'){return x.toString().replace(/\./g,'')}}csrf_token_name="ci_csrf_token";csrf_cookie_name="awanesia";jQuery(function(jQuery){var object={};object[csrf_token_name]=jQuery.cookie(csrf_cookie_name);jQuery.ajaxSetup({data:object});$(document).ajaxComplete(function(){object[csrf_token_name]=jQuery.cookie(csrf_cookie_name);jQuery.ajaxSetup({data:object});jQuery("input[name='"+csrf_token_name+"']").val(jQuery.cookie(csrf_cookie_name))})});jQuery(document).ready(function(){jQuery("select.select").select2();$.fn.modal.Constructor.prototype.enforceFocus=function(){};jQuery("body").append(jQuery(".az-modal"));jQuery('.az-modal').on('shown.bs.modal',function(){jQuery('input:text:visible:first',this).not('.x-hidden').focus()});jQuery(document).on('show.bs.modal','.modal',function(){var zIndex=1040+(10*jQuery('.modal:visible').length);$(this).css('z-index',zIndex);setTimeout(function(){jQuery('.modal-backdrop').not('.modal-stack').css('z-index',zIndex-1).addClass('modal-stack')},0)});jQuery(document).on('hidden.bs.modal','.modal',function(){jQuery('.modal:visible').length&&jQuery(document.body).addClass('modal-open')});jQuery("body").on("change",".filter-table select",function(){var table_id=jQuery(".filter-tabel").attr("tid");var dtable=jQuery('#'+table_id).dataTable({bRetrieve:true});dtable.fnDraw()});jQuery('.az-form').on('keyup keypress',function(e){var keyCode=e.keyCode||e.which;if(keyCode===13){e.preventDefault();return false}});jQuery(".format-number").on('keyup keydown',function(e){jQuery(this).val(thousand_separator(jQuery(this).val()))});jQuery(".format-number").keydown(function(e){if($.inArray(e.keyCode,[46,8,9,27,13,110,190])!==-1||(e.keyCode==65&&(e.ctrlKey===true||e.metaKey===true))||(e.keyCode>=35&&e.keyCode<=40)){return}if((e.shiftKey||(e.keyCode<48||e.keyCode>57))&&(e.keyCode<96||e.keyCode>105)){e.preventDefault()}});jQuery(document).on('click','.az-table tbody tr td',function(event){var btn=jQuery(this).find('button');if(btn.length==0){jQuery(this).parents('tr').toggleClass('selected')}})});jQuery("body").on("click",".hidden-menu-text",function(){jQuery("menu ul:eq(0)").slideToggle('fast');jQuery("menu .hidden-menu-text i").toggleClass("fa-caret-square-o-up fa-caret-square-o-down")});jQuery("body form").append('<input class="x-hidden" type="hidden" name="ci_csrf_token" value="">');jQuery('.img-btn-language').click(function(){var lang=jQuery(this).attr('data-id');jQuery.ajax({url:app_url+'home/change_language/'+lang,success:function(respond){location.reload()},})});var selected_lang="";if(selected_lang=='indonesian'){jQuery('.img-btn-language[data-id="id"]').css('opacity',1);jQuery('.img-btn-language[data-id="en"]').css('opacity',0.5)}else{jQuery('.img-btn-language[data-id="id"]').css('opacity',0.5);jQuery('.img-btn-language[data-id="en"]').css('opacity',1)}jQuery(document).ready(function(){jQuery('#transaction_date').datetimepicker({format:'DD-MM-YYYY HH:mm:ss'});generate_table_product();function generate_table_product(){
	var total_column=[];
	var column=jQuery("#product thead tr:eq(0) th").length;
	for(var i=0;i<column;i++){total_column.push(null)}
	jQuery("#product").dataTable({
		"bServerSide":true,"sAjaxSource":app_url+"product/get_info",
		"bFilter":true,
		"bProcessing":true,
		"bLengthChange":true,
		"bSort":true,
		"bSortCellsTop":true,
		"dom":'<"row"<"col-sm-6 col-sm-offset-6">> <"row"<"col-sm-12"tr>><"row"<"col-sm-5"l><"col-sm-7"p>><"row"<"col-sm-12"i>>',"bAutoWidth":false,"bPaginate":true,"bInfo":true,"lengthMenu":[[10,25,50,100,200,300,500],[10,25,50,100,200,300,500]],"aoColumns":total_column,"columnDefs":[
		{"targets":"no-sort","orderable":false,"order":[]}
		],
		"fnServerParams":function(aoData){jQuery(".form-filter").each(function(){var id_filter=jQuery(this).attr("data-filter");var clear_id_filter=id_filter.substring(2);aoData.push({"name":"cfilter["+clear_id_filter+"]","value":jQuery(this).val()})});jQuery(".form-top-filter-product .element-top-filter").each(function(){var id_filter=jQuery(this).attr("data-id");var value_filter=jQuery(this).val();var con_value="";jQuery(this).find(".con-element-top-filter").each(function(){var pre="";if(con_value!=""){pre="~az~"}con_value+=pre+jQuery(this).val()});if(con_value!=""){value_filter=con_value}aoData.push({"name":"topfilter["+id_filter+"]","value":value_filter})})},})}

		var callback_edit_product=function(response){};jQuery("body").on("click",".btn-edit-product",function(){var id=jQuery(this).attr("data_id");edit(app_url+'product/edit',id,"","product",callback_edit_product)});var callback_delete_product=function(response){};jQuery("body").on("click",".btn-delete-product",function(){var id=jQuery(this).attr("data_id");remove(app_url+'product/delete',id,"product",callback_delete_product)});var callback_save_product=function(response){};var data_save_product={};jQuery("body").on("click",".btn-save-product",function(){save(app_url+'product/save',"","product",callback_save_product,data_save_product)});jQuery("body").on("click",".btn-add-product",function(){clear();jQuery(".modal-title span").text("Add");show_modal("product")});jQuery("#btn_filter_product").click(function(){var dtable=$("#product").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery("#btn_top_filter_product").click(function(){var dtable=$("#product").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery(document).on("click",".az-table#product tbody tr td",function(event){var btn=jQuery(this).find("button");if(btn.length==0){var selected=check_table_product();init_selected_table_product()}});jQuery(".btn-select-all-product").on("click",function(){sel_un_all_product("select")});jQuery(".btn-unselect-all-product").on("click",function(){sel_un_all_product("unselect")});jQuery(".az-table#product").on("draw.dt",function(){init_selected_table_product()});jQuery(document).on("hidden.bs.modal",".modal",function(){sel_un_all_product()});jQuery(".btn-delete-selected-product").on("click",function(){var id_delete=check_table_product();remove(app_url+'product/delete',id_delete,"product",callback_delete_product)});jQuery(".form-top-filter-hide-product").on("click",function(){jQuery(".form-top-filter-body-product").slideToggle("fast");jQuery(this).find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up")});jQuery("#product_filter input").attr("placeholder","");function init_selected_table_product(){var selected=check_table_product();var btn_hide=jQuery(".btn-select-all-product, .btn-unselect-all-product, .btn-delete-selected-product, .selected-data-product");if(selected.length>0){btn_hide.show()}else{btn_hide.hide()}}function check_table_product(){var table_select=jQuery(".az-table#product tbody tr.selected");var arr_delete=[];table_select.each(function(){var check_data=jQuery(this).find(".btn-delete-product").attr("data_id");if(typeof check_data!="undefined"){arr_delete.push(check_data)}});jQuery(".selected-data-product").text(arr_delete.length+" Data Terpilih");return arr_delete}function sel_un_all_product(type){if(type=="select"){jQuery(".az-table#product tbody tr").addClass("selected")}else{jQuery(".az-table#product tbody tr").removeClass("selected")}init_selected_table_product()}generate_table_transaction();function generate_table_transaction(){var total_column=[];var column=jQuery("#transaction thead tr:eq(0) th").length;for(var i=0;i<column;i++){total_column.push(null)}jQuery("#transaction").dataTable({"bServerSide":true,"sAjaxSource":app_url+'transaction/get/?tgc=',"bFilter":true,"bProcessing":true,"bLengthChange":true,"bSort":true,"bSortCellsTop":true,"dom":'<"row"<"col-sm-6 col-sm-offset-6">> <"row"<"col-sm-12"tr>><"row"<"col-sm-5"><"col-sm-7"p>><"row"<"col-sm-12"i>>',"bAutoWidth":false,"bPaginate":false,"bInfo":false,"lengthMenu":[[10,25,50,100,200,300,500],[10,25,50,100,200,300,500]],"aoColumns":total_column,"columnDefs":[{"targets":"no-sort","orderable":false,"order":[]}],"fnServerParams":function(aoData){jQuery(".form-filter").each(function(){var id_filter=jQuery(this).attr("data-filter");var clear_id_filter=id_filter.substring(2);aoData.push({"name":"cfilter["+clear_id_filter+"]","value":jQuery(this).val()})});jQuery(".form-top-filter-transaction .element-top-filter").each(function(){var id_filter=jQuery(this).attr("data-id");var value_filter=jQuery(this).val();var con_value="";jQuery(this).find(".con-element-top-filter").each(function(){var pre="";if(con_value!=""){pre="~az~"}con_value+=pre+jQuery(this).val()});if(con_value!=""){value_filter=con_value}aoData.push({"name":"topfilter["+id_filter+"]","value":value_filter})})},})}var callback_edit_transaction=function(response){};jQuery("body").on("click",".btn-edit-transaction",function(){var id=jQuery(this).attr("data_id");edit(app_url+'transaction/edit',id,"form","transaction",callback_edit_transaction)});var callback_delete_transaction=function(response){jQuery(".transaction-price").html(response.final_price)};jQuery("body").on("click",".btn-delete-transaction",function(){var id=jQuery(this).attr("data_id");remove(app_url+'transaction/delete',id,"transaction",callback_delete_transaction)});var callback_save_transaction=function(response){jQuery(".transaction-price").html(response.final_price)};var data_save_transaction={};jQuery("body").on("click",".btn-save-transaction",function(){save(app_url+'transaction/save',"form","transaction",callback_save_transaction,data_save_transaction)});jQuery("body").on("click",".btn-add-transaction",function(){clear();jQuery(".modal-title span").text("Add");show_modal("transaction")});jQuery("#btn_filter_transaction").click(function(){var dtable=$("#transaction").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery("#btn_top_filter_transaction").click(function(){var dtable=$("#transaction").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery(document).on("click",".az-table#transaction tbody tr td",function(event){var btn=jQuery(this).find("button");if(btn.length==0){var selected=check_table_transaction();init_selected_table_transaction()}});jQuery(".btn-select-all-transaction").on("click",function(){sel_un_all_transaction("select")});jQuery(".btn-unselect-all-transaction").on("click",function(){sel_un_all_transaction("unselect")});jQuery(".az-table#transaction").on("draw.dt",function(){init_selected_table_transaction()});jQuery(document).on("hidden.bs.modal",".modal",function(){sel_un_all_transaction()});jQuery(".btn-delete-selected-transaction").on("click",function(){var id_delete=check_table_transaction();remove(app_url+'transaction/delete',id_delete,"transaction",callback_delete_transaction)});jQuery(".form-top-filter-hide-transaction").on("click",function(){jQuery(".form-top-filter-body-transaction").slideToggle("fast");jQuery(this).find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up")});jQuery("#transaction_filter input").attr("placeholder","");function init_selected_table_transaction(){var selected=check_table_transaction();var btn_hide=jQuery(".btn-select-all-transaction, .btn-unselect-all-transaction, .btn-delete-selected-transaction, .selected-data-transaction");if(selected.length>0){btn_hide.show()}else{btn_hide.hide()}}function check_table_transaction(){var table_select=jQuery(".az-table#transaction tbody tr.selected");var arr_delete=[];table_select.each(function(){var check_data=jQuery(this).find(".btn-delete-transaction").attr("data_id");if(typeof check_data!="undefined"){arr_delete.push(check_data)}});jQuery(".selected-data-transaction").text(arr_delete.length+" Data Terpilih");return arr_delete}function sel_un_all_transaction(type){if(type=="select"){jQuery(".az-table#transaction tbody tr").addClass("selected")}else{jQuery(".az-table#transaction tbody tr").removeClass("selected")}init_selected_table_transaction()}jQuery("#idcustomer").select2({placeholder:"~ Choose Customer ~",allowClear:true,minimumInputLength:0,ajax:{url:"http://ido.awanesia.com/index.php/customer/get_data",dataType:"json",delay:250,data:function(params){return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}},cache:true}});});</script>
