-- Inserindo alguns educadores de exemplo (se ainda não existirem)
INSERT INTO usuarios (nome, email, senha, tipo, foto) 
SELECT * FROM (
    SELECT 'Maria Silva', 'maria@educonnect.com', MD5('123456'), 'educador', 'images/default-profile.jpg'
) AS tmp
WHERE NOT EXISTS (
    SELECT email FROM usuarios WHERE email = 'maria@educonnect.com'
) LIMIT 1;

INSERT INTO usuarios (nome, email, senha, tipo, foto)
SELECT * FROM (
    SELECT 'João Santos', 'joao@educonnect.com', MD5('123456'), 'educador', 'images/default-profile.jpg'
) AS tmp
WHERE NOT EXISTS (
    SELECT email FROM usuarios WHERE email = 'joao@educonnect.com'
) LIMIT 1;

-- Vinculando os educadores às matérias
INSERT INTO educadores (usuario_id, materia, valor_hora, experiencia)
SELECT u.id, 'Matemática', 80.00, '5 anos de experiência em ensino médio e superior'
FROM usuarios u 
WHERE u.email = 'maria@educonnect.com'
AND NOT EXISTS (
    SELECT 1 FROM educadores WHERE usuario_id = u.id
);

INSERT INTO educadores (usuario_id, materia, valor_hora, experiencia)
SELECT u.id, 'Física', 85.00, '7 anos de experiência em cursos preparatórios'
FROM usuarios u 
WHERE u.email = 'joao@educonnect.com'
AND NOT EXISTS (
    SELECT 1 FROM educadores WHERE usuario_id = u.id
);

-- Inserindo algumas avaliações de exemplo
INSERT INTO avaliacoes (educador_id, aluno_id, avaliacao, comentario)
SELECT e.usuario_id, a.id, 4.5, 'Ótima professora, muito didática!'
FROM educadores e
JOIN usuarios u ON e.usuario_id = u.id
CROSS JOIN (SELECT id FROM usuarios WHERE tipo = 'aluno' LIMIT 1) a
WHERE u.email = 'maria@educonnect.com'
AND NOT EXISTS (
    SELECT 1 FROM avaliacoes WHERE educador_id = e.usuario_id
);
