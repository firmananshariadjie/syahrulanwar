<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        .signatures {
            width: 100%;
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
        }
        .signature-box img {
            width: 150px; /* sesuaikan ukuran tanda tangan */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Invoice {{ $invoice->invoice_number }}</h2>
        <p>Status: {{ ucfirst($invoice->status) }}</p>
    </div>

    @foreach ($invoice->travels as $travel)
        <h3>{{ $travel->travel_name }}</h3>
        <!-- <p>Subtotal (SAR): {{ number_format($travel->pivot->subtotal, 0, ',', '.') }}</p> -->

        <table class="table">
            <thead>
                <tr>
                    <th>Group Name</th>
                    <th>PAX</th>
                    <th>Add PAX</th>
                    <th>FEE C/IN-OUT</th>
                    <th>TOTAL SNACK & TOTAL SAR</th>
                    <th>Bill Total (SAR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($travel->groups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->quota }}</td>
                        <td>{{ $group->bill->quota_add }}</td>
                        <td>{{ $group->bill?->fee_in_out }}</td>
                        <td>{{ ($group->quota + $group->bill->quota_add) }} Pax X {{ $group->bill->trip}} Trip = <br/> 
                        {{ ($group->quota + $group->bill->quota_add) * ($group->bill?->trip ?? 0) }} Pax X {{ $group->bill->fee_snack }} SAR = <br/>
                         {{ ($group->quota + $group->bill->quota_add) * ($group->bill?->trip ?? 0) * $group->bill->fee_snack }}</td>
                        <td>{{ number_format($group->bill?->total ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
    <h3>Total Invoice:</h3>
    <ul>
        <li><strong>Total (SAR):</strong> {{ number_format($invoice->total_amount, 0, ',', '.') }}</li>
        <li><strong>Kurs (IDR):</strong> {{ number_format($invoice->kurs, 0, ',', '.') }}</li>
        <li><strong>Total (IDR):</strong> {{ number_format($invoice->total_amount * $invoice->kurs, 0, ',', '.') }}</li>
    </ul>
     <!-- Signature Section -->
    <table style="width: 100%; margin-top: 50px;">
        <tr>
            <td style="text-align: center; vertical-align: bottom;">
                <img src="{{ public_path('images/image.png') }}" alt="Tanda Tangan Syahrul" style="width: 150px; height: auto;">
                <p>(Syahrul Anwar Datu)</p>                
            </td>                
                <p style="margin-top: 80px;">({{ $invoice->travels->first()->travel_name ?? '' }})</p>
            <td style="text-align: center; vertical-align: bottom;">
                
            </td>
        </tr>
    </table>

</body>
</html>
