<?php
use App\Utils\Cart;
use App\Utils\Security;
?>
<!-- BARRA LATERAL -->
<aside id="lateral">

	<div id="carrito" class="block_aside">
		<h3>Mi carrito</h3>
		<ul>
			<?php $stats = Cart::getStats(); ?>
			<li><a href="index.php?controller=carrito&action=index">Productos (<?= $stats['count'] ?>)</a></li>
			<li><a href="index.php?controller=carrito&action=index">Total: <?= $stats['total'] ?> €</a></li>
			<li><a href="index.php?controller=carrito&action=index">Ver el carrito</a></li>
		</ul>
	</div>
	
	<div id="login" class="block_aside">
		
		<?php if(!isset($_SESSION['identity'])): ?>
			<h3>Entrar a la web</h3>
			<?php if(isset($_SESSION['error_login'])): ?>
				<strong class="alert_red"><?= $_SESSION['error_login'] ?></strong>
			<?php endif; ?>
			<form action="index.php?controller=usuario&action=login" method="post" autocomplete="off">
				<input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
				<label for="email">Email</label>
				<input type="email" name="login_email" autocomplete="off" required />
				<label for="password">Contraseña</label>
				<input type="password" name="login_password" autocomplete="new-password" required />
				<input type="submit" value="Enviar" />
			</form>
		<?php else: ?>
			<h3><?= Security::e($_SESSION['identity']->getNombre()) ?> <?= Security::e($_SESSION['identity']->getApellidos()) ?></h3>
		<?php endif; ?>

		<ul>
			<?php if(isset($_SESSION['admin'])): ?>
				<li><a href="index.php?controller=categoria&action=index">Gestionar categorias</a></li>
				<li><a href="index.php?controller=producto&action=gestion">Gestionar productos</a></li>
				<li><a href="index.php?controller=pedido&action=gestion">Gestionar pedidos</a></li>
			<?php endif; ?>
			
			<?php if(isset($_SESSION['identity'])): ?>
				<li><a href="index.php?controller=pedido&action=mis_pedidos">Mis pedidos</a></li>
				<li><a href="index.php?controller=usuario&action=logout">Cerrar sesión</a></li>
			<?php else: ?> 
				<li><a href="index.php?controller=usuario&action=registro">Registrate aqui</a></li>
			<?php endif; ?> 
		</ul>
	</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">
