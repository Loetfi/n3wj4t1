<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header"><?php echo @$title; ?></h3>
    </div>
    <div id="main-wrapper">
        <?php echo $this->session->flashdata('message_system'); ?>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form action="<?php echo site_url('order/prosescard?projectname='.@urlencode($_POST['projectname']).'&tipeorder='.@$_POST['tipeorder'].'&deadline='.@$_POST['deadline']) ?>" method="POST">
                    <!-- tipe order -->
                    <input type="hidden" name="tipeorder" value="card">


                    <!-- end --> 
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td><b>Nama Project</b> *</td>
                            <td>
                                <input type="text" name="projectname" class="form-control" width="30px" required="" onkeyup="this.value=this.value.toUpperCase()" value="<?php echo ($this->session->userdata('projectname')) ? $this->session->userdata('projectname') : '' ;  ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>SALES</b></td>
                            <td>
                                <select name="sales" class="form-control select">
                                    <?php foreach ($sales as $sls) { ?>
                                        <option value="<?php echo $sls['idsales'] ?>"> <?php echo $sls['namasales'] ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="200px"><b>Customer</b> * </td>
                            <td colspan="4">
                                <select id="idcustomer" name="idcustomer" class="form-control select select2-ajax"></select> 
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><input type="text" name="orderdate" readonly="" value="<?php echo date('d F Y, H:i:s'); ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><b>Satuan Project</b> *</td>
                            <td>
                                <input type="text" name="satuanproject" class="form-control" width="150px" required="" onkeyup="this.value=this.value.toUpperCase()" value=""> EX : BAHAN DIGITAL
                            </td>
                        </tr>
                        <tr>
                            <td><b>Qty</b></td>
                            <td><input type="text" name="qty" value="" class="form-control format-number"></td>
                        </tr>
                        <tr>
                            <td><b>Cetak</b> * </td>
                            <td>
                                <div class="form-group"> 
                                    <?php $no=0; foreach ($cetak as $cet) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="cetak" value="<?php echo $cet['idattributecetak']; ?>" <?php echo ($no==0?'checked=""':''); ?> >
                                            <?php echo $cet['attributecetak']; ?>
                                        </label>
                                        &nbsp;&nbsp; 
                                        <?php $no++; } ?> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Kertas</b> *</td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <select id="kertas" name="productid" required="" class="form-control select select2-ajax"></select> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Laminating</b></td>
                                <td>
                                    <div class="form-group">
                                        <?php $i=0; foreach ($laminating as $lam) { ?>
                                            <label class="radio-inline"> 
                                                <input type="radio" name="laminating" value="<?php echo $lam['idlaminating'] ?>" <?php echo ($i==0?'checked=""':''); ?> >
                                                <?php echo $lam['namalaminating']; ?>
                                            </label>
                                            &nbsp;&nbsp; 
                                            <?php $i++; } ?>  
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Finishing 1</b> </td>
                                    <td>
                                        <div class="row">

                                            <?php 
                                            foreach ($finishing as $fin) {
                                                if (($fin['idfinishing'] % 2) == 1)
                                                { 
                                                    echo '<div class="col-sm-6">';
                                                    echo '<input type="checkbox" name="finishing[]" value="'.$fin['idfinishing'].'">'.$fin['namafinishing'] ;
                                                    echo '</div>';
                                                }

                                                if (($fin['idfinishing'] % 2) == 0)
                                                { 
                                                    echo '<div class="col-sm-6">';
                                                    echo '<input type="checkbox" name="finishing[]" value="'.$fin['idfinishing'].'">'.$fin['namafinishing'] ;
                                                    echo '</div>';
                                                }
                                          }
                                          ?>
                                          <?php //foreach ($finishing as $fin) { ?>
                                            <!-- <input type="checkbox" name="finishing[]" value="<?php echo $fin['idfinishing']; ?>"> <?php echo $fin['namafinishing']; ?>  -->
                                            <?php //} ?>     
                                        </div>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Notes</b> (opsional) </td>
                                <td colspan="5">
                                    <textarea name="notes" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><font color="red"> Deadline </font></td>
                                <td>
                                    <div class="input-group az-datetime" >
                                        <input type="text" class="form-control con-element-top-filter" id="transaction_date_1" name="deadline" value="<?php echo (isset($_GET['deadline'])) ? @$_GET['deadline'] : date('d-m-Y') ;?>"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <button class="btn btn-primary">Tambah Keranjang</button>
                        <a href="<?php echo site_url('order/card?reset=y') ?>" onclick="return confirm('Cancel Order dapat mereset order page ini');" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-body">

                    <legend>Keranjang Order</legend>
                    <table class="table table-bordered">
                        <tr>
                            <th>Satuan Project</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Cetak</th>
                            <th>Kertas</th>
                            <th>Laminating</th>
                            <th>Finishing 1</th>
                            <!-- <th>Finishing 2</th> -->
                            <th>Notes</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $i = 1; ?> 
                        <?php foreach ($this->cart->contents() as $items){ ?> 
                            <tr>
                                <td><?php echo $items['options']['0']['satuanproject']; ?></td>
                                <td><?php echo getCustomer($items['options']['0']['idcustomer']); ?></td>
                                <td><?php echo $items['options']['0']['qty']; ?></td>
                                <td><?php echo getCetak($items['options']['0']['cetak']); ?></td>
                                <td><?php echo getProduk($items['options']['0']['productid']); ?></td>
                                <td><?php echo getLaminating($items['options']['0']['laminating']); ?></td>
                <td><?php //echo implode(',', $items['options']['0']['finishing']);
                if (count(@$items['options']['0']['finishing']) > 0)

                    foreach ($items['options']['0']['finishing'] as $fin) {
                        echo getFinishingSatu($fin);
                        echo "<br>";
                    }  ?></td>
                    <!-- <td><?php echo @$items['options']['0']['finishing2']; ?></td> -->
                    <td><?php echo $items['options']['0']['notes']; ?></td>
                    <td>
                        <a onclick="return confirm('Apakah kamu yakin ? ');" href="<?php echo site_url('order/remove/'.$items['rowid'].'/'.@$_GET['projectname']) ?>" class="btn btn-danger btn-xs">Remove</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php } ?> 
        </table>
        <?php $disabled = ""; $link = site_url('order/previewcard?projectname='.@$_GET['projectname'].'&tipeorder='.@$_GET['tipeorder'].'&deadline='.@$_GET['deadline']); if (count($this->cart->contents()) == 0 ) { $disabled = 'disabled=""'; $link = "#"; } ?>
        <a <?php echo $disabled; ?> href="<?php echo $link; ?>" class="btn btn-success">Proses Keranjang</a>
    </div>
</div>
</div>
<!-- Main Wrapper -->
</div>
<!-- /Page Inner -->
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#transaction_date_1')
        .datetimepicker({format:'DD-MM-YYYY'});

    });
    
    // jQuery('#transaction_date_2').datetimepicker({format:'DD-MM-YYYY'});

    jQuery("#kertas").select2(
    {
      placeholder:"~ Pilih Kertas ~",
      required:"",
      allowClear:true,minimumInputLength:0,
      ajax:{
        url:"<?php echo site_url('json/product')?>",
        dataType:"json",
        delay:250,
        data:function(params){
          return{
            term:params.term,
            page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
    
    
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

        jQuery("#idcustomer").select2({
          placeholder:"~ Pilih Customer ~",
          allowClear:true,
          minimumInputLength:0,
          ajax:{url:"<?php echo site_url('customer/get_data')?>",
          dataType:"json",delay:250,data:function(params){return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}},cache:true}});

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
                        location.href = "http://project.awanesia.com/ido/index.php/transaction";
                    }
                },
                error:function(response){
                    console.log(response);
                }
            });
        }

    });
</script> 

