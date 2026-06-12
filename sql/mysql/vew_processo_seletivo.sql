CREATE OR REPLACE VIEW view_processo_seletivo AS
SELECT 
    processo_seletivo.*,
    curso.nome AS curso_nome,
    coligada.nome AS coligada_nome,
    tipo_ensino.nome AS ensino_nome,
    coligada.coligada AS coligada_totvs,
    
    DATE_FORMAT(processo_seletivo.data_prova, '%d/%m/%Y') AS data_prova_fmt,
    DATE_FORMAT(processo_seletivo.data_resultado_inicio, '%d/%m/%Y') AS data_resultado_inicio_fmt,
    DATE_FORMAT(processo_seletivo.data_resultado_fim, '%d/%m/%Y') AS data_resultado_fim_fmt
  
FROM processo_seletivo
LEFT JOIN curso ON curso.idcurso = processo_seletivo.fk_curso
LEFT JOIN coligada ON coligada.idcoligada = processo_seletivo.fk_coligada
LEFT JOIN tipo_ensino ON tipo_ensino.idensino = processo_seletivo.fk_ensino;