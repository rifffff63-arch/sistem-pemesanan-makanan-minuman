<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f4f7fe;
            overflow-x:hidden;
        }

        /* SIDEBAR */
        .sidebar{
            width:260px;
            height:100vh;
            background:#111827;
            position:fixed;
            left:0;
            top:0;
            padding:30px 20px;
        }

        .logo{
            color:white;
            font-size:28px;
            font-weight:700;
            margin-bottom:40px;
        }

        .menu-title{
            color:#9ca3af;
            font-size:13px;
            margin-bottom:15px;
            text-transform:uppercase;
        }

        .sidebar a{
            display:block;
            color:#d1d5db;
            text-decoration:none;
            padding:14px 18px;
            border-radius:16px;
            margin-bottom:10px;
            transition:.3s;
            font-size:15px;
        }

        .sidebar a:hover{
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
            transform:translateX(5px);
        }

        .sidebar a i{
            margin-right:10px;
        }

        /* MAIN */
        .main{
            margin-left:260px;
        }

        /* TOPBAR */
        .topbar{
            background:white;
            height:80px;
            padding:20px 40px;
            box-shadow:0 5px 25px rgba(0,0,0,.05);
        }

        .profile{
            width:45px;
            height:45px;
            border-radius:50%;
            background:#2563eb;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:600;
        }

        /* CARD */
        .card{
            border:none;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .card:hover{
            transform:translateY(-5px);
            transition:.3s;
        }

        .content{
            padding:30px;
        }

        .welcome-card{
            border-radius:30px;
            background:linear-gradient(135deg,#2563eb,#7c3aed);
            color:white;
        }

    </style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        🍽 Food Order
    </div>

    <div class="menu-title">
        Main Menu
    </div>

    <a href="/">
        <i class="bi bi-grid"></i>
        Dashboard
    </a>

    <a href="{{ route('menu-items.index') }}">
        <i class="bi bi-cup-hot"></i>
        Menu Makanan
    </a>

    <a href="{{ route('food-orders.index') }}">
        <i class="bi bi-cart3"></i>
        Pesanan
    </a>

    <a href="#">
        <i class="bi bi-graph-up"></i>
        Laporan
    </a>

    <a href="#">
        <i class="bi bi-gear"></i>
        Pengaturan
    </a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <div>

            <h4 class="fw-bold mb-0">
                Dashboard
            </h4>

            <small class="text-muted">
                Sistem Pemesanan Makanan & Minuman
            </small>

        </div>

        <div class="d-flex align-items-center">

            <div class="me-3 text-end">

                <div class="fw-semibold">
                    User
                </div>

                <small class="text-muted">
                    User
                </small>

            </div>

            <div class="profile">
                A
            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        @yield('content')

    </div>

</div>

</body>
</html>