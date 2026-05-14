<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Returned Items Report</title>

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
            color: #166534;
        }

        /* =========================
           TABLE
        ========================= */
        table{
            width: 100%;
            border-collapse: collapse;
        }

        thead{
            background: #1d4ed8;
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
           STATUS BADGES
        ========================= */
        .badge-returned{
            display: inline-block;
            padding: 4px 8px;
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .badge-borrowed{
            display: inline-block;
            padding: 4px 8px;
            background: #fef3c7;
            color: #92400e;
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

    <h1>Returned Items Report</h1>

        <p>
            Generated on {{ now()->format('d M Y - H:i') }}
        </p>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        Total Records:
        <strong>{{ $records->count() }}</strong>
    </div>

    @if($records->count())

    <table>

        <thead>
            <tr>
                <th style="width:5%">S/N</th>
                <th style="width:12%">Force No</th>
                <th style="width:18%">Borrower</th>
                <th style="width:18%">Item</th>
                <th style="width:7%">Qty</th>
                <th style="width:12%">Company</th>
                <th style="width:14%">Borrow Date</th>
                <th style="width:14%">Return Date</th>
                <th style="width:10%">Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($records as $r)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $r->force_number }}
                </td>

                <td>
                    {{ $r->borrower_name }}
                </td>

                <td>
                    {{ $r->item->name ?? '-' }}
                </td>

                <td>
                    {{ $r->quantity }}
                </td>

                <td>
                    {{ $r->company }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($r->borrow_date)->format('d M Y') }}
                </td>

                <td>
                    {{ $r->return_date 
                        ? \Carbon\Carbon::parse($r->return_date)->format('d M Y')
                        : '-' }}
                </td>

                <td>
                    @if($r->status == 'returned')

                        <span class="badge-returned">
                            Returned
                        </span>

                    @else

                        <span class="badge-borrowed">
                            Borrowed
                        </span>

                    @endif
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    @else

        <p style="text-align:center; margin-top:40px; color:#64748b;">
            No returned item records found.
        </p>

    @endif

    <!-- FOOTER -->
    <div class="footer">
       Tps Moshi CCP
    </div>

</body>
</html>