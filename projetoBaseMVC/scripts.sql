-- Issue eproc/eproc2#618 Criação do evento: Revogado o acordo de não persecução penal
-- Issue eproc/eproc2#615 Criação do evento: Juntada de Dossiê Previdenciário
--

CREATE TABLE eproc_1grau_develop.evento_criacao_paradigma
(
    id_evento_judicial_v2 int NOT NULL,
    cod_evento_v2 char(10),
    id_evento_judicial_tu int NOT NULL,
    cod_evento_tu char(10),
    des_evento_tu varchar(255) NOT NULL,
    cod_mni_movimento int,
    cod_mni_tabelado int,
    operacao char(1),
    sin_evento_migrado char(1)
);

-- operacao:
-- E - Exclusão
-- M - Migração - de eventoA para eventoB
-- N - Novo
-- D - Desmembrar
-- F - Desmembrar
-- U - Unificar
-- V - Unificar

INSERT INTO eproc_1grau_develop.evento_criacao_paradigma(id_evento_judicial_v2,cod_evento_v2,id_evento_judicial_tu,cod_evento_tu,des_evento_tu,cod_mni_movimento,cod_mni_tabelado,operacao,sin_evento_migrado) 
VALUES(40400809,'540400809',40400884,'540400884','Revogado o acordo de não persecução penal',12734,null,'N','N'),(40400380,'540400380',40400885,'540400885','Juntada de Dossiê Previdenciário',581,80,'N','N');


SET @idSecJF := '711230778800100015100000000126';
SET @agora := (SELECT now());

-- CRIACAO DOS EVENTOS
INSERT INTO eproc_1grau_develop.evento_judicial
SELECT distinct
 ed.id_evento_judicial_tu, ed.cod_evento_tu, ed.des_evento_tu,
  e.sin_publicacao,e.sin_sigilo,e.sin_mudanca_orgao,e.sin_prazo,e.sin_advert_atribuicao,e.sin_evento_lancavel,e.sin_pede_magistrado,e.sin_possui_comple_complemento,e.tipo_texto,e.sin_gera_diligencia,e.sin_encerra_prazo,e.sin_gera_expediente_publicacao,e.sin_bloqueio_peticao,e.sin_evento_juntada,e.id_grupo_evento,e.sta_processo,e.sin_lanca_evento_orgao_atual,e.tipo_evento,e.cod_tipo_fase_judicial,e.sin_libera_texto_publicacao,e.sin_altera_data,e.cod_orgao_destino,e.sta_ciclo_processo,e.sin_evento_audive,e.sin_sempre_imprime,e.sin_informa_mandada,e.sin_informa_oficial_justica,e.com_situacao_processo,e.sta_parte,e.tipo_dialogo_judicial,e.sin_exclusao_logica,e.sin_lancavel_externo,e.sin_controle_eletronico,e.sin_permite_cancelamento,e.sin_visualiza_documento_externo,e.sin_envia_email,e.id_localizador,e.cod_status_audiencia,e.sin_exige_localizador,e.sin_abre_prazo,e.sin_fecha_prazo,'TC',e.nivel,e.sin_documento_obrigatorio,e.sin_documento_proibido,e.sin_autocomposicao,e.sin_ignora_suspensao,ed.cod_mni_movimento
FROM eproc_1grau_develop.evento_judicial e inner join eproc_1grau_develop.evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
WHERE ed.operacao not in ('E', 'V');

SELECT * FROM  eproc_1grau_develop.evento_criacao_paradigma WHERE cod_mni_movimento = 12734;


insert into eproc_1grau_develop.evento_judicial_mni_complemento_tabelado
SELECT id_evento_judicial_tu, cod_mni_tabelado
FROM eproc_1grau_develop.evento_criacao_paradigma ed inner join eproc_1grau_develop.evento_judicial e
                                            on e.id_evento_judicial = id_evento_judicial_tu
WHERE ed.cod_mni_tabelado <> 0;


INSERT INTO eproc_1grau_develop.evento_orgao_judicial
select distinct e.id_orgao, ed.id_evento_judicial_tu, e.cod_orgao, ed.cod_evento_tu, 'S', @idSecJF, @agora, null, null
from eproc_1grau_develop.evento_orgao_judicial e inner join eproc_1grau_develop.evento_criacao_paradigma ed
on ed.id_evento_judicial_v2 = e.id_evento_judicial
where e.id_evento_judicial = ed.id_evento_judicial_v2 and e.sin_ativo = 'S'
  AND ed.operacao <> 'E';

-- CRIACAO DOS EVENTOS
SELECT *FROM evento_judicial_mni_complemento_tabelado
SELECT id_evento_judicial_tu, cod_mni_tabelado
FROM evento_criacao_paradigma ed inner join evento_judicial e on e.id_evento_judicial = id_evento_judicial_tu WHERE ed.cod_mni_tabelado <> 0;


-- evento_judicial_mni_complemento_tabelado
insert into evento_judicial_mni_complemento_tabelado
SELECT id_evento_judicial_tu, cod_mni_tabelado
FROM evento_criacao_paradigma ed inner join evento_judicial e on e.id_evento_judicial = id_evento_judicial_tu WHERE ed.cod_mni_tabelado <> 0;



-- AUTORIZACAO PARA ORGAOS
INSERT INTO evento_orgao_judicial
select distinct e.id_orgao, ed.id_evento_judicial_tu, e.cod_orgao, ed.cod_evento_tu, 'S', @idSecJF, @agora, null, null
from evento_orgao_judicial e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
where e.id_evento_judicial = ed.id_evento_judicial_v2 and e.sin_ativo = 'S'
  AND ed.operacao <> 'E';


-- TABELA CONTROLE EVENTO JUDICIAL - ESTATÍSTICA
SET @idControleEvento := (SELECT MAX(id_controle_evento)+1 FROM controle_evento);

INSERT INTO controle_evento
SELECT @idControleEvento := @idControleEvento + 1, cod_evento_sistema, des_evento_sistema, id_evento_judicial_tu, cod_evento_tu
FROM (
    SELECT  distinct  e.cod_evento_sistema, e.des_evento_sistema, ed.id_evento_judicial_tu, ed.cod_evento_tu
    from controle_evento e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
    WHERE ed.operacao not in ('V', 'E')
    ) as subquery;

-- TABELA CONTROLE_LOCALIZADOR_SISTEMA_EVENTO
SET @id := (SELECT IFNULL(MAX(id_controle_localizador_sistema_evento) + 1, 1) FROM controle_localizador_sistema_evento);

INSERT INTO controle_localizador_sistema_evento
SELECT @id := @id +1, id_controle_localizador_sistema, id_evento_judicial_tu, 'S', @idSecJF, @agora, null, null
FROM
    (SELECT distinct  e.id_controle_localizador_sistema, ed.id_evento_judicial_tu
    FROM controle_localizador_sistema_evento e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
    WHERE e.sin_ativo = 'S'
    AND ed.operacao in ('M', 'D', 'U', 'V')) as subquery;

UPDATE controle_localizador_sistema_evento e, evento_criacao_paradigma ed
SET e.sin_ativo = 'N', e.id_usuario_desativacao = @idSecJF, e.dth_desativacao = @agora
WHERE e.id_evento_judicial = ed.id_evento_judicial_v2
  AND e.sin_ativo = 'S'
  AND ed.operacao in ('M', 'D', 'U', 'V');

-- TABELA CONTROLE_LOCALIZADOR_SISTEMA_EVENTO_FILTRO
SET @id := (SELECT IFNULL(MAX(id_controle_localizador_sistema_evento_filtro) + 1, 1)
FROM controle_localizador_sistema_evento_filtro);

INSERT INTO controle_localizador_sistema_evento_filtro
SELECT @id := @id +1, id_controle_localizador_sistema, id_evento_judicial_tu, 'S', @idSecJF, @agora, null, null
FROM
    (SELECT distinct e.id_controle_localizador_sistema, ed.id_evento_judicial_tu
    FROM controle_localizador_sistema_evento_filtro e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_filtro
    WHERE e.sin_ativo = 'S'
    AND ed.operacao in ('M', 'D', 'U', 'V')) as subquery;

-- TABELA CONTROLE_LOCALIZADOR_SISTEMA_EVENTO_SENTENCA_ORIGEM
SET @id := (SELECT IFNULL(MAX(id_controle_localizador_sistema_evento_sentenca_origem) + 1, 1) FROM controle_localizador_sistema_evento_sentenca_origem);

INSERT INTO controle_localizador_sistema_evento_sentenca_origem
SELECT @id := @id +1, id_controle_localizador_sistema, id_evento_judicial_tu, 'S', @idSecJF, @agora, null, null
FROM
    (SELECT distinct e.id_controle_localizador_sistema, ed.id_evento_judicial_tu
    FROM controle_localizador_sistema_evento_sentenca_origem e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_sentenca_origem
    WHERE e.sin_ativo = 'S'
    AND ed.operacao in ('M', 'D', 'U', 'V')) as subquery;

-- TABELA CONTROLE_EVENTO_SISTEMA - EVENTOS DE COMUNICAÇÃO
SET @idControleEventoSistema := (SELECT MAX(id_controle_evento_sistema)+1 FROM controle_evento_sistema);

INSERT INTO controle_evento_sistema
SELECT @idControleEventoSistema := @idControleEventoSistema +1, id_classe_judicial_origem, id_classe_judicial_destino,
       cod_evento_origem, cod_evento_destino, sin_informa_processo, sin_comunica_principal, sin_comunica_cancelamento,
       sin_comunica_sempre_1grau, sin_comunica_siapro, sin_somente_movimento, sin_comunica_origem_relacionado,
       sin_remete_vara_origem, sin_comunica_delegada, sin_remete_conciliacao, sin_comunica_declinado, id_sigilo_destino,
       'S', @agora, @idSecJF, null, null
FROM
    (SELECT distinct
    e.id_classe_judicial_origem, e.id_classe_judicial_destino, ed.cod_evento_tu cod_evento_origem,
    e.cod_evento_destino, e.sin_informa_processo, e.sin_comunica_principal, e.sin_comunica_cancelamento, e.sin_comunica_sempre_1grau,
    e.sin_comunica_siapro, e.sin_somente_movimento, e.sin_comunica_origem_relacionado, e.sin_remete_vara_origem, e.sin_comunica_delegada,
    e.sin_remete_conciliacao, e.sin_comunica_declinado, e.id_sigilo_destino
    FROM controle_evento_sistema e inner join evento_criacao_paradigma ed on ed.cod_evento_v2 = e.cod_evento_origem
    WHERE e.sin_ativo = 'S'
    AND ed.operacao in ('M', 'D', 'U', 'V', 'N')) as subquery;

INSERT INTO controle_evento_sistema
SELECT @idControleEventoSistema := @idControleEventoSistema +1, id_classe_judicial_origem, id_classe_judicial_destino,
       cod_evento_origem, cod_evento_destino, sin_informa_processo, sin_comunica_principal, sin_comunica_cancelamento,
       sin_comunica_sempre_1grau, sin_comunica_siapro, sin_somente_movimento, sin_comunica_origem_relacionado,
       sin_remete_vara_origem, sin_comunica_delegada, sin_remete_conciliacao, sin_comunica_declinado, id_sigilo_destino,
       'S', @agora, @idSecJF, null, null
FROM
    (SELECT distinct e.id_classe_judicial_origem, e.id_classe_judicial_destino, e.cod_evento_origem, ed.cod_evento_tu cod_evento_destino,
    e.sin_informa_processo, e.sin_comunica_principal, e.sin_comunica_cancelamento, e.sin_comunica_sempre_1grau,
    e.sin_comunica_siapro, e.sin_somente_movimento, e.sin_comunica_origem_relacionado, e.sin_remete_vara_origem,
    e.sin_comunica_delegada, e.sin_remete_conciliacao, e.sin_comunica_declinado, e.id_sigilo_destino
    FROM controle_evento_sistema e inner join evento_criacao_paradigma ed on ed.cod_evento_v2 = e.cod_evento_destino
    WHERE e.sin_ativo = 'S'
    AND ed.operacao in ('M', 'D', 'U', 'V', 'N')) as subquery;


UPDATE controle_evento_sistema e, evento_criacao_paradigma ed
 
SET e.sin_ativo = 'N', e.id_usuario_desativacao = @idSecJF, e.dth_desativacao = @agora
WHERE e.cod_evento_origem = ed.cod_evento_v2
  AND e.sin_ativo = 'S'
  AND ed.operacao in ('M', 'D', 'U', 'V', 'E');

UPDATE controle_evento_sistema e, evento_criacao_paradigma ed
SET e.sin_ativo = 'N', e.id_usuario_desativacao = @idSecJF, e.dth_desativacao = @agora
WHERE e.cod_evento_destino = ed.cod_evento_v2
  AND e.sin_ativo = 'S'
  AND ed.operacao in ('M', 'D', 'U', 'V', 'E');


-- TABELA evento_peticao_dado_complementar_valor
SET @idEventoPeticao := (SELECT MAX(id_evento_peticao_dado_complementar_valor) + 1
 FROM evento_peticao_dado_complementar_valor);

INSERT INTO evento_peticao_dado_complementar_valor
SELECT @idEventoPeticao := @idEventoPeticao +1, id_evento_judicial, id_tipo_peticao_judicial, id_dado_complementar, id_dado_comp_valor,
       sin_certidao_execucao, 'S', @idSecJF, @agora, null, null
FROM
    ( SELECT distinct ed.id_evento_judicial_tu id_evento_judicial, e.id_tipo_peticao_judicial, e.id_dado_complementar, e.id_dado_comp_valor, e.sin_certidao_execucao
    from evento_peticao_dado_complementar_valor e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
    WHERE ed.operacao <> 'E'
    AND e.sin_ativo = 'S') as subquery;

UPDATE evento_peticao_dado_complementar_valor e, evento_criacao_paradigma ed
SET e.sin_ativo = 'N', e.dth_desativacao = @agora, e.id_usuario_desativacao = @idSecJF
WHERE e.id_evento_judicial = ed.id_evento_judicial_v2 and e.sin_ativo = 'S';

-- TABELA controle_evento_lancamento
SET @id := (SELECT MAX(id_controle_evento_lancamento) + 1 FROM controle_evento_lancamento);

delete from controle_evento_lancamento_de_para d where d.id_controle_evento_lancamento is not null;

INSERT INTO controle_evento_lancamento_de_para
SELECT e.id_controle_evento_lancamento, ed.id_evento_judicial_tu as id_evento_judicial_decisao,
       e.id_evento_judicial_lancamento,
       @id := @id + 1 as id_controle_evento_lancamento_para
FROM controle_evento_lancamento e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial_decisao
WHERE e.sin_ativo = 'S'
  AND ed.operacao not in ('E')
  AND ed.id_evento_judicial_v2 <> 848 -- foi unificado com 847 e está nas mesmas classes e competências
;

INSERT INTO controle_evento_lancamento
SELECT cd.id_controle_evento_lancamento_para, c.id_classe_judicial, c.cod_competencia,
       cd.id_evento_judicial_decisao, cd.id_evento_judicial_lancamento,
       c.sin_ignora_parte_sem_procurador, 'S', @idSecJF, @agora, null, null, c.id_tipo_entidade_exclusiva
FROM controle_evento_lancamento_de_para cd inner join controle_evento_lancamento c on c.id_controle_evento_lancamento = cd.id_controle_evento_lancamento;

SET @id := (SELECT MAX(id_controle_evento_lancamento_valor) + 1
FROM controle_evento_lancamento_valor);

INSERT INTO controle_evento_lancamento_valor
SELECT @id := @id + 1,
       cd.id_controle_evento_lancamento_para,
       cv.cod_tipo_pessoa,
       cv.id_tipo_entidade,
       cv.cod_tipo_prazo,
       cv.sin_polo,
       cv.num_dias_prazo,
       cv.num_dias_especial,
       cv.sin_nao_intimar,
       cv.sin_centro_juridico,
       'S',@idSecJF, @agora, null, null
FROM controle_evento_lancamento_valor cv
    inner join controle_evento_lancamento_de_para cd
on cd.id_controle_evento_lancamento = cv.id_controle_evento_lancamento
WHERE cv.sin_ativo = 'S';

-- TABELA evento_judicial_informacao_prazo
SET @id := (SELECT MAX(id_evento_judicial_informacao_prazo) + 1
FROM evento_judicial_informacao_prazo);


INSERT INTO evento_judicial_informacao_prazo
SELECT @id := @id + 1, ed.id_evento_judicial_tu, e.des_informacao_prazo, e.num_dias_prazo, 'S', e.dth_inicio_informacao,
       e.dth_fim_informacao, e.sin_aguardando_abertura, e.sin_colegiado, e.sin_tr, e.sin_criminal
FROM evento_judicial_informacao_prazo e inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = e.id_evento_judicial
WHERE ed.operacao <> 'E'
  AND e.sin_ativo = 'S';

-- TABELA abre_fecha_prazo - eventos de intimação/citação
UPDATE abre_fecha_prazo c , evento_criacao_paradigma e
SET c.id_evento_abertura = e.id_evento_judicial_tu
WHERE c.id_evento_abertura = e.id_evento_judicial_v2
  AND e.operacao not in ('E','N');

UPDATE abre_fecha_prazo c , evento_criacao_paradigma e
SET c.id_evento_fechamento_sistema = e.id_evento_judicial_tu
WHERE c.id_evento_fechamento_sistema = e.id_evento_judicial_v2
  AND e.operacao not in ('E','N');

INSERT INTO  abre_fecha_prazo
SELECT ed.id_evento_judicial_tu, a.id_evento_abertura, a.id_tipo_peticao_judicial_fechamento, a.id_evento_fechamento_sistema, a.sin_secretaria
FROM abre_fecha_prazo a
         inner join evento_criacao_paradigma ed on ed.id_evento_judicial_v2 = a.id_evento_judicial_secretaria
WHERE ed.operacao <> 'E';

-- ---------------------------------------------------------------------------------------------------------------------
-- Fim da Issue eproc/eproc2#618 e eproc/eproc2#615

