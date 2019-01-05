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
                                            <input type="text" class="form-control con-element-top-filter" id="transaction_date_1" name="transaction_date_1" value="<?= set_value($_GET['transaction_date_2']) ?>"/> 
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
                                            <input type="text" class="form-control con-element-top-filter" id="transaction_date_2" name="transaction_date_2" value="<?= set_value($_GET['transaction_date_2']) ?>"/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="" class="col-sm-1 control-label">Customer</label>
                            <div class="col-sm-3">
                                <select id="idcustomer" name="idcustomer" class="form-control select select2-ajax element-top-filter" value="<?= set_value('idcustomer')?>">
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
                            <th style="width:4%">#</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Nota</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Grand Total</th>
                            <th>Cashier</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($filter as $key => $value): ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?= getCustomer($value['idcustomer']) ?></td>
                                <td><?= date_format(date_create($value['transaction_date']),'d/m/Y H:i:s') ?></td>
                                <td><?=$value['code']?></td>
                                <td>
                                    <span class="badge"><?= get_transaction($value['idtransaction_group'],'qty') ?></span> 
                                    <?= getProduk(get_transaction($value['idtransaction_group'],'idproduct')) ?>
                                </td>
                                <td><?=number_format($value['total_sell_price'])?></td>
                                <td><?=number_format($value['total_discount'])?></td>
                                <td><?=number_format($value['total_final_price'])?></td>
                                <td><?=$value['code']?></td>
                                <td>aksi</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#myTable").DataTable();

        $('#idcustomer').select2({
            width: 'resolve',
            data: <?php echo $list_customer; ?>
        });

        <?php if($this->uri->segment(3) == 'filter'): ?>
            <?php $idcustomer = isset($_GET['idcustomer']) ? $_GET['idcustomer'] : 1 ; ?>
            $('#idcustomer').val(<?=$idcustomer?>).trigger('change');
        <?php endif ?>
    })
    
    jQuery(document).ready(function(){
        jQuery('#transaction_date_1')
        .datetimepicker({format:'DD-MM-YYYY',date:"<?=date_format(date_create($_GET['transaction_date_1']), 'd-m-Y')?>"});
    });
    
    jQuery(document).ready(function(){
        jQuery('#transaction_date_2')
        .datetimepicker({format:'DD-MM-YYYY',date:"<?=date_format(date_create($_GET['transaction_date_2']), 'd-m-Y')?>"});
    });
</script>