<?php use App\Utils\Security; ?>
<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
	<h1>Tu pedido se ha confirmado</h1>
	<p>
		Tu pedido ha sido guardado con exito, una vez que realices la transferencia
		bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.
	</p>
	<br/>
	<?php if (isset($pedido)): ?>
		<h3>Datos del pedido:</h3>

		Número de pedido: <?= $pedido->getId() ?>   <br/>
		Total a pagar: <?= $pedido->getCoste() ?> € <br/>
		Productos:

		<table>
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Unidades</th>
			</tr>
			<?php foreach ($productos as $producto): ?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<img src="uploads/images/<?= Security::e($producto->imagen) ?>" class="img_carrito" />
						<?php else: ?>
							<img src="assets/img/camiseta.png" class="img_carrito" />
						<?php endif; ?>
					</td>
					<td>
						<a href="index.php?controller=product&action=ver&id=<?= $producto->id ?>"><?= Security::e($producto->nombre) ?></a>
					</td>
					<td>
						<?= Security::e((string)$producto->precio) ?> €
					</td>
					<td>
						<?= Security::e((string)$producto->unidades) ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>

	<?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
	<h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>
