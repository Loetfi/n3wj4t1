<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<!-- Load paper.css for happy printing -->
<link rel="stylesheet" href="dist/paper.css">

<!-- Set page size here: A5, A4 or A3 -->
<!-- Set also "landscape" if you need -->
<style>@page { size: A6 };
body {font-family: "Times New Roman", Times, serif;}
body { font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } h3 { font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px; } p { font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px; } blockquote { font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; } pre { font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5667px; }
table {
  border-collapse: collapse;
}

td, th {
  border: 1px solid black;
  padding: 3px;
}

</style> 

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A6">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <!-- Write HTML just like a web page -->
    <div class="col-sm-12">
      <div class="content">
        <div class="panel panel-primary">
          <div class="panel-body">
            <p><b>Detail Work Order <?=$order['projectname']?></b></p>
            <p>Nomor Order : # <?php echo $order['trorderid']; ?></p>
            
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
                    <td><b><?php echo $order['tipeorder']; ?></b></td>
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
            <br>

            <?php $i = 1; ?> 
            <?php foreach ($detail_order as $key => $value): ?> 

              <table class="table table-bordered"> 
                <tr>
                  <td rowspan="8"><?php echo $i; ?></td>
                </tr>
                 <tr>
                  <td>Satuan Project</td>
                  <td>:</td>
                  <td><?php echo $value['satuanproject']; ?></td>
                </tr>
                <tr>
                  <td>Qty</td>
                  <td>:</td>
                  <td><?php echo $value['qty']; ?></td>
                </tr>
                <tr>
                  <td>Cetak</td>
                  <td>:</td>
                  <td><?php echo getCetak($value['cetak']); ?></td>
                </tr>
                <tr>
                  <td>Kertas</td>
                  <td>:</td>
                  <td><?php echo getProduk($value['kertas']); ?></td>
                </tr>
                <tr>
                  <td>Laminating</td>
                  <td>:</td>
                  <td><?php echo getLaminating($value['laminating']); ?></td>
                </tr>
                <tr>
                  <td>Finishing 1</td>
                  <td>:</td>
                  <td>
                    <?php if (@$value['finishing1']): ?>
                      <?php echo finishingsatu(@$value['finishing1']);?>
                      <br>
                    <?php endif ?>    
                  </td>
                </tr>
                <tr>
                  <td>Notes</td>
                  <td>:</td>
                  <td><?php echo $value['notes']; ?></td>
                </tr> 

              </table>

              <?php $i++; ?>
            <?php endforeach; ?>  
        </div>
        <br>
      </div>
    </div>
  </div> 

  </section>

</body>


<body class="A6">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <div class="col-sm-12">
      <div class="content">
        <div class="panel panel-primary">
          <div class="panel-body">
            <p><b>Detail Work Order <?=$order['projectname']?></b></p>
            <p>Nomor Order : # <?php echo $order['trorderid']; ?></p>
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
                    <td><b><?php echo $order['tipeorder']; ?></b></td>
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
            <br>

            <?php $i = 1; ?> 
            <?php foreach ($detail_order as $key => $value): ?> 

              <table class="table table-bordered"> 
                <tr>
                  <td rowspan="8"><?php echo $i; ?></td>
                </tr>
                 <tr>
                  <td>Satuan Project</td>
                  <td>:</td>
                  <td><?php echo $value['satuanproject']; ?></td>
                </tr>
                <tr>
                  <td>Qty</td>
                  <td>:</td>
                  <td><?php echo $value['qty']; ?></td>
                </tr>
                <tr>
                  <td>Cetak</td>
                  <td>:</td>
                  <td><?php echo getCetak($value['cetak']); ?></td>
                </tr>
                <tr>
                  <td>Kertas</td>
                  <td>:</td>
                  <td><?php echo getProduk($value['kertas']); ?></td>
                </tr>
                <tr>
                  <td>Laminating</td>
                  <td>:</td>
                  <td><?php echo getLaminating($value['laminating']); ?></td>
                </tr>
                <tr>
                  <td>Finishing 1</td>
                  <td>:</td>
                  <td>
                    <?php if (@$value['finishing1']): ?>
                      <?php echo finishingsatu(@$value['finishing1']);?>
                      <br>
                    <?php endif ?>    
                  </td>
                </tr>
                <tr>
                  <td>Notes</td>
                  <td>:</td>
                  <td><?php echo $value['notes']; ?></td>
                </tr> 

              </table>

              <?php $i++; ?>
            <?php endforeach; ?>  
        </div>
        <br>
      </div>
    </div>
  </div> 


<table>
 <tr>
  <td>OCE
   <br>
   <br>
   <br>
   <br>
   _________________
 </td>
 <td>Indigo
   <br>
   <br>
   <br>
   <br>
   _________________
 </td>
 <td>Finishing
   <br>
   <br>
   <br>
   <br>
   _________________
 </td>
 <td>Manager
   <br>
   <br>
   <br>
   <br>
   _________________
 </td>

</tr>

</table>
</section>

</body>
