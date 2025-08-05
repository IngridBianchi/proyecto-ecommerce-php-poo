<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" href="<?php echo base_url; ?>assets/css/styles.css" />
	<!-- Añadir Font Awesome para íconos en el menú -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<!-- Añadir Bebas Neue para el texto del logo -->
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>
	<div id="container">
		<!-- CABECERA -->
		<header id="header">
			<div id="logo">
				<img src="<?= base_url ?>assets/img/logo.camisetas.png" alt="Rock Tees Logo" height="140" />
				<a href="<?= base_url ?>">
					Tienda de Camisetas
				</a>
			</div>
		</header>

		<!-- MENU -->
		<?php $categorias = Utils::showCategorias(); ?>
		<nav id="menu">
			<div class="menu-toggle">☰</div>
			<ul class="menu-items">
				<li><a href="<?= base_url ?>"><i class="fas fa-home"></i> Inicio</a></li>
				<?php while ($cat = $categorias->fetch_object()): ?>
					<li>
						<a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>">
							<?php $icono = (stripos($cat->nombre, 'sudadera') !== false) ? 'fas fa-hoodie' : ((stripos($cat->nombre, 'tirantes') !== false) ? 'fas fa-shirt' : 'fas fa-tshirt'); ?>
							<i class="<?= $icono ?>"></i> <?= $cat->nombre ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</nav>

		<div id="content">
			<script>
				document.querySelector('.menu-toggle').addEventListener('click', function() {
					document.querySelector('.menu-items').classList.toggle('active');
				});
			</script>