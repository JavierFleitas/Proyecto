-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 21:49:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pcfleitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_usuarios`
--

CREATE TABLE `carrito_usuarios` (
  `ID` int(20) NOT NULL,
  `id_sesion` varchar(50) NOT NULL,
  `id_producto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `img` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `Nombre`, `Descripcion`, `img`) VALUES
(1, 'Graficas', 'En esta carta encontraras todo lo que necesitas saber de nuestras Graficas', 'img4'),
(2, 'Procesadores', 'En esta carta encontraras todo lo que necesitas saber de nuestras Procesadores', 'img5'),
(3, 'Placas bases', 'En esta carta encontraras todo lo que necesitas saber de nuestras Placas bases', 'img6'),
(4, 'Memoria RAM', 'En esta carta encontraras todo lo que necesitas saber de nuestras Memoria RAM', 'img7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `categoria_id` int(50) NOT NULL,
  `img` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `categoria_id`, `img`) VALUES
(1, 'Geforce RTX 3070Ti', 'La tarjeta gráfica Nvidia GeForce RTX 3070 Ti es una potente unidad de procesamiento gráfico diseñada para juegos y aplicaciones de alto rendimiento. Ofrece un excelente equilibrio entre rendimiento y precio, con capacidades de trazado de rayos en tiempo real y soporte para resoluciones de juego de alta calidad. Esta GPU es una opción popular para entusiastas de los juegos y creadores de contenido que buscan un rendimiento sólido a un precio relativamente accesible.', 650.00, 1, 'g1'),
(2, 'Geforce RTX 2080Ti', 'La tarjeta gráfica Nvidia GeForce RTX 2080 Ti es una unidad de procesamiento gráfico de alta gama diseñada para ofrecer un rendimiento excepcional en juegos y aplicaciones intensivas en gráficos. Es conocida por su capacidad para admitir trazado de rayos en tiempo real y ofrecer un rendimiento de juego fluido en resoluciones 4K. La RTX 2080 Ti es una opción preferida para entusiastas y jugadores que buscan lo mejor en términos de calidad visual y rendimiento.', 520.00, 1, 'g2'),
(3, 'Geforce RTX 4070Ti', 'La NVIDIA GeForce RTX 4070Ti es una tarjeta gráfica de ensueño para los entusiastas de los juegos y la edición de video que buscan un rendimiento gráfico excepcional y una experiencia visual inigualable. Con su capacidad de trazado de rayos, núcleos Tensor, velocidades de reloj impresionantes y una generosa cantidad de memoria, esta tarjeta ofrece un rendimiento de vanguardia en todas las aplicaciones y juegos más exigentes.', 990.00, 1, 'g3'),
(4, 'Geforce RTX 3060', 'La tarjeta gráfica Nvidia GeForce RTX 3060 es una unidad de procesamiento gráfico diseñada para ofrecer un excelente rendimiento en juegos de 1080p y 1440p a un precio relativamente asequible. Es conocida por su eficiencia energética y capacidad para admitir trazado de rayos en tiempo real, lo que mejora la calidad visual de los juegos. La RTX 3060 es una opción popular para jugadores que buscan un buen equilibrio entre rendimiento y costo, así como para creadores de contenido que realizan tareas de edición de video y diseño gráfico.', 460.00, 1, 'g4'),
(5, 'Geforce RTX 4080', 'La NVIDIA GeForce RTX 4080 es el epítome del rendimiento gráfico y la tecnología de vanguardia, ofreciendo una experiencia de juego y creación de contenido incomparable. Con sus capacidades de trazado de rayos, inteligencia artificial y rendimiento en bruto, esta tarjeta gráfica es ideal para los entusiastas más exigentes.', 1088.00, 1, 'g5'),
(6, 'Geforce RTX 2080Ti', 'La tarjeta gráfica Nvidia GeForce RTX 2080 Ti es una unidad de procesamiento gráfico de alta gama que fue lanzada en 2018. Ofrece un rendimiento excepcional en juegos y aplicaciones intensivas en gráficos. La RTX 2080 Ti es conocida por su capacidad de trazado de rayos en tiempo real, lo que permite efectos visuales más realistas y una calidad de imagen mejorada en juegos compatibles.', 549.00, 1, 'g6'),
(7, 'Geforce RTX 2080Ti', 'La MSI Duke GeForce RTX 2080 Ti es una variante personalizada de la tarjeta gráfica Nvidia GeForce RTX 2080 Ti diseñada por MSI. Esta tarjeta gráfica ofrece un rendimiento excepcional en juegos y aplicaciones gráficas de alta demanda. La serie Duke de MSI es conocida por su robusto diseño de enfriamiento y construcción de alta calidad. La MSI Duke GeForce RTX 2080 Ti generalmente incluye características como múltiples ventiladores para un enfriamiento eficiente, overclocking de fábrica para un rendimiento aún mayor y una variedad de salidas de video para múltiples monitores.', 572.00, 1, 'g7'),
(8, 'Geforce RTX 3080Ti', 'La ASUS GeForce RTX 3080 Ti es una tarjeta gráfica de alta gama diseñada para ofrecer un rendimiento excepcional en juegos y aplicaciones de gráficos intensivos. Esta tarjeta se basa en la arquitectura Ampere de Nvidia y ofrece un gran número de núcleos CUDA, lo que la convierte en una potente unidad de procesamiento gráfico (GPU). La ASUS GeForce RTX 3080 Ti suele contar con un sistema de enfriamiento avanzado, como ventiladores Axial-tech y disipadores de calor de alta calidad, para mantener la temperatura bajo control durante sesiones de juego intensas. ', 749.00, 1, 'g8'),
(9, 'Intel Core i5-11600K', 'El Intel Core i5-11600K es un procesador de escritorio de alto rendimiento diseñado para juegos y tareas informáticas generales. Ofrece 6 núcleos y 12 hilos, lo que significa que puede manejar múltiples tareas de manera eficiente. Tiene una frecuencia base de reloj de 3.9 GHz y una frecuencia turbo máxima de 4.9 GHz, lo que le permite un excelente rendimiento en juegos y aplicaciones que requieren potencia de procesamiento.', 345.00, 2, 'p1'),
(10, 'Intel Core i9-9900K', 'El Intel Core i9-9900K es un procesador de alto rendimiento diseñado para usuarios que buscan un rendimiento excepcional en juegos y aplicaciones intensivas. Cuenta con 8 núcleos físicos y 16 hilos de procesamiento, lo que significa que puede manejar fácilmente tareas multitarea intensivas y aplicaciones que requieren un alto rendimiento de CPU. El i9-9900K tiene una frecuencia base de reloj de 3.6 GHz y una frecuencia turbo máxima de 5.0 GHz, lo que lo convierte en uno de los procesadores más rápidos disponibles en su momento.', 499.00, 2, 'p2'),
(11, 'Intel Core i7-7700', 'El Intel Core i7-7700 es un procesador de escritorio de alto rendimiento diseñado para ofrecer un buen equilibrio entre rendimiento y eficiencia energética. Cuenta con 4 núcleos físicos y 8 hilos de procesamiento, lo que le permite manejar una variedad de tareas de forma eficiente, incluyendo juegos y aplicaciones multitarea. El i7-7700 tiene una frecuencia base de reloj de 3.6 GHz y una frecuencia turbo máxima de 4.2 GHz, lo que le permite ofrecer un buen rendimiento en aplicaciones que requieren potencia de procesamiento', 399.00, 2, 'p3'),
(12, 'Intel Core i3-10100F', 'El Intel Core i3-10100F es un procesador de nivel básico que forma parte de la serie Comet Lake de Intel. Cuenta con 4 núcleos físicos y 8 hilos de procesamiento, lo que lo hace adecuado para tareas informáticas cotidianas y multitarea ligera. Aunque es una opción de menor rendimiento en comparación con los procesadores i5, i7 y i9 de gama alta de Intel, es una elección adecuada para sistemas de presupuesto y computadoras de uso general. El i3-10100F tiene una frecuencia base de reloj de 3.6 GHz, lo que le permite realizar tareas como navegación web, procesamiento de documentos y reproducción de medios de manera eficiente.', 420.00, 2, 'p4'),
(13, 'AMD Ryzen 5 5600X', 'El AMD Ryzen 5 5600X es un procesador de alto rendimiento diseñado para usuarios que buscan un excelente rendimiento en juegos y aplicaciones. Cuenta con 6 núcleos físicos y 12 hilos de procesamiento, lo que le permite manejar eficientemente tareas multitarea y aplicaciones intensivas en procesador. El Ryzen 5 5600X tiene una frecuencia base de reloj de 3.7 GHz y una frecuencia turbo máxima de 4.6 GHz, lo que le brinda un rendimiento excepcional en una amplia gama de aplicaciones.', 379.00, 2, 'p5'),
(14, 'AMD Ryzen 7 5800X', 'El AMD Ryzen 7 5800X es un procesador de alto rendimiento diseñado para usuarios que buscan un excelente rendimiento en una amplia gama de aplicaciones, desde juegos hasta tareas creativas intensivas en procesador. Cuenta con 8 núcleos físicos y 16 hilos de procesamiento, lo que lo hace altamente capaz para tareas de multitarea y aplicaciones que aprovechan múltiples núcleos. El Ryzen 7 5800X tiene una frecuencia base de reloj de 3.8 GHz y una frecuencia turbo máxima de 4.7 GHz, lo que lo convierte en uno de los procesadores más rápidos disponibles en el mercado.', 620.00, 2, 'p6'),
(15, 'AMD Ryzen 9 5900X', 'El AMD Ryzen 9 5900X es un procesador de gama alta diseñado para usuarios que buscan el máximo rendimiento en una amplia variedad de aplicaciones. Cuenta con 12 núcleos físicos y 24 hilos de procesamiento, lo que lo convierte en una opción poderosa para tareas de multitarea intensiva y aplicaciones que aprovechan al máximo los núcleos. El Ryzen 9 5900X tiene una frecuencia base de reloj de 3.7 GHz y una frecuencia turbo máxima de 4.8 GHz, lo que lo convierte en uno de los procesadores más potentes disponibles en el mercado de consumo', 719.00, 2, 'p7'),
(16, 'ASUS ROG Strix X570-F', 'La ASUS ROG Strix X570-F Gaming es una placa base de alta calidad que ofrece un conjunto completo de características y un diseño atractivo, lo que la convierte en una excelente opción para construir una PC de alto rendimiento orientada a juegos y tareas de creación de contenido.', 449.00, 3, 'pl1'),
(17, 'ASUS PRIME B560M-A', 'La ASUS PRIME B560M-A es una placa base de la serie Prime de ASUS diseñada para usuarios que buscan una solución confiable y equilibrada para construir una computadora de escritorio. La ASUS PRIME B560M-A es una placa base de formato microATX que utiliza el zócalo LGA 1200 de Intel, lo que la hace compatible con procesadores de 10ª y 11ª generación de Intel Core. Está diseñada para brindar estabilidad y durabilidad, con una serie de características esenciales para la construcción de una PC de uso general.', 199.00, 3, 'pl2'),
(18, 'ASUS PRIME Z690-A', 'La ASUS PRIME Z690-A es una placa base de alta calidad y alto rendimiento diseñada para usuarios entusiastas que buscan construir una PC de alto rendimiento para juegos, creación de contenido, o cualquier tarea que requiera un rendimiento excepcional. Ofrece una amplia gama de características y un diseño premium para satisfacer las necesidades de los constructores de PC más exigentes.', 379.00, 3, 'pl3'),
(19, 'Gigabyte H410M H V3', 'La Gigabyte H410M H V3 es una placa base de nivel básico diseñada para usuarios que buscan construir una computadora sencilla y económica. La Gigabyte H410M H V3 utiliza el zócalo LGA 1200 de Intel y es compatible con procesadores de 10ª y 11ª generación de Intel Core. Es una placa base microATX que ofrece las características esenciales para la construcción de una PC de uso general, pero no incluye algunas de las funciones más avanzadas que se encuentran en placas de gama alta.', 170.00, 3, 'pl4'),
(20, 'Gigabyte X670 GAMING X', 'La Gigabyte X670 GAMING X AX es una placa base de alto rendimiento diseñada para jugadores y entusiastas que buscan construir una PC de gama alta con procesadores Ryzen de última generación. Ofrece una amplia gama de características, conectividad avanzada y capacidades de overclocking para satisfacer las necesidades de los usuarios exigentes.', 240.00, 3, 'pl5'),
(21, 'MSI B450 GAMING PLUS', 'La MSI B450 GAMING PLUS MAX es una placa base popular entre los jugadores y los usuarios que buscan una opción sólida para sus sistemas de juegos de gama media y alta. Ofrece un buen equilibrio entre rendimiento y precio y está diseñada para satisfacer las necesidades de los entusiastas de los juegos.', 99.00, 3, 'pl6'),
(22, 'MSI Z490-A PRO', 'La MSI Z490-A PRO es una placa base sólida y confiable que se adapta bien a usuarios que buscan construir una PC de alto rendimiento sin necesidad de características adicionales de lujo. Es ideal para jugadores y entusiastas que desean un rendimiento fiable y opciones de overclocking en un diseño funcional.', 220.00, 3, 'pl7'),
(23, 'MSI PRO Z690-A', 'La MSI PRO Z690-A es una placa base confiable y funcional que es ideal para usuarios que buscan construir una PC de alto rendimiento sin la necesidad de características adicionales de lujo. Es adecuada para jugadores y entusiastas que desean un rendimiento fiable y opciones de overclocking en un diseño funcional y duradero.', 333.00, 3, 'pl8'),
(24, 'T-Force Delta (2x4GB)', 'Este kit de memoria está diseñado para proporcionar 8 GB de RAM en total, distribuidos en dos módulos de 4 GB cada uno. Tiene una velocidad de reloj de 2400 MHz y cuenta con iluminación RGB para un aspecto visual atractivo en tu sistema. La RAM es un componente esencial en una computadora que afecta el rendimiento general, y esta kit en particular está diseñado para ofrecer un equilibrio entre capacidad y velocidad.', 150.00, 4, 'r1'),
(25, 'Vengeance rgb 3600 Mhz', 'La Vengeance RGB RS 3600 MHz es un kit de memoria RAM de alto rendimiento con iluminación RGB personalizable, diseñado para mejorar el rendimiento de tu sistema y proporcionar un aspecto visual atractivo. Es una excelente elección para usuarios que buscan un rendimiento rápido y una estética de iluminación RGB en su PC.', 169.00, 4, 'r2'),
(26, 'G.Skill Trident Z RGB', 'La G.Skill Trident Z RGB 3200 MHz es una opción popular entre los entusiastas de PC que buscan un rendimiento sólido y una estética de iluminación RGB en su sistema. Combina una velocidad de memoria respetable con una iluminación personalizable para ofrecer un excelente equilibrio entre rendimiento y estilo.', 220.00, 4, 'r3'),
(27, 'HYPERX 8 GB 2666 MHZ', 'La memoria RAM HyperX DDR4 8GB 2666MHz es una opción adecuada si buscas una actualización de memoria RAM sencilla para tu sistema. Proporciona un aumento de rendimiento en comparación con la memoria RAM más antigua o con menos capacidad, aunque no incluye características avanzadas como iluminación RGB.', 80.00, 4, 'r4'),
(28, 'Kingston Fury (2 x 32GB)', 'El Kingston Fury Beast RGB 64GB (2 x 32GB) DDR4 3200 MHz CL16 es un kit de memoria RAM de alto rendimiento que combina una gran capacidad con una velocidad de reloj rápida y una iluminación RGB personalizable. Es ideal para usuarios que necesitan un alto rendimiento en tareas de edición de video, renderizado y otros trabajos creativos, así como para jugadores que buscan un sistema potente.', 249.00, 4, 'r5'),
(29, 'Gigabyte 16Gb (2x8Gb)', 'Las memorias RAM Gigabyte DDR4 16GB (2x8GB) 3600MHz Aorus son una excelente elección para usuarios que buscan un rendimiento sólido y una estética llamativa para su sistema. Con una velocidad de reloj de 3600MHz y la iluminación RGB personalizable, son adecuadas para jugadores y entusiastas que desean un sistema de alto rendimiento con un toque visual personalizado.', 340.00, 4, 'r6'),
(30, 'ADATA LANCER 16GB', 'La memoria RAM ADATA XPG LANCER RGB 16GB 5200MHz DDR5 es una opción de alto rendimiento diseñada para entusiastas y jugadores que buscan el máximo rendimiento posible en sus sistemas. La alta velocidad de reloj y la iluminación RGB personalizable la hacen adecuada para sistemas de gama alta con una estética llamativa. Sin embargo, asegúrate de que tu placa base sea compatible con DDR5 antes de adquirirla.', 500.00, 4, 'r7'),
(31, 'G.SKILL 64GB (32GBx2)', 'El kit de memoria RAM G.SKILL 64GB (32GBx2) DDR4/3600 es una opción sólida para usuarios que buscan un alto rendimiento y una gran cantidad de memoria para sus sistemas. Ofrece un buen equilibrio entre capacidad y velocidad, lo que lo hace adecuado para aplicaciones exigentes y multitarea intensiva.', 590.00, 4, 'r8'),
(32, 'AMD Ryzen 3 4100', 'El procesador AMD Ryzen 3 4100 es una joya de la ingeniería de procesadores, diseñado para brindar un rendimiento excepcional en tareas cotidianas y multitarea ligera. Con sus 4 núcleos y 8 hilos, este procesador ofrece una capacidad de procesamiento ágil y eficiente. La arquitectura Zen+ de última generación de AMD asegura una eficiencia energética sobresaliente, lo que significa que no solo obtendrás un rendimiento potente, sino también una menor demanda de energía y una menor generación de calor.', 520.00, 2, 'p8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `cod_user` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_exp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `cod_user`, `token`, `fecha`, `fecha_exp`) VALUES
(242, 224, 'eyJ1c3VhcmlvIjoiamF2aSIsImV4cCI6MTcxNDU5Mjg3M31jbG', '2024-05-01 21:47:38', '2024-05-01 21:47:53'),
(243, 28, 'eyJ1c3VhcmlvIjoiQWRtaW4iLCJleHAiOjE3MTQ1OTI5MDV9Y2', '2024-05-01 21:48:10', '2024-05-01 21:48:25'),
(244, 224, 'eyJ1c3VhcmlvIjoiamF2aSIsImV4cCI6MTcxNDU5MjkzN31jbG', '2024-05-01 21:48:42', '2024-05-01 21:48:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `correo` varchar(90) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `perfil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod`, `usuario`, `correo`, `clave`, `perfil`) VALUES
(28, 'Admin', 'adminweb@gmail.com', '1234', 'Admin'),
(224, 'javi', 'javi@gmail.com', '1234', 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foranea` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foranea_categoria` (`categoria_id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foranea_user` (`cod_user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD CONSTRAINT `foranea` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `foranea_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `foranea_user` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
