<div class="col-sm-12">
    <div class="content">
        <div class="panel panel-primary">
            <div class="panel-body">
                <legend>Detail Work Order <?=$order['projectname']?></legend>
                <div class="panel panel-success">
                    <div class="panel-body">
                        <?php //print_r($order); ?>
                        <table class="table table-hover table-bordered">
                            <tr>
                                <td>Nama Customer</td>
                                <td><?php echo getCustomer($order['customerid']); ?></td>
                            </tr>
                            <tr>
                                <td>Tipe Order</td>
                                <td><?php echo $order['tipeorder']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Project</td>
                                <td>
                                    <?php echo $order['projectname']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Order</td>
                                <td>
                                    <?php echo date('d F Y, H:i:s', strtotime($order['tglorder'])); ?> WIB
                                </td>
                            </tr>
                            <tr>
                                <td>Deadline</td>
                                <td>
                                    <?php echo date('d F Y', strtotime($order['deadline'])); ?> WIB
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-body">
                        <table class="table table-hover table-bordered">
                        <table class="table table-bordered">
                            <tr>
                                <th>Satuan Project</th>
                                <th>Customer</th>
                                <th>Qty</th>
                                <th>Cetak</th>
                                <th>Kertas</th>
                                <th>Laminating</th>
                                <th>Finishing 1</th>
                                <th>Finishing 2</th>
                                <th>Notes</th>
                            </tr>
                            <?php $i = 1; ?> 
                            <?php foreach ($detail_order as $key => $value): ?> 
                            <tr>
                                <td><?php echo $value['satuanproject']; ?></td>
                                <td><?php echo getCustomer($value['customerid']); ?></td>
                                <td><?php echo $value['qty']; ?></td>
                                <td><?php echo getCetak($value['cetak']); ?></td>
                                <td><?php echo getProduk($value['kertas']); ?></td>
                                <td><?php echo getLaminating($value['laminating']); ?></td>
                                <td>
                                    <?php if (@$value['finishing1']): ?>
                                        <?php echo finishingsatu(@$value['finishing1'])   ?>
                                    <?php endif ?>    
                                </td>
                                <td><?php echo @$value['finishing2']; ?></td>
                                <td><?php echo $value['notes']; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?> 
                        </table>
                        <a href="<?php echo site_url('work_order'); ?>" class="btn btn-default">Kembali</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div> <!-- end row -->
