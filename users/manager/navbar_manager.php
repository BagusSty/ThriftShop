
<nav class="navbar navbar-expand-sm fixed-out">
	<div class="container-fluid">
		<button type="button" id="sidebarCollapse" class="btn">
			<i class="fas fa-align-left"></i>
		</button>
		<div class="dropdown">
			<button class="btn dropdown-toggle" type="button" id="dropdown-profil" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa fa-fw fa-user"></i> <?php echo $_SESSION['nama']; ?>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdown-profil">
				<li><a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Profil</a></li>
				<li><a class="dropdown-item" href="../../logout.php" onclick="return confirm('Anda yakin ingin logout ?')" ><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
			</ul>
		</div>
	</div>
</nav>