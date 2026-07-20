<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Espace Administrateur') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a365d;
            --primary-dark: #0f223d;
            --primary-light: #2c5282;
            --bg: #f0f2f5;
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f8f9fa;
            --text-muted: #6c757d;
            --accent: #4299e1;
        }

        body {
            background-color: var(--bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .op-navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
            min-height: 64px;
        }

        .op-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
        }

        .btn-logout {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: #ffffff !important;
            border-radius: 8px;
            padding: 0.4rem 1.2rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: #ffffff;
            color: #ffffff !important;
        }

        .sidebar {
            background-color: var(--sidebar-bg);
            border-right: 1px solid #e9ecef;
            min-height: calc(100vh - 64px);
            padding: 1.5rem 0;
        }

        .sidebar .nav-section {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0.75rem 1.5rem 0.5rem;
            font-weight: 600;
        }

        .sidebar a {
            color: #4a5568;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.85rem 1.5rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: var(--primary);
            border-left-color: var(--accent);
        }

        .sidebar a.active {
            background-color: #ebf8ff;
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .main-content {
            padding: 2rem;
            min-height: calc(100vh - 64px);
        }

        .page-header {
            margin-bottom: 1.75rem;
        }

        .page-header h2 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.25rem;
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
            box-shadow: 0 4px 8px rgba(26, 54, 93, 0.3);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg op-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/operateur/dashboard">
                <i class="bi bi-shield-lock-fill me-2"></i>Mobile Money - Admin
            </a>

            <div class="d-flex align-items-center gap-3">
                <a href="/operateur/logout" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <div class="nav-section">Menu principal</div>
                <a href="/operateur/dashboard" class="<?= isset($page) && $page === 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i>Tableau de bord
                </a>
                <a href="/operateur/prefixes" class="<?= isset($page) && $page === 'prefixes' ? 'active' : '' ?>">
                    <i class="bi bi-telephone"></i>Préfixes
                </a>
                <a href="/operateur/types_operations" class="<?= isset($page) && $page === 'types_operations' ? 'active' : '' ?>">
                    <i class="bi bi-diagram-3"></i>Types d'opérations
                </a>
                <a href="/operateur/baremes_frais" class="<?= isset($page) && $page === 'baremes_frais' ? 'active' : '' ?>">
                    <i class="bi bi-cash-stack"></i>Barèmes de frais
                </a>
            </nav>

            <main class="col-md-10 main-content">
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
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
