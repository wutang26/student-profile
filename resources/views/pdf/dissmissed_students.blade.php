<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dismissed Students Report</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 25px;
        }

        /* =========================
           HEADER
        ========================= */
        .header{
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1{
            margin: 0;
            font-size: 22px;
            color: #0f172a;
        }

        .header p{
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        /* =========================
           SUMMARY
        ========================= */
        .summary{
            margin-bottom: 20px;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .summary strong{
            color: #dc2626;
        }

        /* =========================
           TABLE
        ========================= */
        table{
            width: 100%;
            border-collapse: collapse;
        }

        thead{
            background: #1e3a8a;
            color: white;
        }

        th{
            padding: 10px;
            border: 1px solid #cbd5e1;
            text-align: left;
            font-size: 11px;
        }

        td{
            padding: 9px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        tbody tr:nth-child(even){
            background: #f8fafc;
        }

        /* =========================
           BADGE
        ========================= */
        .badge{
            display: inline-block;
            padding: 4px 8px;
            background: #fee2e2;
            color: #b91c1c;
            font-size: 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        /* =========================
           FOOTER
        ========================= */
        .footer{
            margin-top: 25px;
            text-align: right;
            font-size: 10px;
            color: #64748b;
        }

        /* =========================
            LOGO
            ========================= */
            .logo{
                width: 80px;
                height: auto;
                margin-bottom: 10px;
            }

    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
    <img 
    src="{{ public_path('assets/img/logo.png') }}" 
    alt="Logo"
    class="logo">  

    <h1>Dismissed Students Report</h1>
        <p>
            Generated on {{ now()->format('d M Y - H:i') }}
        </p>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        Total Dismissed Students:
        <strong>{{ $dismissedStudents->count() }}</strong>
    </div>

    @if($dismissedStudents->count())

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">S/N</th>
                    <th style="width: 20%;">Force Number</th>
                    <th style="width: 30%;">Student Name</th>
                    <th style="width: 30%;">Company</th>
                    <th style="width: 30%;">Platoon</th>
                    <th style="width: 30%;">Dismissal Reason</th>
                    <th style="width: 15%;">Dismissed On</th>
                </tr>
            </thead>

            <tbody>
                @foreach($dismissedStudents as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                          <td>
                            {{ $student->force_number ?? '-' }}
                        </td>

                        <td>
                            {{ $student->first_name }}
                            {{ $student->middle_name }}
                            {{ $student->last_name }}
                        </td>
                        <td>{{ $student->company }}</td>
                         <td>{{ $student->platoon }}</td>
                        <td>
                            {{ $student->dismiss_reason ?? 'No reason provided' }}
                        </td>

                        <td>
                            <span class="badge">
                                {{ $student->dismissed_at 
                                    ? \Carbon\Carbon::parse($student->dismissed_at)->format('d M Y')
                                    : '-' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p style="text-align:center; margin-top:40px; color:#64748b;">
            No dismissed students found.
        </p>

    @endif

    <!-- FOOTER -->
    <div class="footer">
        Tps Moshi - CCP
    </div>

</body>
</html>