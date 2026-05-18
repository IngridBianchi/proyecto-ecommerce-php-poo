<h1>Algunos de nuestros productos</h1>

<?php 
use App\Utils\Security;
$baseUrl = $_ENV['APP_URL'] ?? 'http://localhost:8080/';
?>

<?php foreach($productos as $product): ?>
	<div class="product">
		<a href="index.php?controller=product&action=ver&id=<?= $product->id ?>">
			<?php if($product->imagen != null): ?>
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
