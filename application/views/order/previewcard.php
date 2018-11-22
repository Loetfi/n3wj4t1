 
        <div class="col-sm-12">
            <div class="content">   
                <?php echo $this->session->flashdata('message_system'); ?>
                <legend><?php echo $title; ?></legend>

                <?php $pod = $this->session->userdata('cardheader'); ?>
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>Nama Customer</td>
                        <td><?php echo getCustomer($pod['customerid']); ?></td>
                    </tr>
                    <tr>
                        <td>Tipe Order</td>
                        <td><?php echo $pod['tipeorder']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Project</td>
                        <td>
                            <?php echo $pod['projectname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Order</td>
                        <td>
                            <?php echo date('d F Y, H:i:s', strtotime($pod['tglorder'])); ?>
                        </td>
                    </tr>
                </table> 

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

                <a href="<?php echo site_url('order/save?projectname='.@$_GET['projectname'].'&tipeorder='.@$_GET['tipeorder'].'&deadline='.@$_GET['deadline']); ?>" class="btn btn-primary">Proses</a>
                <a href="<?php echo site_url('order/card'); ?>" class="btn btn-default">Cancel</a>

                <br>
            </div> 
        </div>
    </div>

</div> <!-- end row -->

 
