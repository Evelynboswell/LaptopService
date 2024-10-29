<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .no-border td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>Nota Penjualan Sparepart</h2>
    </div>
    <table class="invoice-table">
        <tr>
            <td>No Faktur   : </td>
            <td>{{ $transaksi_sparepart->invoice_number }}</td>
        </tr>
        <tr>
            <td>Teknisi     : </td>
            <td>{{ $transaksi_sparepart->technician->name }}</td>
        </tr>
        <tr>
            <td>Pelanggan   :</td>
            <td>{{ $transaksi_sparepart->customer->customer_name }}</td>
        </tr>
        <tr>
            <td>No. HP      :</td>
            <td>{{ $transaksi_sparepart->laptop->laptop_brand }}</td>
        </tr>
        <tr>
            <td>Total Price</td>
            <td>Rp {{ number_format($transaksi_sparepart->total_price, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Entry Date</td>
            <td>{{ $transaksi_sparepart->entry_date }}</td>
        </tr>
        <tr>
            <td>Takeout Date</td>
            <td>{{ $transaksi_sparepart->takeout_date }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $transaksi_sparepart->status }}</td>
        </tr>
    </table>
    <h3>Services</h3>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Price</th>
                <th>Warranty</th>
            </tr>
        </thead>
        <tbody>
            @foreach(json_decode($transaksi_sparepart->service_ids) as $serviceId)
            @php
                $service = $services->firstWhere('id_service', $serviceId);
            @endphp
            <tr>
                <td>{{ $service->service_name }}</td>
                <td>Rp {{ number_format($service->service_price, 2, ',', '.') }}</td>
                <td>{{ $service->warranty_range }} months</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
