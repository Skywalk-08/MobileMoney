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
            --text-muted: #6c757d;
            --accent: #3a7bbf;
            --success: #16a085;
            --warning: #d68910;
            --danger: #c0392b;
            --info: #2980b9;
            --border: #e2e8f0;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-700: #4a5568;
            --gray-800: #2d3748;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        body {
            background-color: var(--bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--gray-800);
        }

        .mm-navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 20px rgba(43, 92, 143, 0.15);
            padding: 0.85rem 0;
            min-height: 68px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .mm-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.3px;
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .mm-navbar .navbar-brand i {
            font-size: 1.5rem;
            opacity: 0.95;
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

        .btn-logout {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff !important;
            border-radius: 10px;
            padding: 0.5rem 1.4rem;
            font-weight: 600;
            transition: all 0.25s ease;
            backdrop-filter: blur(4px);
            font-size: 0.9rem;
        }

        .btn-logout:hover {
            background-color: #ffffff;
            border-color: #ffffff;
            color: var(--primary) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .main-content {
            padding: 2.25rem 0;
            min-height: calc(100vh - 68px - 80px);
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 2px solid var(--border);
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
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background: var(--white);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .card-header-custom {
            background-color: var(--white);
            border-bottom: 2px solid var(--border);
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
            box-shadow: 0 2px 8px rgba(43, 92, 143, 0.2);
            color: #ffffff;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(43, 92, 143, 0.3);
            color: #ffffff;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, var(--success) 0%, #1abc9c 100%);
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

        .btn-warning-custom {
            background: linear-gradient(135deg, var(--warning) 0%, #f39c12 100%);
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

        .btn-danger-custom {
            background: linear-gradient(135deg, var(--danger) 0%, #e74c3c 100%);
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

        .btn-outline-custom {
            border: 2px solid var(--border);
            border-radius: 10px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s ease;
            color: var(--gray-700);
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(43, 92, 143, 0.04);
            transform: translateY(-1px);
        }

        .btn-action {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.75rem;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: #ffffff;
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: var(--shadow-sm);
            padding: 1rem 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert i {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(22, 160, 133, 0.1) 0%, rgba(26, 188, 156, 0.1) 100%);
            color: #0d5f52;
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(192, 57, 43, 0.1) 0%, rgba(231, 76, 60, 0.1) 100%);
            color: #922b21;
            border-left: 4px solid var(--danger);
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(41, 128, 185, 0.1) 0%, rgba(52, 152, 219, 0.1) 100%);
            color: #2471a3;
            border-left: 4px solid var(--info);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(214, 137, 16, 0.1) 0%, rgba(243, 156, 18, 0.1) 100%);
            color: #9a6000;
            border-left: 4px solid var(--warning);
        }

        .form-control, .form-select {
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: var(--white);
            color: var(--gray-800);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(58, 123, 191, 0.12);
            background: var(--white);
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
            box-shadow: 0 0 0 4px rgba(43, 92, 143, 0.15);
            border-color: var(--primary);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
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
            border-bottom: 1px solid var(--gray-100);
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: var(--gray-50);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-custom {
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
            color: var(--gray-700);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .action-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        @media (min-width: 576px) {
            .action-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.25rem 0;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }

            .page-header {
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
            }

            .card {
                border-radius: 10px;
            }

            .table thead th,
            .table tbody td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
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
                    <a href="/client/logout" class="btn btn-logout">
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
