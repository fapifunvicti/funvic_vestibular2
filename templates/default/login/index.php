    <style>
        /* Garantir que o corpo ocupe toda a altura da viewport e centralize o conteúdo */
        body {
            background: linear-gradient(135deg, #f5f7fc 0%, #e9eef5 100%);
            font-family: system-ui, 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
        }

        /* Card com efeito sutil e melhor contraste */
        .login-card {
            border: none;
            border-radius: 1.5rem;
            backdrop-filter: blur(0px);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .login-card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.08) !important;
        }

        /* Espaço reservado para o logo: container com fundo suave e aparência profissional */
        .logo-area {
            width: 100px;
            height: 100px;
            margin: 0 auto 1rem auto;
            background-color: #ffffff;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03), 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Ícone/logo placeholder estilizado — fácil substituir por imagem real */
        .logo-placeholder-svg {
            width: 56px;
            height: 56px;
            background: linear-gradient(145deg, #3b71ca, #1e4a8a);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.8rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        /* Pequenos ajustes nos inputs para ficarem mais agradáveis */
        .form-control {
            border-radius: 0.75rem;
            padding: 0.7rem 1rem;
            border: 1px solid #dee2e6;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #3b71ca;
            box-shadow: 0 0 0 3px rgba(59, 113, 202, 0.2);
        }

        .btn-primary {
            background-color: #2c5f9a;
            border: none;
            border-radius: 0.75rem;
            padding: 0.7rem 1rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #1e4a8a;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        .form-check-input:checked {
            background-color: #2c5f9a;
            border-color: #2c5f9a;
        }

        a {
            color: #2c5f9a;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        a:hover {
            color: #0d3b6b;
            text-decoration: underline;
        }

        /* Responsividade extra para telas muito pequenas */
        @media (max-width: 576px) {
            .login-card .card-body {
                padding: 2rem 1.5rem !important;
            }
            .logo-area {
                width: 85px;
                height: 85px;
            }
            .logo-placeholder-svg {
                width: 48px;
                height: 48px;
                font-size: 1.5rem;
            }
        }
    </style>
<div class="d-flex align-items-center min-vh-100 p-3 p-md-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <!-- Card principal com sombra suave e bordas arredondadas -->
                <div class="card login-card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Área do LOGO (centralizada e acima do formulário) -->
                        <div class="text-center mb-4">
                            <div class="logo-area">
                                <!-- Substitua este bloco pela sua imagem de logo real.
                                     Exemplo com <img src="seu-logo.png" alt="Logo" width="70"> -->
                                <div class="logo-placeholder-svg">
                                    <span>🚀</span>
                                </div>
                                <!-- Caso queira usar uma imagem real, descomente a linha abaixo e remova o placeholder acima -->
                                <!-- <img src="https://via.placeholder.com/70x70?text=LOGO" alt="Logo da empresa" class="img-fluid" style="max-width: 70px;"> -->
                            </div>
                            <h4 class="mt-3 fw-semibold text-secondary">Bem-vindo(a)</h4>
                            <p class="text-muted small">Acesse sua conta com e-mail e senha</p>
                        </div>

                        <!-- Formulário de login com e-mail e senha -->
                        <form id="loginForm" action="#" method="post">
                            <!-- Campo de E-mail -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium text-secondary">Endereço de e-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#6c757d" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-2 6.788L8.291 9.41 1 12.17V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-.171l-4.708-2.825zM1 11.105l4.708-2.825L1 5.383v5.722z"/>
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control border-start-0 rounded-end-3" id="email" name="email" placeholder="seu@email.com" required autofocus>
                                </div>
                                <div class="invalid-feedback d-none" id="emailError">Por favor, insira um e-mail válido.</div>
                            </div>

                            <!-- Campo de Senha -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-medium text-secondary">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#6c757d" viewBox="0 0 16 16">
                                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control border-start-0 rounded-end-3" id="password" name="password" placeholder="••••••••" required>
                                </div>
                                <div class="invalid-feedback d-none" id="passwordError">A senha é obrigatória.</div>
                            </div>

                            <!-- Opções extras: Lembrar-me e esqueci a senha -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberCheck">
                                    <label class="form-check-label small text-secondary" for="rememberCheck">
                                        Lembrar-me
                                    </label>
                                </div>
                                <a href="#" class="small" id="forgotPasswordLink">Esqueceu a senha?</a>
                            </div>

                            <!-- Botão de acesso principal -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-semibold shadow-sm">
                                    Entrar na conta
                                </button>
                            </div>

                            <!-- Link adicional para cadastro (opcional, mas melhora usabilidade) -->
                            <div class="text-center mt-4">
                                <span class="text-muted small">Não tem uma conta?</span>
                                <a href="#" class="small fw-semibold ms-1" id="signupLink">Criar nova conta</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Rodapé com mensagem informativa discreta -->
                <p class="text-center text-muted small mt-4 opacity-75">
                    Ambiente seguro 🔒 | Demonstração de login
                </p>
            </div>
        </div>
    </div>
</div>

    
