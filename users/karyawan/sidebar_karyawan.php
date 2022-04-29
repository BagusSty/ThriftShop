<nav id="sidebar">
	<div class="sidebar-header mt-5">
		<h3>Buganishogi Thrift Shop</h3>
	</div>
	<hr>
	<ul class="list-unstyled components">
		<li>
			<a href="../../users/karyawan/beranda_karyawan.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
		</li>
		<li>
			<a href="#submenu1" data-bs-toggle="collapse"><i class="fas fa-folder"></i></i> Data Master</a>
			<ul class="collapse list-unstyled components" id="submenu1" data-bs-parent="#menu">
				<li>
					<a href="../../page/barang/data_barang.php"><i class='fas fa-tshirt'></i> Data Barang</a>
				</li>
				<li>
					<a href="../../page/kategori/data_kategori.php"><i class="fas fa-columns"></i> Data Kategori</a>
				</li>
				<li>
					<a href="../../page/supplier/data_supplier.php"><i class='fas fa-truck'></i> Data Supplier</a>
				</li>
				<li>
					<a href="../../page/barangmasuk/data_barang_masuk.php"><i class='fas fa-box'></i> Data Barang Masuk</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="../../page/invoice/invoice.php"><i class="fas fa-file"></i> Invoice</a>
		</li>
		<li>
			<a href="#submenu3" data-bs-toggle="collapse"><i class="fas fa-clipboard"></i> Laporan</a>
			<ul class="collapse list-unstyled componenets" id=submenu3 data-bs-parent="#menu">
				<li>
					<a href="../../page/laporan/laporan_barang.php">Laporan Barang</a>
				</li>
				<li>
					<a href="../../page/laporan/laporan_data_masuk.php">Laporan Barang Masuk</a>
				</li>
				<li>
					<a href="#">Laporan Penjualan</a>
				</li>
			</ul>
		</li>
		<hr>
		<li>
			<a onclick="return confirm('Anda yakin ingin logout ?')" href="../../logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
		</li>
	</ul>
	<span>Copyright © 2022</span>
</nav>