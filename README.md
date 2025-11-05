# Projeto1PHP

Sistema de cadastro com PHP e MySQL

## Como rodar

1. Baixar e instalar o XAMPP
2. Colocar a pasta do projeto em `C:\xampp\htdocs\`
3. Abrir o phpMyAdmin (localhost/phpmyadmin)
4. Criar um banco chamado `meusite`
5. Rodar os comandos SQL abaixo
6. Acessar localhost/projeto1 no navegador

## Criar o banco de dados

Copia isso e cola no SQL do phpMyAdmin:

```sql
CREATE DATABASE IF NOT EXISTS meusite;
USE meusite;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alistamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    morre_pela_patria BOOLEAN DEFAULT FALSE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE paginas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    conteudo TEXT,
    data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT,
    data_publicacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mensagens_contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Pronto, é só isso.
