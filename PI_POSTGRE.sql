-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION postgres;

-- DROP SEQUENCE public.andamento_id_seq;

CREATE SEQUENCE public.andamento_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.apresentante_id_seq;

CREATE SEQUENCE public.apresentante_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.autenticacao_id_seq;

CREATE SEQUENCE public.autenticacao_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.documento_id_seq;

CREATE SEQUENCE public.documento_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.especie_id_seq;

CREATE SEQUENCE public.especie_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.failed_jobs_id_seq;

CREATE SEQUENCE public.failed_jobs_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.forma_pagamento_id_seq;

CREATE SEQUENCE public.forma_pagamento_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.grupo_id_seq;

CREATE SEQUENCE public.grupo_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.jobs_id_seq;

CREATE SEQUENCE public.jobs_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.migrations_id_seq;

CREATE SEQUENCE public.migrations_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.natureza_id_seq;

CREATE SEQUENCE public.natureza_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.parte_id_seq;

CREATE SEQUENCE public.parte_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.protocolo_id_seq;

CREATE SEQUENCE public.protocolo_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.seq_grupo_1;

CREATE SEQUENCE public.seq_grupo_1
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 20000000
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.seq_grupo_2;

CREATE SEQUENCE public.seq_grupo_2
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 10000000
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.seq_numero_protocolo;

CREATE SEQUENCE public.seq_numero_protocolo
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.tipo_andamento_id_seq;

CREATE SEQUENCE public.tipo_andamento_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.tipo_parte_id_seq;

CREATE SEQUENCE public.tipo_parte_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.usuario_id_seq;

CREATE SEQUENCE public.usuario_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;-- public."cache" definição

-- Drop table

-- DROP TABLE public."cache";

CREATE TABLE public."cache" (
	"key" varchar(255) NOT NULL,
	value text NOT NULL,
	expiration int4 NOT NULL,
	CONSTRAINT cache_pkey PRIMARY KEY (key)
);


-- public.cache_locks definição

-- Drop table

-- DROP TABLE public.cache_locks;

CREATE TABLE public.cache_locks (
	"key" varchar(255) NOT NULL,
	"owner" varchar(255) NOT NULL,
	expiration int4 NOT NULL,
	CONSTRAINT cache_locks_pkey PRIMARY KEY (key)
);


-- public.documento definição

-- Drop table

-- DROP TABLE public.documento;

CREATE TABLE public.documento (
	id bigserial NOT NULL,
	tipo varchar(64) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT documento_pkey PRIMARY KEY (id)
);


-- public.especie definição

-- Drop table

-- DROP TABLE public.especie;

CREATE TABLE public.especie (
	id bigserial NOT NULL,
	tipo varchar(20) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT especie_pkey PRIMARY KEY (id)
);


-- public.failed_jobs definição

-- Drop table

-- DROP TABLE public.failed_jobs;

CREATE TABLE public.failed_jobs (
	id bigserial NOT NULL,
	"uuid" varchar(255) NOT NULL,
	"connection" text NOT NULL,
	queue text NOT NULL,
	payload text NOT NULL,
	"exception" text NOT NULL,
	failed_at timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
	CONSTRAINT failed_jobs_pkey PRIMARY KEY (id),
	CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid)
);


-- public.forma_pagamento definição

-- Drop table

-- DROP TABLE public.forma_pagamento;

CREATE TABLE public.forma_pagamento (
	id bigserial NOT NULL,
	tipo varchar(20) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT forma_pagamento_pkey PRIMARY KEY (id)
);


-- public.grupo definição

-- Drop table

-- DROP TABLE public.grupo;

CREATE TABLE public.grupo (
	id bigserial NOT NULL,
	tipo varchar(50) NOT NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT grupo_pkey PRIMARY KEY (id)
);


-- public.job_batches definição

-- Drop table

-- DROP TABLE public.job_batches;

CREATE TABLE public.job_batches (
	id varchar(255) NOT NULL,
	"name" varchar(255) NOT NULL,
	total_jobs int4 NOT NULL,
	pending_jobs int4 NOT NULL,
	failed_jobs int4 NOT NULL,
	failed_job_ids text NOT NULL,
	"options" text NULL,
	cancelled_at int4 NULL,
	created_at int4 NOT NULL,
	finished_at int4 NULL,
	CONSTRAINT job_batches_pkey PRIMARY KEY (id)
);


-- public.jobs definição

-- Drop table

-- DROP TABLE public.jobs;

CREATE TABLE public.jobs (
	id bigserial NOT NULL,
	queue varchar(255) NOT NULL,
	payload text NOT NULL,
	attempts int2 NOT NULL,
	reserved_at int4 NULL,
	available_at int4 NOT NULL,
	created_at int4 NOT NULL,
	CONSTRAINT jobs_pkey PRIMARY KEY (id)
);
CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


-- public.migrations definição

-- Drop table

-- DROP TABLE public.migrations;

CREATE TABLE public.migrations (
	id serial4 NOT NULL,
	migration varchar(255) NOT NULL,
	batch int4 NOT NULL,
	CONSTRAINT migrations_pkey PRIMARY KEY (id)
);


-- public.password_reset_tokens definição

-- Drop table

-- DROP TABLE public.password_reset_tokens;

CREATE TABLE public.password_reset_tokens (
	email varchar(255) NOT NULL,
	"token" varchar(255) NOT NULL,
	created_at timestamp(0) NULL,
	CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email)
);


-- public.sessions definição

-- Drop table

-- DROP TABLE public.sessions;

CREATE TABLE public.sessions (
	id varchar(255) NOT NULL,
	user_id int8 NULL,
	ip_address varchar(45) NULL,
	user_agent text NULL,
	payload text NOT NULL,
	last_activity int4 NOT NULL,
	CONSTRAINT sessions_pkey PRIMARY KEY (id)
);
CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


-- public.tipo_andamento definição

-- Drop table

-- DROP TABLE public.tipo_andamento;

CREATE TABLE public.tipo_andamento (
	id bigserial NOT NULL,
	tipo varchar(50) NOT NULL,
	possui_valor varchar(3) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT tipo_andamento_pkey PRIMARY KEY (id)
);


-- public.usuario definição

-- Drop table

-- DROP TABLE public.usuario;

CREATE TABLE public.usuario (
	id bigserial NOT NULL,
	nome varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	email_verified_at timestamp(0) NULL,
	"password" varchar(255) NOT NULL,
	telefone varchar(255) NOT NULL,
	endereco varchar(255) NOT NULL,
	setor varchar(255) NOT NULL,
	usuario varchar(255) NOT NULL,
	foto varchar(255) NULL,
	remember_token varchar(100) NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT usuario_email_unique UNIQUE (email),
	CONSTRAINT usuario_pkey PRIMARY KEY (id)
);


-- public.apresentante definição

-- Drop table

-- DROP TABLE public.apresentante;

CREATE TABLE public.apresentante (
	id bigserial NOT NULL,
	id_documento int8 NOT NULL,
	numero_documento varchar(20) NOT NULL,
	nome varchar(64) NOT NULL,
	numero_contato varchar(15) NOT NULL,
	email varchar(100) NOT NULL,
	tipo_contato varchar(100) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT apresentante_pkey PRIMARY KEY (id),
	CONSTRAINT apresentante_id_documento_foreign FOREIGN KEY (id_documento) REFERENCES public.documento(id)
);


-- public.natureza definição

-- Drop table

-- DROP TABLE public.natureza;

CREATE TABLE public.natureza (
	id bigserial NOT NULL,
	tipo varchar(50) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	id_grupo int8 NOT NULL,
	CONSTRAINT natureza_pkey PRIMARY KEY (id),
	CONSTRAINT natureza_id_grupo_fkey FOREIGN KEY (id_grupo) REFERENCES public.grupo(id) ON UPDATE CASCADE
);


-- public.protocolo definição

-- Drop table

-- DROP TABLE public.protocolo;

CREATE TABLE public.protocolo (
	id bigserial NOT NULL,
	numero_documento int4 NOT NULL,
	data_documento date NOT NULL,
	data_abertura date DEFAULT CURRENT_DATE NOT NULL,
	data_cancelamento date NULL,
	numero_protocolo int4 NULL,
	numero_registro int4 NULL,
	data_retirada timestamp(0) NULL,
	data_registro timestamp(0) NULL,
	id_usuario int8 NOT NULL,
	id_apresentante int8 NOT NULL,
	id_grupo int8 NOT NULL,
	id_especie int8 NOT NULL,
	id_natureza int8 NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT protocolo_pkey PRIMARY KEY (id),
	CONSTRAINT protocolo_id_apresentante_foreign FOREIGN KEY (id_apresentante) REFERENCES public.apresentante(id),
	CONSTRAINT protocolo_id_especie_foreign FOREIGN KEY (id_especie) REFERENCES public.especie(id),
	CONSTRAINT protocolo_id_grupo_foreign FOREIGN KEY (id_grupo) REFERENCES public.grupo(id),
	CONSTRAINT protocolo_id_natureza_foreign FOREIGN KEY (id_natureza) REFERENCES public.natureza(id),
	CONSTRAINT protocolo_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.usuario(id)
);

-- Table Triggers

create trigger trg_numero_protocolo before
insert
    on
    public.protocolo for each row execute function atribui_numero_protocolo();


-- public.tipo_parte definição

-- Drop table

-- DROP TABLE public.tipo_parte;

CREATE TABLE public.tipo_parte (
	id bigserial NOT NULL,
	tipo varchar(20) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	id_grupo int8 NOT NULL,
	CONSTRAINT tipo_parte_pkey PRIMARY KEY (id),
	CONSTRAINT tipo_parte_id_grupo_fkey FOREIGN KEY (id_grupo) REFERENCES public.grupo(id)
);


-- public.andamento definição

-- Drop table

-- DROP TABLE public.andamento;

CREATE TABLE public.andamento (
	id bigserial NOT NULL,
	data_hora timestamp(0) DEFAULT '2025-06-03 23:25:19'::timestamp without time zone NOT NULL,
	valor numeric(10, 2) DEFAULT '0'::numeric NOT NULL,
	observacao varchar(255) NULL,
	id_tipo_andamento int8 NOT NULL,
	id_usuario int8 NOT NULL,
	id_protocolo int8 NOT NULL,
	updated_at timestamptz NULL,
	created_at timestamptz NULL,
	CONSTRAINT andamento_pkey PRIMARY KEY (id),
	CONSTRAINT andamento_id_protocolo_foreign FOREIGN KEY (id_protocolo) REFERENCES public.protocolo(id),
	CONSTRAINT andamento_id_tipo_andamento_foreign FOREIGN KEY (id_tipo_andamento) REFERENCES public.tipo_andamento(id),
	CONSTRAINT andamento_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.usuario(id)
);


-- public.autenticacao definição

-- Drop table

-- DROP TABLE public.autenticacao;

CREATE TABLE public.autenticacao (
	id bigserial NOT NULL,
	valor numeric(10, 2) DEFAULT '0'::numeric NOT NULL,
	data_autenticacao date NULL,
	numero_cheque int4 NULL,
	agencia varchar(6) NULL,
	conta varchar(15) NULL,
	banco varchar(30) NULL,
	id_usuario int8 NOT NULL,
	id_protocolo int8 NOT NULL,
	id_forma_pagamento int8 NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	CONSTRAINT autenticacao_pkey PRIMARY KEY (id),
	CONSTRAINT autenticacao_id_forma_pagamento_foreign FOREIGN KEY (id_forma_pagamento) REFERENCES public.forma_pagamento(id),
	CONSTRAINT autenticacao_id_protocolo_foreign FOREIGN KEY (id_protocolo) REFERENCES public.protocolo(id),
	CONSTRAINT autenticacao_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.usuario(id)
);


-- public.parte definição

-- Drop table

-- DROP TABLE public.parte;

CREATE TABLE public.parte (
	id bigserial NOT NULL,
	identificacao varchar(100) NOT NULL,
	created_at timestamp(0) NULL,
	updated_at timestamp(0) NULL,
	id_tipo_parte int8 NOT NULL,
	id_protocolo int8 NOT NULL,
	CONSTRAINT parte_pkey PRIMARY KEY (id),
	CONSTRAINT parte_id_protocolo_foreign FOREIGN KEY (id_protocolo) REFERENCES public.protocolo(id),
	CONSTRAINT parte_id_tipo_parte_foreign FOREIGN KEY (id_tipo_parte) REFERENCES public.tipo_parte(id)
);



-- DROP FUNCTION public.atribui_numero_protocolo();

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
;

-- Inserir dados na tabela grupo
INSERT INTO grupo (id, tipo) VALUES
(1, 'Títulos e Documentos'),
(2, 'Pessoa Jurídica');

-- Inserir dados na tabela natureza
INSERT INTO natureza (id, tipo, id_grupo) VALUES
(1, 'Ata de Condomínio', 1),
(2, 'Cédula de Crédito', 1),
(3, 'Conservação', 1),
(4, 'Notificação', 1),
(5, 'Tradução', 1),
(6, 'Ata de Assembleia', 2),
(7, 'Abertura de Filial', 2),
(8, 'Contrato Social', 2),
(9, 'Distrato', 2),
(10, 'Estatuto', 2);

-- Inserir dados na tabela especie
INSERT INTO especie (id, tipo) VALUES
(1, 'Registro'),
(2, 'Averbação');

-- Inserir dados na tabela documento
INSERT INTO documento (id, tipo) VALUES
(1, 'RG'),
(2, 'CPF'),
(3, 'CNH'),
(4, 'CNPJ');

-- Inserir dados na tabela tipo_parte
INSERT INTO tipo_parte (id, tipo, id_grupo) VALUES
(1, 'Condomínio', 1),
(2, 'Destinatário', 1),
(3, 'Emitente', 1),
(4, 'Parte', 1),
(5, 'Remetente', 1),
(6, 'Síndico', 1),
(7, 'Associação', 2),
(8, 'Diretor Executivo', 2),
(9, 'Presidente', 2),
(10, 'Secretário', 2),
(11, 'Sócio', 2);