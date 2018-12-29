    
<div class="col-sm-12">
    <div class="content">   
        <?php echo $this->session->flashdata('message_system'); ?>

        <div class="panel panel-primary">
            <div class="panel-body">
                <legend><?php echo $title; ?></legend>

                <?php $okl = $this->session->userdata('cardheader'); ?>
                <div class="panel panel-success">
                    <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <td>Nama Customer</td>
                                <td><?php echo getCustomer($okl['customerid']); ?></td>
                            </tr>
                            <tr>
                                <td>Tipe Order</td>
                                <td><?php echo $okl['tipeorder']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Project</td>
                                <td>
                                    <?php echo $okl['projectname']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Order</td>
                                <td>
                                    <?php echo date('d F Y, H:i:s', strtotime($okl['tglorder'])); ?>
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

                            <?php foreach ($this->cart->contents() as $items): ?> 

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
                            <td><?php echo @$items['options']['0']['finishing2']; ?></td>
                            <td><?php echo $items['options']['0']['notes']; ?></td>

                        </tr>

                        <?php $i++; ?>

                    <?php endforeach; ?> 

                </table>    

                <a href="<?php echo site_url('order/saveokl?projectname='.@$_GET['projectname'].'&tipeorder='.@$_GET['tipeorder'].'&deadline='.@$_GET['deadline']); ?>" class="btn btn-primary">Proses Orderan</a>
                <a href="<?php echo site_url('order/okl'); ?>" class="btn btn-default">Cancel</a>

            </div></div>
            <br>
        </div>
    </div>
</div> 
</div>
</div>

</div> <!-- end row -->


