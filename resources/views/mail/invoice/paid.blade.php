<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Invoice Paid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .invoice-details {
            margin-top: 30px;
        }

        .invoice-details p {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }

        .invoice-details .amount {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quotation Paid</h1>
        <div class="invoice-details">
            <p><strong>Amount:</strong> ${{ $quotation->amount }}</p>
            <p>Qui i dettagli:</p>

            <ul>
                <li>Total Price: {{ $quotation->total_price }}</li>
                <li>Taxable Price: {{ $quotation->taxable_price }}</li>
                <li>Tax Price: {{ $quotation->tax_price }}</li>
            </ul>
        </div>
        <div class="footer">
            <p>Thank you for your payment.</p>
        </div>
    </div>
</body>

</html>
