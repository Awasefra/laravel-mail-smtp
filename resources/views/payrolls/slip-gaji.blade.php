<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Slip</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin: 10px;
        }
        .title {
            font-size: 24px;
            margin-top: 10px;
            color: #337ab7;
        }
        .details, .salary-info {
            margin-bottom: 20px;
        }
        .details td, .salary-info td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .salary-info {
            border-collapse: collapse;
            width: 100%;
        }
        .salary-info th, .salary-info td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 10px;
        }
        .total {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .signature {
            margin-top: 30px;
            text-align: right;
        }
        .icon {
            font-size: 18px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('path/to/your/logo.png') }}" alt="Company Logo">
            <div class="title">Payroll Slip <i class="icon fa fa-file-text"></i></div>
        </div>
        <div class="details">
            <table>
                <tr>
                    <td><strong>Nama Karyawan:</strong> {{ $employee_name }} <i class="icon fa fa-user"></i></td>
                </tr>
                <tr>
                    <td><strong>Posisi:</strong> {{ $position }} <i class="icon fa fa-briefcase"></i></td>
                </tr>
            </table>
        </div>
        <div class="salary-info">
            <table>
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gaji Pokok <i class="icon fa fa-money"></i></td>
                        <td>{{ number_format($basic_salary, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Tunjangan <i class="icon fa fa-gift"></i></td>
                        <td>{{ number_format($allowance, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Potongan <i class="icon fa fa-minus"></i></td>
                        <td>{{ number_format($deduction, 2) }}</td>
                    </tr>
                    <tr class="total">
                        <td>Total Gaji <i class="icon fa fa-calculator"></i></td>
                        <td>{{ number_format($basic_salary + $allowance - $deduction, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="signature">
            <p>______________________________</p>
            <p><em>Tanda Tangan</em></p>
        </div>
    </div>
</body>
</html>