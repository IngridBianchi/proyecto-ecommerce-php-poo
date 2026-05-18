<?php use App\Utils\Security; ?>
<h1>Crear nueva categoria</h1>

<form action="index.php?controller=categoria&action=save" method="POST" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<input type="submit" value="Guardar" />
</form>
