<?php use App\Utils\Security; ?>
<?php if (isset($gestion)): ?>
	<h1>Gestionar pedidos</h1>
<?php else: ?>
	<h1>Mis pedidos</h1>
<?php endif; ?>
<table>
	<tr>
		<th>Nº Pedido</th>
		<th>Coste</th>
		<th>Fecha</th>
		<th>Estado</th>
	</tr>
	<?php
	foreach ($pedidos as $ped):
		?>

		<tr>
			<td>
				<a href="index.php?controller=pedido&action=detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
			</td>
			<td>
				<?= Security::e((string)$ped->coste) ?> €
			</td>
			<td>
				<?= Security::e($ped->fecha) ?>
			</td>
			<td>
				<?= \App\Utils\Utils::showStatus($ped->estado) ?>
			</td>
		</tr>

	<?php endforeach; ?>
</table>
