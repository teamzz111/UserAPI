-- UserAPI schema (derived from models/*.php) + FICTITIOUS demo data. Not real people.
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8mb4;
USE `mydb`;

CREATE TABLE `rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `nivel` VARCHAR(45) NOT NULL,
  `estado` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `modulo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `icono` VARCHAR(45) NOT NULL,
  `opciones` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `permiso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `leer` VARCHAR(45) NOT NULL,
  `escribir` VARCHAR(45) NOT NULL,
  `eliminar` VARCHAR(45) NOT NULL,
  `modulo_id` INT NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_permiso_modulo` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`),
  CONSTRAINT `fk_permiso_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `tipo_doc` VARCHAR(45) NOT NULL,
  `nro_doc` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_usuario_email` (`email`),
  UNIQUE KEY `uq_usuario_nro_doc` (`nro_doc`),
  UNIQUE KEY `uq_usuario_usuario` (`usuario`),
  CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB;


INSERT INTO `rol` (`id`, `nombre`, `nivel`, `estado`) VALUES
(1, 'Administrador', '1', 1),
(2, 'Operador', '2', 1),
(3, 'Consulta', '3', 1);

INSERT INTO `modulo` (`id`, `nombre`, `icono`, `opciones`, `estado`) VALUES
(1, 'Usuarios', 'fa-users', 'crear,editar,listar', 'activo'),
(2, 'Roles', 'fa-id-badge', 'crear,editar,listar', 'activo'),
(3, 'Modulos', 'fa-th', 'crear,editar,listar', 'activo'),
(4, 'Permisos', 'fa-lock', 'asignar,listar', 'activo');

INSERT INTO `permiso` (`id`, `fecha`, `leer`, `escribir`, `eliminar`, `modulo_id`, `rol_id`) VALUES
(1, '2019-01-15', 'si', 'si', 'si', 1, 1),
(2, '2019-01-15', 'si', 'si', 'si', 2, 1),
(3, '2019-01-15', 'si', 'si', 'si', 3, 1),
(4, '2019-01-15', 'si', 'si', 'si', 4, 1),
(5, '2019-01-15', 'si', 'si', 'no', 1, 2),
(6, '2019-01-15', 'si', 'si', 'no', 2, 2),
(7, '2019-01-15', 'si', 'si', 'no', 3, 2),
(8, '2019-01-15', 'si', 'si', 'no', 4, 2),
(9, '2019-01-15', 'si', 'no', 'no', 1, 3),
(10, '2019-01-15', 'si', 'no', 'no', 2, 3),
(11, '2019-01-15', 'si', 'no', 'no', 3, 3),
(12, '2019-01-15', 'si', 'no', 'no', 4, 3);

INSERT INTO `usuario` (`id`, `nombres`, `apellidos`, `tipo_doc`, `nro_doc`, `email`, `telefono`, `direccion`, `usuario`, `clave`, `estado`, `rol_id`) VALUES
(1, 'Mateo', 'Pérez', 'CC', '9000000001', 'mateo.perez@example.com', '3000000001', 'Calle 92 # 45-78', 'mateo.perez', 'demo1234', 'activo', 1),
(2, 'Mariana', 'Torres', 'CC', '9000000002', 'mariana.torres@example.com', '3000000002', 'Calle 68 # 6-94', 'mariana.torres', 'demo1234', 'activo', 2),
(3, 'Daniel', 'López', 'CC', '9000000003', 'daniel.lopez@example.com', '3000000003', 'Calle 118 # 69-16', 'daniel.lopez', 'demo1234', 'activo', 2),
(4, 'Mateo', 'Reyes', 'CC', '9000000004', 'mateo.reyes@example.com', '3000000004', 'Calle 97 # 11-71', 'mateo.reyes', 'demo1234', 'activo', 2),
(5, 'Camila', 'Herrera', 'CC', '9000000005', 'camila.herrera@example.com', '3000000005', 'Calle 76 # 81-80', 'camila.herrera', 'demo1234', 'inactivo', 2),
(6, 'Luis', 'Pérez', 'CC', '9000000006', 'luis.perez@example.com', '3000000006', 'Calle 93 # 74-25', 'luis.perez', 'demo1234', 'activo', 2),
(7, 'Camila', 'Ramírez', 'CC', '9000000007', 'camila.ramirez@example.com', '3000000007', 'Calle 18 # 6-85', 'camila.ramirez', 'demo1234', 'activo', 3),
(8, 'Daniel', 'Navarro', 'CC', '9000000008', 'daniel.navarro@example.com', '3000000008', 'Calle 59 # 99-38', 'daniel.navarro', 'demo1234', 'activo', 3),
(9, 'Ana', 'Reyes', 'CC', '9000000009', 'ana.reyes@example.com', '3000000009', 'Calle 21 # 30-13', 'ana.reyes', 'demo1234', 'activo', 3),
(10, 'Sofía', 'Reyes', 'CC', '9000000010', 'sofia.reyes@example.com', '3000000010', 'Calle 98 # 36-59', 'sofia.reyes', 'demo1234', 'inactivo', 3),
(11, 'Felipe', 'Torres', 'CC', '9000000011', 'felipe.torres@example.com', '3000000011', 'Calle 94 # 21-48', 'felipe.torres', 'demo1234', 'activo', 3),
(12, 'Paula', 'Díaz', 'CC', '9000000012', 'paula.diaz@example.com', '3000000012', 'Calle 91 # 27-86', 'paula.diaz', 'demo1234', 'activo', 3),
(13, 'Ana', 'García', 'CC', '9000000013', 'ana.garcia@example.com', '3000000013', 'Calle 69 # 90-88', 'ana.garcia', 'demo1234', 'activo', 3),
(14, 'Felipe', 'Rojas', 'CC', '9000000014', 'felipe.rojas@example.com', '3000000014', 'Calle 19 # 78-82', 'felipe.rojas', 'demo1234', 'activo', 3),
(15, 'Mariana', 'López', 'CC', '9000000015', 'mariana.lopez@example.com', '3000000015', 'Calle 44 # 69-94', 'mariana.lopez', 'demo1234', 'inactivo', 3),
(16, 'Sofía', 'Rojas', 'CC', '9000000016', 'sofia.rojas@example.com', '3000000016', 'Calle 63 # 21-60', 'sofia.rojas', 'demo1234', 'activo', 3),
(17, 'Mateo', 'Rodríguez', 'CC', '9000000017', 'mateo.rodriguez@example.com', '3000000017', 'Calle 98 # 35-82', 'mateo.rodriguez', 'demo1234', 'activo', 3),
(18, 'Isabela', 'Martínez', 'CC', '9000000018', 'isabela.martinez@example.com', '3000000018', 'Calle 143 # 29-88', 'isabela.martinez', 'demo1234', 'activo', 3);
