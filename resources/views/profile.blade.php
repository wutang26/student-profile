<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fb 0%, #eef2ff 100%);
            color:#111827;
        }

        .wrapper{
            min-height:100vh;
            padding:50px 16px;
        }

        .container{
            max-width:1000px;
            margin:0 auto;
        }

        /* Header */
        .header{
            margin-bottom:24px;
        }

        .title{
            font-size:26px;
            font-weight:700;
            letter-spacing:-0.5px;
        }

        .subtitle{
            font-size:13px;
            color:#6b7280;
            margin-top:6px;
        }

        /* Cards */
        .card{
            background:#fff;
            border:1px solid #e5e7eb;
            border-radius:16px;
            padding:28px;
            box-shadow:0 18px 45px rgba(17,24,39,0.06);
            margin-bottom:18px;
            transition:0.2s;
        }

        .card:hover{
            transform:translateY(-2px);
            box-shadow:0 22px 55px rgba(17,24,39,0.08);
        }

        .danger{
            border:1px solid #fee2e2;
        }

        /* Inner content width */
        .inner{
            max-width:520px;
        }

        /* Optional top nav (minimal) */
        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .brand{
            font-weight:700;
            font-size:14px;
            color:#4f46e5;
        }

        .badge{
            font-size:12px;
            padding:6px 10px;
            border-radius:999px;
            background:#eef2ff;
            color:#4338ca;
            font-weight:600;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="container">

        <!-- TOP BAR -->
        <div class="topbar">
            <div class="brand">My Account</div>
            <div class="badge">Settings</div>
        </div>

        <!-- HEADER -->
        <div class="header">
            <div class="title">Profile Settings</div>
            <div class="subtitle">
                Manage your personal information, password, and account security
            </div>
        </div>

        <!-- PROFILE INFO -->
        <div class="card">
            <div class="inner">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="card">
            <div class="inner">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <!-- DELETE ACCOUNT -->
        <div class="card danger">
            <div class="inner">
                <livewire:profile.delete-user-form />
            </div>
        </div>

    </div>

</div>

</body>
</html>