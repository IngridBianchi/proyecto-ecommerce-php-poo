<?php use App\Utils\Security; ?>
<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($carrito as $indice => $elemento): 
                $producto = $elemento['producto'];
            ?>
            <tr>
                <td>
                    <?php if ($producto->getImagen() != null): ?>
                        <img src="uploads/images/<?= Security::e($producto->getImagen()) ?>" class="img_carrito" />
                    <?php else: ?>
                        <img src="assets/img/camiseta.png" class="img_carrito" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?controller=product&action=ver&id=<?=$producto->getId()?>"><?= Security::e($producto->getNombre()) ?></a>
                </td>
                <td>
                    <?= Security::e((string)$producto->getPrecio()) ?> €
                </td>
                <td>
                    <div class="units-management">
                        <span class="unit-count"><?= Security::e((string)$elemento['unidades']) ?></span>
                        <div class="updown-unidades">
                            <a href="index.php?controller=carrito&action=up&index=<?=$indice?>" class="button">+</a>
                            <a href="index.php?controller=carrito&action=down&index=<?=$indice?>" class="button">-</a>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="index.php?controller=carrito&action=delete&index=<?=$indice?>" class="button button-carrito button-red">Quitar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="cart-footer">
        <div class="cart-actions">
            <a href="index.php?controller=carrito&action=delete_all" class="button button-delete button-red">Vaciar carrito</a>
        </div>
        <div class="cart-totals">
            <?php $stats = \App\Utils\Cart::getStats(); ?>
            <h3>Precio total: <?= Security::e((string)$stats['total']) ?> €</h3>
            <a href="index.php?controller=pedido&action=hacer" class="button button-pedido">Confirmar Pedido</a>
        </div>
    </div>

<?php else: ?>
    <p>El carrito está vacío, ¡añade algún producto!</p>
<?php endif; ?>
