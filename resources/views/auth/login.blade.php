<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Restoran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background: linear-gradient(135deg,#4f46e5,#2563eb,#06b6d4);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            font-family:'Segoe UI',sans-serif;
        }

        .login-card{
            width:420px;
            border:none;
            border-radius:25px;
            background:rgba(255,255,255,.95);
            backdrop-filter:blur(15px);
            box-shadow:0 20px 40px rgba(0,0,0,.25);
        }

        .logo{
            width:90px;
            height:90px;
            border-radius:50%;
            background:linear-gradient(135deg,#2563eb,#4f46e5);
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            color:white;
            font-size:42px;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

        .input-group-text{
            border-radius:12px 0 0 12px;
            background:#f8f9fa;
        }

        .btn-login{
            border-radius:12px;
            padding:12px;
            font-weight:bold;
            font-size:17px;
            background:linear-gradient(135deg,#2563eb,#4f46e5);
            border:none;
            transition:.3s;
        }

        .btn-login:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(37,99,235,.3);
        }

        .title{
            font-weight:700;
            color:#2563eb;
        }

        .subtitle{
            color:#6c757d;
        }

    </style>

</head>
<body>

<div class="card login-card">

    <div class="card-body p-5">

        <div class="text-center mb-4">

            <div class="logo mb-3">
                <i class="bi bi-shop"></i>
            </div>

            <h2 class="title">
                Restoran App
            </h2>

            <p class="subtitle">
                Silakan login untuk melanjutkan
            </p>

        </div>

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST" action="{{ route('login.post') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email"
                        required>

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>

                </div>

            </div>

            <button class="btn btn-login text-white w-100">

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </button>

        </form>

        <hr>

        <div class="text-center text-muted">

            <small>
                Sistem Pemesanan Makanan & Minuman
            </small>

        </div>

    </div>

</div>

</body>
</html>