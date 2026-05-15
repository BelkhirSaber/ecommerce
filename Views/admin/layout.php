<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?? 'Admin Dashboard' ?> | B3S Store</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/<?= RACINE ?>/assets/css/admin/main.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/<?= RACINE ?>/admin/dashboard" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/<?= RACINE ?>/" target="_blank" class="nav-link">Voir le site</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">3 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-shopping-cart mr-2"></i> 2 nouvelles commandes
                    </a>
                </div>
            </li>
            <!-- User Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="/<?= RACINE ?>/admin/profile" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Mon profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/<?= RACINE ?>/logout" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/<?= RACINE ?>/admin/dashboard" class="brand-link">
            <img src="/<?= RACINE ?>/assets/images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" onerror="this.style.display='none'">
            <span class="brand-text font-weight-light">B3S Store Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/dashboard" class="nav-link <?= $_SERVER['REQUEST_URI'] == '/'.RACINE.'/admin/dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Produits -->
                    <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/products') !== false || strpos($_SERVER['REQUEST_URI'], '/admin/categories') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Catalogue
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/<?= RACINE ?>/admin/products" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produits</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/<?= RACINE ?>/admin/categories" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Catégories</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Commandes -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/orders" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Commandes
                                <span class="badge badge-info right">5</span>
                            </p>
                        </a>
                    </li>

                    <!-- Clients -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/customers" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Clients</p>
                        </a>
                    </li>

                    <!-- Coupons -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/coupons" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Coupons</p>
                        </a>
                    </li>

                    <!-- Analytics -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/analytics" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Analytics</p>
                        </a>
                    </li>

                    <!-- Paramètres -->
                    <li class="nav-item">
                        <a href="/<?= RACINE ?>/admin/settings" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Paramètres</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $pageTitle ?? 'Dashboard' ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/<?= RACINE ?>/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><?= $pageTitle ?? 'Dashboard' ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &​copy; 2024 <a href="#">B3S Store</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Custom JS -->
<script src="/<?= RACINE ?>/assets/js/admin-custom.js"></script>
</body>
</html>