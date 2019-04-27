    
<div class="col-sm-12">
    <div class="content">   
        <?php echo $this->session->flashdata('message_system'); ?>

        <div class="panel panel-primary">
            <div class="panel-body">
                <legend><?php echo $title; ?></legend>

                <?php $pod = $this->session->userdata('cardheader'); ?>
                <div class="panel panel-success">
                    <div class="panel-body">
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
                    </div>
                </div>
                <div class="panel panel-success">
                <div class="panel-body">
                     
                     <table class="table table-bordered table-hover">
                        <tr>
                            <th>No</th>
                            <th colspan="3">Order </th>
                        </tr>
                        <?php $i = 1; ?> 
                        <?php foreach ($this->cart->contents() as $items): ?> 
                             <tr>
                                <td rowspan="24"> <?php echo $i; ?> </td>
                                <td>Nama Proyek</td>
                                <td width="1%">:</td>
                                <td>
                                    <?php echo $items['options']['projectname']; ?> 
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
                                <td>Mesin Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getMesin($items['options']['mesinisi1']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>Ukuran Cover </td>
                                <td>:</td>
                                <td>
                                    <?php echo getUkuran($items['options']['ukurancover']); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>TOTAL KERTAS = QTY/RUMUS P x L </td>
                                <td>:</td>
                                <td>
                                    <?php echo $items['total_kertas']; ?> 
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
                            <tr>
                                <td>JUMLAH KERTAS A3</td>
                                <td>:</td>
                                <td>
                                    <?php
                                        $a = array();
                                        $b = array();
                                        $a[] = ['29.7','42.0']; // ukuran A3; 
                                        $b[] = getArrUkuran($items['options']['mesinisi1']); 
                                        // dd($b);
                                        $hasil = nilai_ukuran($a, $b);

                                        for ($i=0; $i<sizeof($hasil); $i++) {
                                            $jumlahnya =  round($hasil[$i][0],0) * round($hasil[$i][1],0);
                                        }
                                        echo ceil($items['options']['qty']/@$jumlahnya);
                                    ?> 
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?> 
                    </table>

                <a href="<?php echo site_url('order/savebook?projectname='.@$_GET['projectname'].'&tipeorder='.@$_GET['tipeorder'].'&deadline='.@$_GET['deadline']); ?>" class="btn btn-primary">Proses Orderan</a>
                <a href="<?php echo site_url('order/card'); ?>" class="btn btn-default">Cancel</a>

            </div></div>
            <br>
        </div>
    </div>
</div> 
</div>
</div>

</div> <!-- end row -->


