<?php use App\Utils\Security; ?>
<h1>Detalle del pedido</h1>

<?php if (isset($pedido)): ?>
		<?php if(isset($_SESSION['admin'])): ?>
			<h3>Cambiar estado del pedido</h3>
			<form action="index.php?controller=pedido&action=estado" method="POST">
                <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
				<input type="hidden" value="<?=$pedido->getId()?>" name="pedido_id"/>
				<select name="estado">
					<option value="confirm" <?=$pedido->getEstado() == "confirm" ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->getEstado() == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready" <?=$pedido->getEstado() == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sended" <?=$pedido->getEstado() == "sended" ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" />
			</form>
			<br/>
		<?php endif; ?>

		<h3>Dirección de envio</h3>
		Provincia: <?= Security::e($pedido->getProvincia()) ?>   <br/>
		Cuidad: <?= Security::e($pedido->getLocalidad()) ?> <br/>
		Direccion: <?= Security::e($pedido->getDireccion()) ?>   <br/><br/>

		<h3>Datos del pedido:</h3>
		Estado: <?= \App\Utils\Utils::showStatus($pedido->getEstado()) ?> <br/>
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
