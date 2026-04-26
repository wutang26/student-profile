<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Group Loan Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6fb;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            width: 240px;
            height: 100%;
            background: linear-gradient(180deg, #077973, #077973);
            color: #fff;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }

        /* ===== MAIN ===== */
        .main {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: #fff;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar .title {
            font-weight: 600;
        }

        .navbar .user {
            font-size: 14px;
            color: #555;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 25px;
            flex: 1;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .btn {
            background: #6c5ce7;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #5a4bd6;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fc;
            text-align: left;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #023447;
            text-align: center;
            padding: 12px;
            font-size: 13px;
            color: #888;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <h2>Loan Admin</h2>

    <a href="/groups"><i class="fas fa-users"></i> Groups</a>
    <a href="/group-loans/create"><i class="fas fa-hand-holding-dollar"></i> Issue Loan</a>
    <a href="#"><i class="fas fa-credit-card"></i> Repayments</a>
    <a href="#"><i class="fas fa-chart-line"></i> Reports</a>
</div>

<!-- ===== MAIN AREA ===== -->
<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="title">Group Loan System</div>
        <div class="user">
            <i class="fas fa-user-circle"></i> Admin
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} NAC Loan System — All rights reserved.
    </div>

</div>

</body>
</html>