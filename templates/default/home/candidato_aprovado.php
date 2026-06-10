<?php

/***
 * @var mixed $candidato
 * @var object $processo
 */




$nome = $candidato->NOME;
$curso = $candidato->OPCAO1;


$format_dinheiro = new \NumberFormatter("pt-BR", \NumberFormatter::CURRENCY);
$simbolo =  $format_dinheiro->getSymbol(\NumberFormatter::INTL_CURRENCY_SYMBOL);
$valor = $format_dinheiro->formatCurrency((float)$candidato->VALOR, $simbolo);
$valor_original = $format_dinheiro->formatCurrency((float)$candidato->VALOR_ORIGINAL, $simbolo);

?>
<div class="pinda_presencial">

    <div class="banner-candidato"></div>

    <main role="main" class="container-candidato">



        <div class="container">

            <br><br>

            <div>
                <h1 class="parabens"><b><?php echo h($nome);  ?></b></h1>
                <h4 class="aprovado-texto">Você foi aprovado(a) no <strong><?=  h($processo->nome); ?></strong>  para o curso <b><?php echo h($curso); ?></b>.</h4>

                <hr>

                <p>

                    <b>Horários de atendimento - Campus Pinda</b>

                    <div class="mb-3 font-weight-bolder">Pinda - 09h às 20h</div>
                    </br>

                    <div class="mt-3">
                        <i>Agendando sua matrícula até <?php "DATA AGENDAMENTO" ?>, para cursos presenciais você garante seu desconto na matrícula e a bolsa Graduação ao seu Alcance do <span class="font-weight-bolder"><strong><?=  h($processo->nome); ?></strong></span> .
                    </div>
                    <div class="mb-3">
                        <ul>
                            <li>45% de desconto na matrícula</li>
                            <li>Bolsa Graduação ao seu Alcance com 45% de desconto nas mensalidades do curso.</li>
                        </ul>
                    </div>

                    </i>

                </p>

                <br>

                <p class="h3">Informações</p>
                <p>
                    O contrato deverá ser assinado no ato da matrícula;</br>
                    Candidatos maiores de 18 anos deverão comparecer com um garantidor responsável;</br>
                    Candidatos menores de idade deverão estar acompanhados do responsável legal e de um garantidor maior de idade.</br>
                </p>

                <br>

                <div class="shadow p-3 mb-5 bg-white rounded mb-3 text-justify">

                    <p class="h3 text-danger">Observações:</p>
                    <p >
                            No ato da matrícula, poderá ser utilizado: dinheiro, cartão de débito ou PIX. </br>
                            Os valores são reajustados anualmente, conforme política institucional.</br>
                            Bolsa Graduação ao seu Alcance, o termo da bolsa ficará disponível no setor financeiro, sendo entregue no ato do pagamento da matrícula.</br>
                            A mensalidade deve ser paga até o dia 05 de cada mês.</br>
                            A porcentagem de desconto é aplicada sobre o valor integral (sem desconto).</br>
                    </p>
                    
                </div>

                <br>

                <div class="mb-3">
                    <div class="mb-3 font-weight-bolder"> Informação que consta no Manual do Candidato:</div>
                        Os ingressantes neste vestibular comporão as turmas dos cursos em andamento. Observação: Os alunos deverão cursar integralmente todas as disciplinas previstas na estrutura curricular do curso. A integralização ocorrerá dentro do período regular estabelecido para cada curso, em conformidade com as diretrizes do Ministério da Educação
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

                <div class="col-xs-12 col-md-6" style="margin-top: 25px;">
                    <button type="button" class="btn btn-lg btn-documentos" data-toggle="modal" data-target="#exampleModal">
                        Documentos para a Matrícula
                    </button>
                </div>

                <!-- Botoão Agendamento -->

                <div class="col-xs-12 col-md-6" style="margin-top: 25px;">
                    <a href="https://unifunvic.reservio.com" target="_blank"><button class="btn btn-lg btn-resultado" id="reserve">Agende sua Matrícula</button></a>
                </div>

                <!--  -->


            </div>

        </div>

</div>

</main>
</div>
