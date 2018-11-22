<!-- Page Container -->
<div class="page-container">
	<!-- Page Sidebar -->
	<div class="page-sidebar">
		<a class="logo-box" href="index.html">
			<span>Ido Printing</span>
			<i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
			<i class="icon-close" id="sidebar-toggle-button-close"></i>
		</a>
		<div class="page-sidebar-inner">
			<div class="page-sidebar-menu">
				<ul class="accordion-menu">
					<li class="active-page">
						<a href="index.html">
							<i class="menu-icon icon-home4"></i><span>Dashboard</span>
						</a>
					</li> 
					<li class="open">
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-file active"></i><span>Order</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu" style="display: block;">
							<li class="animation active"><a href="<?php echo site_url('order/card/') ?>">Kartu Nama</a></li>
							<li class="animation"><a href="<?php echo site_url('order/book/') ?>">Buku</a></li> 
							<li class="animation"><a href="<?php echo site_url('order/pod/') ?>">POD</a></li> 
							<li class="animation"><a href="<?php echo site_url('order/okl/') ?>">OKL</a></li> 
						</ul>
					</li>

					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-usd"></i><span>Pembayaran</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="<?php echo site_url('pembayaran') ?>">List Pembayaran</a></li>
							<li><a href="<?php echo site_url('pembayaran/dp/') ?>">Bayar Down Payment</a></li> 
							<li><a href="<?php echo site_url('pembayaran/card/') ?>">Bayar Pelunasan</a></li>  
						</ul>
					</li>


					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-user"></i><span>Pelanggan</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-alerts.html">List Pembayaran</a></li>
							<li><a href="ui-buttons.html">Bayar Down Payment</a></li> 
							<li><a href="ui-buttons.html">Bayar Pelunasan</a></li>  
						</ul>
					</li>

					<li>
						<a href="<?php echo site_url('transaksi') ?>">
							<i class="menu-icon fa fa-list"></i><span>Transaksi</span>
						</a>
					</li>


					<li>
						<a href="index.html">
							<i class="menu-icon fa fa-navicon"></i><span>Invoice</span>
						</a>
					</li>


					<li>
						<a href="index.html">
							<i class="menu-icon fa fa-address-book-o"></i><span>Supplier</span>
						</a>
					</li>

					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-th"></i><span>Produk</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-alerts.html">Kategori Produk</a></li>
							<li><a href="ui-buttons.html">Unit Produk</a></li>  
							<li><a href="ui-buttons.html">Data Produk</a></li>  
						</ul>  
					</li>

					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-database"></i><span>Stock</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-alerts.html">Stock Masuk</a></li>
							<li><a href="ui-buttons.html">Stock Keluar</a></li>  
						</ul> 
					</li>

					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-print"></i><span>Laporan</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-alerts.html">Laporan Penjualan</a></li>
							<li><a href="ui-buttons.html">Laporan Stok Masuk</a></li>  
							<li><a href="ui-buttons.html">Laporan Stok Keluar</a></li>  
						</ul>  
					</li>

					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-user"></i><span>Pengaturan</span><i class="accordion-icon fa fa-angle-left"></i>
						</a>
						<ul class="sub-menu">
							<li><a href="ui-alerts.html">Manajemen Pengguna</a></li>
							<li><a href="ui-buttons.html">Pengaturan Sistem</a></li>  
						</ul>
					</li> 

				</ul>
			</div>
		</div>
	</div><!-- /Page Sidebar -->

	<!-- Page Content -->
	<div class="page-content">
		<!-- Page Header -->
		<div class="page-header"> 
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<div class="logo-sm">
							<a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
							<a class="logo-box" href="index.html"><span>Space</span></a>
						</div>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
							<li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
							<!-- <li><a href="javascript:void(0)" id="search-button"><i class="fa fa-search"></i></a></li> -->
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<!-- <li><a href="javascript:void(0)" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><i class="fa fa-envelope"></i></a></li>  -->
							<li class="dropdown user-dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<?php echo @$sesi['name']; ?>
									<img src="http://steelcoders.com/space/demo/theme/assets/images/avatars/avatar1.jpg" alt="" class="img-circle"></a>
								<ul class="dropdown-menu">
									<li><a href="#">Profile</a></li>
									<li><a href="#">Calendar</a></li>
									<li><a href="#"><span class="badge pull-right badge-danger">42</span>Messages</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">Account Settings</a></li>
									<li><a href="#">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div><!-- /Page Header -->
