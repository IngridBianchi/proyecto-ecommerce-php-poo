<?php use App\Utils\Security; ?>
<h1>Gestionar categorias</h1>

<a href="index.php?controller=categoria&action=crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
	</tr>
	<?php foreach($categorias as $cat): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?= Security::e($cat->nombre); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
