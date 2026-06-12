<?php
/***
 * @var mixed $candidato
 * @var mixed $processo
 */

//$datas1 = $config->resultados->data_resultado[0]['chamada'];
//$data_texto = $config->resultados->data_prova;


$confirma_medicina = $_SESSION['resultado']['medicina'];


$unidade = $_SESSION['resultado']['coligada'];


$nome = $candidato->NOME;
$curso = $candidato->OPCAO1;

$periodo =  "(Teste Periodo)";

$format_dinheiro = new \NumberFormatter("pt-BR", \NumberFormatter::CURRENCY);
$simbolo =  $format_dinheiro->getSymbol(\NumberFormatter::INTL_CURRENCY_SYMBOL);
$valor = $format_dinheiro->formatCurrency((float)$candidato->VALOR, $simbolo);
$valor_original = $format_dinheiro->formatCurrency((float)$candidato->VALOR_ORIGINAL, $simbolo);

?>


<div class="pinda_presencial">

    <div class="banner-candidato-medicina"></div>

    <main role="main" class="container-candidato">



        <div class="container">

            <br><br>

            <div>
                <h1 class="parabens"><b><?php echo htmlentities($nome);  ?></b></h1>
                <h4 class="aprovado-texto">Você foi aprovado(a) no Vestibular 2025  para o curso <strong><?php echo h($curso); ?></strong> no UniFUNVIC!</h4>

                <hr>

                <p>


                <div class="mb-3">
                    <p>A seguir, você encontra informações importantes para efetuar sua matrícula.</p>
                    
                    <p>
                        <strong>Agendamento para Matrícula:</strong>
                    </p>
                    <p>
                        Para maior comodidade e agilidade, será necessário agendar e realizar sua matrícula em um dos dias disponíveis para a 1ª chamada, que ocorrerá de 10/11 a 12/11/2025 (segunda a quarta-feira, das 9h às 20h) no Campus I UniFUNVIC:   
                    </p> 
                    <p>
                        <strong>Endereço:</strong> Estrada Radialista Percy Lacerda, 1000 -  Pinhão do Borba, Pindamonhangaba.
                    </p>
                </div>


                <div class="mb-3">
                <iframe width="425" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=-45.47082960605622%2C-22.990787575072407%2C-45.4663234949112%2C-22.987380098332704&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=18/-22.989084/-45.468577">Zoom</a></small>
                </div>

                <div class="mb-3">
                    <p>
                    <strong>Atenção:</strong> Após essas datas, a vaga será automaticamente disponibilizada para o próximo candidato na fila de espera.
                        <p>
                            <p><strong>Informações Importantes:</strong></p>

                                <ul>
                                    <li>O <strong>contrato educacional</strong> deverá ser assinado no momento da matrícula, pelo candidato (se maior de 18 anos), juntamente com um ou dois garantidores, conforme estabelecido no edital do Vestibular de Medicina do UniFUNVIC. Os garantidores podem ser responsáveis (pai, mãe ou outros).</li>
                                    <li>Para candidatos <strong>menores de 18 anos</strong>, o contrato deverá ser assinado pelo responsável, mais um ou dois garantidores maiores de idade, conforme o edital do Vestibular de Medicina do UniFUNVIC.</li>
                                    <li>Todo <strong>desconto/bolsa</strong> oferecido neste vestibular só terá validade se a matrícula for oficializada dentro do prazo estabelecido.</li>
                                    <li>Todos que assinarem o contrato deverão entregar cópias dos seguintes documentos: <strong> Cédula de Identidade, Cadastro de Pessoa Física (CPF) e comprovante de endereço atualizado.</strong></li>
                                    <li>As turmas somente serão iniciadas com o preenchimento de no mínimo <strong>60% das vagas</strong> disponíveis.</li>
                                </ul>
                        </p>
                    </p>
                </div>


                <div class="mb-3">
                    <h4><b>Informações sobre valores</b></h4>
                    <ul>
                        <li>O pagamento deverá ser no ato da matrícula com dinheiro, cartão de débito ou PIX.</li>
                        <li>O <strong>desconto/bolsa de 25%</strong> concedido à turma de Medicina 2026 será válido durante todo o curso, desde que sejam cumpridas as condições de pontualidade.</li>
                        <li>Os Descontos/Bolsas não são acumuláveis com outras ofertas, bolsas ou financeiro</li>
                        <li><strong>Valor integral da mensalidade do curso para referência: R$ 11.908,00.</strong></li>

                    </ul>
                </div>

                <div class="shadow p-3 mb-5 bg-white rounded mb-3 text-justify" style="width: 100%; overflow-x: auto;">
                    <p class="h3 text-uppercase">Investimento:</p>
                    <span class="h5"><?= h($curso); ?></span>
                    <div class="mt-3">
                        <p class="h5 text-uppercase">Matrícula com Desconto:</p>
                        <p class="lead font-weight-bold"><?= h($valor); ?></p>

                        <p class="h5 text-uppercase">Valor sem Desconto</p>
                        <p class="lead font-weight-bold"><?= h($valor_original) ?></p>
                    </div>

                </div>

                <br>

                <h4><b>Ficou com alguma dúvida?</b> <a href="https://api.whatsapp.com/send?phone=5512996507709" target="_blank">Clique aqui para entrar em contato via WhatsApp.</a></h4>
                <small>Não conseguiu acessar o link? Nosso WhatsApp é (12)99650-7709.</small>

            </div>

            <div class="row" style="text-align:center; margin-top: 50px;">

                <div class="col-xs-12 col-md-4" style="margin-top: 25px;">
                    <button type="button" class="btn btn btn-documentos" data-toggle="modal" data-target="#exampleModal">
                        Documentos para a Matrícula
                    </button>
                </div>

                <!-- Botoão Agendamento -->

                <div class="col-xs-12 col-md-4" style="margin-top: 25px;">
                    <a href="https://unifunvic.reservio.com" target="_blank"><button class="btn btn btn-resultado" id="reserve">Agende sua Matrícula</button></a>
                </div>

                <!--  -->

                <div class="col-xs-12 col-md-4" style="margin-top: 25px;">
                    <a href="https://fundacaouniversitaria151485.rm.cloudtotvs.com.br/FrameHTML/web/app/Edu/PortalProcessoSeletivo/?c=1&f=1&ct=1&ps=153#/es/resultados" target="_blank"><button class="btn btn btn-secondary" id="reserve">Faça Matrícula Online</button></a>
                </div>


            </div>

        </div>

</div>



<div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Documentos Necessários para a Matrícula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">

                    <p>
                        OBS: Todos os documentos deverão ser apresentados em duas vias (cópias) e com o original para conferência. Todas em folha de tamanho A4. Poderá ser solicitado documento complementar posteriormente, caso necessário.
                    </p>

                    <h4>Documentos do Candidato:</h4>
                    <ul>
                        <li>No momento da matrícula, será necessário apresentar os seguintes documentos:</li>
                        <li>Certificado de Conclusão do Ensino Médio ou equivalente.</li>
                        <li>Histórico Escolar do Ensino Médio ou equivalente.</li>
                        <li>Caso possua, diploma de curso superior.</li>
                        <li>Fotocópia da Cédula de Identidade (RG/RNE).</li>
                        <li>Passaporte (para candidatos estrangeiros com visto de estudante válido para o UniFUNVIC).</li>
                        <li>Fotocópia do Título de Eleitor ou protocolo.</li>
                        <li>Fotocópia do comprovante de votação.</li>
                        <li>Certificado de Reservista, Atestado de Alistamento Militar ou Atestado de Matrícula em CPOR ou NPOR, para candidatos brasileiros, maiores de 18 anos e do sexo masculino.</li>
                        <li>Certidão de Nascimento ou Casamento (com averbações, se for o caso).</li>
                        <li>Cadastro de Pessoa Física (CPF) ou protocolo de solicitação.</li>
                        <li>Uma fotografia 3x4.</li>
                        <li>Comprovante de endereço atualizado.</li>

                    </ul>
                    
                    <h4>Documentos do garantidor solidário: 2 cópias de cada:</h4>
                    <ul>
                                <li>Comprovante de residência atualizado, com no máximo 30 dias (conta de água, luz ou telefone fixo), do(s) devedor(es) solidário(s).</li>
                                <li>Declaração de Imposto de Renda 2024 (ano base 2023) completa e com as páginas de recibo.</li>
                                <li>Comprovante de Renda – o(s) devedor(es) solidário(s) deve(m) comprovar renda mínima de 1,5 (uma vez e meio) vez o valor da mensalidade.</li>
                                <li>RG e CPF do devedor solidário e respectivo cônjuge</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

</main>
</div>

