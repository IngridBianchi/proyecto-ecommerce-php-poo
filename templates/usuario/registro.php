<?php
use App\Utils\Security;
?>
<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php unset($_SESSION['register']); ?>

<form action="index.php?controller=usuario&action=save" method="POST" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" autocomplete="off" required/>
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" autocomplete="off" required/>
	
	<label for="email">Email</label>
	<input type="email" name="email" autocomplete="off" required/>
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" autocomplete="new-password" required/>
	
	<input type="submit" value="Registrarse" />
</form>
