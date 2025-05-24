CREATE DATABASE cartorio;
USE cartorio;
SHOW tables;

CREATE TABLE usuario(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(64) NOT NULL,
usuario VARCHAR(64) NOT NULL,
setor VARCHAR(60) NOT NULL,
senha INT NOT NULL,
email VARCHAR(100) NOT NULL,
foto VARCHAR(100) NOT NULL
);

CREATE TABLE documento(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(64) NOT NULL,
classificacao VARCHAR(30) NOT NULL
);

CREATE TABLE apresentante(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_documento INT NOT NULL,
CONSTRAINT fk_documento_with_apresentante FOREIGN KEY (id_documento) REFERENCES documento (id),
numero_documento VARCHAR(20) NOT NULL,
nome VARCHAR(64) NOT NULL,
numero_contato VARCHAR(15) NOT NULL,
email VARCHAR(100) NOT NULL,
tipo_contato VARCHAR(20) NOT NULL
);

CREATE TABLE grupo(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
sequencia INT NOT NULL,
registro INT NOT NULL
);

CREATE TABLE natureza(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(50) NOT NULL,
dias_retorno INT NOT NULL,
tipo_dias_retorno VARCHAR(10) NOT NULL
);	

CREATE TABLE especie(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL
);	

ALTER TABLE natureza ADD id_documento INT NOT NULL;
ALTER TABLE natureza DROP COLUMN id_documento;
ALTER TABLE natureza ADD id_grupo INT NOT NULL;
ALTER TABLE natureza ADD CONSTRAINT fk_grupo_with_natureza FOREIGN KEY (id_grupo) REFERENCES grupo (id);

SELECT * FROM natureza;

ALTER TABLE natureza ADD id_especie INT NOT NULL;
ALTER TABLE natureza ADD CONSTRAINT fk_especie_with_natureza FOREIGN KEY (id_especie) REFERENCES especie (id);

CREATE TABLE tipo_parte(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20) NOT NULL,
id_natureza INT NOT NULL,
CONSTRAINT fk_natureza_with_tipo_parte FOREIGN KEY (id_natureza) REFERENCES natureza (id)
);	

CREATE TABLE parte(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_tipo_parte INT NOT NULL,
CONSTRAINT fk_tipo_parte_with_parte FOREIGN KEY (id_tipo_parte) REFERENCES tipo_parte (id),
identificacao VARCHAR(100) NOT NULL
);

CREATE TABLE protocolo(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
numero_documento INT NOT NULL,
data_documento DATE NOT NULL,
data_abertura DATE DEFAULT (CURRENT_DATE),
data_cancelamento DATE,
id_grupo INT NOT NULL,
id_especie INT NOT NULL,
id_natureza INT NOT NULL,
id_apresentante INT NOT NULL,
id_usuario INT NOT NULL,
CONSTRAINT fk_grupo_with_protocolo FOREIGN KEY (id_grupo) REFERENCES grupo (id),
CONSTRAINT fk_especie_with_protocolo FOREIGN KEY (id_especie) REFERENCES especie (id),
CONSTRAINT fk_natureza_with_protocolo FOREIGN KEY (id_natureza) REFERENCES natureza (id),
CONSTRAINT fk_apresentante_with_protocolo FOREIGN KEY (id_apresentante) REFERENCES apresentante (id),
CONSTRAINT fk_usuario_with_protocolo FOREIGN KEY (id_usuario) REFERENCES usuario (id)
);

INSERT INTO protocolo (data_abertura, data_cancelamento)
VALUES (
    CURRENT_DATE,
    CURRENT_DATE + INTERVAL 30 DAY
);

ALTER TABLE usuario
MODIFY COLUMN senha VARCHAR(255) NOT NULL;

ALTER TABLE usuario
MODIFY COLUMN email VARCHAR(255) UNIQUE NOT NULL;

-- mostra definicoes da tabela
DESCRIBE usuario;

CREATE TABLE tipo_andamento(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(50) NOT NULL,
possui_valor VARCHAR(3) NOT NULL
);

CREATE TABLE andamento(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
valor DECIMAL(10, 2) DEFAULT 0.00,
observacao VARCHAR(255) NOT NULL,
id_tipo_andamento INT NOT NULL,
id_usuario INT NOT NULL,
id_protocolo INT NOT NULL,
CONSTRAINT fk_tipo_andamento_with_andamento FOREIGN KEY (id_tipo_andamento) REFERENCES tipo_andamento (id),
CONSTRAINT fk_usuario_with_andamento FOREIGN KEY (id_usuario) REFERENCES usuario (id),
CONSTRAINT fk_protocolo_with_andamento FOREIGN KEY (id_protocolo) REFERENCES protocolo (id)
);

CREATE TABLE forma_pagamento(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(20)
);

ALTER TABLE protocolo ADD numero_protocolo INT NOT NULL;
ALTER TABLE protocolo ADD numero_registro INT;
ALTER TABLE protocolo ADD data_retirada DATETIME;

DESCRIBE protocolo;

CREATE TABLE autenticacao(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
valor NUMERIC(10, 2) NOT NULL,
data_autenticacao DATETIME,
numero_cheque INT,
agencia VARCHAR(6),                
conta VARCHAR(15),
banco VARCHAR(30),
id_usuario INT NOT NULL,
id_protocolo INT NOT NULL,
id_forma_pagamento INT NOT NULL,
CONSTRAINT fk_usuario_with_autenticacao FOREIGN KEY (id_usuario) REFERENCES usuario (id),
CONSTRAINT fk_protocolo_with_autenticacao FOREIGN KEY (id_protocolo) REFERENCES protocolo (id),
CONSTRAINT fk_forma_pagamento_with_autenticacao FOREIGN KEY (id_forma_pagamento) REFERENCES forma_pagamento (id)
);

ALTER TABLE autenticacao ADD ordem INT NOT NULL;
ALTER TABLE autenticacao ADD tipo VARCHAR(2) NOT NULL;


