<div class="container-fluid">
    <div class="row">
        <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-<?= $this->session->flashdata('type') ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('message') ?>
        </div>
        <?php endif ?>
        <div class="col-sm-12">
            <div class="content">
                <h4>Laporan Penjualan</h4>
                <hr>
                <div class="form-top-filter form-top-filter-transaction_list">
                    <div class="form-top-filter-body-transaction_list">
                        <form class="form-horizontal az-form" id="myForm" name="form" method="get" action="<?= site_url('laporan/lists/filter') ?>">
                            
                            <label for="" class="col-sm-1 control-label">Date</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="input-group az-datetime" >
                                            <input type="text" class="form-control con-element-top-filter" id="transaction_date_1" name="transaction_date_1" value=""/> 
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 div-between-col">
                                        s/d
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group az-datetime" >
                                            <input type="text" class="form-control con-element-top-filter" id="transaction_date_2" name="transaction_date_2" value=""/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="" class="col-sm-1 control-label">Customer</label>
                            <div class="col-sm-3">
                                <select id="idcustomer" name="idcustomer" class="form-control select select2-ajax element-top-filter">
                                </select>
                            </div>
                            <!-- 
                                <div class="form-group">
                                    <label for="" class="col-sm-1 control-label">Nota</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control element-top-filter" name="transaction_group_code" id="transaction_group_code" data-id="dvkd2HHO6/1+C+yXOKA7sx/NI4bs97h6SOlII9LYEzRC8IpjzdD6E2YcxcOhEK0Cepf6OkNtTcVaMm14ZpXpKg=="/>
                                    </div>
                                    <label for="" class="col-sm-1 control-label">Cashier</label>
                                    <div class="col-sm-3">
                                
                                        <select id="idkasir" name="idkasir" data-id='2w6VIJ78koYyU2Pr5jU0qBNc0MG2xmmx7JTrzT/JS1LuLC/nRBnqXLrIlTdlyjcovRQLiXcIHduG6j4+qcVJIg==' class="form-control select select2-ajax element-top-filter">
                                        </select>
                                    </div>
                                </div> -->
                            <div>
                                <button type="submit" class="btn btn-info" id="btn-filter" type="button"><i class="fa fa-search"></i> &nbsp;Filter</button>
                            </div>
                        </form>
                    </div>
                </div>

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
    </div>
</div>

<script type="text/javascript">
    jQuery("#idcustomer").select2({
      placeholder:"~ Pilih Customer ~",
      allowClear:true,
      minimumInputLength:0,
      ajax:{url:"<?php echo site_url('customer/get_data')?>",
      dataType:"json",delay:250,data:function(params){return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
    
    jQuery("#idkasir").select2({placeholder:"~ Select Cashier ~",allowClear:true,minimumInputLength:0,ajax:{url:"http://ido.awanesia.com/index.php/user/get_data",dataType:"json",delay:250,data:function(params){return{term:params.term,page:params.page||1,parent:jQuery("#").val(),}},cache:true}});
    
    jQuery(document).ready(function(){
        jQuery('#transaction_date_1')
        .datetimepicker({format:'DD-MM-YYYY'});
    });
    
    jQuery(document).ready(function(){
        jQuery('#transaction_date_2')
        .datetimepicker({format:'DD-MM-YYYY'});
    });
</script>