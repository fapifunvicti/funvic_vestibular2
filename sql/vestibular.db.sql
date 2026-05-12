BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "coligada" (
	"idcoligada"	INTEGER NOT NULL,
	"nome"	TEXT(255) NOT NULL DEFAULT ('Sem Nome'),
	"ativo"	INTEGER NOT NULL DEFAULT (1),
	"criado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"alterado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"deletado_em"	TEXT,
	PRIMARY KEY("idcoligada" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "curso" (
	"idcurso"	INTEGER NOT NULL,
	"nome"	TEXT(255) NOT NULL DEFAULT ('Curso Sem Nome'),
	"ativo"	INTEGER NOT NULL DEFAULT (1),
	"criado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"alterado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"deletado_em"	TEXT,
	PRIMARY KEY("idcurso" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "curso_disponivel" (
	"idcursodisponivel"	INTEGER,
	"curso_fk"	INTEGER NOT NULL,
	"coligada_fk"	INTEGER NOT NULL,
	"ensino_fk"	INTEGER NOT NULL,
	"nome"	TEXT,
	"periodo"	TEXT,
	"area"	TEXT,
	"disponivel"	INTEGER DEFAULT 1,
	"ativo"	INTEGER DEFAULT 1,
	PRIMARY KEY("idcursodisponivel" AUTOINCREMENT),
	FOREIGN KEY("coligada_fk") REFERENCES "coligada"("idcoligada"),
	FOREIGN KEY("curso_fk") REFERENCES "curso"("idcurso"),
	FOREIGN KEY("ensino_fk") REFERENCES "tipo_ensino"("idensino")
);
CREATE TABLE IF NOT EXISTS "menu_item" (
	"idmenu"	INTEGER NOT NULL,
	"pai_id"	INTEGER,
	"nome"	TEXT,
	"url"	REAL,
	"ordem"	INTEGER DEFAULT 0,
	"ativo"	INTEGER DEFAULT 1,
	"inserido_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"alterado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"deletado_em"	TEXT,
	"dropdown"	INTEGER DEFAULT 0,
	PRIMARY KEY("idmenu" AUTOINCREMENT),
	FOREIGN KEY("pai_id") REFERENCES "menu_item"("idmenu")
);
CREATE TABLE IF NOT EXISTS "processo_seletivo" (
	"idprocesso"	INTEGER NOT NULL,
	"fk_curso"	INTEGER NOT NULL,
	"fk_coligada"	INTEGER NOT NULL,
	"data_prova"	TEXT NOT NULL,
	"id_totvs"	INTEGER NOT NULL DEFAULT (0),
	"habilitar_resultado"	INTEGER DEFAULT 0,
	"data_resultado_inicio"	TEXT NOT NULL DEFAULT (datetime('now')),
	"data_resultado_fim"	TEXT,
	"inserido_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"alterado_em"	TEXT NOT NULL DEFAULT (datetime('now')),
	"deletado_em"	TEXT,
	PRIMARY KEY("idprocesso" AUTOINCREMENT),
	CONSTRAINT "processo_seletivo_coligada_FK" FOREIGN KEY("fk_coligada") REFERENCES "coligada"("idcoligada"),
	CONSTRAINT "processo_seletivo_curso_FK" FOREIGN KEY("fk_curso") REFERENCES "curso"("idcurso")
);
CREATE TABLE IF NOT EXISTS "tipo_ensino" (
	"idensino"	INTEGER,
	"nome"	TEXT,
	"inserido_em"	TEXT DEFAULT (datetime('now')),
	"atualizado_em"	TEXT DEFAULT (datetime('now')),
	"deletado_em"	TEXT,
	PRIMARY KEY("idensino" AUTOINCREMENT)
);
INSERT INTO "coligada" ("idcoligada","nome","ativo","criado_em","alterado_em","deletado_em") VALUES (3,'Pinda',1,'2026-05-11 20:05:17','2026-05-11 20:05:17',NULL),
 (4,'Mococa11',1,'2026-05-11 20:06:48','2026-05-11 20:17:31',NULL);
INSERT INTO "curso" ("idcurso","nome","ativo","criado_em","alterado_em","deletado_em") VALUES (1,'Geral',1,'2026-05-11 20:19:11','2026-05-11 20:19:47',NULL),
 (2,'Medicina',1,'2026-05-11 20:19:59','2026-05-11 20:20:09',NULL);
INSERT INTO "curso_disponivel" ("idcursodisponivel","curso_fk","coligada_fk","ensino_fk","nome","periodo","area","disponivel","ativo") VALUES (1,1,3,1,'Administração','Matutino','Humanas',1,1);
INSERT INTO "menu_item" ("idmenu","pai_id","nome","url","ordem","ativo","inserido_em","alterado_em","deletado_em","dropdown") VALUES (1,NULL,'Início','/',0,1,'2026-05-12 13:24:28','2026-05-12 13:24:28',NULL,0),
 (2,NULL,'Inscreva-se','/inscreva-se',1,1,'2026-05-12 13:25:05','2026-05-12 13:25:05',NULL,0),
 (3,NULL,'Informações','javascript:void(0);',2,1,'2026-05-12 13:25:45','2026-05-12 13:25:45',NULL,1),
 (4,NULL,'Manual do Candidato','javascript:void(0);',3,1,'2026-05-12 13:26:30','2026-05-12 13:26:30',NULL,0),
 (5,NULL,'Cursos','/cursos',4,1,'2026-05-12 13:27:16','2026-05-12 13:27:16',NULL,0),
 (6,NULL,'Resultados','/resultados',5,0,'2026-05-12 13:27:51','2026-05-12 13:27:51',NULL,0),
 (7,3,'Data da Prova','/data-prova',0,1,'2026-05-12 13:28:56','2026-05-12 13:28:56',NULL,0),
 (8,3,'Informacoes','/',0,1,'2026-05-12 17:02:58','2026-05-12 17:02:58',NULL,0);
INSERT INTO "processo_seletivo" ("idprocesso","fk_curso","fk_coligada","data_prova","id_totvs","habilitar_resultado","data_resultado_inicio","data_resultado_fim","inserido_em","alterado_em","deletado_em") VALUES (1,1,3,'0',200,0,'2026-05-11 20:27:48',NULL,'2026-05-11 20:27:48','2026-05-11 20:27:48',NULL);
INSERT INTO "tipo_ensino" ("idensino","nome","inserido_em","atualizado_em","deletado_em") VALUES (1,'Presencial','2026-05-12 17:35:38','2026-05-12 17:35:38',NULL),
 (2,'Semipresencial','2026-05-12 17:35:58','2026-05-12 17:35:58',NULL);
CREATE VIEW view_arvore_menu AS
WITH RECURSIVE menu_tree AS (
    -- âncora: itens raiz
    SELECT idmenu, pai_id, nome, url, ordem, ativo, inserido_em, alterado_em, deletado_em, 	dropdown, 0 AS nivel
    FROM menu_item
    WHERE pai_id IS NULL AND ativo = 1

    UNION ALL

    -- recursão: filhos
    SELECT m.idmenu, m.pai_id, m.nome, m.url, m.ordem, m.ativo, m.inserido_em, m.alterado_em, m.deletado_em, m.dropdown, mt.nivel + 1
    FROM menu_item m
    JOIN menu_tree mt ON m.pai_id = mt.idmenu
    WHERE m.ativo = 1
)
SELECT
    idmenu,
    pai_id,
	nome,
    printf('%s%s', printf('%.*c', nivel * 2, ' '), nome) AS nome_identado,
    url,
	ordem,
	ativo,
	inserido_em,
	alterado_em,
	deletado_em,
	dropdown,
    nivel
FROM menu_tree
ORDER BY nivel, ordem;
CREATE TRIGGER alteracao_coligada
AFTER UPDATE ON coligada
FOR EACH ROW                          -- dispara uma vez por linha alterada
BEGIN
    UPDATE coligada
        SET alterado_em = datetime('now')
        WHERE idcoligada = OLD.idcoligada;            -- OLD.id = id do registro que sofreu o UPDATE
END;
CREATE TRIGGER alteracao_curso
AFTER UPDATE ON curso
FOR EACH ROW                          -- dispara uma vez por linha alterada
BEGIN
    UPDATE curso
        SET alterado_em = datetime('now')
        WHERE idcurso = OLD.idcurso;            -- OLD.id = id do registro que sofreu o UPDATE
END;
CREATE TRIGGER alteraracao_processo
AFTER UPDATE ON processo_seletivo
FOR EACH ROW                          -- dispara uma vez por linha alterada
BEGIN
    UPDATE processo_seletivo
        SET alterado_em = datetime('now')
        WHERE idprocesso = OLD.idprocesso;            -- OLD.id = id do registro que sofreu o UPDATE
END;
COMMIT;
