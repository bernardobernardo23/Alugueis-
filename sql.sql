CREATE DATABASE aluguel_trajes;
USE aluguel_trajes;

-- Tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco VARCHAR(150)
);

-- Tabela de trajes
CREATE TABLE trajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(150) NOT NULL,
    tamanho VARCHAR(10),
    valor_aluguel DECIMAL(10,2) NOT NULL,
    disponivel BOOLEAN DEFAULT 1
);

-- Tabela de aluguéis
CREATE TABLE alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    traje_id INT NOT NULL,
    data_retirada DATE NOT NULL,
    data_devolucao DATE NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    status ENUM('Ativo','Concluído','Atrasado') DEFAULT 'Ativo',
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (traje_id) REFERENCES trajes(id)
);