<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Alfamart</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #d32f2f;
            --primary-hover: #b71c1c;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
            --bg-color: #f3f4f6;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --header-height: 70px;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            border-right: 1px solid rgba(0,0,0,0.05);
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.02);
            overflow-x: hidden;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            white-space: nowrap;
        }
        
        .sidebar.collapsed .sidebar-brand {
            padding: 0;
            justify-content: center;
        }
        
        .sidebar.collapsed .sidebar-brand span {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-brand i {
            margin: 0 !important;
            font-size: 1.5rem;
        }

        .sidebar-brand span {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
            letter-spacing: -0.5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            white-space: nowrap;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px 0;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        .sidebar.collapsed .nav-link i {
            margin: 0;
            font-size: 1.25rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background: rgba(211, 47, 47, 0.04);
        }

        .nav-link.active {
            color: var(--primary-color);
            background: rgba(211, 47, 47, 0.08);
            border-left-color: var(--primary-color);
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-right: 12px;
        }
        
        /* Header */
        .top-header {
            height: var(--header-height);
            background: white;
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 999;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: left 0.3s;
        }
        
        .sidebar.collapsed ~ .top-header {
            left: var(--sidebar-collapsed-width);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 32px;
            padding-top: calc(var(--header-height) + 32px);
            min-height: 100vh;
            transition: margin-left 0.3s;
        }
        
        .sidebar.collapsed ~ .main-wrapper {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Utility */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            background: white;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 20px 24px;
            font-weight: 600;
            border-radius: 16px 16px 0 0 !important;
        }

        .text-primary-brand {
            color: var(--primary-color) !important;
        }

        .btn-primary-brand {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }
        .btn-primary-brand:hover {
            background-color: var(--primary-hover);
            color: white;
        }
        
        .toggle-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-wrapper {
                margin-left: 0;
                padding: 16px;
                padding-top: calc(var(--header-height) + 16px);
            }
            .top-header {
                left: 0;
                padding: 0 16px;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-building me-2 fs-4 text-primary-brand"></i>
        <span>Admin Panel</span>
    </div>
    
    <div class="py-3">
        <small class="text-uppercase text-muted px-4 mb-2 d-block fw-bold section-title" style="font-size: 0.75rem;">Main Menu</small>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" title="Dashboard">
                    <i class="bi bi-grid-1x2"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mt-auto border-top p-3">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-100 text-danger border-0 bg-transparent" title="Sign Out">
                <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span>
            </button>
        </form>
    </div>
</nav>

<!-- Header -->
<header class="top-header">
    <div class="d-flex align-items-center">
        <button class="toggle-btn me-3 d-none d-md-block" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <button class="toggle-btn me-3 d-md-none" onclick="document.querySelector('.sidebar').classList.toggle('show')">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="mb-0 fw-bold">@yield('header_title', 'Admin Dashboard')</h5>
    </div>
    
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    A
                </div>
                <span class="d-none d-sm-inline fw-medium">Administrator</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownUser1">
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Content -->
<div class="main-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        // Save preference functionality could be added here
    }
</script>
@stack('scripts')
</body>
</html>
