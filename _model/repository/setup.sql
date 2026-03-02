CREATE DATABASE IF NOT EXISTS dashboard_app
  CHARACTER SET = 'utf8mb4';

USE dashboard_app;

CREATE TABLE IF NOT EXISTS `fornecedor`(
  `id_fornecedor` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(31) NOT NULL,
  `e-mail` varchar(255) NOT NULL,
  `telefone` varchar(31) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_fornecedor`)
);

CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descrição` varchar(511) NOT NULL,
  `código` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produto`)
);

CREATE TABLE IF NOT EXISTS `produto_fornecedor` (
  `id_produto` mediumint unsigned NOT NULL,
  `id_fornecedor` smallint unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produto`,`id_fornecedor`),
  CONSTRAINT `fk_produto_fornecedor_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_produto_fornecedor_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`) ON DELETE RESTRICT ON UPDATE CASCADE
);
