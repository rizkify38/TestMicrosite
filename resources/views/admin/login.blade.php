<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alfamart Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: white;
            padding: 48px;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .btn-primary-brand {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-primary-brand:hover {
            background-color: #b71c1c;
            transform: translateY(-1px);
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .form-control:focus {
            background-color: white;
            border-color: #d32f2f;
            box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.1);
        }
        
        .brand-icon {
            color: #d32f2f;
            font-size: 3rem;
            margin-bottom: 1rem;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <div class="mb-4">
        <i class="bi bi-shield-lock-fill brand-icon"></i>
        <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
        <p class="text-muted small">Please sign in to access the dashboard</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger bg-danger-subtle text-danger border-0 rounded-3 text-start small mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST" class="text-start">
        @csrf
        <div class="mb-4">
            <label for="email" class="form-label text-muted small fw-bold text-uppercase">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 border text-muted rounded-start-3 ms-0 ps-3"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control border-start-0 ps-2" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label text-muted small fw-bold text-uppercase">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 border text-muted rounded-start-3 ms-0 ps-3"><i class="bi bi-key"></i></span>
                <input type="password" class="form-control border-start-0 ps-2" id="password" name="password" placeholder="••••••••" required>
            </div>
        </div>
        <!-- <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" style="cursor: pointer;">
                <label class="form-check-label small text-muted user-select-none" for="remember" style="cursor: pointer;">Remember me</label>
            </div>
        </div> -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary-brand shadow-sm">
                Sign In
            </button>
        </div>
    </form>
    
    <div class="mt-4 pt-4 border-top">
        <small class="text-muted">&copy; {{ date('Y') }} Promo Murah ABC</small>
    </div>
</div>

</body>
</html>
