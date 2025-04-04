CREATE DATABASE tienda_master;
USE tienda_master;

CREATE TABLE usuarios(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
apellidos       varchar(255),
email           varchar(255) not null,
password        varchar(255) not null,
rol             varchar(20),
imagen          varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);

CREATE TABLE categorias(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id) 
)ENGINE=InnoDb;

INSERT INTO categorias VALUES(null, 'Manga corta');
INSERT INTO categorias VALUES(null, 'Tirantes');
INSERT INTO categorias VALUES(null, 'Manga larga');
INSERT INTO categorias VALUES(null, 'Sudaderas');

CREATE TABLE productos(
id              int(255) auto_increment not null,
categoria_id    int(255) not null,
nombre          varchar(100) not null,
descripcion     text,
precio          float(100,2) not null,
stock           int(255) not null,
oferta          varchar(2),
fecha           date not null,
imagen          varchar(255),
CONSTRAINT pk_categorias PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


CREATE TABLE pedidos(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
provincia       varchar(100) not null,
localidad       varchar(100) not null,
direccion       varchar(255) not null,
coste           float(200,2) not null,
estado          varchar(20) not null,
fecha           date,
hora            time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
id              int(255) auto_increment not null,
pedido_id       int(255) not null,
producto_id     int(255) not null,
unidades        int(255) not null,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;

INSERT INTO productos (id, categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(NULL, 1, 'Camiseta Blanca', 'Camiseta de algodón blanca, ideal para el verano.', 15.99, 100, NULL, '2025-04-01', NULL),
(NULL, 1, 'Camiseta Negra', 'Camiseta de algodón negra, básica y cómoda.', 17.99, 80, NULL, '2025-04-01', NULL),
(NULL, 2, 'Top Tirantes Azul', 'Top de tirantes azul, perfecto para días calurosos.', 12.99, 50, NULL, '2025-04-01', NULL),
(NULL, 2, 'Top Tirantes Rojo', 'Top de tirantes rojo, con diseño moderno.', 14.99, 60, NULL, '2025-04-01', NULL),
(NULL, 3, 'Camiseta Manga Larga Verde', 'Camiseta de manga larga verde, ideal para otoño.', 19.99, 40, NULL, '2025-04-01', NULL),
(NULL, 3, 'Camiseta Manga Larga Gris', 'Camiseta de manga larga gris, cómoda y versátil.', 21.99, 30, NULL, '2025-04-01', NULL),
(NULL, 4, 'Sudadera con Capucha', 'Sudadera con capucha, perfecta para el invierno.', 29.99, 25, NULL, '2025-04-01', NULL),
(NULL, 4, 'Sudadera Deportiva', 'Sudadera deportiva, ideal para entrenar.', 34.99, 20, NULL, '2025-04-01', NULL);


UPDATE productos SET imagen = 'camiseta_blanca.png' WHERE nombre = 'Camiseta Blanca';
UPDATE productos SET imagen = 'camiseta_negra.png' WHERE nombre = 'Camiseta Negra';
UPDATE productos SET imagen = 'top_tirantes_azul.png' WHERE nombre = 'Top Tirantes Azul';
UPDATE productos SET imagen = 'top_tirantes_rojo.png' WHERE nombre = 'Top Tirantes Rojo';
UPDATE productos SET imagen = 'camiseta_manga_larga_verde.png' WHERE nombre = 'Camiseta Manga Larga Verde';
UPDATE productos SET imagen = 'camiseta_manga_larga_gris.png' WHERE nombre = 'Camiseta Manga Larga Gris';
UPDATE productos SET imagen = 'sudadera_capucha.png' WHERE nombre = 'Sudadera con Capucha';
UPDATE productos SET imagen = 'sudadera_deportiva.png' WHERE nombre = 'Sudadera Deportiva';