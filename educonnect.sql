CREATE DATABASE educonnect;
USE educonnect;

-- Tabela principal de autenticação
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('aluno', 'educador', 'admin')  NOT NULL
);

-- Detalhes dos alunos
CREATE TABLE alunos (
  usuario_id INT PRIMARY KEY,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Detalhes dos educadores
CREATE TABLE educadores (
  usuario_id INT PRIMARY KEY,
  materia VARCHAR(100),
  bairro VARCHAR(100),
  cidade VARCHAR(100),
  avaliacao DECIMAL(2,1),
  foto VARCHAR(255),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Detalhes dos admins
CREATE TABLE admins (
  usuario_id INT PRIMARY KEY,
  nivel_acesso INT DEFAULT 1,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Agendamentos conectando aluno a educador
CREATE TABLE agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  educador_id INT,
  data DATETIME,
  FOREIGN KEY (aluno_id) REFERENCES usuarios(id),
  FOREIGN KEY (educador_id) REFERENCES usuarios(id)
);

select * from usuarios;
select * from alunos;
select * from educadores;
select * from admins;
select * from agendamentos;

show tables;

SELECT * FROM agendamentos;






