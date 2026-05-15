<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Unreturned Items Report</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 25px;
            line-height: 1.5;
        }

        /* =========================
           HEADER
        ========================= */
        .header{
            text-align: center;
            border-bottom: 3px solid #b91c1c;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .logo{
            width: 85px;
            margin-bottom: 8px;
        }

        .system-name{
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
            margin: 0;
        }

        .report-title{
            font-size: 18px;
            color: #b91c1c;
            margin-top: 5px;
            font-weight: bold;
        }

        .report-date{
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }

        /* =========================
           SUMMARY BOX
        ========================= */
        .summary-box{
            background: #f8fafc;
            border-left: 5px solid #dc2626;
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .summary-title{
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .summary-value{
            font-size: 24px;
            font-weight: bold;
            color: #b91c1c;
        }

        /* =========================
           TABLE
        ========================= */
        table{
            width: 100%;
            border-collapse: collapse;
        }

        thead th{
            background: #b91c1c;
            color: white;
            padding: 12px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            text-align: left;
        }

        tbody td{
            border: 1px solid #e2e8f0;
            padding: 10px;
            font-size: 11px;
        }

        tbody tr:nth-child(even){
            background: #f8fafc;
        }

        tbody tr:hover{
            background: #f1f5f9;
        }

        /* =========================
           STATUS BADGE
        ========================= */
        .badge{
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }

        /* =========================
           EMPTY STATE
        ========================= */
        .empty{
            text-align: center;
            padding: 30px;
            border: 1px dashed #cbd5e1;
            color: #64748b;
            margin-top: 20px;
            border-radius: 8px;
        }

        /* =========================
           FOOTER
        ========================= */
        .footer{
            margin-top: 40px;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
            font-size: 10px;
            color: #64748b;
        }

        .footer-left{
            float: left;
        }

        .footer-right{
            float: right;
        }

        .clearfix::after{
            content: "";
            display: block;
            clear: both;
        }

        /* =========================
   TOP ACTIONS
========================= */
.top-actions{
    width: 100%;
    margin-bottom: 15px;
    text-align: right;
}

.download-btn{
    display: inline-block;
    background: #b91c1c;
    color: #ffffff;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: bold;
    transition: 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.12);
}

.download-btn:hover{
    background: #991b1b;
}

    </style>
</head>

<body>

<!-- DOWNLOAD BUTTON -->
<div class="top-actions">
    <a href="{{ route('reports.unreturned.download') }}" class="download-btn">
    ⬇ Download PDF
</a>
</div>
    <!-- HEADER -->
    <div class="header">

       <img 
    src="{{ asset('assets/img/logo.png') }}" 
    alt="Logo"
    class="logo">

        <h1 class="system-name">
            Tanzania Police Service
        </h1>

        <div class="report-title">
            Unreturned Items Report
        </div>

        <div class="report-date">
            Generated on {{ now()->format('d M Y • H:i A') }}
        </div>

    </div>

    <!-- SUMMARY -->
    <div class="summary-box">
        <div class="summary-title">
            TOTAL UNRETURNED ITEMS
        </div>

        <div class="summary-value">
            {{ $unreturned_items->count() }}
        </div>
    </div>

    @if($unreturned_items->count())

    <!-- TABLE -->
    <table>

        <thead>
            <tr>
                <th>S/N</th>
                <th>Force No</th>
                <th>Borrower</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Company</th>
                <th>Borrow Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($unreturned_items as $unreturned_item)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $unreturned_item->force_number }}
                </td>

                <td>
                    {{ $unreturned_item->borrower_name }}
                </td>

                <td>
                    {{ $unreturned_item->item->name ?? '-' }}
                </td>

                <td>
                    {{ $unreturned_item->quantity }}
                </td>

                <td>
                    {{ $unreturned_item->company }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($unreturned_item->borrow_date)->format('d M Y') }}
                </td>

                <td>
                    <span class="badge">
                        NOT RETURNED
                    </span>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

    @else

    <div class="empty">
        No pending unreturned items found.
    </div>

    @endif

    <!-- FOOTER -->
    <div class="footer clearfix">

        <div class="footer-left">
            Tps Moshi CCP
        </div>

        <div class="footer-right">
            Page 1
        </div>

    </div>

</body>
</html>