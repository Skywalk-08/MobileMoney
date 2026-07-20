<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Mobile Money') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2b5c8f;
            --primary-dark: #1e3f5e;
            --primary-light: #3a7bbf;
            --bg: #f0f2f5;
            --sidebar-bg: #ffffff;
            --text-muted: #6c757d;
        }

        body {
            background-color: var(--bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .mm-navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
        }

        .mm-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }

        .mm-navbar .nav-link,
        .mm-navbar .navbar-text {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
        }

        .mm-navbar .nav-link:hover,
        .mm-navbar .navbar-text:hover {
            color: #ffffff !important;
        }

        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 140px);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(43, 92, 143, 0.3);
        }

        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
            padding: 1.5rem 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(43, 92, 143, 0.15);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg mm-navbar">
        <div class="container-fluid px-0">
            <a class="navbar-brand ms-3" href="/client/dashboard">
                <i class="bi bi-wallet2 me-2"></i>Mobile Money
            </a>

            <div class="d-flex align-items-center gap-3 me-3">
                <?php if (! empty($client)): ?>
                    <span class="navbar-text d-none d-sm-inline text-white-50">
                        <i class="bi bi-person-circle me-1"></i><?= esc($client['telephone']) ?>
                    </span>
                    <a href="/client/logout" class="btn btn-outline-light btn-sm rounded-pill">
                        <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?= esc(session()->getFlashdata('success')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <small>Espace client Mobile Money</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
