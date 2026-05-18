<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" href="assets/css/styles.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>
	<div id="container">
		<!-- CABECERA -->
		<header id="header">
			<div id="logo">
				<img src="assets/img/logo.camisetas.png" alt="Rock Tees Logo" height="140" />
				<a href="index.php">
					Tienda de Camisetas
				</a>
			</div>
		</header>

		<!-- MENU -->
		<nav id="menu">
			<ul class="menu-items">
				<li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
				<?php foreach ($allCategories as $cat): ?>
					<li>
						<a href="index.php?controller=categoria&action=ver&id=<?= $cat->id ?>">
							<?php $icono = (stripos($cat->nombre, 'sudadera') !== false) ? 'fas fa-hoodie' : ((stripos($cat->nombre, 'tirantes') !== false) ? 'fas fa-shirt' : 'fas fa-tshirt'); ?>
							<i class="<?= $icono ?>"></i> <?= $cat->nombre ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<div id="content">
