<?php use App\Utils\Security; ?>
<?php if (isset($categoria)): ?>
	<h1><?= Security::e($categoria->getNombre()) ?></h1>
	<?php if (empty($productos)): ?>
		<p>No hay productos para mostrar</p>
	<?php else: ?>

		<?php foreach ($productos as $product): ?>
			<div class="product">
				<a href="index.php?controller=product&action=ver&id=<?= $product->id ?>">
					<?php if ($product->imagen != null): ?>
						<img src="uploads/images/<?= Security::e($product->imagen) ?>" />
					<?php else: ?>
						<img src="assets/img/camiseta.png" />
					<?php endif; ?>
					<h2><?= Security::e($product->nombre) ?></h2>
				</a>
				<p><?= Security::e((string)$product->precio) ?> €</p>
				<a href="index.php?controller=carrito&action=add&id=<?= $product->id ?>" class="button">Comprar</a>
			</div>
		<?php endforeach; ?>

	<?php endif; ?>
<?php else: ?>
	<h1>La categoría no existe</h1>
<?php endif; ?>
