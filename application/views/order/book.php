<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header"><?php echo @$title; ?></h3>
    </div>
    <div id="main-wrapper">
        <!-- <div class="row"> -->
            <?php echo $this->session->flashdata('message_system'); ?> 
            <form action="<?php echo site_url('order/prosesbook/') ?>" method="POST" target="_blank">
                <input type="hidden" name="orderdate" readonly="" value="<?php echo date('d F Y'); ?>" class="form-control">

                <div class="panel panel-primary">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td><b>Nama Project *</b></td>
                                <td colspan="2">
                                    <input type="text" name="projectname" class="form-control" width="30px" required="" value="<?php echo ($this->session->userdata('projectname')) ? $this->session->userdata('projectname') : '' ;  ?>">
                                </td>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td><b>SALES</b></td>
                                <td colspan="2">
                                    <select name="sales" class="form-control select select2">
                                        <?php foreach ($sales as $sls) { ?>
                                            <option value="<?php echo $sls['idsales'] ?>"> <?php echo $sls['namasales'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td><b>Customer</b></td>
                                <td colspan="2">
                                    <select id="idcustomer" name="idcustomer" class="form-control select select2-ajax"></select> 
                                </td>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td><b>Satuan Project</b> *</td>
                                <td>
                                    <input type="text" name="satuanproject" class="form-control" width="150px" required="" onkeyup="this.value=this.value.toUpperCase()" value="">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Qty</b></td>
                                <td><input type="text" name="qty" value="0" class="form-control format-number"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-body">
                     <table class="table table-striped">
                        <tr>
                            <td colspan="6"><b>COVER</b></td>
                        </tr>
                        <tr>
                            <td><b>Ukuran Cover *</b></td>
                            <td>
                                <div class="form-group">
                                    <?php foreach ($ukuran as $ukur) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="ukurancover" value="<?php echo $ukur['idukuran']; ?>" checked=""><?php echo $ukur['namaukuran']; ?>
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                    <?php } ?> 
                                </div>
                            </td>
                            <td><b>Mesin Cover*</b></td>
                            <td>
                                <div class="form-group">
                                    <?php foreach ($mesin as $msn) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="mesincover" value="<?php echo $msn['idmesin']; ?>" checked="">
                                            <?php echo $msn['namamesin']; ?>
                                        </label>
                                        &nbsp;&nbsp; 
                                    <?php } ?> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Cetak Cover</b></td>
                            <td>
                                <div class="form-group">
                                    <?php $no=0; foreach ($cetak as $cet) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="cetakcover" value="<?php echo $cet['idattributecetak']; ?>" <?php echo ($no==0?'checked=""':''); ?> >
                                            <?php echo $cet['attributecetak']; ?>
                                        </label> 
                                        &nbsp;&nbsp; 
                                        <?php $no++; } ?>  
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td><b>Bahan Cover</b></td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <select id="kertas" name="bahancover" required="" class="form-control select select2-ajax"></select> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Laminating Cover</b></td>
                                <td>
                                    <div class="form-group">
                                        <?php $i=0; foreach ($laminating as $lam) { ?>
                                            <label class="radio-inline">
                                                <input type="radio" name="laminatingcover" value="<?php echo $lam['idlaminating'] ?>" <?php echo ($i==0?'checked=""':''); ?> >
                                                <?php echo $lam['namalaminating']; ?>
                                            </label> 
                                            &nbsp;&nbsp; 
                                            <?php $i++; } ?>   
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Qty Cover</b></td>
                                    <td><input type="text" name="qtycover" value="0" class="form-control format-number"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <table class="table table-striped">


                                <tr>
                                    <td colspan="6"><b>ISI</b></td>
                                </tr>
                                <tr>
                                    <td><b>Banyak Halaman *</b></td>
                                    <td>
                                        <input type="text" name="banyakhalamanisi" class="form-control format-number" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Mesin *</b></td>
                                    <td>
                                        INDIGO
                                        <input type="hidden" name="mesinisi1" value="1">
                        <!-- <div class="form-group">
                            <?php foreach ($mesin as $msn) { ?>
                            <input type="radio" name="mesinisi1" value="<?php echo $msn['idmesin']; ?>" checked="">
                            <span class="labels"><?php echo $msn['namamesin']; ?></span>
                            &nbsp;&nbsp; 
                            <?php } ?>  -->
                            <!-- </div> -->
                        </td>
                        <td>Detail Halaman *</td>
                        <td>
                            <input type="text" name="detailhalaman1" class="form-control format-number" required="">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Cetak Isi *</b></td>
                        <td>
                            <div class="form-group">
                                <?php $no=0; foreach ($cetak as $cet) { ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="cetakisi" value="<?php echo $cet['idattributecetak']; ?>" <?php echo ($no==0?'checked=""':''); ?> >
                                        <?php echo $cet['attributecetak']; ?>
                                    </label>
                                    &nbsp;&nbsp; 
                                    <?php $no++; } ?> 
                                </div>
                            </td>
                            <td><b>Ukuran *</b></td>
                            <td>
                                <div class="form-group">
                                    <?php foreach ($ukuran as $ukur) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="ukurancover" value="<?php echo $ukur['idukuran']; ?>" checked="">
                                            <?php echo $ukur['namaukuran']; ?>
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                    <?php } ?> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Bahan *</b></td>
                            <td colspan="3">
                                <div class="form-group">
                                    <select id="kertasisi" name="bahanisi" class="form-control select select2-ajax"></select> 
                                </div>
                            </td>
                        </tr>

                </table>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table table-striped">
                    
                        <tr>
                            <td><b>Mesin *</b></td>
                            <td>
                                <div class="form-group">
                                    OCE
                                    <input type="hidden" name="mesinisi2" value="3" checked="">
                            <!-- <?php foreach ($mesin as $msn) { ?>
                                <input type="radio" name="mesinisi2" value="<?php echo $msn['idmesin']; ?>" checked="">
                                <span class="labels"><?php echo $msn['namamesin']; ?></span>
                                &nbsp;&nbsp; 
                                <?php } ?>  -->
                            </div>
                        </td>
                        <td>Detail Halaman *</td>
                        <td>
                            <input type="text" name="detailhalaman2" class="form-control format-number" required="">
                        </td>
                    </tr>
                 <tr>
                    <td><b>Cetak Isi *</b></td>
                    <td>
                        <div class="form-group">
                            <?php $no=0; foreach ($cetak as $cet) { ?>
                                <label class="radio-inline">
                                    <input type="radio" name="cetakisimesin" value="<?php echo $cet['idattributecetak']; ?>" <?php echo ($no==0?'checked=""':''); ?> >
                                    <?php echo $cet['attributecetak']; ?>
                                </label>
                                &nbsp;&nbsp; 
                                <?php $no++; } ?> 
                            </div>
                        </td>
                        <td><b>Ukuran *</b></td>
                        <td>
                            <div class="form-group">
                                <?php foreach ($ukuran as $ukur) { ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="ukurancover" value="<?php echo $ukur['idukuran']; ?>" checked="">
                                        <?php echo $ukur['namaukuran']; ?>
                                    </label>
                                    &nbsp;&nbsp;&nbsp;
                                <?php } ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Bahan *</b></td>
                        <td colspan="3">
                            <div class="form-group">
                                <select id="kertasisi2" name="bahanisi" class="form-control select select2-ajax"></select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Finishing *</b> </td>
                        <td colspan="4">
                            <div class="form-group"> 
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
                            </div>
                        </td>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td><b>Notes</b> (opsional)</td>
                    <td colspan="5">
                        <textarea name="notes" class="form-control"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-striped">
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
            <a href="<?php echo site_url('order') ?>" class="btn btn-default">Cancel</a>
        </div>
    </div>
    
</form>


<div class="panel panel-success">
    <div class="panel-body">

        <!-- </div> end row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="content">
                    <legend>Keranjang Order</legend>
                    <!-- cart order -->
                    <!-- <?php  echo "<pre>"; print_r($this->cart->contents()); echo "</pre>"; ?> -->
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>No</th>
                            <th colspan="3">Order </th>
                            <th>Aksi</th>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items): ?> 
                            <tr>
                                <td rowspan="22"> <?php echo $i; ?> </td>
                                <td>Nama Proyek</td>
                                <td width="1%">:</td>
                                <td>
                                    <?php echo $items['options']['projectname']; ?> 
                                </td>
                                <td rowspan="22">
                                    <a onclick="return confirm('Apakah kamu yakin ? ');" href="<?php echo site_url('order/removebook/'.$items['rowid'].'/'.@$_GET['projectname']) ?>" class="btn btn-danger btn-xs">Remove</a> 
                                </td>
                            </tr>
                            <tr>
                                <td>Sales </td>
                                <td>:</td>
                                <td>
                                    <?php echo getSales($items['options']['sales']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Order</td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['orderdate']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>:</td>
                                <td>
                                    <?php echo getCustomer($items['options']['idcustomer']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Qty </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['qty']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Cover</b></td>
                            </tr>
                            <tr>
                                <td>Ukuran Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getUkuran($items['options']['ukurancover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Mesin Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getMesin($items['options']['mesincover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Cetak Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getCetak($items['options']['cetakcover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Bahan Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getProduk($items['options']['bahancover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Laminating Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getLaminating($items['options']['laminatingcover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Qty Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['qtycover']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Isi</b></td>
                            </tr>
                            <tr>
                                <td>Cetak Isi </td>
                                <td>:</td>
                                <td>
                                    <?php echo getCetak($items['options']['cetakisi']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Banyak Halaman Isi </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['banyakhalamanisi']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Detail Halaman Isi 1 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['detailhalaman1']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Mesin Isi 1 </td>
                                <td>:</td>
                                <td>
                                    <?php echo getMesin($items['options']['mesinisi1']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Detail Halaman Isi 2 </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['detailhalaman2']; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Mesin Isi 2 </td>
                                <td>:</td>
                                <td>
                                    <?php echo getMesin($items['options']['mesinisi2']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Bahan Isi</td>
                                <td>:</td>
                                <td>
                                    <?php echo getProduk($items['options']['bahanisi']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Finishing </td>
                                <td>:</td>
                                <td>
                                    <?php foreach ($items['options']['finishing'] as $fin) {
                                        echo getFinishingSatu($fin);
                                        echo "<br>";
                                    }  ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['options']['notes']; ?> 
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?> 
                    </table>
                    <?php $disabled = ""; $link = site_url('order/previewbook?projectname='.@$_GET['projectname'].'&tipeorder='.@$_GET['tipeorder'].'&deadline='.@$_GET['deadline']); if (count($this->cart->contents()) == 0 ) { $disabled = 'disabled=""'; $link = "#"; } ?>
                    <a <?php echo $disabled; ?> href="<?php echo $link; ?>" class="btn btn-success">Proses Keranjang</a>
                </div>
            </div>
            <!-- end content -->
        </div>
    </div>
</div>
</div>
</div>
<!-- end content -->

<!-- end col-md-12 -->
<footer> </footer>
<script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('#transaction_date_1')
      .datetimepicker({format:'DD-MM-YYYY'});

  });

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
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.az-modal').on('shown.bs.modal', function () {
        jQuery('#total_cash').focus();
        jQuery("#transaction_total").val(jQuery(".transaction-price").text());
              // jQuery("#total_cash").val("");
              jQuery("#total_cash").val(thousand_separator(jQuery("#total_cash").val()));
              jQuery("#transaction_group_code").val(jQuery("#transaction_group_code_hd").val());
              calculate_payment();
              check_btn();
              // jQuery("#transaction_date").val(jQuery.format.date(Date(), "dd-MM-yyyy HH:mm:ss"));
          });

      jQuery('#total_cash, #total_discount').on("keyup", function() {
        calculate_payment();
        check_btn();
    });

      jQuery(".btn-action-save").click(function() {
        save_payment('cash');
    });

      jQuery(".btn-action-save-print").click(function() {
        save_payment('cash', 'print');
    });

      jQuery(".btn-action-save-charge").click(function() {
        if (jQuery("#idcustomer").val() == "") {
          bootbox.alert({
            title: "Error",
            message: "Field Pelanggan harus diisi untuk pembayaran tipe Hutang"
        });
      }
      else {
          save_payment('credit');
      }
  });

      jQuery("#total_cash, #total_discount").on("keyup", function(e) {
        if (e.keyCode == 13) {
          save_payment('cash');
      }
  }); 

      function calculate_payment() {
        var total_transaction = remove_separator(jQuery("#transaction_total").val());
        var total_discount = remove_separator(jQuery("#total_discount").val());
        var total_cash = remove_separator(jQuery("#total_cash").val());
        var total_change = remove_separator(jQuery("#total_change").val());
        var change = remove_separator(jQuery(".total-change-price").text());

        var final_grand_total = total_transaction - total_discount;
        jQuery(".grand-total-payment-price").text(thousand_separator(final_grand_total));

        var grand_total = remove_separator(jQuery(".grand-total-payment-price").text());
        var final_change = total_cash - grand_total;
        jQuery(".total-change-price").text(thousand_separator(final_change));
    }
    
    function save_payment(payment_type, print_nota) {
        if(!print_nota) {
          print_nota = '';
      }

      show_loading();
      jQuery.ajax({
          url: app_url+'transaction/save_payment/'+payment_type,
          data: {
            "transaction_date" : jQuery("#transaction_date").val(),
            "idcustomer" : jQuery("#idcustomer").val(),
            "total_cash" : jQuery("#total_cash").val(),
            "transaction_total" : jQuery("#transaction_total").val(), 
            "idtransaction_group" : jQuery("#idtransaction_group").val(),
            "total_discount" : jQuery("#total_discount").val(),
            "transaction_group_code" : jQuery("#transaction_group_code").val(),
            "total_change_price" : jQuery(".total-change-price").text(),
            "grand_total" : jQuery(".grand-total-payment-price").text()
        },
        dataType: 'JSON',
        type: 'POST',
        success: function(response){                
            hide_loading();
            if (response.sMessage == "") {
              bootbox.alert({
                title: "Sukses",
                message: "Transaction success",
                callback: function(brespon){
                  location.href = "http://project.awanesia.com/ido/index.php/transaction";
                  if (print_nota == 'print') {
                    window.open("http://project.awanesia.com/ido/index.php/transaction_list/print_nota/?code=8UUCuPwQytKTQkX8JHPHIZJYhAoKFcsnVIpKKBI7-9A6NqRv5EC-fUMImfiQ_eX2pHwJAlCXKbzXylqxMtTOzg%7E%7E", '_blank');
                }
            }
        });
          }
          else {
              bootbox.alert({
                title: "Error",
                message: response.sMessage
            });
          }
      },
      error:function(response){
        console.log(response);
    }
});
  }

  function check_btn() {
    if (parseInt(jQuery("#transaction_total").val()) > 0) {
      jQuery(".btn-action-save").prop("disabled", false);
      jQuery(".btn-action-save-print").prop("disabled", false);
      check_btn_charge();
  }
  else {
      jQuery(".btn-action-save").prop("disabled", true);
      jQuery(".btn-action-save-print").prop("disabled", true);
      jQuery(".btn-action-save-charge").prop("disabled", true);
  }
}

function check_btn_charge() {
    if (parseInt(jQuery(".total-change-price").text()) >= 0) {
      jQuery(".btn-action-save").prop("disabled", false);
      jQuery(".btn-action-save-print").prop("disabled", false);
      jQuery(".btn-action-save-charge").prop("disabled", true);
  }
  else {
      jQuery(".btn-action-save").prop("disabled", true);
      jQuery(".btn-action-save-print").prop("disabled", true);
      jQuery(".btn-action-save-charge").prop("disabled", false);   
  }
}

});
</script>         
<script type='text/javascript'>function show_modal(id){jQuery('.az-modal-'+id).modal({backdrop:'static',keyboard:true})}function show_loading(){jQuery(".az-loading").show()}function hide_loading(){jQuery(".az-loading").hide()}function clear(){jQuery(".az-modal form input").not(".x-hidden").val("");jQuery(".az-modal form select").each(function(index,value){if(jQuery(this).hasClass("select2-ajax")){jQuery(this).val("").trigger("change")}else{jQuery(this).val(jQuery(this).find("option:first").val()).trigger("change")}});jQuery(".az-modal form textarea").val("");var t_ckeditor=jQuery(".az-modal form .ckeditor");jQuery(t_ckeditor).each(function(){var id_ckeditor=jQuery(this).attr('id');CKEDITOR.instances[id_ckeditor].setData('')});var filter_table=jQuery(".filter-tabel select");jQuery(filter_table).each(function(){var fil=jQuery(this).attr("fil");jQuery("#"+fil).val(jQuery("#f"+fil).val())});jQuery('#l_product_name').text('-')}function edit(url,id,form,table_id,callback){show_loading();clear();$.ajax({type:"POST",url:url,data:{id:id,},success:function(response){var f_input=jQuery('#'+form+' input');var arr_ajax=[];jQuery.each(response[0],function(index,valu){jQuery('#'+index).val(valu).trigger("change");if(jQuery('#'+index).hasClass("format-number")){jQuery('#'+index).val(thousand_separator(jQuery('#'+index).val()))}var ajax_=index;if(ajax_.indexOf("ajax_")>=0){arr_ajax.push(ajax_)}});if(arr_ajax.length>0){jQuery.each(arr_ajax,function(index_arr,value_arr){var idajax=value_arr.replace("ajax_","");if(response[0][value_arr]!=null){jQuery("#"+idajax+".select2-ajax").append(new Option(response[0][value_arr],response[0][idajax],true,true)).trigger('change')}})}var t_area=jQuery("#"+form+' .ckeditor');jQuery(t_area).each(function(){var id_ckeditor=jQuery(this).attr('id');CKEDITOR.instances[id_ckeditor].setData(response[0][id_ckeditor])});hide_loading();callback(response)},error:function(response){hide_loading()},dataType:"json"});jQuery(".modal-title span").text("Edit");show_modal(table_id)};function save(url,form,vtable,callback,data){show_loading();var formdata=new FormData();var txt_ckeditor=jQuery(form+' .ckeditor');jQuery(txt_ckeditor).each(function(){var id_ckeditor=jQuery(this).attr("id");CKEDITOR.instances[id_ckeditor].updateElement()});$.each(jQuery('#'+form).serializeArray(),function(a,b){formdata.append(b.name,b.value)});if(!data){data=[]}jQuery.each(data,function(ke,va){formdata.append(ke,jQuery(va).val())});$.ajax({url:url,data:formdata,processData:false,contentType:false,type:'POST',dataType:"json",success:function(response){hide_loading();if(response.sMessage!=""){var err_response=response.sMessage;err_response=err_response.replace(/\n/g,"<br>");bootbox.alert({title:'Error',message:err_response})}else{bootbox.alert({title:"Success",message:"Save data success"});jQuery(".az-modal").modal("hide");var dtable=jQuery('#'+vtable).dataTable({bRetrieve:true});dtable.fnDraw();callback(response)}},error:function(response){console.log(response);hide_loading()}})}function remove(url,id,vtable,callback){bootbox.confirm({title:"Delete data",message:"Are you sure for delete?",callback:function(result){if(result==true){$.ajax({url:url,type:"post",dataType:"json",data:{id:id},success:function(response){if(response.err_code>0){bootbox.alert({title:"Error",message:response.err_message})}else{var dtable=jQuery('#'+vtable).dataTable({bRetrieve:true});dtable.fnDraw();callback(response)}},error:function(er){bootbox.alert({title:"Error",message:"Delete data failed "+er})}})}}})}function thousand_separator(x){if(typeof x!=='undefined'){return x.toString().replace(/\./g,'').replace(/\B(?=(\d{3})+(?!\d))/g,".")}}function remove_separator(x){if(typeof x!=='undefined'){return x.toString().replace(/\./g,'')}}csrf_token_name="csrf_azosTech";csrf_cookie_name="csrf_cookie_azosTech";jQuery(function(jQuery){var object={};object[csrf_token_name]=jQuery.cookie(csrf_cookie_name);jQuery.ajaxSetup({data:object});$(document).ajaxComplete(function(){object[csrf_token_name]=jQuery.cookie(csrf_cookie_name);jQuery.ajaxSetup({data:object});jQuery("input[name='"+csrf_token_name+"']").val(jQuery.cookie(csrf_cookie_name))})});jQuery(document).ready(function(){jQuery("select.select").select2();$.fn.modal.Constructor.prototype.enforceFocus=function(){};jQuery("body").append(jQuery(".az-modal"));jQuery('.az-modal').on('shown.bs.modal',function(){jQuery('input:text:visible:first',this).not('.x-hidden').focus()});jQuery(document).on('show.bs.modal','.modal',function(){var zIndex=1040+(10*jQuery('.modal:visible').length);$(this).css('z-index',zIndex);setTimeout(function(){jQuery('.modal-backdrop').not('.modal-stack').css('z-index',zIndex-1).addClass('modal-stack')},0)});jQuery(document).on('hidden.bs.modal','.modal',function(){jQuery('.modal:visible').length&&jQuery(document.body).addClass('modal-open')});jQuery("body").on("change",".filter-table select",function(){var table_id=jQuery(".filter-tabel").attr("tid");var dtable=jQuery('#'+table_id).dataTable({bRetrieve:true});dtable.fnDraw()});jQuery('.az-form').on('keyup keypress',function(e){var keyCode=e.keyCode||e.which;if(keyCode===13){e.preventDefault();return false}});jQuery(".format-number").on('keyup keydown',function(e){jQuery(this).val(thousand_separator(jQuery(this).val()))});jQuery(".format-number").keydown(function(e){if($.inArray(e.keyCode,[46,8,9,27,13,110,190])!==-1||(e.keyCode==65&&(e.ctrlKey===true||e.metaKey===true))||(e.keyCode>=35&&e.keyCode<=40)){return}if((e.shiftKey||(e.keyCode<48||e.keyCode>57))&&(e.keyCode<96||e.keyCode>105)){e.preventDefault()}});jQuery(document).on('click','.az-table tbody tr td',function(event){var btn=jQuery(this).find('button');if(btn.length==0){jQuery(this).parents('tr').toggleClass('selected')}})});jQuery("body").on("click",".hidden-menu-text",function(){jQuery("menu ul:eq(0)").slideToggle('fast');jQuery("menu .hidden-menu-text i").toggleClass("fa-caret-square-o-up fa-caret-square-o-down")});jQuery("body form").append('<input class="x-hidden" type="hidden" name="csrf_azosTech" value="cf43025880910e0bd9b16cbab750a5d5">');jQuery('.img-btn-language').click(function(){var lang=jQuery(this).attr('data-id');jQuery.ajax({url:app_url+'home/change_language/'+lang,success:function(respond){location.reload()},})});var selected_lang="";if(selected_lang=='indonesian'){jQuery('.img-btn-language[data-id="id"]').css('opacity',1);jQuery('.img-btn-language[data-id="en"]').css('opacity',0.5)}else{jQuery('.img-btn-language[data-id="id"]').css('opacity',0.5);jQuery('.img-btn-language[data-id="en"]').css('opacity',1)}jQuery(document).ready(function(){jQuery('#transaction_date').datetimepicker({format:'DD-MM-YYYY HH:mm:ss'});generate_table_product();function generate_table_product(){var total_column=[];var column=jQuery("#product thead tr:eq(0) th").length;for(var i=0;i<column;i++){total_column.push(null)}jQuery("#product").dataTable({"bServerSide":true,"sAjaxSource":app_url+"product/get_info","bFilter":true,"bProcessing":true,"bLengthChange":true,"bSort":true,"bSortCellsTop":true,"dom":'<"row"<"col-sm-6 col-sm-offset-6">> <"row"<"col-sm-12"tr>><"row"<"col-sm-5"l><"col-sm-7"p>><"row"<"col-sm-12"i>>',"bAutoWidth":false,"bPaginate":true,"bInfo":true,"lengthMenu":[[10,25,50,100,200,300,500],[10,25,50,100,200,300,500]],"aoColumns":total_column,"columnDefs":[{"targets":"no-sort","orderable":false,"order":[]}],"fnServerParams":function(aoData){jQuery(".form-filter").each(function(){var id_filter=jQuery(this).attr("data-filter");var clear_id_filter=id_filter.substring(2);aoData.push({"name":"cfilter["+clear_id_filter+"]","value":jQuery(this).val()})});jQuery(".form-top-filter-product .element-top-filter").each(function(){var id_filter=jQuery(this).attr("data-id");var value_filter=jQuery(this).val();var con_value="";jQuery(this).find(".con-element-top-filter").each(function(){var pre="";if(con_value!=""){pre="~az~"}con_value+=pre+jQuery(this).val()});if(con_value!=""){value_filter=con_value}aoData.push({"name":"topfilter["+id_filter+"]","value":value_filter})})},})}var callback_edit_product=function(response){};jQuery("body").on("click",".btn-edit-product",function(){var id=jQuery(this).attr("data_id");edit(app_url+'product/edit',id,"","product",callback_edit_product)});var callback_delete_product=function(response){};jQuery("body").on("click",".btn-delete-product",function(){var id=jQuery(this).attr("data_id");remove(app_url+'product/delete',id,"product",callback_delete_product)});var callback_save_product=function(response){};var data_save_product={};jQuery("body").on("click",".btn-save-product",function(){save(app_url+'product/save',"","product",callback_save_product,data_save_product)});jQuery("body").on("click",".btn-add-product",function(){clear();jQuery(".modal-title span").text("Add");show_modal("product")});jQuery("#btn_filter_product").click(function(){var dtable=$("#product").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery("#btn_top_filter_product").click(function(){var dtable=$("#product").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery(document).on("click",".az-table#product tbody tr td",function(event){var btn=jQuery(this).find("button");if(btn.length==0){var selected=check_table_product();init_selected_table_product()}});jQuery(".btn-select-all-product").on("click",function(){sel_un_all_product("select")});jQuery(".btn-unselect-all-product").on("click",function(){sel_un_all_product("unselect")});jQuery(".az-table#product").on("draw.dt",function(){init_selected_table_product()});jQuery(document).on("hidden.bs.modal",".modal",function(){sel_un_all_product()});jQuery(".btn-delete-selected-product").on("click",function(){var id_delete=check_table_product();remove(app_url+'product/delete',id_delete,"product",callback_delete_product)});jQuery(".form-top-filter-hide-product").on("click",function(){jQuery(".form-top-filter-body-product").slideToggle("fast");jQuery(this).find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up")});jQuery("#product_filter input").attr("placeholder","");function init_selected_table_product(){var selected=check_table_product();var btn_hide=jQuery(".btn-select-all-product, .btn-unselect-all-product, .btn-delete-selected-product, .selected-data-product");if(selected.length>0){btn_hide.show()}else{btn_hide.hide()}}function check_table_product(){var table_select=jQuery(".az-table#product tbody tr.selected");var arr_delete=[];table_select.each(function(){var check_data=jQuery(this).find(".btn-delete-product").attr("data_id");if(typeof check_data!="undefined"){arr_delete.push(check_data)}});jQuery(".selected-data-product").text(arr_delete.length+" Data Terpilih");return arr_delete}function sel_un_all_product(type){if(type=="select"){jQuery(".az-table#product tbody tr").addClass("selected")}else{jQuery(".az-table#product tbody tr").removeClass("selected")}init_selected_table_product()}generate_table_transaction();function generate_table_transaction(){var total_column=[];var column=jQuery("#transaction thead tr:eq(0) th").length;for(var i=0;i<column;i++){total_column.push(null)}jQuery("#transaction").dataTable({"bServerSide":true,"sAjaxSource":app_url+'transaction/get/?tgc=',"bFilter":true,"bProcessing":true,"bLengthChange":true,"bSort":true,"bSortCellsTop":true,"dom":'<"row"<"col-sm-6 col-sm-offset-6">> <"row"<"col-sm-12"tr>><"row"<"col-sm-5"><"col-sm-7"p>><"row"<"col-sm-12"i>>',"bAutoWidth":false,"bPaginate":false,"bInfo":false,"lengthMenu":[[10,25,50,100,200,300,500],[10,25,50,100,200,300,500]],"aoColumns":total_column,"columnDefs":[{"targets":"no-sort","orderable":false,"order":[]}],"fnServerParams":function(aoData){jQuery(".form-filter").each(function(){var id_filter=jQuery(this).attr("data-filter");var clear_id_filter=id_filter.substring(2);aoData.push({"name":"cfilter["+clear_id_filter+"]","value":jQuery(this).val()})});jQuery(".form-top-filter-transaction .element-top-filter").each(function(){var id_filter=jQuery(this).attr("data-id");var value_filter=jQuery(this).val();var con_value="";jQuery(this).find(".con-element-top-filter").each(function(){var pre="";if(con_value!=""){pre="~az~"}con_value+=pre+jQuery(this).val()});if(con_value!=""){value_filter=con_value}aoData.push({"name":"topfilter["+id_filter+"]","value":value_filter})})},})}var callback_edit_transaction=function(response){};jQuery("body").on("click",".btn-edit-transaction",function(){var id=jQuery(this).attr("data_id");edit(app_url+'transaction/edit',id,"form","transaction",callback_edit_transaction)});var callback_delete_transaction=function(response){jQuery(".transaction-price").html(response.final_price)};jQuery("body").on("click",".btn-delete-transaction",function(){var id=jQuery(this).attr("data_id");remove(app_url+'transaction/delete',id,"transaction",callback_delete_transaction)});var callback_save_transaction=function(response){jQuery(".transaction-price").html(response.final_price)};var data_save_transaction={};jQuery("body").on("click",".btn-save-transaction",function(){save(app_url+'transaction/save',"form","transaction",callback_save_transaction,data_save_transaction)});jQuery("body").on("click",".btn-add-transaction",function(){clear();jQuery(".modal-title span").text("Add");show_modal("transaction")});jQuery("#btn_filter_transaction").click(function(){var dtable=$("#transaction").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery("#btn_top_filter_transaction").click(function(){var dtable=$("#transaction").dataTable({bRetrieve:true});dtable.fnDraw()});jQuery(document).on("click",".az-table#transaction tbody tr td",function(event){var btn=jQuery(this).find("button");if(btn.length==0){var selected=check_table_transaction();init_selected_table_transaction()}});jQuery(".btn-select-all-transaction").on("click",function(){sel_un_all_transaction("select")});jQuery(".btn-unselect-all-transaction").on("click",function(){sel_un_all_transaction("unselect")});jQuery(".az-table#transaction").on("draw.dt",function(){init_selected_table_transaction()});jQuery(document).on("hidden.bs.modal",".modal",function(){sel_un_all_transaction()});jQuery(".btn-delete-selected-transaction").on("click",function(){var id_delete=check_table_transaction();remove(app_url+'transaction/delete',id_delete,"transaction",callback_delete_transaction)});jQuery(".form-top-filter-hide-transaction").on("click",function(){jQuery(".form-top-filter-body-transaction").slideToggle("fast");jQuery(this).find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up")});jQuery("#transaction_filter input").attr("placeholder","");function init_selected_table_transaction(){var selected=check_table_transaction();var btn_hide=jQuery(".btn-select-all-transaction, .btn-unselect-all-transaction, .btn-delete-selected-transaction, .selected-data-transaction");if(selected.length>0){btn_hide.show()}else{btn_hide.hide()}}function check_table_transaction(){var table_select=jQuery(".az-table#transaction tbody tr.selected");var arr_delete=[];table_select.each(function(){var check_data=jQuery(this).find(".btn-delete-transaction").attr("data_id");if(typeof check_data!="undefined"){arr_delete.push(check_data)}});jQuery(".selected-data-transaction").text(arr_delete.length+" Data Terpilih");return arr_delete}function sel_un_all_transaction(type){if(type=="select"){jQuery(".az-table#transaction tbody tr").addClass("selected")}else{jQuery(".az-table#transaction tbody tr").removeClass("selected")}init_selected_table_transaction()}
    jQuery("#idcustomer").select2({
      placeholder:"~ Pilih Customer ~",
      allowClear:true,
      minimumInputLength:0,
      ajax:{url:"<?php echo site_url('customer/get_data')?>",
      dataType:"json",delay:250,data:function(params){return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
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
    
    jQuery("#kertasisi").select2({placeholder:"~ Pilih Kertas ~",
      allowClear:true,minimumInputLength:0,
      required:"",
      ajax:{
        url:"<?php echo site_url('json/product')?>",
        dataType:"json",
        delay:250,
        data:function(params){
          return{
            term:params.term,
            page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
    
    jQuery("#kertasisi2").select2({placeholder:"~ Pilih Kertas ~",
      allowClear:true,minimumInputLength:0,
      required:"",
      ajax:{
        url:"<?php echo site_url('json/product')?>",
        dataType:"json",
        delay:250,
        data:function(params){
          return{
            term:params.term,
            page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
    
});




</script>
