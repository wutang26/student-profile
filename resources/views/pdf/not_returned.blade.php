<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Not Returned Items Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 25px;
            color: #1e293b;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        .summary {
            background: #f8fafc;
            padding: 10px;
            border: 1px solid #e2e8f0;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #dc2626;
            color: white;
            padding: 10px;
            font-size: 11px;
            text-align: left;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 8px;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .badge {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
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

    <div class="header">
          <img 
    src="{{ public_path('assets/img/logo.png') }}" 
    alt="Logo"
    class="logo">

        <h1>Not Returned Items Report</h1>
        <p>Generated on {{ now()->format('d M Y H:i') }}</p>
    </div>

    <div class="summary">
        Total Not Returned Items:
        <strong>{{ $unreturned_items->count() }}</strong>
    </div>

    @if($unreturned_items->count())

    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Force No</th>
                <th>Borrower</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Company</th>
                <th>Borrow Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($unreturned_items as $unreturned_item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $unreturned_item->force_number }}</td>
                <td>{{ $unreturned_item->borrower_name }}</td>
                <td>{{ $unreturned_item->item->name ?? '-' }}</td>
                <td>{{ $unreturned_item->quantity }}</td>
                <td>{{ $unreturned_item->company }}</td>
                <td>{{ \Carbon\Carbon::parse($unreturned_item->borrow_date)->format('d M Y') }}</td>
                <td>
                    <span class="badge">Not Returned</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else
        <p style="text-align:center;">No pending items found.</p>
    @endif

    <div class="footer">
        Inventory System Report
    </div>

</body>
</html>