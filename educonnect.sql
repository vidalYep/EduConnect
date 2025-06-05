CREATE DATABASE educonnect;
USE educonnect;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL
);

select * from usuarios;

CREATE TABLE agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  professor_id INT,
  data DATETIME,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (professor_id) REFERENCES professores(id)
);

CREATE TABLE educadores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  materia VARCHAR(100),
  bairro VARCHAR(100),
  cidade VARCHAR(100),
  avaliacao DECIMAL(2,1),
  foto VARCHAR(255)
);

select * from educadores;

INSERT INTO educadores (nome, email, materia, bairro, cidade, avaliacao, foto)
VALUES
('Carlos Lima', 'carlos@educonnect', 'Matemática', 'Centro', 'São Paulo', 4.7, 'images/educadores.png'),
('Ana Souza', 'ana@educonnect', 'Português', 'Jardins', 'São Paulo', 4.9, 'images/educadores.png'),
('João Pedro', 'joao@educonnect', 'História', 'Tijuca', 'Rio de Janeiro', 4.6, 'images/educadores.png');