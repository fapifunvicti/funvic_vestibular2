<?php
    /***
     * @var mixed $processo
     */

    $data_prova = explode(" ", $processo->data_prova_fmt);
    $data = $data_prova[0];
    $hora = $data_prova[1];

?>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .main-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            color: white;
        }
        
        .content-section {
            padding: 2rem;
        }
        
        .info-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #667eea;
            transition: transform 0.2s;
        }
        
        .info-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .info-card h4 {
            color: #667eea;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .info-card i {
            margin-right: 10px;
            color: #667eea;
        }
        
        .azul {
            color: #667eea;
            font-weight: 600;
        }
        
        .aviso {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            border-radius: 10px;
            margin: 1.5rem 0;
        }
        
        .aviso h4 {
            color: #856404;
            margin-bottom: 0;
        }
        
        .btn-voltar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .btn-voltar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .data-prova {
            font-size: 1.2rem;
            background: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            margin-bottom: 1rem;
        }
        
        .link-info {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        
        .link-info:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        .whatsapp-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #25D366;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .whatsapp-link:hover {
            transform: scale(1.05);
            color: white;
            background: #128C7E;
        }
        
        hr {
            margin: 2rem 0;
            background: linear-gradient(to right, #667eea, transparent);
            height: 2px;
        }
        
        .badge-medicina {
            background: #ff6b6b;
            color: white;
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            margin-left: 10px;
        }
        
        @media (max-width: 768px) {
            .content-section {
                padding: 1.5rem;
            }
            
            .header-gradient {
                padding: 1.5rem;
            }
        }
    </style>
  <main role="main">
        <div class="container">
            <div class="main-card">
                <!-- Cabeçalho com gradiente -->
                <div class="header-gradient">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <div class="data-prova">
                                <i class="fas fa-calendar-alt"></i> Data da Prova: <?= h($data); ?>
                            </div>
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