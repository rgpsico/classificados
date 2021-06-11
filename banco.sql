-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para classificados
CREATE DATABASE IF NOT EXISTS `classificados` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `classificados`;

-- Copiando estrutura para tabela classificados.anuncios
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT '',
  `valor` float NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  `descricao` text,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela classificados.anuncios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` (`id`, `id_categoria`, `titulo`, `valor`, `id_usuario`, `descricao`, `estado`) VALUES
	(2, 3, 'roger neves', 21, 1, 'eee', 0),
	(4, 3, 'roger neves 11', 21, 1, 'eee', 0),
	(7, 1, 'roger neves', 21, 1, 'olha sÃƒÂ³ ', 0);
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;

-- Copiando estrutura para tabela classificados.anuncios_imagens
CREATE TABLE IF NOT EXISTS `anuncios_imagens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL DEFAULT '',
  `id_anuncio` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela classificados.anuncios_imagens: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios_imagens` DISABLE KEYS */;
INSERT INTO `anuncios_imagens` (`id`, `url`, `id_anuncio`) VALUES
	(64, 'e25aa0dcaceeaf0a042409e8a71c4650.jpg', 4),
	(65, 'c991efe5e3e01d7bfdff2e5163e843e1.jpg', 2),
	(66, '1288265a11d0959d29dee8ac9f11aa64.jpg', 2),
	(67, '954f35a43eafcd722510ca271859b223.jpg', 7),
	(68, '65b51be9cced27dcc169228158da5808.jpg', 2),
	(69, 'ea8ee0e0a235bd5cc4191ce4514c6c8c.jpg', 2),
	(70, 'c8366f0809c6ada5899938bfffbf2c4c.jpg', 2);
/*!40000 ALTER TABLE `anuncios_imagens` ENABLE KEYS */;

-- Copiando estrutura para tabela classificados.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela classificados.categoria: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nome`) VALUES
	(1, 'relogio'),
	(2, 'Roupas'),
	(3, 'Eletronicas');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela classificados.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela classificados.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`) VALUES
	(1, 'roger', 'yuripsico2010@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '21990271287');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
