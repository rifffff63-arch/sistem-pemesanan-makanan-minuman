<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Restoran App</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e1b4b, #2563eb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 30px 0;
        }

        .register-card {
            width: 460px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }

        .form-label {
            font-size: 14px;
            color: #4b5563;
            font-weight: 500;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #6b7280;
            padding-left: 15px;
            padding-right: 15px;
        }

        .form-control {
            border-radius: 0 14px 14px 0;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            border-color: #3b82f6;
            background-color: white;
        }

        .btn-register {
            border-radius: 14px;
            padding: 13px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(135deg, #3b82f6, #4f46e5);
            border: none;
            transition: all 0.3s;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.25);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(79, 70, 229, 0.35);
            background: linear-gradient(135deg, #2563eb, #4338ca);
        }

        .title {
            font-weight: 700;
            color: #1f2937;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
        }
        
        .alert-custom {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #dc2626;
            font-size: 14px;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="card register-card border-0">
    <div class="card-body p-5">
        
        <div class="text-center mb-4">
            <h2 class="title mb-1">Daftar Akun</h2>
            <p class="subtitle">Buat akun untuk mulai memesan makanan</p>
        </div>

        @if($errors->any())
            <div class="alert alert-custom mb-4" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required>
                </div>
            </div>

            <button type="submit" class="btn btn-register text-white w-100 mb-4">
                Daftar Akun Baru <i class="bi bi-person-plus ms-1"></i>
            </button>
            
            <div class="text-center">
                <span class="text-muted small">Sudah memiliki akun? </span>
                <a href="{{ route('login') }}" class="text-decoration-none small fw-bold text-primary">Masuk di sini</a>
            </div>
        </form>
        
    </div>
</div>

</body>
</html>