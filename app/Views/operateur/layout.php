<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Espace Opérateur') ?></title>
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
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .op-navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 20px rgba(26, 54, 93, 0.15);
            padding: 0.85rem 0;
            min-height: 68px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .op-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: -0.3px;
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .op-navbar .navbar-brand i {
            font-size: 1.5rem;
            opacity: 0.95;
        }

        .btn-logout {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff !important;
            border-radius: 10px;
            padding: 0.5rem 1.4rem;
            font-weight: 600;
            transition: all 0.25s ease;
            backdrop-filter: blur(4px);
        }

        .btn-logout:hover {
            background-color: #ffffff;
            border-color: #ffffff;
            color: var(--primary) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .sidebar {
            background-color: var(--sidebar-bg);
            border-right: 1px solid #e2e8f0;
            min-height: calc(100vh - 68px);
            padding: 1.5rem 0;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.02);
        }

        .sidebar .nav-section {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            padding: 1rem 1.75rem 0.6rem;
            font-weight: 700;
            margin-top: 0.5rem;
        }

        .sidebar .nav-section:first-child {
            margin-top: 0;
        }

        .sidebar a {
            color: #4a5568;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.9rem 1.75rem;
            font-weight: 500;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
            margin: 0.15rem 0;
            border-radius: 0;
            font-size: 0.95rem;
        }

        .sidebar a i {
            width: 22px;
            text-align: center;
            margin-right: 0.85rem;
            font-size: 1.15rem;
            opacity: 0.75;
            transition: opacity 0.2s ease;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: var(--primary);
            border-left-color: var(--accent);
            text-decoration: none;
        }

        .sidebar a:hover i {
            opacity: 1;
            color: var(--accent);
        }

        .sidebar a.active {
            background: linear-gradient(90deg, rgba(66, 153, 225, 0.08) 0%, transparent 100%);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
            box-shadow: inset 0 0 12px rgba(66, 153, 225, 0.04);
        }

        .sidebar a.active i {
            opacity: 1;
            color: var(--primary);
        }

        .main-content {
            padding: 2.25rem;
            min-height: calc(100vh - 68px);
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .page-header h2 {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.35rem;
            font-size: 1.75rem;
            letter-spacing: -0.3px;
        }

        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .page-header .breadcrumb-item a {
            color: var(--accent);
            text-decoration: none;
        }

        .page-header .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background: #ffffff;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            border-radius: 14px 14px 0 0 !important;
            padding: 1.25rem 1.75rem;
            font-weight: 600;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.75rem;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(26, 54, 93, 0.2);
            color: #ffffff;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(26, 54, 93, 0.3);
            color: #ffffff;
        }

        .btn-outline-custom {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s ease;
            color: #4a5568;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(26, 54, 93, 0.04);
            transform: translateY(-1px);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #16a085 0%, #1abc9c 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.75rem;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(22, 160, 133, 0.2);
            transition: all 0.25s ease;
        }

        .btn-success-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22, 160, 133, 0.3);
            color: #ffffff;
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.75rem;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(231, 76, 60, 0.2);
            transition: all 0.25s ease;
        }

        .btn-danger-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(231, 76, 60, 0.3);
            color: #ffffff;
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, #d68910 0%, #f39c12 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.75rem;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(243, 156, 18, 0.2);
            transition: all 0.25s ease;
        }

        .btn-warning-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(243, 156, 18, 0.3);
            color: #ffffff;
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            padding: 1rem 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert i {
            font-size: 1.25rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(22, 160, 133, 0.1) 0%, rgba(26, 188, 156, 0.1) 100%);
            color: #0d5f52;
            border-left: 4px solid #16a085;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(192, 57, 43, 0.1) 0%, rgba(231, 76, 60, 0.1) 100%);
            color: #922b21;
            border-left: 4px solid #c0392b;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(66, 153, 225, 0.1) 0%, rgba(52, 152, 219, 0.1) 100%);
            color: #2471a3;
            border-left: 4px solid #2980b9;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #ffffff;
            color: #2d3748;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.12);
            background: #ffffff;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 4px rgba(26, 54, 93, 0.15);
            border-color: var(--primary);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: #ffffff;
        }

        .table thead th {
            font-weight: 600;
            padding: 1rem 1.25rem;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
            border-bottom: none;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-status {
            padding: 0.45rem 0.85rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 0.2px;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3.5rem;
            opacity: 0.3;
            margin-bottom: 1rem;
            display: block;
        }

        .empty-state h5 {
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }

            .main-content {
                padding: 1.25rem;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg op-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/operateur/dashboard">
                <i class="bi bi-wallet2 me-2"></i>Mobile Money - Opérateur
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
                <a href="/operateur/autres_operateurs" class="<?= isset($page) && $page === 'autres_operateurs' ? 'active' : '' ?>">
                    <i class="bi bi-people"></i>Autres opérateurs
                </a>
                <a href="/operateur/gains" class="<?= isset($page) && $page === 'situation_gain' ? 'active' : '' ?>">
                    <i class="bi bi-graph-up"></i>Situation des gains
                </a>
                <a href="/operateur/montants_externes" class="<?= isset($page) && $page === 'situation_externe' ? 'active' : '' ?>">
                    <i class="bi bi-cash-coin"></i>Montants à envoyer
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
