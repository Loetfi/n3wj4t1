<div class="container-fluid">
    <div class="row">
        <hr>
        <div class="col-sm-12">
            <div class="content">
                <?php echo $this->session->flashdata('message_system'); ?>
                <legend>DETAIL PEMBAYARAN</legend>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <!-- <div class="panel-heading"> -->
                                <h3 class="panel-title">
                                    <center>PEMBAYARAN</center>
                                </h3>
                            <!-- </div> -->
                            <div class="panel-body">
                                <table class="table ">
                                    <tr>
                                        <th>tipebayar</th>
                                        <th>:</th>
                                        <td><?php echo $pembayaran['tipebayar']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>carabayar</th>
                                        <th>:</th>
                                        <td><?php echo $pembayaran['carabayar']; ?><br><?php echo $pembayaran['codekhusus']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>nominal</th>
                                        <th>:</th>
                                        <td><?php echo number_format($pembayaran['nominal'],2); ?></td>
                                    </tr>
                                    <tr>
                                        <th>tglbayar</th>
                                        <th>:</th>
                                        <td><?php echo $pembayaran['tglbayar']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>keterangan</th>
                                        <th>:</th>
                                        <td><?php echo $pembayaran['keterangan']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <!-- <div class="panel-heading"> -->
                                <h3 class="panel-title">
                                    <center>CUSTOMER</center>
                                </h3>
                            <!-- </div> -->
                            <div class="panel-body">
                                <table class="table ">
                                    <tr>
                                        <th>name</th>
                                        <th>:</th>
                                        <td><?php echo $detailCustomer['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>gender</th>
                                        <th>:</th>
                                        <td><?php echo $detailCustomer['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>phone</th>
                                        <th>:</th>
                                        <td><?php echo $detailCustomer['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>address</th>
                                        <th>:</th>
                                        <td><?php echo $detailCustomer['address']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <!-- <div class="panel-heading"> -->
                                <h3 class="panel-title">
                                    <center>RINCIAN PEMBAYARAN</center>
                                </h3>
                            <!-- </div> -->
                            <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Inv</th>
                                            <th>Project Name</th>
                                            <th>Tgl Order</th>
                                            <th>Tipe Order</th>
                                            <th>Nominal Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=0; foreach($pembayarandetail as $row){ ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo @$row['phone']; ?></td>
                                            <td><?php echo @$row['projectname']; ?></td>
                                            <td><?php echo @$row['tglorder']; ?></td>
                                            <td><?php echo @$row['tipeorder']; ?></td>
                                            <td><?php echo number_format($row['nominalpembayaran'],2); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>