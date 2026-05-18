<?php use App\Utils\Security; ?>
<?php if(isset($edit) && isset($product) && is_object($product)): ?>
	<h1>Editar producto <?= Security::e($product->getNombre()) ?></h1>
	<?php $url_action = "index.php?controller=product&action=save&id=" . $product->getId(); ?>
	
<?php else: ?>
	<h1>Crear nuevo producto</h1>
	<?php $url_action = "index.php?controller=product&action=save"; ?>
<?php endif; ?>
	
<div class="form_container">
	
	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($product) && is_object($product) ? Security::e($product->getNombre()) : ''; ?>" required/>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion" required><?=isset($product) && is_object($product) ? Security::e($product->getDescripcion()) : ''; ?></textarea>

		<label for="precio">Precio</label>
		<input type="text" name="precio" value="<?=isset($product) && is_object($product) ? Security::e((string)$product->getPrecio()) : ''; ?>" required/>

		<label for="stock">Stock</label>
		<input type="number" name="stock" value="<?=isset($product) && is_object($product) ? Security::e((string)$product->getStock()) : ''; ?>" required/>

		<label for="categoria">Categoria</label>
		<select name="categoria">
			<?php foreach ($categorias as $cat): ?>
				<option value="<?= $cat->id ?>" <?=isset($product) && is_object($product) && $cat->id == $product->getCategoriaId() ? 'selected' : ''; ?>>
					<?= Security::e($cat->nombre) ?>
				</option>
			<?php endforeach; ?>
		</select>
		
		<label for="imagen">Imagen</label>
		<?php if(isset($product) && is_object($product) && !empty($product->getImagen())): ?>
			<img src="uploads/images/<?= Security::e($product->getImagen()) ?>" class="thumb"/> 
		<?php endif; ?>
		<input type="file" name="imagen" />
		
		<input type="submit" value="Guardar" />
	</form>
</div>
