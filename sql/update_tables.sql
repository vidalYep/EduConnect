-- Adicionando campos necessários na tabela educadores
ALTER TABLE educadores
ADD COLUMN IF NOT EXISTS valor_hora DECIMAL(10,2) NOT NULL DEFAULT 0.00,
ADD COLUMN IF NOT EXISTS experiencia TEXT;

-- Criando tabela de avaliações
CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    educador_id INT NOT NULL,
    aluno_id INT NOT NULL,
    avaliacao DECIMAL(3,1) NOT NULL CHECK (avaliacao >= 0 AND avaliacao <= 5),
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (educador_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
