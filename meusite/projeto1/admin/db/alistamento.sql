CREATE TABLE IF NOT EXISTS alistamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    morre_pela_patria BOOLEAN DEFAULT FALSE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Adicionar coluna numero se a tabela já existe
ALTER TABLE alistamentos ADD COLUMN IF NOT EXISTS numero VARCHAR(20) NOT NULL DEFAULT '';