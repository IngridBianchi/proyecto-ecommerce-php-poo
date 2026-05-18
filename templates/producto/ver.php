<?php use App\Utils\Security; ?>
<?php if (isset($product)): ?>
	<h1><?= Security::e($product->getNombre()) ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->getImagen() != null): ?>
				<img src="uploads/images/<?= Security::e($product->getImagen()) ?>" />
			<?php else: ?>
				<img src="assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= Security::e($product->getDescripcion()) ?></p>
			<p class="price"><?= Security::e((string)$product->getPrecio()) ?> €</p>
			<a href="index.php?controller=carrito&action=add&id=<?= $product->getId() ?>" class="button">Comprar</a>
		</div>
	</div>
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>
