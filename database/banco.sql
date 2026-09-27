CREATE DATABASE IF NOT EXISTS metaltech;
USE metaltech;

CREATE TABLE IF NOT EXISTS funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    carga_horaria INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS horas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT NOT NULL,
    data_trabalho DATE NOT NULL,
    entrada TIME NOT NULL,
    saida TIME NOT NULL,
    intervalo_minutos INT NOT NULL DEFAULT 0,
    quantidade_horas DECIMAL(5,2) NOT NULL,
    tipo_dia ENUM('normal', 'sabado', 'domingo') NOT NULL,
    valor_hora DECIMAL(10,2) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id) ON DELETE CASCADE
);