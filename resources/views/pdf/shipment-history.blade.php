<!DOCTYPE html>
<html>
<head>
    <title>Shipment History PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Shipment History</h2>

    <table>
        <thead>
            <tr>
                <th>No. Resi</th>
                <th>Tanggal Status</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Status</th>
                <th>Completed</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($history as $row)
                <tr>
                    <td>{{ $row->tracking_number }}</td>
                    <td>{{ $row->tanggal_status ? date('d-m-Y H:i', strtotime($row->tanggal_status)) : '-' }}</td>
                    <td>{{ $row->sender_name }}</td>
                    <td>{{ $row->receiver_name }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->completed_at ? date('d-m-Y H:i', strtotime($row->completed_at)) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>
</html>
