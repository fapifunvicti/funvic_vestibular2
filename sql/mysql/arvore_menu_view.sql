CREATE OR REPLACE VIEW view_arvore_menu AS
WITH RECURSIVE menu_tree AS (
    -- âncora: itens raiz
    SELECT idmenu, pai_id, nome, url, ordem, ativo, inserido_em, alterado_em, deletado_em, dropdown, 0 AS nivel
    FROM menu_item
    WHERE pai_id IS NULL 
    -- AND ativo = 1

    UNION ALL

    -- recursão: filhos
    SELECT m.idmenu, m.pai_id, m.nome, m.url, m.ordem, m.ativo, m.inserido_em, m.alterado_em, m.deletado_em, m.dropdown, mt.nivel + 1
    FROM menu_item m
    JOIN menu_tree mt ON m.pai_id = mt.idmenu
    -- WHERE m.ativo = 1
)
SELECT
    idmenu,
    pai_id,
    nome,
    CONCAT(REPEAT(' ', nivel * 2), nome) AS nome_identado,
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