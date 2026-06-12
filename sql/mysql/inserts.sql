INSERT INTO coligada (idcoligada, nome, ativo, criado_em, alterado_em, deletado_em, coligada) VALUES 
(2, 'Mococa', 1, '2026-05-11 20:06:48', '2026-06-10 15:35:04', NULL, 2),
(3, 'Pinda', 1, '2026-05-11 20:05:17', '2026-05-11 20:05:17', NULL, 1);

INSERT INTO tipo_ensino (idensino, nome, inserido_em, atualizado_em, deletado_em) VALUES 
(1, 'Presencial', '2026-05-12 17:35:38', '2026-05-12 17:35:38', NULL),
(2, 'Semipresencial', '2026-05-12 17:35:58', '2026-05-12 17:35:58', NULL);


INSERT INTO curso (idcurso, nome, ativo, criado_em, alterado_em, deletado_em) VALUES 
(1, 'Geral', 1, '2026-05-11 20:19:11', '2026-05-19 13:15:49', NULL),
(2, 'Medicina', 1, '2026-05-11 20:19:59', '2026-05-21 13:42:20', NULL);

INSERT INTO curso_disponivel (idcursodisponivel, curso_fk, coligada_fk, ensino_fk, nome, periodo, area, disponivel, ativo) VALUES 
(1, 1, 3, 1, 'Administração', 'Matutino', 'Humanas', 1, 1);

INSERT INTO menu_item (idmenu, pai_id, nome, url, ordem, ativo, inserido_em, alterado_em, deletado_em, dropdown) VALUES 
(1, NULL, 'Início', '/', 0, 1, '2026-05-12 13:24:28', '2026-05-21 09:45:36', NULL, 0),
(2, 3, 'Inscreva-se', '/inscreva-se', 1, 1, '2026-05-12 13:25:05', '2026-05-20 16:57:49', NULL, 0),
(3, NULL, 'Informações', 'javascript:void(0);', 1, 1, '2026-05-12 13:25:45', '2026-05-21 09:39:36', NULL, 1),
(4, NULL, 'Manual do Candidato', 'javascript:void(0);', 1, 1, '2026-05-12 13:26:30', '2026-05-21 09:39:50', NULL, 0),
(5, NULL, 'Cursos', '/cursos', 4, 1, '2026-05-12 13:27:16', '2026-05-20 15:56:51', NULL, 0),
(6, NULL, 'Resultados', '/resultado', 8, 1, '2026-05-12 13:27:51', '2026-05-25 12:28:23', NULL, 0),
(7, 3, 'Data da Prova', '/data-prova', 6, 1, '2026-05-12 13:28:56', '2026-05-20 16:50:40', NULL, 0),
(8, NULL, 'Informacoes', '/', 7, 0, '2026-05-12 17:02:58', '2026-05-25 11:12:20', NULL, 1),
(9, NULL, 'TESTE', NULL, 5, 0, '2026-05-21 09:24:35', '2026-05-21 10:04:43', NULL, 1);

INSERT INTO processo_seletivo (idprocesso, fk_curso, fk_coligada, fk_ensino, nome, data_prova, id_totvs, habilitar_resultado, data_resultado_inicio, data_resultado_fim, inserido_em, alterado_em, deletado_em, categoria, tipo_resultado) VALUES 
(2, 1, 3, 1, 'Vestibular 2 Semestre Presencial', '2026-05-21 13:54:04', 201, 1, '2026-05-21 13:54:04', '2026-06-01 11:56', '2026-05-21 13:54:04', '2026-06-10 15:19:44', NULL, 3, 0),
(3, 2, 2, 2, 'TESTE', '2026-05-21 14:02:50', 0, 0, '2026-05-21 14:02:50', '2026-06-02 10:11', '2026-05-21 14:02:50', '2026-06-02 13:11:51', NULL, 1, 0),
(8, 1, 2, 1, 'Vestibular 2 Semetre111', '2026-06-02 11:20', 0, 0, '2026-06-02 11:20', '2026-06-19 11:20', '2026-06-02 11:23:38', '2026-06-02 11:23:38', NULL, 1, 0),
(9, 1, 2, 2, 'TESTE PROCESSO 123', '2026-06-02 11:23', 0, 0, '2026-06-02 12:23', '2026-06-02 11:24', '2026-06-02 11:24:03', '2026-06-10 15:19:51', NULL, 1, 0);


INSERT INTO usuario (idusuario, email, senha, permissao, ultimo_login, inserido_em, alterado_em, deletado_em) VALUES 
(1, 'nicholasluis@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$dW1QRFNuWHhwdGVMUFhqTA$uk0x6IcxB6Tngni9gGMji3wVS0ImPKDPweqoRox0Mzw', 999, '2026-05-13 12:14:52', '2026-05-13 12:14:52', '2026-05-13 12:14:52', NULL);