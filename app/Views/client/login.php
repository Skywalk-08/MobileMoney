<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2b5c8f;
            --primary-dark: #1e3f5e;
            --primary-light: #3a7bbf;
            --bg: #f0f2f5;
            --text-muted: #6c757d;
            --accent: #3a7bbf;
            --border: #e2e8f0;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-700: #4a5568;
            --gray-800: #2d3748;
            --success: #16a085;
            --danger: #c0392b;
        }

        body {
            background: linear-gradient(135deg, #f0f2f5 0%, #e2e8f0 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 80%;
            height: 200%;
            background: linear-gradient(135deg, rgba(43, 92, 143, 0.04) 0%, rgba(58, 123, 191, 0.06) 100%);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(43, 92, 143, 0.12);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 70px rgba(43, 92, 143, 0.18);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .login-header .logo-icon {
            width: 72px;
            height: 72px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin-bottom: 1.1rem;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .login-header h3 {
            font-weight: 800;
            margin: 0;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
            position: relative;
        }

        .login-header p {
            margin: 0.4rem 0 0;
            opacity: 0.92;
            font-size: 0.95rem;
            font-weight: 500;
            position: relative;
        }

        .login-body {
            padding: 2.5rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            padding: 0.95rem 1.2rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
        }

        .alert i {
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(192, 57, 43, 0.08) 0%, rgba(231, 76, 60, 0.08) 100%);
            color: #922b21;
            border-left: 4px solid var(--danger);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(22, 160, 133, 0.08) 0%, rgba(26, 188, 156, 0.08) 100%);
            color: #0d5f52;
            border-left: 4px solid var(--success);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-size: 0.88rem;
            letter-spacing: 0.1px;
        }

        .form-control {
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: var(--gray-50);
            color: var(--gray-800);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(58, 123, 191, 0.12);
            background: var(--white);
            outline: none;
        }

        .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .form-text {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 0.4rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 0.85rem;
            font-size: 1.05rem;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(43, 92, 143, 0.3);
            color: var(--white);
            margin-top: 0.75rem;
            letter-spacing: 0.1px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(43, 92, 143, 0.4);
            color: var(--white);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(43, 92, 143, 0.25);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border);
        }

        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1rem;
            }

            .login-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .login-header .logo-icon {
                width: 56px;
                height: 56px;
                font-size: 1.7rem;
                border-radius: 16px;
            }

            .login-header h3 {
                font-size: 1.35rem;
            }

            .login-body {
                padding: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="logo-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h3>Mobile Money</h3>
                    <p>Espace Client</p>
                </div>

                <div class="login-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div><?= esc(session()->getFlashdata('error')) ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            <div><?= esc(session()->getFlashdata('success')) ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="/client/login/authenticate" method="post">
                        <div class="mb-4">
                            <label class="form-label" for="telephone">
                                Numéro de téléphone
                            </label>
                            <input
                                type="text"
                                name="telephone"
                                class="form-control"
                                id="telephone"
                                placeholder="Ex : 033 12 345 67"
                                value="<?= esc(old('telephone')) ?>"
                                required
                                autofocus>
                            <div class="form-text">Préfixes acceptés : 032, 033, 034, 037, 038</div>
                        </div>

                        <button type="submit" class="btn btn-login w-100">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                        </button>
                    </form>
                </div>

                <div class="login-footer">
                    <a href="/operateur/login">
                        <i class="bi bi-arrow-left me-1"></i>Accès opérateur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
