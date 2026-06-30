<?php
    /***
     * @var mixed $processo
     */


?>
<link rel="stylesheet" href="/assets/css/informacoes.css">
    <main class="mb-3" role="main">
        <div class="container">
            <div class="main-card">
                <!-- Cabeçalho com gradiente -->
                <div class="header-gradient">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <?php if($data): ?>
                            <div class="data-prova">
                                <i class="fas fa-calendar-alt"></i> Data da Prova: <?= h($data); ?>
                            </div>
                            <?php endif; ?>
                            <h1 class="display-4 fw-bold mb-0">
                                INFORMAÇÕES
                                <br>
                                <small class="text-white-50 fs-5">Guia completo para sua prova</small>
                            </h1>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <i class="fas fa-graduation-cap fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- Conteúdo -->
                <div class="content-section">
                    <!-- SEÇÃO DO BOTÃO INSCREVA-SE (DESTACADA) -->
   

                    <!-- Alerta de atraso -->
                    <div class="alert alert-info border-0 rounded-3 shadow-sm mb-4" role="alert">
                        <i class="fas fa-clock"></i> <strong class="azul">Lembre-se, não se atrase!</strong>
                    </div>

                    <!-- Card ENEM -->
                    <div class="info-card">
                        <h4>
                            <i class="fas fa-file-alt"></i>
                            Informações sobre o ENEM
                        </h4>
                        <p>
                            <a href="./enem.php" class="link-info">
                                <i class="fas fa-external-link-alt"></i> Clique aqui para mais informações sobre como utilizar a nota do ENEM
                            </a>
                        </p>
                        <p class="mb-0">
                            Ao optar pela utilização da nota do ENEM, o candidato não realizará a prova, mas deverá se inscrever normalmente preenchendo com <strong>"sim"</strong> na opção <strong>"quero utilizar a nota do ENEM"</strong> e completando as informações solicitadas.
                        </p>
                    </div>

                    <!-- Aviso taxa -->
                    <div class="aviso">
                        <h4>
                            <i class="fas fa-exclamation-triangle"></i> Atenção!
                        </h4>
                        <p class="mb-0">O recolhimento da taxa de inscrição é obrigatório para todas as formas de ingresso.</p>
                    </div>

                    <!-- Taxa de inscrição -->
                    <div class="info-card">
                        <h4>
                            <i class="fas fa-tag"></i>
                            Taxa de Inscrição
                        </h4>
                        <p class="mb-0">Conforme curso escolhido</p>
                    </div>

                    <!-- Efetivação -->
                    <div class="info-card">
                        <h4>
                            <i class="fas fa-check-circle"></i>
                            Efetivação da inscrição
                        </h4>
                        <p>Para a efetivação da inscrição, o candidato deverá fazer o pagamento:</p>
                        <p class="mb-0">
                            <i class="fas fa-hourglass-half"></i> Até <strong>dois (02) dias</strong> antes da data da prova;
                        </p>
                    </div>

                    <!-- Local da prova -->
                    <div class="info-card">
                        <h4>
                            <i class="fas fa-laptop-house"></i>
                            Onde irei fazer a prova?
                            <span class="badge-medicina">
                                <i class="fas fa-stethoscope"></i> Exceto Medicina
                            </span>
                        </h4>
                        <p class="mb-0">
                            A prova será realizada em uma plataforma virtual de forma on-line, remota, em horário determinado.
                            O candidato receberá, por e-mail, o link para a realização da prova até 2h antes do horário estipulado para o início.
                        </p>
                    </div>

                    <!-- Atenção email -->
                    <div class="aviso" style="background: #f8d7da; border-left-color: #dc3545;">
                        <h4 style="color: #721c24;">
                            <i class="fas fa-envelope"></i> Atenção especial com seu e-mail:
                        </h4>
                        <p class="mb-2">
                            Ao cadastrar o seu e-mail, verifique se este foi corretamente digitado e é um e-mail válido.
                            <strong>Não é permitido utilizar o mesmo e-mail</strong> para mais de um candidato,
                            <strong class="text-danger">sob pena de eliminação.</strong>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-spam"></i> Caso não receba o e-mail até duas horas antes da prova, verifique na caixa de spam.
                            Se não recebeu, por favor, nos contate com urgência através do e-mail ou WhatsApp informados neste manual.
                        </p>
                    </div>

                    <hr>

                    <!-- Contato WhatsApp -->
                    <div class="text-center">
                        <h4 class="mb-3">Dúvidas?</h4>
                        <a href="https://wa.me/5512996507709" target="_blank" class="whatsapp-link">
                            <i class="fab fa-whatsapp fa-xl"></i>
                            Entre em contato pelo WhatsApp - (12) 99650-7709
                        </a>
                    </div>

                    <hr>

                    <!-- Botão voltar -->
                    <div class="text-center">
                        <a class="btn btn-voltar text-white" href="/">
                            <i class="fas fa-arrow-left"></i> Voltar para página inicial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>