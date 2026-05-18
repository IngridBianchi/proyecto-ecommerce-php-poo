<?php use App\Utils\Security; ?>
<h1>Gestión de productos</h1>

<a href="index.php?controller=product&action=crear" class="button button-small">
	Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha guardado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha guardado correctamente</strong>
<?php endif; ?>
<?php unset($_SESSION['producto']); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php unset($_SESSION['delete']); ?>
	
<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		<th>ACCIONES</th>
	</tr>
	<?php foreach($productos as $pro): ?>
		<tr>
			<td><?= $pro->id; ?></td>
			<td><?= Security::e($pro->nombre); ?></td>
			<td><?= Security::e((string)$pro->precio); ?> €</td>
			<td><?= Security::e((string)$pro->stock); ?></td>
			<td>
				<a href="index.php?controller=product&action=editar&id=<?= $pro->id ?>" class="button button-gestion">Editar</a>
				<a href="index.php?controller=product&action=eliminar&id=<?= $pro->id ?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
