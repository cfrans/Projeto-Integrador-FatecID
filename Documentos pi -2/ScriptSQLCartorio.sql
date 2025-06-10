CREATE TABLE grupo(
    id SERIAL NOT NULL,
    tipo varchar(50) NOT NULL,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE natureza(
    id SERIAL NOT NULL,
    tipo varchar(50) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id_grupo bigint NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT natureza_id_grupo_fkey FOREIGN key(id_grupo) REFERENCES grupo(id)
);

CREATE TABLE especie(
    id SERIAL NOT NULL,
    tipo varchar(20) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE documento(
    id SERIAL NOT NULL,
    tipo varchar(64) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE apresentante(
    id SERIAL NOT NULL,
    id_documento bigint NOT NULL,
    numero_documento varchar(20) NOT NULL,
    nome varchar(64) NOT NULL,
    numero_contato varchar(15) NOT NULL,
    email varchar(100) NOT NULL,
    tipo_contato varchar(100) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT apresentante_id_documento_foreign FOREIGN key(id_documento) REFERENCES documento(id)
);

CREATE TABLE tipo_parte(
    id SERIAL NOT NULL,
    tipo varchar(20) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id_grupo bigint NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT tipo_parte_id_grupo_fkey FOREIGN key(id_grupo) REFERENCES grupo(id)
);

CREATE TABLE parte(
    id SERIAL NOT NULL,
    identificacao varchar(100) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id_tipo_parte bigint NOT NULL,
    id_protocolo bigint NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT parte_id_protocolo_foreign FOREIGN key(id_protocolo) REFERENCES protocolo(id),
    CONSTRAINT parte_id_tipo_parte_foreign FOREIGN key(id_tipo_parte) REFERENCES tipo_parte(id)
);


CREATE TABLE forma_pagamento(
    id SERIAL NOT NULL,
    tipo varchar(20) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE usuario(
    id SERIAL NOT NULL,
    nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    email_verified_at timestamp without time zone,
    password varchar(255) NOT NULL,
    telefone varchar(255) NOT NULL,
    endereco varchar(255) NOT NULL,
    setor varchar(255) NOT NULL,
    usuario varchar(255) NOT NULL,
    foto varchar(255),
    remember_token varchar(100),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);
CREATE UNIQUE INDEX usuario_email_unique ON public.usuario USING btree (email);

CREATE TABLE protocolo(
    id SERIAL NOT NULL,
    numero_documento integer NOT NULL,
    data_documento date NOT NULL,
    data_abertura date NOT NULL DEFAULT CURRENT_DATE,
    data_cancelamento date,
    numero_protocolo integer,
    numero_registro integer,
    data_retirada timestamp without time zone,
    data_registro timestamp without time zone,
    id_usuario bigint NOT NULL,
    id_apresentante bigint NOT NULL,
    id_grupo bigint NOT NULL,
    id_especie bigint NOT NULL,
    id_natureza bigint NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT protocolo_id_apresentante_foreign FOREIGN key(id_apresentante) REFERENCES apresentante(id),
    CONSTRAINT protocolo_id_especie_foreign FOREIGN key(id_especie) REFERENCES especie(id),
    CONSTRAINT protocolo_id_grupo_foreign FOREIGN key(id_grupo) REFERENCES grupo(id),
    CONSTRAINT protocolo_id_natureza_foreign FOREIGN key(id_natureza) REFERENCES natureza(id),
    CONSTRAINT protocolo_id_usuario_foreign FOREIGN key(id_usuario) REFERENCES usuario(id)
);

CREATE TABLE autenticacao(
    id SERIAL NOT NULL,
    valor numeric(10,2) NOT NULL DEFAULT '0'::numeric,
    data_autenticacao date,
    numero_cheque integer,
    agencia varchar(6),
    conta varchar(15),
    banco varchar(30),
    id_usuario bigint NOT NULL,
    id_protocolo bigint NOT NULL,
    id_forma_pagamento bigint NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT autenticacao_id_forma_pagamento_foreign FOREIGN key(id_forma_pagamento) REFERENCES forma_pagamento(id),
    CONSTRAINT autenticacao_id_protocolo_foreign FOREIGN key(id_protocolo) REFERENCES protocolo(id),
    CONSTRAINT autenticacao_id_usuario_foreign FOREIGN key(id_usuario) REFERENCES usuario(id)
);

CREATE TABLE tipo_andamento(
    id SERIAL NOT NULL,
    tipo varchar(50) NOT NULL,
    possui_valor varchar(3) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE andamento(
    id SERIAL NOT NULL,
    data_hora timestamp without time zone NOT NULL DEFAULT '2025-06-03 23:25:19'::timestamp without time zone,
    valor numeric(10,2) NOT NULL DEFAULT '0'::numeric,
    observacao varchar(255),
    id_tipo_andamento bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_protocolo bigint NOT NULL,
    updated_at timestamp with time zone,
    created_at timestamp with time zone,
    PRIMARY KEY(id),
    CONSTRAINT andamento_id_protocolo_foreign FOREIGN key(id_protocolo) REFERENCES protocolo(id),
    CONSTRAINT andamento_id_tipo_andamento_foreign FOREIGN key(id_tipo_andamento) REFERENCES tipo_andamento(id),
    CONSTRAINT andamento_id_usuario_foreign FOREIGN key(id_usuario) REFERENCES usuario(id)
);

CREATE OR REPLACE FUNCTION public.atribui_numero_protocolo()
 RETURNS trigger
 LANGUAGE plpgsql
 SET search_path TO 'public'
AS $function$
BEGIN
    IF NEW.numero_protocolo IS NULL THEN
        IF NEW.id_grupo = 1 THEN
            NEW.numero_protocolo := nextval('seq_grupo_1');
        ELSIF NEW.id_grupo = 2 THEN
            NEW.numero_protocolo := nextval('seq_grupo_2');
        END IF;
    END IF;
    RETURN NEW;
END;
$function$


INSERT INTO grupo (id, tipo, updated_at) VALUES
(1, 'Títulos e Documentos', NOW()),
(2, 'Pessoa Jurídica', NOW());


INSERT INTO natureza (id, tipo, created_at, updated_at, id_grupo) VALUES
(1, 'Ata de Condomínio', NOW(), NOW(), 1),
(2, 'Cedula de Crédito', NOW(), NOW(), 1),
(3, 'Conservação', NOW(), NOW(), 1),
(4, 'Notificação', NOW(), NOW(), 1),
(5, 'Tradução', NOW(), NOW(), 1),


(6, 'Ata de Assembleia', NOW(), NOW(), 2),
(7, 'Abertura de Filial', NOW(), NOW(), 2),
(8, 'Contrato Social', NOW(), NOW(), 2),
(9, 'Distrato', NOW(), NOW(), 2),
(10, 'Estatuto', NOW(), NOW(), 2);


INSERT INTO especie (id, tipo, created_at, updated_at) VALUES
(1, 'Registro', NOW(), NOW()),
(2, 'Averbação', NOW(), NOW());


INSERT INTO documento (id, tipo, created_at, updated_at) VALUES
(1, 'RG', NOW(), NOW()),
(2, 'CPF', NOW(), NOW()),
(3, 'CNH', NOW(), NOW()),
(4, 'CNPJ', NOW(), NOW());


INSERT INTO tipo_parte (id, tipo, created_at, updated_at, id_grupo) VALUES
(1, 'Condomínio', NOW(), NOW(), 1),
(2, 'Destinatário', NOW(), NOW(), 1),
(3, 'Emitente', NOW(), NOW(), 1),
(4, 'Parte', NOW(), NOW(), 1),
(5, 'Remetente', NOW(), NOW(), 1),
(6, 'Síndico', NOW(), NOW(), 1),
(7, 'Associação', NOW(), NOW(), 2),
(8, 'Diretor Executivo', NOW(), NOW(), 2),
(9, 'Presidente', NOW(), NOW(), 2),
(10, 'Secretário', NOW(), NOW(), 2),
(11, 'Sócio', NOW(), NOW(), 2);

